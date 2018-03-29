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
	$dealer_id=$_REQUEST['dealer_id'];  ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
   
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		//  fetch_clients();
	//assign_salesperson();
  
        
 //load select boxes
 		//load_users();
		
//load the client dashboard
var url="outlet_profile.php?mode=outlet_dashboard&dealer_id="+<?php echo $dealer_id?>;
	$("#client_dashboard").load(url);
	var eds="outlet_eds.php?dealer_id="+<?php echo $dealer_id?>;
	$("#eds").load(eds);
	var objectives="outlet_profile.php?outlet_objectives="+<?php echo $dealer_id?>;
	$("#outlet_objectives").load(objectives);
	var outlet_assets="outlet_profile.php?outlet_assets="+<?php echo $dealer_id?>;
	$("#outlet_assets").load(objectives);
	//stock taken
	var stock="outlet_profile.php?mode=outlet_stock&dealer_id="+<?php echo $dealer_id?>;
    $("#take_stock").load(stock);
	//merchandize merchandize_body.php
	var merch="merchandize_body.php?dealer_id="+<?php echo $dealer_id?>;
	 $("#merchandize").load(merch);
//photos 
var photos="outlet_photos.php?dealer_id="+<?php echo $dealer_id?>;
 $("#outlet_photos").load(photos);

		
		 }); //end load function
		 //select sales people
 
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
            <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
              <div class="border-head">
                         <?php include('submenu.php');?>
               	 <h3 class="float_left">Outlet profile for:
                 <?php echo business_name($dealer_id) ?> </h3> 
                </div>   
                     
                     <!--start -->    
                   
                  
                      <!--CUSTOM CHART START -->
                     <div class="col-lg-12 mt">		
					<div class="row content-panel">
							<div class="panel-heading">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a data-toggle="tab" href="#client_dashboard">Dashboard </a>
									</li>
                                    <li >
										<a data-toggle="tab" href="#eds">EDS </a>
									</li>
                                    
                                    <li >
										<a data-toggle="tab" href="#take_stock">stock </a>
                                        
									</li>
									<li>
										<a data-toggle="tab" href="#merchandize" >RED</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#outlet_plans" >Plans</a>
									</li>
                                    
                                    <li>
										<a data-toggle="tab" href="#orders" >Orders</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#payments" >Payments</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#deliveries" >deliveries</a>
									</li>
                                   
									<li>
										<a data-toggle="tab" href="#outlet_photos">Photos</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#outlet_assets">Assets</a>
									</li>
                                     <li>
										<a data-toggle="tab" href="#outlet_objectives">Objectives</a>
									</li>
                                        
								</ul>
							</div><!--/panel-heading -->
							
							<div class="panel-body">
								<div class="tab-content">
									<div id="client_dashboard" class="tab-pane active">
										Loading <img src='images/37.gif'>
                                        </div>
                                        <div id="eds" class="tab-pane">
                                        Loading <img src='images/37.gif'>
                                        
                                        </div>
                                      <div id="take_stock" class="tab-pane">Loading <img src='images/37.gif'>
									</div><!--/tab-pane -->
									
									<div id="merchandize" class="tab-pane">
								</div><!--/tab-pane -->
                                    <div id="orders" class="tab-pane">
										<?php include("fetch_client_orders.php");?>
                                       
									</div><!--/tab-pane -->
                                    <div id="payments" class="tab-pane">
                                    
										<?php include("fetch_client_payments.php");?>
									</div><!--/tab-pane -->
                                    <div id="deliveries" class="tab-pane">
                                  
										<?php   include("fetch_client_deliveries.php");?>
									</div><!--/tab-pane -->
                                      <div id="statistics" class="tab-pane">Loading <img src='images/37.gif'>
										<?php //include("client_orders.php");?>
									</div><!--/tab-pane -->
									
									<div id="outlet_photos" class="tab-pane">
                                   Loading <img src='images/37.gif'>
										<?php  ?>
								  </div><!--/row -->
                                  <div id="outlet_plans" class="tab-pane">
                                   Loading <img src='images/37.gif'>
										<?php  ?>
								  </div><!--/row -->
                                   <div id="outlet_assets" class="tab-pane">
                                   Loading <img src='images/37.gif'>
										<?php  ?>
								  </div><!--/row -->
                                   <div id="outlet_objectives" class="tab-pane">
                                   Loading <img src='images/37.gif'>
										<?php  ?>
								  </div><!--/row -->
                                   <div id="outlet_plans" class="tab-pane">
                                   Loading <img src='images/37.gif'>
										<?php  ?>
								  </div><!--/row -->
                                  
							  </div><!--/tab-pane -->
								</div><!-- /tab-content -->
							
							</div><!--/panel-body -->
							
						</div><!-- /col-lg-12 -->
               
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->    <?Php //include("right_of_client.php");
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
	





    
  </body>
</html>
