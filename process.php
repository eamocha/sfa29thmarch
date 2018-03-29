<?php
include('assets/lib/config.php');
session_start();
$uid=$_SESSION['u_id'];

$type = $_REQUEST['type'];

if($type == 'new')
{
	$startdate = $_REQUEST['startdate'].'+'.$_REQUEST['zone'];
	$title = $_REQUEST['title'];
	$did = $_REQUEST['id'];
	
	$insert = mysqli_query($con,"INSERT INTO tbl_route_plan( `dealer_id`, `made_by`, `assigned_to`, `title`, `startdate`, `enddate`, `allDay`) VALUES($did,$uid,$uid,'$title','$startdate','$startdate','false')");
	$lastid = mysqli_insert_id($mysqli);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}
if($type == 'changetitle')
{
	$eventid = $_REQUEST['eventid'];
	$title = $_REQUEST['title'];
	$update = mysqli_query($mysqli,"UPDATE tbl_route_plan SET title='$title' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate')
{
	$title = $_REQUEST['title'];
	$startdate = $_REQUEST['start'];
	$enddate = $_REQUEST['end'];
	$eventid = $_REQUEST['eventid'];
	$update = mysqli_query($mysqli,"UPDATE tbl_route_plan SET title='$title', startdate = '$startdate', enddate = '$enddate' where visted=0 and id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove')
{
	$eventid = $_REQUEST['eventid'];
	$delete = mysqli_query($mysqli,"DELETE FROM tbl_route_plan where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch')
{
	$events = array();
	$query = mysqli_query($mysqli, "SELECT * FROM tbl_route_plan rp left join tbl_dealers d on rp.dealer_id=d.dealer_id order by d.business_name");
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$e = array();
    $e['id'] = $fetch['id'];
    $e['title'] = $fetch['business_name'];
    $e['start'] = $fetch['startdate'];
    $e['end'] = $fetch['enddate'];
	$e['color'] = $fetch['color'];
    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;

    array_push($events, $e);
	}
	echo json_encode($events);
}
if($type== 'outlets'){
	$cluster=$_SESSION['cluster_id'];
	$res=array();
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status=0 and cluster_id=$cluster_id")or die (mysql_error());
	while($r=mysqli_fetch_array($q))
	{
		$e=array();
		$e['id']=$r['dealer_id'];
		$e['name']=$r['business_name'];
		array_push($res,$e);
		}
		echo json_encode($res);
	
	}


?>