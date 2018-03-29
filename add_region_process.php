<?php
session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$name=clean($_REQUEST['name']);
$descr=clean($_REQUEST['description']);
$user_id=clean($_SESSION['u_id']);
$incharge=clean($_REQUEST['incharge']);
$mode=clean($_REQUEST['mode']);
if($mode=="area"){///////////////////////////
$reg_id=$_REQUEST['region'];
$q=mysqli_query($mysqli,"INSERT INTO `tbl_areas`( `area_name`, `region_id`, `reg_by`, `description`,incharge) VALUES ('$name',$reg_id,$user_id,'$descr',$incharge)")or die(mysqli_error($mysqli));
if($q) goback();		
	else echo mysqli_errno;
		}////////////////////////
	else if($mode=="region"){
$q=mysqli_query($mysqli,"INSERT INTO `tbl_regions`( `region_name`, `added_by`, `date_time`, `description`) VALUES ('$name',$user_id,'$today_constant','$descr')")or die(mysqli_error($mysqli));
if($q)
 {	header("location:regions.php");
	}
	else echo mysqli_errno;
			}
		else if($mode=="cluster"){
			$reg_id=clean($_REQUEST['region']);
			$area_id=clean($_REQUEST['area']);
$q=mysqli_query($mysqli,"INSERT INTO `tbl_clusters`( `cluster_name`, `region_id`, `area_id`, `reg_by`, `description`) VALUES ('$name',$reg_id,$area_id,$user_id,'$descr')")or die(mysqli_error($mysqli));
if($q) goback();		
	else echo mysqli_errno;
		}/////////////////////////////
		else if($mode=="ad_cluster"){
			$cluster_id=clean($_REQUEST['cluster']);
			$reg_id= getColumnName("tbl_clusters","region_id", "cluster_id=".$cluster_id);
			$area_id= getColumnName("tbl_clusters","area_id", "cluster_id=".$cluster_id);
			$q=mysqli_query($mysqli,"INSERT INTO `tbl_ad_clusters`(`ad_cluster_name`, `added_by`, `region_id`, `area_id`, `sub_area_id`, `description`) VALUES ('$name',$user_id,$reg_id,$area_id,$cluster_id,'$descr')")or die(mysqli_error($mysqli));
if($q) goback();		
	else echo mysqli_errno;
		}//////////////////////
			else if($mode=="update_adCluster"){
			$sub_area_id=clean($_REQUEST['sub_area_id']);
			$ad_cluster=clean($_REQUEST['ad_cluster_name']);
		$ad_cluster_id=clean($_REQUEST['ad_cluster_id']);
			$area_id= clean($_REQUEST['area']);
			$q=mysqli_query($mysqli,"UPDATE  `tbl_ad_clusters` SET `ad_cluster_name`='$ad_cluster',  `area_id`=$area_id, `sub_area_id`=$sub_area_id WHERE ad_cluster_id=$ad_cluster_id")or die(mysqli_error($mysqli));
if($q) header("location:AD_clusters.php?mode=area&area_id=$area_id");		
	else echo mysqli_errno;
		}//////////////////////
		else if($mode=="distributor"){
			
			$cluster_id=clean($_REQUEST['cluster']);
			$reg_id= getColumnName("tbl_clusters","region_id", "cluster_id=".$cluster_id);
			$area_id= getColumnName("tbl_clusters","area_id", "cluster_id=".$cluster_id);
			$q=mysqli_query($mysqli,"INSERT INTO `tbl_distributors`( `distributor_name`, `d_description`, `reg_by`,  `cluster_id`, `area_id`, `region_id`, `town`, `longtitute`, `latitute`) VALUES ('$name','$descr',$user_id,$cluster_id,$area_id,$reg_id,'',0,0)")or die(mysqli_error($mysqli));
if($q) goback();		
	else echo mysqli_errno;
		}//////////////////////
		else if($mode=="route"){
			$reg_id=clean($_REQUEST['region']);
			$area_id=clean($_REQUEST['area']);
			$cluster_id=clean($_REQUEST['cluster']);
			$distributor_id=clean($_REQUEST['distributor']);
			$day1=$_REQUEST['day1'];
			$day2=$_REQUEST['day2'];
			
			$date=date("Y-m-d h:i:s");
$q=mysqli_query($mysqli,"INSERT INTO `tbl_routes`( `route_name`, `details`, `distributor_id`, `region_id`, `created_by`, `route_assigned_to`, `Assistant_sales`, `day`, day2,`date_created`) VALUES ('$name','$descr',$distributor_id,$reg_id,$user_id,0,0,'$day1','$day2','$date')")or die(mysqli_error($mysqli));
if($q) goback();		
	else echo mysqli_errno;
				}
else if($mode=="add_route"){
			$distributor_id=clean($_REQUEST['distributor_id']);
			$reg_id=getColumnName("tbl_distributors","region_id", "distributor_id=".$distributor_id);
			$area_id=getColumnName("tbl_distributors","area_id", "distributor_id=".$distributor_id);
			$cluster_id=getColumnName("tbl_distributors","cluster_id", "distributor_id=".$distributor_id);;
			
			$day1=$_REQUEST['day1'];
			$day2=$_REQUEST['day2'];
			
			$date=date("Y-m-d h:i:s");
$q=mysqli_query($mysqli,"INSERT INTO `tbl_routes`( `route_name`, `details`, `distributor_id`, cluster_id,area_id,`region_id`, `created_by`, `route_assigned_to`, `Assistant_sales`, `day`, day2,`date_created`) VALUES ('$name','$descr',$distributor_id,$cluster_id,$area_id,$reg_id,$user_id,0,0,'$day1','$day2','$date')")or die(mysqli_error($mysqli));
if($q) goback();		
	else echo mysqli_errno;
				}



?>