<?php
 include ("assets/lib/config.php"); include ("assets/lib/functions.php");
$pid=clean($_REQUEST['pid']);
$del=mysqli_query($mysqli,"UPDATE  `tbl_products` SET `status`=1 WHERE `product_id`=$pid") or die(mysqli_error($mysqli));
if($del) header("location:".$_SERVER['HTTP_REFERER'].""); else echo 'error'.mysql_error();
?>