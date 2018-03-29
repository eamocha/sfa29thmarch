<?php
session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$user_name=clean($_REQUEST['uname'],ENT_QUOTES);

$sql="SELECT * FROM tbl_users WHERE `email`='$user_name' and status=0";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
$row=mysqli_fetch_array($result);

//if username exists
if(mysqli_num_rows($result)>0)
{ 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$new_pass= mt_rand();
 $pass=md5($new_pass);
 $uid=$row['user_id'];
 $ip=getClientIP();
 $to=$row['email'];
 $subject = "SFA Password Reset";
 $txt = "Hi Eric,\r\n your password was reset from $ip at $today_constant .\r\n  Your new Password is<b> $new_pass</b>.\r\n. Visit <a href='http://almasisfa.com'>Almasi SFA</a> to login";
$headers .= "From:info@almasisfa.co.ke" . "\r\n" ;
//send the email
mail($to,$subject,$txt,$headers);
//update the record password
mysqli_query($mysqli,"UPDATE `tbl_users` SET  `password`='$pass' WHERE `user_id`=$uid") or die(mysqli_error($mysqli));
 
		echo 1;
	
		

	}
else
		echo "no"; //Invalid Login


?>