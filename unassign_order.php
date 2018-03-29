<?php 
include("assets/lib/config.php");include("assets/lib/functions.php");
$oid=$_REQUEST['oid'];
$q=mysql_query("UPDATE `tbl_orders` SET `assigned_by`=0,`date_time_assigned`=0,`route_id`=0,`status`=0 where order_id=$oid") or die(mysql_query());
if($q){
	goback();
	}
?>