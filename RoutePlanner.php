<?php
include 'assets/lib/config.php';
include 'assets/lib/functions.php';
$today=date('l', strtotime( $today_constant));

$sel=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE `day`='$today' group by route_assigned_to")or die(mysqli_error($mysqli));
while($rows=mysqli_fetch_array($sel)){
	$rid= $rows["route_id"]; $uid=$rows['route_assigned_to'];
	$outlet_q=mysqli_query($mysqli,"SELECT d.dealer_id as did,business_name FROM `tbl_dealers` d RIGHT JOIN tbl_route_plan rp on rp.dealer_id=d.dealer_id WHERE d.route_id=$rid and d.status=0 group by d.dealer_id order by rp.date_visted asc limit 3 ")or die(mysqli_error($mysqli));
	while($outlet_row=mysqli_fetch_array($outlet_q)){
		//echo $outlet_row['region_id']." ".." ".$outlet_row['date_visted']."</br>";
		plan($outlet_row['did'],$uid,$uid,$outlet_row['business_name'],$today_constant,$today_constant);
		}
	}
	
	function plan($did,$uid,$uid,$title,$check_date,$startdate){
			global $mysqli;	
	//check whther the date has passwed or not
	$check_date=date("Y-m-d",strtotime($startdate));
	$today=date('Y-m-d');
	//check whether it has been scheduled before rescheduling again
	$q=mysqli_query($mysqli,"SELECT * FROM tbl_route_plan  where dealer_id=$did and date(startdate)='$check_date' and status=0")or die(mysqli_error($mysqli));
	if(mysql_num_rows($q)==0){
	if(strtotime($check_date)>=strtotime($today)){
	
	$insert = mysqli_query($mysqli,"INSERT INTO tbl_route_plan( `dealer_id`, `made_by`, `assigned_to`, `title`, `startdate`, `enddate`, `allDay`) VALUES($did,$uid,$uid,'$title','$check_date','$startdate','false')");
	$lastid = mysqli_insert_id($mysqli);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));}//end iff not available 
	else{
		}//dont insert if already scheduled
	}
}
?>