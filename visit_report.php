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
	$plan_id=clean($_REQUEST['plan_id']); 
	$query=mysql_query("SELECT * FROM `tbl_route_plan` WHERE `id`=$plan_id")or die();
	$plan_row=mysql_fetch_array($query); $date_done=$plan_row['date_visted'];
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >   </script>
   
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
                         <h3><b>
				  <?php
						 $checkin_query=mysql_query("SELECT * FROM `tbl_check_in` WHERE  `route_plan_id`=$plan_id") or die(mysql_error());  
   echo business_name($did)?></b> Sales Visit Report of <?php echo date_title($date_done). ' </h3>'; 
						   $checkin_id=0; $stock_level_id=0;
	  
	if(mysql_num_rows($checkin_query)==0){ echo "<div><table><tr><td> Survey not carried out. <a href='mechandize.php?dealer_id=$did&plan_id=$plan_id'>Click Here</a></td></tr></table></div>";} else{
		 $checkin_row=mysql_fetch_array($checkin_query);
	$checkin_id=$checkin_row['checkin_id'];
						  $checkin_date=$checkin_row['date_timein'];
						  $checkout_date=$checkin_row['date_timeout'];
						  $inside_advert="Unailavable"; if($checkin_row['inside_advert']==1) $inside_advert="Available";
						  $outside_advert="Unailavable"; if($checkin_row['outside_advert']==1) $outside_advert="Available";
						  $mechandize="No";if($checkin_row['mechandize']==1)$mechandize='Yes';
						  $has_light_pannels="No"; if($checkin_row['has_light_pannels']==1) $has_light_pannels="yes";
						  $promotion="No"; if($checkin_row['running_promotion']==1) $promotion="Yes";
						  $has_glasses="No"; if($checkin_row['has_glasses']==1) $has_glasses="Yes";
						  $fridge="No"; if($checkin_row['fridge']==1) $fridge="Yes";
						 $has_coasters="No"; if($checkin_row['has_coasters']==1) $has_coasters="yes";
						  $bar_r="No"; if($checkin_row['has_bar_runners']==1) $bar_r="yes";
						  $has_neon_signs="No"; if($checkin_row['has_neon_signs']==1) $has_neon_signs="yes";
						  $remarks_checkin=$checkin_row['remarks'];
						  $img1=$checkin_row['image1'];
							$img2=$checkin_row['image2'];
							$img3=$checkin_row['image3'];
							$lat=$checkin_row['latitute'];
							$long=$checkin_row['longtitute'];
							$by=$checkin_row['user_id'];
							$dealer_id=$checkin_row['dealer_id'];
							  ?>                      </div>
                      <div  style="padding-bottom:20px" class="float_left">
                   <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed"><thead>
                               <tr class=" "  >
                        <th colspan="4"  >Survey status</th>
                      </tr>
                             </thead>
                     <tr>
                       <td nowrap>Checkin Date/time </td>
                       <td nowrap ><?php echo $checkin_date?></td>
                       <td nowrap >Survey Done by</td>
                       <td nowrap ><?php echo get_name($by)?></td>
                     <tr>
                      <td width="37%">Inside Advert</td>
                      <td width="31%" nowrap ><?php echo $inside_advert?> </td>
                      <td width="32%" nowrap >Outside advert</td>
                      <td width="63%" nowrap ><?php echo $outside_advert?></td>
                    <tr>
                      <td nowrap >Did you mechandize?</td>
                      <td nowrap ><?php echo $mechandize ?></td>
                      <td nowrap >Branded Glasses</td>
                      <td nowrap ><?php echo $has_glasses ?></td>
                    <tr>
                      <td>Light Pannels</td>
                      <td nowrap ><?php echo $has_light_pannels?></td>
                      <td nowrap >Is our product chilled?</td>
                      <td nowrap ><?php echo $fridge ?></td>
                    <tr>
                      <td>Neon Signs</td>
                      <td nowrap ><?php echo $has_neon_signs ;?></td>
                      <td nowrap >Coasters?</td>
                      <td nowrap ><?php echo $has_coasters ;?></td>
                    <tr>
                      <td>Bar runners</td>
                      <td nowrap ><?php echo $bar_r?></td>
                      <td nowrap >Is our product chilled?</td>
                      <td nowrap ><?php echo $fridge ?></td>
                    <tr>
                      <td>Running Promotoin</td>
                      <td nowrap ><?php echo $promotion?></td>
                      <td nowrap >Loaction</td>
                      <td nowrap ><?php echo outlet_position($dealer_id)?></td>
                    <tr>
                      <td nowrap>Your Remarks</td>
                      <td nowrap ><?php echo $remarks_checkin?></td>
                      <td nowrap >Place done</td>
                      <td nowrap ><?php d( Get_Address_From_Google_Maps($lat, $long))?> </td>
                      <tr>
                      <td nowrap><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo print_r(image_properties($img1))?>" href="<?php echo $img1?>"><img class="img-responsive" src="<?php echo $img1?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div></td>
                      <td nowrap ><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo print_r(image_properties($img2))?>" href="<?php echo $img2?>"><img class="img-responsive" src="<?php echo $img2?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div>
                      
                     </td>
                      <td nowrap > <div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo print_r(image_properties($img3))?>" href="<?php echo $img3?>"><img class="img-responsive" src="<?php echo $img3?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div></td>
                      <td nowrap >&nbsp;</td>
                    </table> <?php }?>
                  </div>
                  <div class="room-box">
                    <h5>Stock status</h5></div>
                   <!--start -->           
                  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                               <tr class=" "  >
                        <th  >&nbsp;</th>
                        <th  >SKU</th>
                        <th >Pack </th>
                        <th>Type</th>
                        <th >Cases</th>
                        <th >pieces</th>
                       
                      </tr>
                             </thead>
                             <tbody>  <?php $i=1;
							  $q=mysql_query("SELECT * FROM  `tbl_products` p where p.status=0 order by p.product_name asc  ")or die(mysql_error());
							 
										while($row = mysql_fetch_array($q)){

										$sku=$row['product_name'];$sku=$row['product_name'];$available=$row['q_available']; $type=$row['brand']; $pack=$row['product_code']; $pid=$row['product_id'];?>
                              <tr>
                                  
                        <td ><?php echo $i?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                        <td class="numeric"><?php echo stock_taking_report($did,'cases',$pid,$plan_id)?></td>
                           <td class="numeric"><?php echo stock_taking_report($did,'singles',$pid,$plan_id)?></td>
                               </tr><?php $i++; }
							   ?>
                               <tr>
                                  <th width="34"></th>
                                  <th width="374"></th>
                                  <th width="150"></th>  <th width="150"></th>
                                  
                                  <th width="146" >&nbsp;</th> <th width="120" class="numeric">&nbsp;</th>
                                  
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

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

		<script src="assets/js/fancybox/jquery.fancybox.js"></script>   

 <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
  
    
  </body>
</html>
