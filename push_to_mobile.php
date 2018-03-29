<?php
 include ("assets/lib/config.php"); include ("assets/lib/functions.php");
$uid=clean($_REQUEST['uid']);
$region_id=get_user_region($uid);

$week_ago=date("Y-m-d",strtotime(date("Y-m-d"))-86400*5);

$update=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `syncStatus`=0 where `added_by`=$uid") or die(mysqli_error($mysqli));

$routePlans=mysqli_query($mysqli,"UPDATE `tbl_route_plan` SET `syncStatus`=0 WHERE `assigned_to`=$uid and date(`startdate`)>'$week_ago'") or die(mysqli_error($mysqli));
if($routePlans) header("location:".$_SERVER['HTTP_REFERER'].""); else echo 'error'.mysqli_error($mysqli);
?>