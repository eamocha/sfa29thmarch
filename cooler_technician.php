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
	else if($_SESSION['ppt']=='') header("location:uploadppt/index.php");
	//fecgh user_nam
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >
      </script>
      <script type="text/javascript" >
	  
      $(window).load(function(e) {
		  fetch_clients();
	assign_salesperson();
  
        
 //load select boxes
 		load_users();
		//table for dealers
		$('#hidden-table-info').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "assets/js/advanced-datatable/examples/server_side/scripts/client_list.php"
				} );
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
									<h5>Routes</h5>
								</div>
							  <p><img src="assets/img/route_icon.jpg" class="" width="100"></p>
								<p><b>Assigned  and visited routes</b>								</p>
								<div class="row">
								 					<a href="routes.php"><span class="btn btn-small btn-success">Click here</span></a>
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
								<p><b>Deliver and issue delivery Note</b></p>
									<div class="row">
													<a href="deliveries.php"><span class="btn btn-small btn-success">Click here</span></a>
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
								<p><b>Outlets assigned</b></p>
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
									<h5>Payments</h5>
								</div>
								<p><img src="assets/img/payments_icon.jpg" class="img-circle" width="100"></p>
								<p><b>Recieve payment and print recipts</b></p>
									<div class="row">
											<a href="clients_collect_cash.php"><span class="btn btn-small btn-success">Click here</span></a>
									</div>
							</div>
						</div><!-- /col-md-4 -->
           
                      
                  
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
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
  /*      $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to King Beverage DMS!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Developed by cloud connect',
            // (string | optional) the image to display on the left
            image: 'assets/img/eric.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	*/</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "fetch_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
	<script src="assets/js/google-maps/maplace.js"></script>
	<script src="assets/js/google-maps/data/points.js"></script>
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	<script>
	    //ul list example
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-list',
	        controls_type: 'list',
	        controls_title: 'Choose a location:'
	    }).Load();
	
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-tabs',
	        controls_div: '#controls-tabs',
	        controls_type: 'list',
	        controls_on_map: false,
	        show_infowindow: false,
	        start: 1,
	        afterShow: function(index, location, marker) {
	            $('#info').html(location.html);
	        }
	    }).Load();
	</script>
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
