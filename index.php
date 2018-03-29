<?php ob_start();?><!DOCTYPE html>
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
    <![endif]-->
     
    <?php require 'header.php';
	
	
	if(!isset($_SESSION['u_id'] )&& $_SESSION['u_id']=='' && !isset($_SESSION['f_name'] )&& $_SESSION['f_name']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['user_role'] )&& $_SESSION['user_role']==''&& !isset($_SESSION['region_id'] )&& $_SESSION['region_id']=='')
	{
header("location:login.php");
}
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >
      </script>
      <script type="text/javascript" >
	  
      $(window).load(function(e) {

 		load_users();
	
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
      *********************************************************************************************************************************************************** -->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <?php ob_start(); if($user_role==1){ echo "<script type='text/javascript'>window.location.href = 'routes.php';</script>";  } else if($user_role==2) include("regional_index.php");else if($user_role==3) include("arm_index.php");else if($user_role==4) header("location: sfe.php"); /*include("operations_index.php");*/ else if($user_role==5) include("arm_index.php");else if($user_role==6) include("index_ka_exec.php"); else if($user_role==7) header("location:delivery_dashboard.php"); else if($user_role==8) include("arm_index.php"); else if($user_role==9) include("cap_manager.php");
	 else if($user_role==10) include("distributor_index.php");else if($user_role==11) header("location:cooler_technician.php");?>
                  
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

    <!--script for this page-->
       
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<!--<script src="assets/js/advanced-form-components.js"></script>  -->
	
	
 

  </body>
</html>