     <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row" >
              
                  <div class="col-lg-9" style="padding-top:10px">
                 
                  <!-- *******************************************************************-->
                  <h3>Welcome to the Area Manager Dashboard For- <?php $area_id=$_SESSION['area_id']; $region_id=$_SESSION['region_id'];echo get_area( $area_id)?> Area</h3>
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5><?php echo num_rows('tbl_clusters',"status=0 and area_id=".$area_id)?> Sub Areas</h5>
								</div>
								<p><img src="assets/img/list.png" width="80"></p>
								<p><b>Sub Areas within by Area</b></p>
									<div class="row">
											<a href="clusters.php?mode=area&area_id=<?php echo  $_SESSION['area_id'];?>"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                  <!-- *******************************************************************-->
                   
                 <!-- *******************************************************************-->
                 <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Assign Routes To AD clusters</h5>
								</div>
								<p><img src="images/assign.png" alt="assign routes To ad clusters" width="100" class="" /></p>
								<p><b>Sub Areas within by Area</b></p>
									<div class="row">
											<a href="assign_routes2adClusters.php?mode=area&area_id=<?php echo  $_SESSION['area_id'];?>"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                         <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Assign clusters To ADS</h5>
								</div>
								<p><img src="assets/img/assign_cluster_AD.png" class="" width="90"></p>
								<p><b>Assign AD clusters to Individual ADs</b></p>
									<div class="row">
											<a href="assign_adClusters2ADs.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5><?php echo num_rows('tbl_dealers ',"status=0 and area_id=".$area_id)?> New Outlets</h5>
								</div>
								<p><img src="assets/img/outlet.png" class="img-circle" width="100"></p>
								<p><b><?php echo num_rows('tbl_dealers ',"status=0 and verified=1 and area_id=".$area_id)?> Verified and <?php echo num_rows('tbl_dealers ',"status=0 and verified=0 and area_id=".$area_id)?> Unverified</b></p>
									<div class="row">
											<a href="all_outlets.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div>
                  <!-- *******************************************************************-->
                    <!--start first div-->
                    	
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>EDS statistics</h5>
								</div>
								<p><img src="assets/img/deliver_icon.jpg" class="" width="100"></p>
								<p><b><?php echo num_rows('tbl_survey_questions ',"status=0  and region=$region_id or region=0")?> Questions and <?php //echo num_rows('tbl_survey_questions ',"status=0 and verified=0 and region=$region_id or region=0")?> responses </b></p>
									<div class="row">
											<a href="survey_questions.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                 <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5><?php //echo num_rows('tbl_assets ',"status=0  and area_id=$area_id")?> Assets</h5>
								</div>
								<p><img src="assets/img/route_icon.jpg" width="100"></p>
								<p><b>Assets within my Area</b></p>
									<div class="row">
											<a href="assets.php?mode=area&area_id=<?php echo  $_SESSION['area_id'];?>"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                        
                 <!-- *******************************************************************-->
                  <!-- *******************************************************************-->
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Deliveries</h5>
								</div>
								<p><img src="assets/img/deliver_icon.jpg" class="" width="100"></p>
								<p><b>Details about deliveries </b></p>
									<div class="row">
											<a href="deliveries.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                          <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Day Perfomance</h5>
								</div>
								<p><img src="assets/img/deliver_icon.jpg" class="" width="100"></p>
								<p><b>Visits/sales/Orders </b></p>
									<div class="row">
											<a href="daily_perfomance.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                  <!-- *******************************************************************-->
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Preorders</h5>
								</div>
								<p><img src="assets/img/preorder.png" class="img-circle" width="100"></p>
								<p><b>My new and past preorders </b></p>
									<div class="row">
										<a href="sales_preorder.php">	<span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                  <!-- *******************************************************************-->
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Dosa</h5>
								</div>
								<p><img src="assets/img/sales.jpg" class="" width="100"></p>
								<p><b>Carry out Dosa</b></p>
									<div class="row">
												<a href="distributors.php?mode=area&area_id=1<?php //echo $_SESSION['area_id']?>">	<span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 
                  <!-- *******************************************************************-->
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Payments/collections</h5>
								</div>
								<img src="assets/img/payments_icon.jpg" class="img-circle" width="100">
								<p><b>Receive and issue Receipts </b></p>
									<div class="row">
											<a href="clients_collect_cash.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                         
                       <!-- *******************************************************************-->
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Incomplete Outlets</h5>
								</div>
								<img src="assets/img/incomplete.jpg" class="img-circle" width="100">
								<p><b>They dont have all essential info </b></p>
									<div class="row">
											<a href="incomplete_outlets.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                           <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Plans</h5>
								</div>
								<img src="assets/img/plan.jpg" class="img-circle" width="100">
								<p><b>Calender </b></p>
									<div class="row">
											<a href="fullcalendar/index.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                   <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Distributor Targets</h5>
								</div>
								<img src="assets/img/target.png" class="img-circle" width="100">
								<p><b>Area Targets </b></p>
									<div class="row">
											<a href="targets.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                         <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Route Targets</h5>
								</div>
								<img src="assets/img/target.png" class="img-circle" width="100">
								<p><b>Route Targets </b></p>
									<div class="row">
											<a href="targets.php?route=route"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Route Targets</h5>
								</div>
								<img src="assets/img/target.png" class="img-circle" width="100">
								<p><b>Fault Assets </b></p>
									<div class="row">
											<a href="faulty_assets.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Good Morning meeting</h5>
								</div>
								<img src="assets/img/gmm.png" class="img-circle" width="100">
								<p><b>Route Targets </b></p>
									<div class="row">
											<a href="good_morning_meetings.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                  </div><!--end col-lg-9 main chart
                  
      <!-- 