<?php  session_start();
 session_set_cookie_params(3600);

include_once 'config.php';
include_once 'functions.php';

//get the posted values
$user_name=htmlspecialchars($_REQUEST['uname'],ENT_QUOTES);
$pass=md5($_REQUEST['pword']);

//now validating the username and password
$sql="SELECT * FROM tbl_users u WHERE `email`='".$user_name."' and status=0";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
$row=mysqli_fetch_array($result);

//if username exists
if(mysqli_num_rows($result)>0)
{ 
	//compare the password
	if(strcmp($row['password'],$pass)==0)
	{ 
	if(strcmp($row['request_pass_change'],'No')!=0){
	echo "cpd";
		}else echo "yes";
			//now set the session from here if needed
		$_SESSION['u_name']=$user_name; 
		$uid=$_SESSION['u_id']=$row['user_id'];
		$_SESSION['f_name']=$row['full_name'];
		$_SESSION['email']=$row['email'];
		$_SESSION['user_role']=$row['role'];
		$_SESSION['mobile']=$row['mobile'];
		$_SESSION['region_id']=$row['region_id'];
		$_SESSION['distributor_id']=$row['distributor_id'];
		$_SESSION['area_id']=$row['area_id'];
		$_SESSION['cluster_id']=$row['cluster_id'];
		$_SESSION['ppt']=$row['pport'];
		$_SESSION['gender']=$row['gender'];
		$_SESSION['emp_id']=$row['emp_id'];
		//log details
	log_details(8,0,0,0,$uid,'Logged_in');
	$rand=rand(1,10000);
	$ses=mysqli_query($mysqli,"INSERT INTO `tbl_sessions`(`session_name`, `user_id`, `session_status`) VALUES ('$rand',$uid,1)")or die(mysqli_error($mysqli));
	//update login
	$log=mysqli_query($mysqli,"UPDATE `tbl_users` SET `logins`='$today_constant' WHERE `user_id`=$uid") or die(mysqli_error($mysqli));
	 if(isset($_REQUEST['remember'])) {
            //set the cookies for 1 day, ie, 1*24*60*60 secs
            //change it to something like 30*24*60*60 to remember user for 30 days
            setcookie('user_name', $user_name, time() + 1*24*60*60);
            setcookie('password', $pass, time() + 1*24*60*60);}
	}
	else{
	 setcookie('username', '', time() - 1*24*60*60);
      setcookie('password', '', time() - 1*24*60*60);
			
	}
}
else
		echo "no"; //Invalid Login


?>