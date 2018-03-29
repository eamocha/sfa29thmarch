<?php
session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$pid=clean($_REQUEST['pid']);
$cases=(int)clean($_REQUEST['crates']);
$singles=(int)clean($_REQUEST['singles']);
$user_id=clean($_SESSION['u_id']);
$dealer_id=clean($_REQUEST['dealer_id']);
$plan_id=$_REQUEST['plan_id'];

$q=mysqli_query($mysqli,"INSERT INTO `tbl_stock_levels`( `product_id`,route_plan_id, date_added,`cases`, `singles`, `user_id`,dealer_id ) VALUES ($pid,$plan_id,'$today_constant',$cases,$singles,$user_id,$dealer_id)")or die(mysqli_error($mysqli));
if($q)

{ //update the route plan table
	$q=mysqli_query($mysqli,"UPDATE `tbl_route_plan` SET date_visted='$today_constant',`visted`=1,`stock_taken`=1,`color`='#144403'  WHERE id=$plan_id")or die(mysqli_error($mysqli));
	//echo "saved";
		goback();
	}
	else echo mysqli_errno;
?>