<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_REQUEST['user_id'];  ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
        <script type="text/javascript" >
	     $(window).load(function(e) { 
var url="user_profile_parts.php?mode=user_summary&user_id="+<?php echo $user_id?>;
	$("#dashboard").load(url);
	/////////////////////
	var url="user_profile_parts.php?mode=asset_movements&user_id="+<?php echo $user_id?>;
	$("#asset_movements").load(url);
	//////////////////////
	var url="user_profile_parts.php?mode=outlet_sales&user_id="+<?php echo $user_id?>;
		$("#outlet_sales").load(url);
			var url="user_profile_parts.php?mode=distributor_stocks&user_id="+<?php echo $user_id?>;
		$("#distributor_stocks").load(url);
		var url="user_profile_parts.php?mode=user_assets&user_id="+<?php echo $user_id?>;
		$("#assets_body").load(url);
			var url="user_profile_parts.php?mode=verified_assets&user_id="+<?php echo $user_id?>;
		$("#verified_assets_body").load(url);
		var url="user_profile_parts.php?mode=new_outlets_MTD&user_id="+<?php echo $user_id?>;
		$("#new_outlets_MTD").load(url);
		
		var url="user_profile_parts.php?mode=Meetings&user_id="+<?php echo $user_id?>;
		$("#gmm").load(url);
		/////
			
		var url="user_profile_parts.php?mode=closed_outlets&user_id="+<?php echo $user_id?>;
		$("#closed_outlets").load(url);
		var url="user_profile_parts.php?mode=route_sales&user_id="+<?php echo $user_id?>;
		$("#route_sales").load(url);
		
		var url="user_profile_parts.php?mode=user_routes&user_id="+<?php echo $user_id?>;
		$("#user_routes_body").load(url);
			var url="user_profile_parts.php?mode=user_outlets&user_id="+<?php echo $user_id?>;
		$("#user_outlets_body").load(url);
			var url="user_profile_parts.php?mode=verified_outlets&user_id="+<?php echo $user_id?>;
		$("#verified_outlets_body").load(url);
			var url="user_profile_parts.php?mode=asset_relocation&user_id="+<?php echo $user_id?>;
		$("#asset_relocation").load(url);
					 
		var url="user_profile_parts.php?mode=adClusters&user_id="+<?php echo $user_id?>;
		$("#adClusters").load(url);
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
                         <h3 class="float_left"><?php echo get_name($user_id)?> Profile</h3>
                    </div>
                      <div></div>     
                   <section id="unseen">
        <div class="row content-panel">
							<div class="panel-heading">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a data-toggle="tab" href="#dashboard">Dashboard </a>  
                            	</li>
                                                                     
                                       <li>
										<a data-toggle="tab" href="#gmm" >Gmm</a>
									</li>
                                         <li>
										<a data-toggle="tab" href="#route_sales" >R.sales</a>
									</li>
                                     <li>
										<a data-toggle="tab" href="#outlet_sales" >O.sales</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#distributor_stocks" >Dis. stocks</a>
									</li>
                                    
                                    
                                        <li><a data-toggle="tab" href="#new_outlets_MTD">Opened MTD</a></li>
                                        <li><a data-toggle="tab" href="#closed_outlets">Closed MTD</a></li>
                                    <li>
										<a data-toggle="tab" href="#adClusters" >Clusters</a>
									</li>
                                    <li>
										<a data-toggle="tab" href="#user_routes">Routes</a>
									</li>
                                    <li >
										<a data-toggle="tab" href="#user_outlets">Outlets</a>
									</li>
                                     <li >
										<a data-toggle="tab" href="#verified_outlets">V.Outlets</a>
									</li>
									<li>
										<a data-toggle="tab" href="#assets" >Assets</a>
									</li>
                                    	<li>
										<a data-toggle="tab" href="#verified_assets" >V.Assets</a>
									</li>
                                     <li>
										<a data-toggle="tab" href="#asset_movements" >Asset Relocation</a>
									</li>
									
                                
								</ul>
							</div><!--/panel-heading -->
							
							<div class="panel-body">
								<div class="tab-content">
									<div id="dashboard" class="tab-pane active">
                                   Loading  <img src="images/37.gif">
                                       <!-- end tab1-->
                                        </div>
                                         <div id="verified_outlets" class="tab-pane">
												<!-- start new tab-->
                                               <table  width="100%"  class="table table-striped table-condensed " id="table_outlets">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Region</th>
            <th>Area</th>
              <th>S. A</th>
                <th>Distributor</th>
             <th>Route</th>
            <th>Town</th>
             <th>Contact</th>
              <th>Channel</th>
                   <th>Class</th>  <th>Sales FMCG</th>
                  <th>Sales Bevs</th>
             <th>Sales Coke</th>
        
            <th>Last Visit</th>
                  </tr>
        </thead>
        <tbody id="verified_outlets_body">
        <tr><td colspan="15">Loading  <img src="images/37.gif"></td></tr>
        </tbody></table>
                                                  <!-- end Tab-->																							                                    </div><!--/tab-pane -->
                                      <div id="user_outlets" class="tab-pane">
												<!-- start new tab-->
                                               <table  width="100%"  class="table table-striped table-condensed" id="table_outlets">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Region</th>
            <th>Area</th>
              <th>S. A</th>
                <th>Distributor</th>
             <th>Route</th>
            <th>Town</th>
             <th>Contact</th>
              <th>Channel</th>
                   <th>Class</th>  <th>Sales FMCG</th>
                  <th>Sales Bevs</th>
             <th>Sales Coke</th>
        
            <th>Last Visit</th>
                  </tr>
        </thead>
        <tbody id="user_outlets_body">
        <tr><td colspan="15">Loading  <img src="images/37.gif"></td></tr>
        </tbody></table>
                                                  <!-- end Tab-->																							                                    </div><!--/tab-pane -->
									<div id="verified_assets" class="tab-pane">
                                    <table class="table table-bordered table-striped table-condensed" style="background-color:#FFF" id="">
                              <thead>
                              <tr>
                                  
                                  <th>#</th>
                                    <th>Asset Type </th>
                                  <th>Held by</th>
                                   <th>Model</th>
                                  <th>Serial No</th>
                                  <th>Bar Code</th>
                                  <th>Date Issued</th>
                                  <th>Source</th>
                                  <th>Condition</th>
                                   <th>Last checked</th>
                              </tr>
                              </thead>
                              <tbody id="verified_assets_body"><tr><td colspan="10"><img src="images/37.gif"></td></tr></tbody></table>
									</div><!--/tab-pane -->
                                    <div id="assets" class="tab-pane">
                                    <table class="table table-bordered table-striped table-condensed" style="background-color:#FFF" id="">
                              <thead>
                              <tr>
                                  
                                  <th>#</th>
                                    <th>Asset Type </th>
                                  <th>Held by</th>
                                   <th>Model</th>
                                  <th>Serial No</th>
                                  <th>Bar Code</th>
                                  <th>Date Issued</th>
                                  <th>Source</th>
                                  <th>Condition</th>
                                   <th>Last checked</th>
                              </tr>
                              </thead>
                              <tbody id="assets_body"><tr><td colspan="10"><img src="images/37.gif"></td></tr></tbody></table>
									</div><!--/tab-pane -->
                                    <div id="adClusters" class="tab-pane">
										
                                       
									</div><!--/tab-pane -->
                                    <div id="gmm" class="tab-pane">
                                    
									</div><!--/tab-pane -->
                                    <div id="new_outlets_MTD" class="tab-pane">
                                  
									</div><!--/tab-pane -->
                                      <div id="closed_outlets" class="tab-pane">
										
									</div><!--/tab-pane -->
									
									<div id="user_routes" class="tab-pane">
                                            <table  width="100%"  class="table table-bordered table-striped table-condensed" id="">
        <thead>
          <tr>
            <th>No</th>
            <th>Route</th>
            <th>Region</th>
            <th>Area</th>
              <th>S. A</th>
                <th>Distributor</th>
             <th>AD cluster</th>
              <th>Outlets</th>
            <th>Verified</th>
             <th>Assigned by</th>
             
            <th>Actions</th>
                  </tr>
        </thead>
        <tbody id="user_routes_body">
        <tr><td colspan="10">Loading  <img src="images/37.gif"></td></tr>
        </tbody></table>
										
								  </div><!--/row -->
                                  
									<div id="route_sales" class="tab-pane">
                                   
										Loading  <img src="images/37.gif">
								  </div><!--/row -->
                                  <div id="asset_movements" class="tab-pane">
                                   
										Loading  <img src="images/37.gif">
								  </div><!--/row -->
                                  <div id="outlet_sales" class="tab-pane">
                                   
										Loading  <img src="images/37.gif">
								  </div><!--/row -->
                                  <div id="distributor_stocks" class="tab-pane">
                                   
										
								  </div><!--/row -->
                                  
									<div id="asset_relocation" class="tab-pane">
                                   
										
								  </div><!--/row -->
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
