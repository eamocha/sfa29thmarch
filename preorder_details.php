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
	
		 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     
  <script>
  $(document).ready(function(e) {
	 $("#prod_div").hide();
	  var oid=<?php echo $oid?>;
	  //	var returned=	order_source_selected(oid);
		//if(returned==0){  $("#prod_div").hide();} else if(returned==1){ $("#kingbev").attr("checked='checked'"); $("#prod_div").show();} else if(returned==2){ $("#stockist").attr("checked='checked'"); $("#prod_div").show();}

    $(".source").click( function(){
		var oid=<?php echo $oid?>;
		var selected=$(this).attr("id")
		
		 $.ajax(
		 {
		 type:'POST', data:{'selected':selected,'mode':'source_of_prod','oid':oid}, url:"read.php",cache:false,success: function(data)
		 {
			 $("#prod_div").show();
		 }
		 }); //ajax
		 });//click
});
  
        </script>
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
                         <h3 class="float_left">Order Generation </h3>
                      </div>
                      <table><tr><td width="166"><input type="radio" class="source" id="stockist" name="source"> <strong>From Stockist</strong></td>
                        <td width="28">&nbsp;</td>
                      <td width="141"><input id="kingbev" class="source" name="source" type="radio"> <strong>From King Bev</strong></td></tr></table>
                 <div id="products-wrapper">
  
    
    <?php
    //current URL of the Page. cart_update.php redirects back to this URL
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
	$results = $mysqli->query("SELECT * FROM `tbl_products` ORDER BY `product_name` asc");
    if ($results) { 
	?><div id="prod_div" style="display:inline-block; width:60% "  ><table class="product table table-bordered table-striped table-condensed"><tr><th>SKU</th><th>Qty Required</th><th>Qty Supplied(<?php echo $currency?>)</th></tr>
	<?php
        //fetch results set as object and output HTML
        while($obj = $results->fetch_object())
        {?>
			<tr>
            <form method="post" action="cart_update.php">
			<td><div class="product-content"><?php echo  $obj->product_name.' '.$obj->product_code.' - '.$obj->brand?></td>
			<td><div class="product-thumb"><input type="text" name="required" value="0" size="3" /></div></td>
     
        <td><div class="product-info">
			<input type="text" name="product_qty" value="0" size="3" />
            <button class="add_to_cart btn-success btn-xs ">Add</button>
		</div></div>
            <input type="hidden" name="product_code" value="<?php echo $obj->product_code?>" />
			<input type="hidden" name="product_id" value="<?php echo $obj->product_id?>" />
           <input type="hidden" name="type" value="add" />
           <input type="hidden" name="dealer_id" value="<?php echo $did?>" />
			<input type="hidden" name="order_id" value="<?php echo  $oid?>" />
			<input type="hidden" name="return_url" value="<?php echo $current_url?>" />
          </td></form>
            </tr><?php 
        }
       }
	   else{
		   $mysqli->error;}
    ?></table>
    </div>
    
<div class="shopping-cart" style="float:right">
<h2><?php echo business_name($did)?> Order: <?php echo $did .'-'. $oid ?></h2>
<?php
$fetch_ord=mysqli_query($mysqli,"SELECT p.product_name as pname,p.product_id as pid, brand, order_details_id as id,s_price as price,product_code as code,pieces as qty,cases as req FROM `tbl_orders_details` o left join tbl_products p on p.product_id=o.product_id WHERE order_id=".$oid." and o.status=0") or die(mysqli_error($mysqli));
if(mysqli_num_rows($fetch_ord)!=0)
{
    $total = 0;
	
	?><table><tr><td><form name="dd" action="cart_update.php?order_id=<?php echo $oid?>&&return_url='<?php echo $current_url?>" method="POST"> <input placeholder="select due Date" class="form-control form-control-inline input-medium default-date-picker" name="delivery_date" size="16" type="text" value="<?php $select_query=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` WHERE `order_id`=$oid and date(date_due)>DATE(NOW())")or die(mysqli_error($mysqli));  if(mysqli_num_rows($select_query)==0){ echo date("d-m-Y");} else{ $date_row=mysqli_fetch_array($select_query); echo date("d-m-Y",strtotime($date_row['date_due']));}?>"> </td><td  valign="top"><input name="submit_delivery_date" class="add_to_cart btn-success " type="submit" value="Go"></form></div></td></tr></table>
   <ol><?php
    while ($pr=mysql_fetch_array($fetch_ord))
    {
        ?><li class="cart-itm">
        <span class="remove-itm"><a href="cart_update.php?removep=<?php echo $pr["id"]?>&return_url=<?php echo $current_url?>">&times;</a></span>
        <h3> <?php echo $pr["pname"]. ' '.$pr["code"].' '.$pr['brand']?></h3>
        <div class="p-qty">Req : <?php echo $pr["req"]?></div>
		<div class="p-qty">Sup :  <?php echo $pr["qty"]?></div>
		 <?php $preorder=$pr["req"]-$pr["qty"];?>
		<div class="p-qty">Preorded : <?php echo $preorder?></div>
       <div class="p-price">Price : <?php echo $currency.$pr["price"]?> <span class="float_right">
	    <?php echo 	$currency.''.$pr["price"]*$preorder?>
	   <span></div>
        </li> <?php  
        $subtotal = ($pr["price"]*$preorder);
        $total = ($total + $subtotal);
    }
    ?>
    </ol>
	<div><strong>Total :  <?php echo $currency.$total?></strong> </div>
    <div><span class="empty-cart"><a href="cart_update.php?emptycart=1&oid= <?php echo $oid?>&return_url= <?php echo $current_url?>">Cancel Order</a></span><span class="check-out-txt"><a href="delivery_receipt.php?dealer_id= <?php echo $did?>&oid= <?php echo $oid?>">Check-out!</a></div>
	
	<div><span class="check-out-txt"> <a href="preorder.php?dealer_id= <?php echo $did?>&oid= <?php echo $oid?>">preorder</a></span> </div>
 <?php  }else{
    echo 'The order list is empty';
}
//print_r($_SESSION['products']);
?>
   <a href="routes.php" class="btn btn-success">Close Call</a> 
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

	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    


	

	
	
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	


    
  </body>
</html>
