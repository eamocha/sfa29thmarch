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
	   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script>
  load_users();</script>
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
                <div class="col-lg-12 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php');?>
                         <h3 class="float_left">My Delivery Details </h3>
                      </div>
                      
                  <div  style="padding-bottom:20px" class="float_left"><form method="post" name="filter" action="<?php echo $_SERVER['PHP_SELF']?>"><table ><tr><td>From </td><td> <input type="text" class="form-control dpd1" name="from"></td><td>To</td><td> <input type="text" class="form-control dpd2" name="to"></td><td>order By</td><td><select class="form-control" name="o_by"><option>Date of Delivery</option><option>Outlet</option></select></td><td><button class="btn btn-small btn-success" type="submit" >Search</button></td></tr></table></form> </div>
                   <!--start -->           
                  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                              <tr>
                                  <th width="39">No.</th>
                                  <th width="208">Outlet</th>
                                   <th width="218" class="numeric">Description</th>
                                  <th width="182">Date delivered</th>
                                  <th width="139" >Amount (<?php echo $currency;?>)</th>
                                  
                                  <th width="66" class="numeric">Options</th>
                              </tr>
                             </thead>
                             <tbody>  <?php
							
							 $where="`status`=0";
					
							  $i=1; $qs=mysqli_query($mysqli,"SELECT `delivery_id`, `order_id`, `product_id`, `user_id`, `cases`, `pieces`, `plan_id`, `remarks`, `date_time`, `status` FROM `tbl_deliveries` WHERE  $where;") or die (mysqli_error($mysqli));  
							  if(mysqli_num_rows($qs)==0){ echo  '<tr><td colspan=7>No deliveries made </td><tr>';}
							   else{ while($r=mysqli_fetch_array($qs)){ 
							   
							   $order_id=$r["delivery_id"];
							     $did=$r["dealer_id"];
								 $supplied_d=$r["date_time"];  
							   ?><tr>
                                  <td><?php echo $r["order_id"];?></td>
                                  <td><?php echo  get_client($did)?></td>
                                  <td class="numeric"><?php  echo order_details($order_id); ?></td>
                                  <td class="numeric"><?php echo record_date($supplied_d) ; ?></td>
                                  <td class="numeric"><?php echo  price_calc($order_id) ?></td>
                                   <td class="numeric"><a href="delivery_receipt.php?dealer_id=<?php echo $did?>&oid=<?php echo $order_id?>">View</a></td>
                               </tr>
                             <?php $i++; }} ?>
                             </tbody>
                        </table>
 
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                
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
	





 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
