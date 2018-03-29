<?php
/**
 * Updates Sync status of Users
 */
include_once 'db_functions.php';
//Create Object for DB_Functions clas
$db = new DB_Functions(); 

if(isset($_REQUEST["ChangeStatusInDealers"])){
//Get JSON posted by Android Application
$json = $_REQUEST["ChangeStatusInDealers"];
//Remove Slashes
if (get_magic_quotes_gpc()){
$json = stripslashes($json);
}
//Decode JSON into an Array
$data = json_decode($json);
//Util arrays to create response JSON
$a=array();
$b=array();
//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{

$res = $db->updateDealersSyncSts($data[$i]->dealer_id,$data[$i]->syncStatus);
    //Based on inserttion, create JSON response
    if($res){
        $b["dealer_id"] = $data[$i]->dealer_id;
        $b["syncStatus"] = 1;
        array_push($a,$b);
    }else{
        $b["dealer_id"] = $data[$i]->dealer_id;
        $b["syncStatus"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
} 
//********************************************************************************************************************
else if(isset($_REQUEST["ChangeStatusInPlans"]))

{
	$json = $_REQUEST["ChangeStatusInPlans"];
	//Remove Slashes
if (get_magic_quotes_gpc()){
$json = stripslashes($json);
}
//Decode JSON into an Array
$data = json_decode($json);
//Util arrays to create response JSON
$a=array();
$b=array();
//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{

$res = $db->updatePlansSyncSts($data[$i]->id,$data[$i]->syncStatus);
    //Based on inserttion, create JSON response
    if($res){
        $b["id"] = $data[$i]->id;
        $b["syncStatus"] = 1;
        array_push($a,$b);
    }else{
        $b["id"] = $data[$i]->id;
        $b["syncStatus"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
?>