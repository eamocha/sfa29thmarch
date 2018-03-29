 <?php
 session_start();
 $uid=$_SESSION['u_id'];
  include('assets/lib/config.php'); include('assets/lib/functions.php');
   $lon=$_REQUEST['lon'];
   $lat=$_REQUEST['lat'];
   $time=$today_constant;//$_REQUEST['tm'];
   $q=mysqli_query($mysqli,"INSERT INTO `tbl_locations`( `time`, `user_id`, `lat`, `lon`) VALUES ('$time',$uid,$lat,$lon)") or die(mysqli_error($mysqli));
		 ?>