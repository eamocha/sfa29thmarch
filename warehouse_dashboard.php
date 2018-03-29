<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php'; 
	if(!isset($_SESSION['u_id'])){
header("location:login.php");
}
	
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >
      </script>
      <script type="text/javascript" >
	  
      $(window).load(function(e) {
		  fetch_clients();
	assign_salesperson();
  
        
 //load select boxes
 		load_users();
	
		 });
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
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
									<h5>Inventory</h5>
								</div>
								<p><img src="assets/img/inventory_icon.png" class="" width="100"></p>
								<p><b>Stock details</b></p>
									<div class="row">
																<a href="inventory.php"><span class="btn btn-small btn-success">Click here</span></a>
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
								<p><img src="assets/img/preorder.png" class="" width="100"></p>
								<p><b> New and Unapproved orders</b></p>
									<div class="row">
			<a href="preordered_stock.php"><span class="btn btn-small btn-success">Click here</span></a>
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
								<p><img src="assets/img/payments_icon.jpg" class="img-circle" width="100"></p>
								<p><b>Credit details and past payments</b></p>
									<div class="row">
										<a href="payment_history.php">	<span class="btn btn-small btn-success">Click here</span></a>
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
									<h5>Outlets</h5>
								</div>
								<p><img src="assets/img/outlet.png" class="img-circle" width="100"></p>
								<p><b>List and details</b> of dealers</p>
									<div class="row">
											<a href="sales_clients_list.php"><span class="btn btn-small btn-success">Click here</span></a>
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
									<h5>Sales</h5>
								</div>
								<img src="assets/img/delivery_staff.jpg" class="img-circle" width="100">
								<p><b>Staff who deliver products </b></p>
									<div class="row">
											<button class="btn btn-small btn-success">Click here</button>
									</div>
							</div>
						</div><!-- /col-md-4 -->
                        <!--end first div-->
                         <!--start first div-->
                        <div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
							  <div class="white-header">
									<h5>Assets management</h5>
								</div>
								<img src="assets/img/delivery_staff.jpg" class="img-circle" width="100">
								<p><b>Assets Tracking </b></p>
									<div class="row">
											<button class="btn btn-small btn-success">Click here</button>
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
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
           
        });
                
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
 
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  





 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
