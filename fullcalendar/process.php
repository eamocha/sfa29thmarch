<?php
include('../assets/lib/config.php');session_start();
//check if there are past outlets and mark them red if not visisted
$check= mysqli_query($mysqli,"UPDATE `tbl_route_plan` SET `color`='#FF0000' WHERE DATE(`startdate`)<DATE(NOW()) and `visted`=0");
$uid=$_SESSION['u_id'];
$type = $_REQUEST['type'];

if($type == 'copy')//for copying from month to another
{
	
	
	$from=$_REQUEST['from'];
	$to=$_REQUEST['to'];
	$month_difference=$to-$from;
	
	//fetch and copy to 
	//2015-06-16T00:04:00+03:00 date format
	$insert = mysqli_query($mysqli,"INSERT INTO `tbl_route_plan`( `dealer_id`, `made_by`, `assigned_to`, `title`, `startdate`, `enddate`, `allDay`) SELECT `dealer_id`, $uid, $uid, `title`, DATE_ADD(`startdate`,INTERVAL $month_difference MONTH), DATE_ADD(`enddate`,INTERVAL $month_difference MONTH), `allDay` FROM `tbl_route_plan` WHERE status=0 and MONTH(`startdate`)=$from and assigned_to=$uid");
	//$lastid = mysqli_insert_id($mysqli);
	echo json_encode(array('rows'=>mysqli_affected_rows($mysqli)));
	
}
if($type == 'new')
{
	$startdate = $_REQUEST['startdate'].'+'.$_REQUEST['zone'];
	$title = $_REQUEST['title'];
	$did = $_REQUEST['id'];
	//check whther the date has passwed or not
	$check_date=date("Y-m-d",strtotime($startdate));
	$today=date('Y-m-d');
	//check whether it has been scheduled before rescheduling again
	$q= mysql_query($mysqli,"SELECT * FROM tbl_route_plan  where dealer_id=$did and date(startdate)='$check_date' and status=0")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){
	if(strtotime($check_date)>=strtotime($today)){
	
	$insert = mysqli_query($mysqli,"INSERT INTO tbl_route_plan( `dealer_id`, `made_by`, `assigned_to`, `title`, `startdate`, `enddate`, `allDay`) VALUES($did,$uid,$uid,'$title','$check_date','$startdate','false')");
	$lastid = mysqli_insert_id($mysqli);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));}//end iff not available 
	else{
		}//dont insert if already scheduled
	}
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
	$update = mysqli_query($mysqli,"UPDATE tbl_route_plan SET title='$title', startdate = '$startdate', enddate = '$enddate' where visted=0 and DATE(startdate)>=DATE(NOW()) and id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove')
{
	$eventid = $_REQUEST['eventid'];
	$delete = mysqli_query($mysqli,"update tbl_route_plan set status=1 where id='$eventid' and date(startdate)>=date(NOW())");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch')
{
	$events = array();
	$query = mysqli_query($mysqli, "SELECT * FROM tbl_route_plan rp left join tbl_dealers d on rp.dealer_id=d.dealer_id where rp.status=0 and assigned_to=$uid  order by d.business_name limit 3000") or die(mysqli_error($mysqli));
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
	$cluster_id=$_SESSION['cluster_id'];
	$res=array();
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status=0 and cluster_id=$cluster_id")or die (mysqli_error($mysqli));
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