<?php session_start();
 include ("assets/lib/config.php"); include ("assets/lib/functions.php");
$uid=clean($_REQUEST['uid']);
$del=mysqli_query($mysqli,"UPDATE `tbl_users` SET `status`=1 WHERE `user_id`=$uid") or die(mysqli_error($mysqli));
if($del) header("location:".$_SERVER['HTTP_REFERER'].""); else echo 'error'.mysqli_error($mysqli);
?>