<?php
session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
 if(!empty($_REQUEST['details'])){
$did=clean($_REQUEST['did']);
$user_id=$_SESSION['u_id'];
$oid=clean($_REQUEST['oid']);

$type=clean($_REQUEST['type']);
$details=clean($_REQUEST['details']);
$q=mysql_query("INSERT INTO `tbl_comments`( `order_id`, date_posted,`dealer_id`, `details`, `added_by`, `comment_about`) VALUES ($oid,'$today_constant',$did,'$details',$user_id,$type)")or die(mysql_error());
if($q)

{	goback();
	}
	else echo mysql_errno;}
	else goback();
?>