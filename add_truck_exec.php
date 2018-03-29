<?php
session_start();

 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$reg=clean($_REQUEST['regno']);
$capacity=clean($_REQUEST['cap']);
$descr=clean($_REQUEST['descr']);
$user_id=clean($_SESSION['u_id']);

$q=mysqli_query($mysqli,"INSERT INTO `tbl_vehicles`( `reg_no`, date_added,`added_by`, `capacity`, `description`) VALUES ('$reg','$today_constant',$user_id,'$capacity','$descr')")or die(mysqli_error($mysqli));
if($q)

{	header("location:trucks.php");
	}
	else echo mysqli_errno;
?>