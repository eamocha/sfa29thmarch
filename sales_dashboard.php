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
    <![endif]-->
     <script src="assets/js/chart-master/Chart.js"></script> <?php require 'header.php'; 
	
	if(!isset($_SESSION['u_id'] )&& $_SESSION['u_id']=='' && !isset($_SESSION['f_name'] )&& $_SESSION['f_name']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['user_role'] )&& $_SESSION['user_role']==''&& !isset($_SESSION['region_id'] )&& $_SESSION['region_id']=='')
	{
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
     <?php if($user_role==1)include("index_sales.php"); else if($user_role==2) include("index_sales.php");else if($user_role==3) include("index_sales.php");else if($user_role==4) include("operations_index.php") ?>
                  
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
	

	
        
      
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
 
<script type="text/javascript">
        $(document).ready(function () {
			//message();
			
        return false;
        });
	</script>


    
  </body>
</html>
