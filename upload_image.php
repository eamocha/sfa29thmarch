<?php
session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';

$uid=$_SESSION['u_id'];
$image1=''; $image2=''; $image3=''; $image4='';
if(isset($_FILES["image1"]["name"])){
	$image1=$_FILES["image1"]["name"];
	$file_s=$_FILES["image1"]["size"];
	$temp=$_FILES["image1"]["tmp_name"];
	$image1=upload_image($image1,$file_s,$temp);
		}
	$q=mysqli_query($mysqli,"UPDATE `tbl_users` SET `pport`='$image1' WHERE `user_id`=$uid") or die(mysqli_error($mysqli));
	if($q){
		

if (isset($_SESSION['ppt'])) {
    $_SESSION['ppt'] = $image1;
}
goback();}
?>