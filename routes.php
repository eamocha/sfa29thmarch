<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $today=date('Y-m-d',strtotime($today_constant)); 
		  include "export.html";
     ?><script type="text/javascript" src="assets/js/scripts.js" >     </script>
    
  <script type="text/javascript" >
      $(window).load(function(e) {
	
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

              <div class="row" id="pdfthis">
                  <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head " id="dontpdf">
                         <?php include('submenu.php');?>
                         <h3 class="float_left"><?php echo $_SESSION['f_name']?> - <?php echo date_title($today_constant);?> 
                         <?php include "common_export_icons.php"?></h3>
                         
                      </div>   
                      
                     <div  style="padding-bottom:20px" class="float_left room-box">
                     <table  width="100%" ><tr>
                     <td>Route Plan</td><td><?php  echo all_dealers_in_route($user_id,$today);?></td><td>Already Visited </td><td> <?php echo already_visted($user_id,$today) ?></td><td>Canceled</td>
                     <td><?php echo cancelled_route($user_id,$today)?></td>
                     <td>View on Map&gt;&gt;</td>
                     <td><a href="google_maps.php?uid=<?php echo $user_id?>"><img src="assets/img/google_maps.png" width="20" ></a></td>
                     </tr></table>
                      </div>
                     <!--start -->           
                   <section id="pdfthis">
                           <table id="table" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th width="20">No</th>
                                  <th width="64"> Outlet Name</th>
                                  <th width="65"> Location</th>
                                  <th width="76">Contact</th>
                                  <th width="147">Important Notes</th>
                                 <th width="112" >Actions</th>
                              </tr>
                              </thead>
                              <tbody id="routes">
                           <?php $today=date("Y-m-d",strtotime($today_constant)); 
 $user_id=$_SESSION['u_id'];
 // update_route_plan();
 // update_orders_done();
 today_dealers($user_id,$today);?>
                              </tbody></table>
                          </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->       <span id="dontpdf">           
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?></span>
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



    
  </body>
</html>

