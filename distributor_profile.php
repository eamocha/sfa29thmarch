<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $distributor_id=$_REQUEST['distributor_id']; $user_id=$_SESSION['u_id'];   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
        <script type="text/javascript" >
	     $(window).load(function(e) { 
 //load select boxes
 		load_users();
var url="profile_distributor.php?mode=distributor_summary&distributor_id="+<?php echo $distributor_id?>;
	$("#eds").load(url);
	//////////////////////
	var url="profile_distributor.php?mode=distributor_volume_perfomance&distributor_id="+<?php echo $distributor_id?>;
		$("#vp_body").load(url);
		var url="profile_distributor.php?mode=distributor_assets&distributor_id="+<?php echo $distributor_id?>;
		$("#assets").load(url);
		var url="profile_distributor.php?mode=distributor_red_score&distributor_id="+<?php echo $distributor_id?>;
		$("#red_score").load(url);
		
		var url="profile_distributor.php?mode=new_outlets_MTD&distributor_id="+<?php echo $distributor_id?>;
		$("#new_outlets_MTD").load(url);
		/////
			
		var url="profile_distributor.php?mode=closed_outlets&distributor_id="+<?php echo $distributor_id?>;
		$("#closed_outlets").load(url);
		var url="profile_distributor.php?mode=distributor_stock&distributor_id="+<?php echo $distributor_id?>;
		$("#distributor_stock").load(url);
		var url="profile_distributor.php?mode=plant_orders&distributor_id="+<?php echo $distributor_id?>;
		$("#plant_orders").load(url);
		var url="profile_distributor.php?mode=distributor_staff&distributor_id="+<?php echo $distributor_id?>;
		$("#distributor_staff").load(url);
		var url="profile_distributor.php?mode=distributor_gmm&distributor_id="+<?php echo $distributor_id?>;
		$("#distributor_gmm").load(url);
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
                         <h3 class="float_left"><?php echo distributor_name($distributor_id)?> Profile</h3>
                    </div>
                    <!-- <div  style="padding-bottom:20px" class="float_left"><select><option>Select Distributor</option><?php //echo  distributor_selection()?></select>
                    </div>-->
                     <!--start -->      <div></div>     
                   <section id="unseen">
        <div class="row content-panel">
							<div class="panel-heading">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a data-toggle="tab" href="#dashboard">Dashboard </a>  
                                                                            
									</li>
                                    <li >
										<a data-toggle="tab" href="#volume_perfomance_body">Vol.Performance. </a>
									</li>
									<li>
										<a data-toggle="tab" href="#assets" >Assets</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#red_score" >Red Scores</a>
                                      </li>
                                       <li>
										<a data-toggle="tab" href="#new_outlets_MTD" >Opened MTD</a>
									</li>
                                         <li>
										<a data-toggle="tab" href="#closed_outlets" >Closed MTD</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#distributor_stock" >Stock</a>
									</li>
                                     <li>
										<a data-toggle="tab" href="#distributor_sellout" >Sellout</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#plant_orders" >Plant Orders</a>
									</li>
                                   
									<li><a data-toggle="tab" href="#distributor_staff">Staff</a></li>
                                    <li><a data-toggle="tab" href="#distributor_trucks">Trucks</a></li>
                                     <li><a data-toggle="tab" href="#distributor_gmm">Gmm</a></li>
								</ul>
							</div><!--/panel-heading -->
							
							<div class="panel-body">
								<div class="tab-content">
									<div id="dashboard" class="tab-pane active">
									<table width="100%" class="table table-bordered table-striped table-condensed" >
                                        <thead>
  <tr>    <th  rowspan="2" scope="col">Routes</th>
     <th  rowspan="2" scope="col">Outlets</th>
     <th  rowspan="2" scope="col">K.O</th>
    <th  rowspan="2" scope="col">% Contr.</th>
    <th rowspan="2" scope="col">Daily V.P.R</th>
    <th  rowspan="2" scope="col">Target</th>
    <th colspan="3" scope="col">Daily V. Tracker-MTD</th>
    <th colspan="3" scope="col">Suckers Tracker</th>
    <th scope="col">AD</th>
    <th scope="col">KD</th>
   </tr>
  <tr>
    <th scope="col">Target</th>
    <th scope="col">Act.</th>
    <th scope="col">%</th>
    <th scope="col">Excl K.O</th>
    <th scope="col">Sucker</th>
    <th scope="col">Busted</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  


  </thead>
<tbody id="eds">
<tr><td colspan="17">Loading <img src="images/37.gif"></td></tr></tbody>

</table>
                        
                                        <!-- end tab1-->
                                        </div>
                                      <div id="volume_perfomance_body" class="tab-pane">
												<!-- start new tab-->
                                                <table width="100%" class="table table-bordered table-striped table-condensed" >
  <tr>
    <th colspan="11" scope="col">Volume Perfomance 2016</th>
  </tr>
  <tr>
    <th width="97" rowspan="2" scope="col">Month</th>
    
    <th width="97" colspan="3" scope="col"><?php echo date('Y')-1; ?></th>
    <th width="97" colspan="3" scope="col"><?php echo date('Y')-0; ?></th>
    <th width="179" rowspan="2" scope="col"><?php echo date('Y')-1; ?> Actual Vs. <?php echo date('Y')-0; ?> actual</th>
    <th width="82" rowspan="2" scope="col">% Perf. Increase</th>
    <th width="173" rowspan="2" scope="col"> <?php echo date('Y')-0; ?>% Plan Increase</th>
    
  </tr>
  <tr>
    <th scope="col">Planned</th>
    <th scope="col">Actual</th>
    <th scope="col">% Performance.</th>
    <th width="47" scope="col">Planned</th>
    <th width="48" scope="col">Actual</th>
    <th width="97" scope="col">% Perfomance</th>
  </tr>
  
  <tbody id="vp_body"></tbody>
</table>
                                                  <!-- end Tab-->																							                                    </div><!--/tab-pane -->
									<div id="assets" class="tab-pane">Loading <img src="images/37.gif">	</div><!--/tab-pane -->
                                    <div id="red_score" class="tab-pane">Loading <img src="images/37.gif"></div><!--/tab-pane -->
                                    <div id="new_outlets_MTD" class="tab-pane">Loading <img src="images/37.gif"></div><!--/tab-pane -->
                                    <div id="closed_outlets" class="tab-pane">Loading <img src="images/37.gif"></div><!--/tab-pane -->
                                      <div id="distributor_stock" class="tab-pane">Loading <img src="images/37.gif"></div><!--/tab-pane -->
									
									<div id="plant_orders" class="tab-pane">Loading <img src="images/37.gif"></div><!--/row -->
                                  
									<div id="distributor_staff" class="tab-pane">Loading <img src="images/37.gif">v </div><!--/row -->
                                  
									<div id="distributor_trucks" class="tab-pane">Loading <img src="images/37.gif"> </div><!--/row -->
                                    	<div id="distributor_gmm" class="tab-pane">Loading <img src="images/37.gif"> </div><!--/row -->
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
                 <?Php // if($user_role==1){include('home_right.php');
				//  } else include('home_right2.php');
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
