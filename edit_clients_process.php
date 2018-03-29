<?php  include ("assets/lib/config.php"); include ("assets/lib/functions.php");
session_start();
$cid=$_REQUEST['cid'];

		$designation=$_REQUEST['designation'];
		$chanel=$_REQUEST['channel'];
		$bname=clean($_REQUEST['cname']);
		$owner=clean($_REQUEST['decision_maker']);
		$phone=clean($_REQUEST['phone']);
	  if(isset($_REQUEST['long']))	$long=clean($_REQUEST['long']); else $long=0;
		if(isset($_REQUEST['lat']))$lat=clean($_REQUEST['lat']); else $lat=0;
		$town=clean($_REQUEST['town']);
		$pname=clean($_REQUEST['place_name']);
		$user_id=$_SESSION['u_id'];
			$type_of_outlet=clean($_REQUEST['type_of_outlet']);
		
	
	$select=mysql_query("SELECT * FROM `tbl_dealers` WHERE `dealer_id`=$cid ") or die(mysql_error());
while($row=mysql_fetch_array($select))
{
	$logged_in_user_id=$_SESSION['u_id'];
	$did=$row['dealer_id'];
	if(strcmp($row['business_name'],$bname)!=0){log_details(2,'$row["business_name"]',$did,2,$logged_in_user_id,'Dealer namechanged');	}
	if(strcmp($row['email'],$email)!=0){log_details(2,'$row["email"]',$did,8,$logged_in_user_id,'changed email');}
	if(strcmp($row['owner_name'],$owner)!=0){log_details(2,'$row["owner_name"]',$did,3,$logged_in_user_id,'changed password');}
if(strcmp($row['town'],$email)!=0){log_details(2,'$row["town"]',$did,4, $logged_in_user_id,"changed town details");}
	if(strcmp($row['place_name'],$owner)!=0){log_details(2,'$row["place_name"]',$did,5,$logged_in_user_id,'changed password');}
	if(strcmp($row['phone'],$phone)!=0){log_details(2,'$row["phone"]',$did,9,$logged_in_user_id,'changed mobile details');}
	if(strcmp($row['description'],$phone)!=0){log_details(2,'$row["description"]',$did,11,$logged_in_user_id,'changed place details');	}
} //edit
	
	$sql="UPDATE `tbl_dealers` SET `business_name`='$bname',`channel`=$chanel,`owner_name`='$owner',`designation`=$designation,`town`='$town',`place_name`='$pname',`longtitute`='$long',`latitute`='$lat',`phone`='$phone',type_of_outlet=$type_of_outlet WHERE `dealer_id`=$cid";
$data=mysql_query($sql);
if($data) header("location:".$_SERVER['HTTP_REFERER'].""); else echo 'error'.mysql_error();

		?>
	
   