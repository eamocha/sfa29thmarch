<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $cluster_id=$_REQUEST['cluster_id']; $user_id=$_SESSION['u_id'];   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	     $(window).load(function(e) { 
 //load select boxes
 		load_users();
		////// eds
		var url="profiles.php?mode=cluster_summary&cluster_id="+<?php echo $cluster_id?>;
	$("#eds").load(url);
	var url="profiles.php?mode=cluster_assets&cluster_id="+<?php echo $cluster_id?>;
		$("#assets").load(url);
		var url="profiles.php?mode=cluster_volume_perfomance&cluster_id="+<?php echo $cluster_id?>;
		$("#volume_perfomance_body").load(url);
var url="profiles.php?mode=cluster_routes&cluster_id="+<?php echo $cluster_id?>;
		$("#routes").load(url);	
		var url="profiles.php?mode=cluster_staff&cluster_id="+<?php echo $cluster_id?>;
		$("#staff").load(url);	
			var url="profiles.php?mode=cluster_key_accounts&cluster_id="+<?php echo $cluster_id?>;
		$("#key_accounts").load(url);	
		
			var url="profiles.php?mode=cluster_distributors&cluster_id="+<?php echo $cluster_id?>;
		$("#distributors").load(url);	
		var url="profiles.php?mode=cluster_gmm&cluster_id="+<?php echo $cluster_id?>;
		$("#cluster_gmm").load(url);	
		
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
                         <h3 class="float_left"><?php echo sub_area_name($cluster_id)?> Cluster Profile</h3>
                    </div>
                   
                     <!--start -->      <div></div>     
                   <section id="unseen">
        <div class="row content-panel">
							<div class="panel-heading">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a data-toggle="tab" href="#client_dashboard">Summary</a></li>
<li><a data-toggle="tab" href="#volume_perfomance">Vol. Perfomance </a></li>
<li><a data-toggle="tab" href="#assets" class="contact-map">Assets</a></li>
<li><a data-toggle="tab" href="#distributors" class="contact-map">Distributors</a></li>
<li><a data-toggle="tab" href="#routes" class="contact-map">Routes</a></li>
<li><a data-toggle="tab" href="#key_accounts" class="contact-map">Key accounts</a></li>

<li><a data-toggle="tab" href="#staff">Staff</a></li>
<li><a data-toggle="tab" href="#cluster_gmm">Gmm</a></li>
								</ul>
							</div><!--/panel-heading -->
							
							<div class="panel-body">
								<div class="tab-content">
									<div id="client_dashboard" class="tab-pane active">
										<!--start tab-->
                                        <table width="100%" class="table table-bordered table-striped table-condensed" >
                                        <thead>
  <tr>

     <th  rowspan="2" scope="col">Distributors</th>
     <th  rowspan="2" scope="col">Routes</th>
     <th  rowspan="2" scope="col">Outlets</th>
     <th  rowspan="2" scope="col">K.O</th>
    <th  rowspan="2" scope="col">% Contr.</th>
    <th rowspan="2" scope="col">Daily V.P.A</th>
    <th  rowspan="2" scope="col">Target</th>
    <th colspan="3" scope="col">Daily V. Tracker-MTD</th>
    <th colspan="3" scope="col">Suckers Tracker</th>
   
   
  </tr>
  <tr>
    <th scope="col">Target</th>
    <th scope="col">Act.</th>
    <th scope="col">%</th>
    <th scope="col">Excl K.O</th>
    <th scope="col">Sucker</th>
    <th scope="col">Busted</th>
  </tr>
  
                                        </thead>
<tbody id="eds"><tr><td colspan="20">Loading <img src="images/37.gif"></td></tr></tbody>

</table>
                                        <!-- end tab1-->
                                        </div>
                                      <div id="volume_perfomance" class="tab-pane">
												<!-- start new tab-->
                                                <table width="100%" class="table table-bordered table-striped table-condensed" >
  <tr>
    <th colspan="7" scope="col">Volume Perfomance 2016</th>
  </tr>
  <tr>
    <th width="97" rowspan="2" scope="col">Month</th>
    <th width="97" colspan="2" scope="col">Target per month</th>
    <th width="179" rowspan="2" scope="col">% Perfomance vs Plan</th>
    <th width="82" rowspan="2" scope="col">Plan 2016</th>
    <th width="173" rowspan="2" scope="col">% perfomance vs 2015</th>
  </tr>
  <tr>
   
    <th scope="col">Actual <?php echo date('Y')-1; ?></th>
     <th scope="col">Actual <?php echo date('Y')-0; ?></th>
     
  </tr>
  <tbody id="volume_perfomance_body"></tbody>
</table>
                                                <!-- end Tab-->																							                                    
											
										
									</div><!--/tab-pane -->
									
									<div id="assets" class="tab-pane">
										
									
                                      
									</div><!--/tab-pane -->
                                      <div id="distributors" class="tab-pane"></div><!--/tab-pane -->
                                     <div id="routes" class="tab-pane"></div><!--/tab-pane -->
                                     <div id="key_accounts" class="tab-pane">	</div><!--/tab-pane -->
									
									<div id="staff" class="tab-pane"></div><!--/row -->
                                    <div id="cluster_gmm" class="tab-pane"></div><!--/row -->
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

    <!-- js placed at the end of the document so the pages load faster -->

<script src="assets/js/bootstrap.min.js"></script>
	

<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
     
</body>
</html>
