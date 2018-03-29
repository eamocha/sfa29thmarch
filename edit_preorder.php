<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" /> <?php require 'header.php'; 
	$did=clean($_REQUEST['dealer_id']);
 $oid=clean($_REQUEST['order_id']); 
	//order name
		 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     
  
  </head>
  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
         <?php include 'notifications.php'?>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** --> <!--sidebar start
      <aside>
          <?php //include 'side_menu.php'?>
      </aside>
      sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php');?>
                         <h3 class="float_left">Make Preorder </h3>
                      </div>
                      
                 <div id="products-wrapper">
  
    <div class="products">
    <?php
    //current URL of the Page. cart_update.php redirects back to this URL
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
	$results = $mysqli->query("SELECT * FROM `tbl_products` ORDER BY `product_name` ASC");
    if ($results) { 
	
        //fetch results set as object and output HTML
        while($obj = $results->fetch_object())
        {
			echo '<table class="product"><tr>'; 
            echo '<form method="post" action="cart_update.php">';
			echo '<td><div class="product-thumb"><img src="images/'.$obj->product_img_name.'"></div>';
            echo '<div class="product-content"><h3>'.$obj->product_name.'</h3>';
            echo '<div class="product-desc">'.$obj->product_desc.'</div>';
            echo '<div class="product-info">';
			echo '@ '.$currency.$obj->s_price.' | ';
            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
			echo '<button class="add_to_cart btn-success btn-xs ">Add</button>';
			echo '</div></div>';
            echo '<input type="hidden" name="product_code" value="'.$obj->product_code.'" />';
			echo '<input type="hidden" name="product_id" value="'.$obj->product_id.'" />';
            echo '<input type="hidden" name="type" value="add" />';
            echo '<input type="hidden" name="dealer_id" value="'.$did.'" />';
			echo '<input type="hidden" name="order_id" value="'.$oid.'" />';
			echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</td></form>';
            echo '</tr></table>';
        }
       }
	   else{
		   $mysqli->error;}
    ?>
    </div>
    
<div class="shopping-cart">
<h2><?php echo business_name($did)?> Order: <?php echo $did .'-'. $oid ?></h2>
<?php
$fetch_ord=mysql_query("SELECT p.product_name as pname,p.product_id as pid, order_details_id as id,s_price as price,product_code as code,quantity as qty FROM `tbl_orders_details` o left join tbl_products p on p.product_id=o.product_id WHERE order_id=$oid and o.status=0") or die(mysql_error());
if(mysql_num_rows($fetch_ord)!=0)
{
    $total = 0;
	
	echo '<table><tr><td><form name="dd" action="cart_update.php?order_id='.$oid.'&&return_url='.$current_url.'" method="POST"> <input placeholder="select due Date" class="form-control form-control-inline input-medium default-date-picker" name="delivery_date" size="16" type="text" value=""> </td><td  valign="top"><input name="submit_delivery_date" class="add_to_cart btn-success " type="submit" value="Go"></form></div></td></tr></table>';
    echo '<ol>';
    while ($pr=mysql_fetch_array($fetch_ord))
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$pr["id"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$pr["pname"].'</h3>';
        echo '<div class="p-code">P code : '.$pr["code"].'</div>';
        echo '<div class="p-qty">Qty : '.$pr["qty"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$pr["price"].' <span class="float_right">';
	   echo	$currency.''.$pr["price"]*$pr["qty"]; 
	    echo	'<span></div>';
        echo '</li>';
        $subtotal = ($pr["price"]*$pr["qty"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
	echo '<div><strong>Total : '.$currency.$total.'</strong> </div>';
    echo '<div><span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Cancel Order</a></span><span class="check-out-txt"><a href="">Save</a></span></div>';
	
	echo '<div><span class="check-out-txt"> <a href="view_cart.php">Check-out!</a></span> </div>';
}else{
    echo 'The order list is empty';
}
//print_r($_SESSION['products']);
?>
</div>
    
</div>
 
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
  /*      $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to King Beverage DMS!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Developed by cloud connect',
            // (string | optional) the image to display on the left
            image: 'assets/img/eric.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	*/</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "fetch_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
      







 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
