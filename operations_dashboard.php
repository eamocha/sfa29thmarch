<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="assets/image/favicon.ico">
     <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php'; 
	if(!isset($_SESSION['u_id'])){
header("location:login.php");
}
	
	//fecgh user_nam
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >
      </script>
      <script type="text/javascript" >
	  
      $(window).load(function(e) {
		//  fetch_clients();
	//assign_salesperson();
  
        
 //load select boxes
 		load_users();
		//table for dealers
		
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

              <div class="row" >
              
                  <div class="col-lg-9" style="padding-top:10px">
                 
                  <!-- *******************************************************************-->
                    <!--start first div-->
                  <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
							  <div class="white-header">
									<h5>Routes</h5>
								</div>
								<p><img src="assets/img/imagesrooutes.jpg" width="100"  alt="routes"></p>
								<p><b>Create &amp; Assign routes</b></p>
									<div class="row">
											<a href="view_routes.php"><span class="btn btn-small btn-success">Click here</span></a>
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
								<p><img src="assets/img/deliver_icon.jpg" class="img-circle" width="100"></p>
								<p><b>Details about products delivery </b></p>
									<div class="row">
											<button class="btn btn-small btn-success">Click here</button>
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
								<p><img src="assets/img/preorder.png" width="100"></p>
								<p><b>Pre sales and orders approved for dispatch</b></p>
									<div class="row">
											<a href="operations_preorders.php"><span class="btn btn-small btn-success">Click here</span></a>
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
									<h5>Trucks</h5>
								</div>
								<p><img src="assets/img/Truck.png"  width="100"></p>
								<p><b>List of vehicles and thier status</b></p>
									<div class="row">
												<a href="trucks.php"><span class="btn btn-small btn-success">Click here</span></a>
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
									<h5>Stock Levels</h5>
								</div>
								<p><img src="assets/img/stock.jpg"  width="120" height="110" class=""></p>
								<p><b>Details of stock held in outlets</b></p>
									<div class="row">
										<a href="stock_levels.php"><span class="btn btn-small btn-success">Click here</span></a>
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
									<h5>Payments</h5>
								</div>
								<img src="assets/img/payments_icon.jpg" width="100">
								<p><b>Recieve payments and issue receipts</b></p>
									<div class="row">
										<a href="clients_collect_cash.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                 <!-- *******************************************************************-->
                         
                      
                  
                  </div><!--end col-lg-9 main chart
                  
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




    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    >

    <!--script for this page-->
	
	
    	
  </body>
</html>
