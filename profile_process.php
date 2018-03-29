<?php
function number_of_orders($user_id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) FROM `tbl_orders` WHERE `preordered_by`=$user_id")or die(mysqli_error($mysqli));
	return mysqli_num_rows($q);
	}
function trips_assigned($user_id){  global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) FROM `tbl_orders` WHERE `assigned_to`=$user_id")or die(mysqli_error($mysqli));
	return mysqli_num_rows($q);}
function total_sales($user_id){  global $mysqli;
$q=mysqli_query($mysqli,"SELECT sum(price) as sales FROM `tbl_orders` WHERE `assigned_to`=$user_id")or die(mysqli_error($mysqli));
	$row=mysqli_fetch_array($q);
	return $row['sales'];}
function change_password($user_id,$oldpass,$newpass){  global $mysqli;
	$result=array();
	$newpass= md5($newpass);
		
		$sql="SELECT * FROM tbl_users WHERE `user_id`=$user_id and status=0";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
$row=mysqli_fetch_array($result);
$pass=$row['password'];
if(strcmp($pass,md5($oldpass))!==0){ echo 'wrong old password'; die();}
else
		$q=mysqli_query($mysqli,"UPDATE `tbl_users` SET `password`='$newpass' WHERE user_id=$user_id")or die(mysqli_error($mysqli));
		 echo 'Password Changed old password';}
function logins($user_id){  global $mysqli;
$q=mysqli_query($mysqli,"SELECT `logins` FROM `tbl_users` WHERE `user_id`=$user_id")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
echo $r['logins'];
			}
function reg_date($user_id){  global $mysqli;
$q=mysqli_query($mysqli,"SELECT `date_registered` FROM `tbl_users` WHERE `user_id`=$user_id")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
echo $r['date_registered'];
			}
			
		
 ?>