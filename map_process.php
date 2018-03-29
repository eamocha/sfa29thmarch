<?php session_start();
include "assets/lib/config.php";include "assets/lib/functions.php";
$uid=$_SESSION['u_id'];
$today=date("Y-m-d H:i:s");
$region_id=$_SESSION['region_id'];
$role=$_SESSION['user_role'];
################ Save & delete markers #################
if($_REQUEST) //run only if there's a post data
{
	//make sure request is comming from Ajax
	$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
	if (!$xhr){ 
		header('HTTP/1.1 500 Error: Request must come from Ajax!'); 
		exit();	
	}
	
	// get marker position and split it for database
	$mLatLang	= explode(',',$_REQUEST["latlang"]);
	$mLat 		= filter_var($mLatLang[0], FILTER_VALIDATE_FLOAT);
	$mLng 		= filter_var($mLatLang[1], FILTER_VALIDATE_FLOAT);
	
	//Delete Marker
	if(isset($_REQUEST["del"]) && $_REQUEST["del"]==true)
	{
		$results = $mysqli->query("update tbl_dealers set status=1 WHERE latitute=$mLat AND longtitute=$mLng");
		if (!$results) {  
		  header('HTTP/1.1 500 Error: Could not delete outlet!'); 
		  exit();
		} 
		exit("Done!");
	}
	
	$mName 		= filter_var($_REQUEST["name"], FILTER_SANITIZE_STRING);
	$mAddress 	= filter_var($_REQUEST["address"], FILTER_SANITIZE_STRING);
	$mType		= filter_var($_REQUEST["type"], FILTER_SANITIZE_STRING);
		

		$channel=clean($_REQUEST['channel']);	 $decision_maker= clean($_REQUEST['decision_maker']); $designation= $_REQUEST['designation']; $tel=$_REQUEST['tel']; 
	//$town=clean($_REQUEST['town']);	
//cname=khwq&channel=3&decision_maker=sj&designation=2&tel=shiq&town=shqj
	
//	$results = $mysqli->query("INSERT INTO `tbl_dealers`( `business_name`, `channel`, `owner_name`, `designation`, `longtitute`, `latitute`,  `phone`, `added_by`, `region_id`, `reg_date`) VALUES ('$mName',$channel,'$decision_maker',$designation,$mLng,$mLat, '$tel',$uid,$region_id,'$today')");
	$results = $mysqli->query("UPDATE `tbl_dealers` SET `longtitute`=$mLng,`latitute`=$mLat WHERE `dealer_id`=$designation");
	
	if (!$results) {  
		  header('HTTP/1.1 500 Error: Could not create marker!'); 
		  exit();
	} 
	
	$output = '<h1 class="marker-heading">'.$mName.'</h1><p>'.$decision_maker.'</p><p>'.$tel.'</p>';
	exit($output);
}


################ Continue generating Map XML #################

//Create a new DOMDocument object
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers"); //Create new element node
$parnode = $dom->appendChild($node); //make the node show up 

// Select all the rows in the markers table
$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$mySubArea=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" status=0 order by region_id, area_id";
	if($role==4){ $where=" status=0 ";}//cm
		else if($role==2) $where=" region_id=$myregion and status=0 "; //rm
		else if($role==3) $where=" area_id=$myArea and status=0 ";//arm
		else if($role==1) $where=" cluster_id=$mySubArea and status=0 "; //AD
		 

$results = $mysqli->query("SELECT * FROM tbl_dealers WHERE $where");


if (!$results) {  
	header('HTTP/1.1 500 Error: Could not get markers!'); 
	exit();
} 

//set document header to text/xml
header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each
while($obj = $results->fetch_object())
{ $name=business_name($obj->dealer_id);//get the business name with a link
$visits=times_visited($obj->dealer_id);
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("name",$name);
  $newnode->setAttribute("address", $obj->phone);  
  $newnode->setAttribute("lat", $obj->latitute);  
  $newnode->setAttribute("lng", $obj->longtitute);  
  $newnode->setAttribute("type", channel_type($obj->channel));
   $newnode->setAttribute("dealer_id", $obj->dealer_id);
  $newnode->setAttribute("town", $obj->town);
  $newnode->setAttribute("visits", $visits);	
}

echo $dom->saveXML();
//cname=eric+atinga&channel=2&decision_maker=name+of+pesron&designation=2&tel=kkqwq&town=ksa
?>