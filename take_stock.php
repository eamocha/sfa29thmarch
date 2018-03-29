<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/template.css">
    <link rel="stylesheet" type="text/css" href="assets/css/validationEngine.jquery.css">
      <script type="text/javascript"  src="assets/js/scripts.js"></script> <?php require 'header.php';   $dealer_id=''; $plan_id=$_REQUEST['plan_id'];
	if(isset($_REQUEST['dealer_id'])){
	$dealer_id=$_REQUEST['dealer_id']; 
	}
	else {
	header("location:".$_SERVER['HTTP_REFERER']."");}
	?>
    	</script>
    <script type="text/javascript">
 $(document).ready(function(){
	 		//jQuery(".stock_form").validationEngine("attach");
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
                  <?Php include('take_stock_body.php');?><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
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


   
     <?php include("validation.php");?>
   <script type="text/javascript">
   $(document).ready(function(e) {
    $("#stock_form31").validationEngine();
});   </script>		
	



  </body>
</html>
