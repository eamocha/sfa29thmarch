<?php
 session_start(); 
 require '../assets/lib/functions.php';
 require '../assets/lib/config.php'; 
 date_default_timezone_set('Africa/Nairobi');
$today_constant=date("Y-m-d H:i:s");
 $today=date("Y-m-d",strtotime($today_constant)); 
 $user_id=$_SESSION['u_id'];
 // update_route_plan();
 // update_orders_done();
 today_dealers($user_id,$today);
 ?>