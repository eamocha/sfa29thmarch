<?php
session_start();

 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
	$uid=clean($_SESSION['u_id']);//
	$did=clean($_REQUEST["dealer_id"]); //dealer id

 //fetch last order
 $q=mysqli_query($mysqli,"SELECT * FROM tbl_orders  order by order_id desc limit 1");
	$ro=mysqli_fetch_array($q); 
	$order_number=$ro['order_id']+1; 
	$order_name=$did.' - '.$order_number ;
	
 $insert = mysqli_query($mysqli,"INSERT INTO `tbl_orders`( `order_name`,date_made, `preordered_by`,`dealer_id` ) VALUES ( '".$order_name."','$today_constant',$uid,$did )") or die(mysqli_error($mysqli));
	 if(!$insert) { die(mysqli_error($mysqli));}
	 else
	  $order_id=mysqli_insert_id();
	  header("location:preorder_details.php?order_id=$order_id&dealer_id=$did");
	 

?>