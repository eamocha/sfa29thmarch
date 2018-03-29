<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="assets/image/favicon.ico">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <script type="text/javascript"  src="assets/js/scripts.js"></script> <?php require 'header.php';  $plan_id=$_REQUEST['plan_id'];
	//$oid=$_REQUEST['oid'];
	 $dealer_id='';
	if(isset($_REQUEST['dealer_id'])){
	$dealer_id=clean($_REQUEST['dealer_id']); 
	}
	else {
	header("location:".$_SERVER['HTTP_REFERER']."");}
	?>
  <script type="text/javascript" >
	 $(document).ready(function(){
	if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
    var x=position.coords.latitude;
     var y= position.coords.longitude;
		 $("#lat").val(x);$("#long").val(y);
    }); }//end if
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
                  <?Php include('checkin1.php');?><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?php include('home_right.php');?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
   
    <script src="assets/js/bootstrap.min.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>	


	
	<script src="assets/js/advanced-form-components.js"></script>    
    
    
 
  </body>
</html>
