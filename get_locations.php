 <?php
 $uid=$_REQUEST['uid'];
  include('assets/lib/config.php'); include('assets/lib/functions.php');
   $date=date("Y-m-d");  //$col=today_is($today);
		
		try{
		 $db = new PDO($pdo, $db_username, $db_password);
		 $db->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		 $query="SELECT d.`dealer_id` as dealer_id, `business_name`, `channel`, `owner_name`, `designation`, `town`, `place_name`, `longtitute`, `latitute`, `email`, `phone`, `added_by`, `region_id`, d.`status`, d.`reg_date` FROM tbl_route_plan rp LEFT join`tbl_dealers` d on rp.dealer_id=d.dealer_id WHERE `assigned_to`=$uid and DATE(`startdate`)='$date'";
		 $mysql_q=$db->query($query);
		 $locations=$mysql_q->fetchAll();
		 echo json_encode($locations);
		}
		catch(Exception $e){
			echo $e->getMessage();
			}
		 ?>