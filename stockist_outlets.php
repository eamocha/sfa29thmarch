<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; 
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		  fetch_clients();
     
 
 		load_users();
		
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
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Stockists</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                  
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Stockist</th>
                                  <th>Region</th>
                                  <th>Channel</th>
                                  
                                  <th>Contacts</th>
                                  <th>Reg Date</th>
                                   <th>Reg by</th>
                                   <th>Visits</th>
                                  <th>Total Sales</th>
                                 
                              </tr>
                              </thead>
                              <tbody >
                              <?php $i=1; $quer=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE `status`=0 and `type_of_outlet`=1 order by region_id, business_name") or die(mysqli_error($mysql));
							  if(mysqli_num_rows($quer)>0){
								  while($ro=mysqli_fetch_array($quer)){
									  ?>
									 <tr> 
                                     <td><?php echo $i?></td>
                                  <th><?php echo business_name($ro['dealer_id'])?></th>
                                  <th><?php echo region_name($ro['region_id'])?></th>
                                  <th><?php echo channel_type($ro['channel'])?></th>
                                  
                                  <th><?php echo $ro['phone']?></th>
                                  <th><?php echo record_date($ro['reg_date'])?></th>
                                   <th><?php echo get_name($ro['added_by'])?></th>
                                   <th><?php echo times_visited($ro['dealer_id'])?></th>
                                  <th>-</th></tr>
								  <?php $i++;
									  }
								  } ?>
                              
                              </tbody>
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include 'add_region.php';?>
		          <!-- modal -->
                  
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

    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
