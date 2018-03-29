<?php
session_start();
include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$order_id=clean($_REQUEST['oid']);
$remarks=clean($_REQUEST['remarks']);
$selected_odi=array();
$s_date=date("Y-m-d h:i:s");
$user_id=$_SESSION['u_id'];
$did=clean($_REQUEST['dealer_id']);
if(!empty($_REQUEST['selection'])){
for ($i=0; $i < count($_REQUEST['selection']);$i++) {
 $selected_odi=$_REQUEST['selection'][$i];
$q=mysql_query("UPDATE `tbl_orders_details` SET `date_supplied`='$s_date',`supplied_by`=$user_id, `status`=1 WHERE `order_details_id`=$selected_odi") or mysql_error();
     	   if(!$q){
		   echo mysql_errno();
		   }
		   else echo "done";
		    }
$q=mysql_query("UPDATE `tbl_orders` SET date_supplied='$s_date',supplied_by=$user_id, `status`=1,`delivery_remarks`='$remarks' WHERE `order_id`=$order_id") or die( mysql_error());
		}
header("location:delivery_receipt.php?dealer_id=$did&oid=$order_id");
	?>