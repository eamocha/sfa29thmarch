<?php
 session_start();
include("config.php");
 include("functions.php");
 
if(isset($_SESSION['u_id'])){
 $user_id=$_SESSION['u_id'];
 log_details(8,0,0,0,$user_id,'Logged out');
 //session close
 mysqli_query($mysqli,"UPDATE `tbl_sessions` SET `e_datetime`='$today_constant',`session_status`=2 WHERE `user_id`=$user_id and session_status=1") or die(mysqli_error($mysqli));
 //remove all the variables in the session 
 session_unset(); 
  // destroy the session 
 session_destroy();
  }

header("location:../../login.php");

?>