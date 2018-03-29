<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $asset_id=$_REQUEST['id']; $user_id=$_SESSION['u_id'];   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	     $(window).load(function(e) { 
 //load select boxes
 		load_users();
		////// eds
		var url="profiles.php?mode=asset_summary&asset_id="+<?php echo $asset_id?>;
	$("#asset_summary").load(url);
	var url="profiles.php?mode=asset_visit_details&asset_id="+<?php echo $asset_id?>;
		$("#asset_visit_details").load(url);
		var url="profiles.php?mode=asset_photos&asset_id="+<?php echo $asset_id?>;
		$("#asset_photos").load(url);
var url="profiles.php?mode=asset_repair&asset_id="+<?php echo $asset_id?>;
		$("#asset_repair").load(url);	
		var url="profiles.php?mode=asset_movement&asset_id="+<?php echo $asset_id?>;
		$("#asset_movement").load(url);	
			
		
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
                  <div class="col-lg-12 main-chart">
                  
                      <!--CUSTOM CHART START -->
                    <div class="border-head">
                      <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Asset Profile</h3>
                    </div>
                   
                     <!--start -->      <div></div>     
                   <section id="unseen">
        <div class="row content-panel">
							<div class="panel-heading">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
                                    <a data-toggle="tab" href="#asset_summary"> Summary</a>
									</li>
                                    <li >
										<a data-toggle="tab" href="#asset_visit_details">Visit details </a>
									</li>
									<li>
										<a data-toggle="tab" href="#asset_repair" >Repair and Maintanance</a>
									</li>
                                    
                                    <li>
										<a data-toggle="tab" href="#asset_photos" >Photos</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#asset_movement" >Movements</a>
									</li>
                                    
								</ul>
							</div><!--/panel-heading -->
							
							<div class="panel-body">
								<div class="tab-content">
									<div id="asset_summary" class="tab-pane active">
										<!--start tab-->
                                        	Loading <img src='images/37.gif'>
                                        <!-- end tab1-->
                                        </div>
                                      <div id="asset_visit_details" class="tab-pane">
												<!-- start new tab-->
                                              	Loading <img src='images/37.gif'>																					                           									
									</div><!--/tab-pane -->
									
									<div id="asset_repair" class="tab-pane">
										
										Loading <img src='images/37.gif'>
                                      
									</div><!--/tab-pane -->
                                    <div id="asset_photos" class="tab-pane">
								
                                       	Loading <img src='images/37.gif'>
									</div><!--/tab-pane -->
                                   
                                    <div id="asset_movement" class="tab-pane">
                                  
										Loading <img src='images/37.gif'>
									</div><!--/tab-pane -->
                             
									
									
							  </div><!--/tab-pane -->
								</div><!-- /tab-content -->
							
							</div><!--/panel-body -->
                         

<div>

</div>

                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?Php //if($user_role==1){include('home_right.php');
				 // } else include('home_right2.php');
				  ?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php'); include('add_competitor.php');?>
      <!--footer end-->
  </section>
<script src="assets/js/bootstrap.min.js"></script>
	

<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/js/advanced-form-components.js"></script>      
</body>
</html>
