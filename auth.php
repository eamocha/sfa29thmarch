<?php session_start();
date_default_timezone_set('Africa/Nairobi');
$today_date_time=date('Y.m.d H:i:s');
$today_date=date('d/m/Y');
$oneyear=60*60*24*365;


	if(!isset($_SESSION['u_id'] )&& $_SESSION['u_id']=='' && !isset($_SESSION['f_name'] )&& $_SESSION['f_name']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['user_role'] )&& $_SESSION['user_role']==''&& !isset($_SESSION['region_id'] )&& $_SESSION['region_id']=='')
	{
header("location:login.php");
}



?>