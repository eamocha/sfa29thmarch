<?php

 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
 $pay_id=clean($_REQUEST['pay_id']);
$amount=clean($_REQUEST['amount']);
$ref=clean($_REQUEST['ref_no']);
$currency=clean($_REQUEST['currency']);
$mode=clean($_REQUEST['modeofpayment']);
$did=clean($_REQUEST['did']);
$user_id=clean($_SESSION['u_id']);
$descr=clean($_REQUEST['description']);
$q=mysql_query("UPDATE `tbl_payments` SET `details`='$descr',`amount`=$amount,`currency`=$currency,`mode_of_payment`=$mode,`Refernce_no`='$ref' WHERE `payment_id` =$pay_id")or die(mysql_error());
if($q)

{	goback();
	}
	else echo mysql_errno;
?>
