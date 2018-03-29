<?php ob_start()?><title>SFA -<?php include 'assets/lib/config.php'; require_once 'auth.php'; include 'assets/lib/functions.php'; 
echo $file= file_ext_strip($_SERVER["REQUEST_URI"]); ?></title>
<?php 
if(!isset($_SESSION['u_id'] )&& $_SESSION['u_id']=='' && !isset($_SESSION['f_name'] )&& $_SESSION['f_name']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['user_role'] )&& $_SESSION['user_role']==''&& !isset($_SESSION['region_id'] )&& $_SESSION['region_id']=='')
	{
header("location:login.php");
}

$EMPTIES="(107,106,105)"; ?>    <!-- Bootstrap core CSS -->

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/advanced-datatable/media/css/jquery.dataTables.css" />
  
   
  <script src="assets/js/advanced-datatable/media/js/jquery.js"></script>
  
  
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
<script src="assets/js/advanced-datatable/media/js/jquery.dataTables.min.js"></script>
     
    <?php //include("validation.php");?>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    <script> //this is to tarck where one is
   // startTracking();
	//getLocation();

    </script>