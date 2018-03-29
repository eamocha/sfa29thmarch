<?php
/**
 * Creates Unsynced rows data as JSON

    
 */
 include_once 'db_functions.php';
 

   if(true){
    $db = new DB_Functions();
	$u2=$db->getAllUsers2();
//	$u2=$db->getAllUsers2();
echo "<br>";
	
    $users = $db->getUnSyncRowCount();
	
    $a = array();
    $b = array();
    if ($users != false){
        while ($row = mysql_fetch_array($users)) {  
		$b["error"]="false";      
            $b["plan_id"] = $row["Id"];
            $b["dealer_id"] = $row["Name"];
			  $b["made_by"] = $row["Name"];
			  $b["assigned_to"] = $row["Id"];
            $b["visted"] = $row["Name"];
			  $b["date_visted"] = $row["Name"];
			  $b["startdate"] = $row["Id"];
            $b["enddate"] = $row["Name"];
			  $b["status"] = $row["Name"];
			  $b["color"] = $row["Name"];
			  $b["merchandized"] = $row["Name"];
			  $b["order_dane"] = $row["Id"];
            $b["stock_taken"] = $row["Name"];
			  $b["status"] = $row["Name"];
			  $b["message"]="went truw";
			  
             array_push($a,$b);
        }
        echo json_encode($a);
    }
   }
   else{ $r=array();
   		$r['error']="true"; $r['message']="error occured"; 
		
	    $json= json_encode($r);
		echo "[".$json."]";
   }
?>