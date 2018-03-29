<?php session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
 $plan_id=clean($_REQUEST['plan_id']);
$inside=clean($_REQUEST['inside_advert']);
$outside=clean($_REQUEST['outside_advert']);
$long=clean($_REQUEST['long']);
$lat=clean($_REQUEST['lat']);
$did=clean($_REQUEST['did']);
$user_id=$_SESSION['u_id'];
$machandize=clean($_REQUEST['mechandazing']);
$chilled=clean($_REQUEST['chilled']);
$remarks=clean($_REQUEST['survey_remarks']);
$light_pannels=clean($_REQUEST['light_pannels']);
$Coasters=clean($_REQUEST['Coasters']);
$glasses=clean($_REQUEST['glasses']);
$brunners=clean($_REQUEST['brunners']);
$neon=clean($_REQUEST['neon']);
$prom=clean($_REQUEST['prom']);
$image1=''; $image2=''; $image3=''; $image4='';
if(isset($_FILES["image1"]["name"])){
	$image1=$_FILES["image1"]["name"];
	$file_s=$_FILES["image1"]["size"];
	$temp=$_FILES["image1"]["tmp_name"];
	$image1=upload_image($image1,$file_s,$temp);
		} else $image1='';
		//test echo $image1; exit();
if(isset($_FILES["image2"]["name"])){
	$image2=$_FILES["image2"]["name"];
	$file_s=$_FILES["image2"]["size"];
	$temp=$_FILES["image2"]["tmp_name"];
	$image2=upload_image($image2,$file_s,$temp);
	} else $image2='';
	if(isset($_FILES["image3"]["name"])){
	$image=$_FILES["image3"]["name"];
	$file_s=$_FILES["image3"]["size"];
	$temp=$_FILES["image3"]["tmp_name"];
	$image3=upload_image($image,$file_s,$temp);
	} else $image3='';
//check whether it has been done

$q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE id=$plan_id limit 1")or die(mysql_error());
$check_r=mysql_fetch_array($q);
if($check_r['merchandized']==1){
	$q=mysql_query("update `tbl_check_in` set `running_promotion`=$prom, `dealer_id`=$did, `route_plan_id`=$plan_id, `user_id`=$user_id, `date_timein`='$today_constant', `longtitute`='$long', `latitute`='$lat',  `inside_advert`=$inside, `outside_advert`=$outside, `has_glasses`=$glasses, `has_coasters`=$Coasters, `mechandize`=$machandize, `remarks`='remarks', `fridge`=$chilled, `has_light_pannels`=$light_pannels, `has_bar_runners`=$brunners, has_neon_signs=$neon, `image1`='$image1', `image2`='$image2', `image3`='$image3' WHERE route_plan_id=$plan_id")or die(mysql_error());
	header("location:visit_report.php?dealer_id=$did&plan_id=$plan_id");
	}
	 else{
                         //insert 
$query=mysql_query("INSERT INTO `tbl_check_in`( `running_promotion`, `dealer_id`, `route_plan_id`, `user_id`, `date_timein`, `longtitute`, `latitute`,  `inside_advert`, `outside_advert`, `has_glasses`, `has_coasters`, `mechandize`, `remarks`, `fridge`, `has_light_pannels`, `has_bar_runners`, `has_neon_signs`, `image1`, `image2`, `image3`) VALUES ($prom,$did,$plan_id,$user_id,'$today_constant','$long','$lat',$inside,$outside,$glasses,$Coasters,$machandize,'$remarks',$chilled,$light_pannels,$brunners,$neon,'$image1','$image2','$image3')")or die(mysql_error());

if($query)
{	
$q=mysql_query("UPDATE `tbl_route_plan` SET `merchandized`=1  WHERE id=$plan_id")or die(mysql_error());

header("location:visit_report.php?dealer_id=$did&plan_id=$plan_id");
	}
	else echo mysql_errno;
	}
?>