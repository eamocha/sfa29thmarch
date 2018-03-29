 <?php
 $uid= $_REQUEST['uid']; 
  include('assets/lib/config.php'); include('assets/lib/functions.php'); $date=date("Y-m-d");
		
		try{
		 $db = new PDO($pdo, $db_username, $db_password);
		 $db->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		 $query="SELECT d.`dealer_id` as `dealer_id`, `business_name`,`channel`,`owner_name`,`designation`,`town`,`place_name`,`longtitute`,`latitute`,`email`,`phone` FROM `tbl_route_plan` r right join tbl_dealers d on d.dealer_id=r.dealer_id WHERE date(`startdate`)='$date' and assigned_to=$uid and r.status=0 ";
		 $mysql_q=$db->query($query);
		 $locations=$mysql_q->fetchAll();
		 echo json_encode($locations);
		}
		catch(Exception $e){
			echo $e->getMessage();
			}
		 ?>