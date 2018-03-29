<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php'; 
	$did=clean($_REQUEST['dealer_id']);
	$oid=clean($_REQUEST['oid']); 
	$uid=$_SESSION['u_id'];
	if(isset($_REQUEST['deliver'])){
		$q=mysqli_query($mysqli,"UPDATE `tbl_orders_details` SET `status`=1 ,supplied_by=$uid,date_supplied='$today_constant' WHERE `order_id`=$oid") or die(mysqli_error($mysqli)); 
		if($q){
	$q=mysqli_query($mysqli,"UPDATE `tbl_orders` SET `status`=1,`supplied_by`=".$uid.",date_supplied='".$today_constant."' WHERE `order_id`=$oid") or die(mysqli_error($mysqli));}
	else echo 'Wrong detils';
		}
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <style>
     #address{
		
		 background-color:#FFF;
		 width:100%;}
         #address tr td{ text-transform:capitalize; font-size:10px; padding:5px; padding-bottom:0px;
		 }</style>
      
  
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
                         <h3 class="float_left">Order Details <a href="preorder_details.php?dealer_id=<?php echo $did?>&order_id=<?php echo $oid?>">Click to edit</a></h3>
                      </div>
                      
                  <div  style="padding-bottom:20px" class="float_left">
                 
                  </div>
                   <!--start -->           
                  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                               <tr>
                                  <th width="34">Code</th>
                                  <th width="374">SKU</th>
                                   <th width="374">Pack</th>
                                    <th width="374">Type</th>
                                  <th width="150">Quantity</th>
                                  
                                  <th width="146" >Date ordered</th> <th width="120" class="numeric">Price(Ksh)</th>
                                  
                              </tr>
                             </thead>
                             <tbody><?php $oid_of_order=0; $i=1; $status=0; $date_supplied=date("Y-m-d");$sub_t=0;
 $orders=mysqli_query($mysqli,"SELECT product_code,product_name,product_desc, od.date_supplied as date_supplied, od.status as status,brand,pieces,cases,s_price,od.order_id as oid,od.date_added as date_added FROM `tbl_orders` o join tbl_orders_details od on o.order_id=od.order_id left Join tbl_products p on p.product_id=od.product_id WHERE o.`order_id`=$oid ")or die(mysql_error());
 if(mysql_num_rows($orders)==0){echo '<tr><td colspan="7">Empty</td></tr>';} else{
  while($row=mysql_fetch_array($orders)){ 
							 $oid_of_order= $row['oid'];
							 $preorder=$row['cases']-$row['pieces'];
							 $date=$row['date_added'];
							 $status=$row['status'];  $date_supplied=$row['date_supplied'];
							 $sub_t=$preorder*$row['s_price'];
							 if($preorder!=0){
							  ?>
                              
                              <tr>
                                  <td><?php echo $i?></td>
                                  <td><strong><?php echo $row['product_name']?>
                                  <td><?php echo $row['product_code']?></td><td><?php echo $row['brand']; ?></td>
                                  <td class="numeric"><?php echo $preorder?></td><td class="numeric"><?php echo record_date($date)?></td>
                                  <td class="numeric"><?php echo   $sub_t ?></td>
                                  
                               </tr><?php $i++;} 
							   }
							   } ?>
                               <tr>
                                  <th width="34"></th>
                                  <th width="374"></th>
                                  <th width="150"></th>
                                   <th width="150"></th>
                                   <th width="150"></th>
                                  <th width="146" >Total</th> <th width="120" class="numeric"><?php echo $currency.' '. price_calc($oid_of_order)?></th></tr>
                                 <tr><td align="right" colspan="7"><?php if(price_calc($oid_of_order)==0){} else if($status==0){?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><input type="submit" name="deliver" value="Deliver"></form><?php } else echo ' Order Delivered on '.record_date($date_supplied);?></td></tr>
                               </tbody>
                        </table>
 
 
                         
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

    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	<script>
	    //ul list example
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-list',
	        controls_type: 'list',
	        controls_title: 'Choose a location:'
	    }).Load();
	
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-tabs',
	        controls_div: '#controls-tabs',
	        controls_type: 'list',
	        controls_on_map: false,
	        show_infowindow: false,
	        start: 1,
	        afterShow: function(index, location, marker) {
	            $('#info').html(location.html);
	        }
	    }).Load();
	</script>
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
