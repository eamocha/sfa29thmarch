<?php session_start();

 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$amount=clean($_REQUEST['amount']);
$ref=clean($_REQUEST['ref_no']);
$currency=clean($_REQUEST['currency']);
$mode=clean($_REQUEST['modeofpayment']);
$did=clean($_REQUEST['did']);
$user_id=$_SESSION['u_id'];
$descr=clean($_REQUEST['description']);
$q=mysqli_query($mysqli,"INSERT INTO `tbl_payments`(  `received_by`, date_time_made, `dealer_id`, `details`, `amount`, `currency`, `mode_of_payment`, `Refernce_no`) VALUES ($user_id,'$today_constant',$did,'$descr','$amount','$currency',$mode,'$ref')")or die(mysqli_error($mysqli));
if($q)

{	goback();
	}
	else echo mysqli_errno;
?>
