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
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <style>
     #address{
		
		 background-color:#FFF;
		 width:100%;}
         #address tr td{ text-transform:capitalize; font-size:12px; padding:5px; padding-bottom:0px;
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
                        <?php include('submenu.php'); ?>
                         <h3 ><b><?php $date_due=date("Y-m-d");
						
						   echo business_name($did)?></b> Visit Report of <?php echo date("d-m-Y");   $checkin_query=mysql_query("SELECT * FROM `tbl_check_in` WHERE `order_id`=$oid") or die(mysql_error());    if(mysql_num_rows($checkin_query)==0){} else{ $checkin_row=mysql_fetch_array($checkin_query);
						  $checkin_date=$checkin_row['date_timein'];
						  $checkout_date=$checkin_row['date_timeout'];
						  $inside_advert="Unailavable"; if($checkin_row['inside_advert']==1) $inside_advert="Available";
						  $outside_advert="Unailavable"; if($checkin_row['outside_advert']==1) $outside_advert="Available";
						  $mechandize="No";if($checkin_row['mechandize']==1)$mechandize='Yes';
						  $greetings="No"; if($checkin_row['greetings']==1) $greetings="Yes";
						  $remarks_checkin=$checkin_row['remarks'];?></h3>                      </div>
                      <div  style="padding-bottom:20px" class="float_left">
                  <table id="address" class="table-striped" width="100%" ><tr>
                      <td nowrap width="37%">Checkin Date/time </td><td nowrap width="31%" ><?php echo $checkin_date?> </td>
                      <td nowrap width="32%" >CheckOut date/Time</td>
                      <td nowrap width="63%" ><?php echo $checkout_date?></td>
                    <tr>
                      <td>Inside Advert</td>
                      <td nowrap ><?php echo $inside_advert?> </td>
                      <td nowrap >Outside advert</td>
                      <td nowrap ><?php echo $outside_advert?></td>
                    <tr>
                      <td>Did you Great dealer</td>
                      <td nowrap > <?php echo $greetings?> </td>
                      <td nowrap >Did you mechandize</td>
                      <td nowrap ><?php echo $mechandize ?></td>
                    <tr>
                      <td nowrap>Your Remarks</td>
                      <td nowrap ><?php echo $remarks_checkin?></td>
                      <td nowrap >Place Name</td>
                      <td nowrap >&nbsp;</td>
                      <tr>
                      <td nowrap>&nbsp;</td>
                      <td nowrap >&nbsp;</td>
                      <td nowrap >&nbsp;</td>
                      <td nowrap >&nbsp;</td>
                    </table> <?php }?>
                  </div>
                  <div class="room-box"><h5>Products Delivered</h5></div>
                   <!--start -->           
                  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                               <tr>
                                  <th width="34">Code</th>
                                  <th width="374">Name and description</th>
                                  <th width="150">Packaging</th>
                                  <th width="150">No.ordered</th>
                                  <th width="150">No.supplied</th>
                                  <th width="120" class="numeric">Price(Ksh)</th>
                                  
                              </tr>
                             </thead>
                             <tbody><?php
							 $orders=mysql_query("SELECT * FROM `tbl_orders` o join tbl_orders_details od on o.order_id=od.order_id left Join tbl_products p on p.product_id=od.product_id WHERE o.`order_id`=$oid and od.status !=3 ")or die(mysql_errno()); while($row=mysql_fetch_array($orders)){ $sub_t=$row['quantity']*$row['s_price'];
							  
							  ?>
                              <tr>
                                  <td><?php echo $row['product_code']?></td>
                                  <td><strong><?php echo $row['product_name']."</strong><br> ".$row['product_desc']?></td>  <th width="150">No.supplied</th>
                                  <td class="numeric"><?php echo $row['quantity'].' @ '.$row['s_price']?></td><td class="numeric"><?php echo $row['discount']?></td>
                                  <td class="numeric"><?php echo   $sub_t ?></td>
                                  
                               </tr><?php } ?>
                               <tr>
                                  <th width="34"></th>
                                  <th width="374"></th>
                                  <th width="150"></th>  <th width="150"></th>
                                  
                                  <th width="146" >Total</th> <th width="120" class="numeric"><?php echo $currency.' '. price_calc($oid)?></th>
                                  
                               </tbody>
                        </table>
 
   <div class="room-box"><h5>Remarks and comments</h5><ul>
   <?php $d=mysql_query("SELECT * FROM `tbl_orders` WHERE `order_id`=$oid")or die(mysql_query()); $r=mysql_fetch_array($d); $remarks= $r['delivery_remarks']; if ($remarks==''){ echo "none"; } else echo 'Delivery remarks: '. $remarks?><br/>
   <?php $comments_query=mysql_query("SELECT * FROM `tbl_comments` WHERE `order_id`=$oid") or die(mysql_error());
   while($com_row=mysql_fetch_array($comments_query)){
	   $com_by=$com_row['added_by'];
	   $com_detail=$com_row['details'];
	   $date_posted1=$com_row['date_posted'];?>
  <li><?php echo $com_detail?><span class="text-muted" style="font-size:10px"> by <?php echo get_name( $com_by); echo "  "; echo nicetime($date_posted1);?></span> </li><?php }?></ul>
  <form class="form-inline" method="post" action="post_comment.php?oid=<?php echo $oid?>&did=<?php echo $did?>" role="form">
										  <div class="form-group">
										    <input type="text" class="form-control" id="details" name="details" placeholder="any comments"><input name="type" value="1" type="hidden">
										  </div>
										  <button type="submit" name="submit" class="btn btn-default">Post</button>
										</form></div>
       
         <div class="room-box"><h5>Upcoming orders</h5>
         <?php $upco=mysql_query("SELECT * FROM `tbl_orders` WHERE `dealer_id`=$did and DATE(date_due)> DATE(NOW())")or die(mysql_query()); 
		 $fetch_upcoming=mysql_fetch_array($upco); $remarks= $fetch_upcoming['delivery_remarks']; if ($remarks==''){ echo "none"; } else echo 'Delivery remarks: '. $remarks?>
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
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
	<script src="assets/js/google-maps/maplace.js"></script>
	<script src="assets/js/google-maps/data/points.js"></script>
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
