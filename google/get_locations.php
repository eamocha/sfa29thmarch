 <?php
  include('../assets/lib/config.php'); include('../assets/lib/functions.php');
		
		try{
		 $db = new PDO($pdo, $db_username, $db_password);
		 $db->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		 $query="SELECT * FROM `tbl_dealers` WHERE 1";
		 $mysql_q=$db->query($query);
		 $locations=$mysql_q->fetchAll();
		 echo json_encode($locations);
		}
		catch(Exception $e){
			echo $e->getMessage();
			}
		 ?>