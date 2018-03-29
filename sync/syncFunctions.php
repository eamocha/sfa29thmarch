<?php
include_once("../assets/lib/config.php");
$connection=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)or die('Could not create a connection to the database : '.mysql_error());
mysql_set_charset('utf8');
mysql_select_db(DB_NAME) or die('Could not select the database : '.mysql_error());

function showE(){
die("Error " . mysql_errno() . " : " . mysql_error( ));
}
$mode=$_REQUEST['mode'];
$user_id=0;
if(isset($_REQUEST['user_id'])) $user_id=$_REQUEST['user_id'];

if($mode=="SyncRoutePlans"){
	getUnSyncedplans($user_id);
}
if($mode=="syncAssets"){
	getUnSyncedAssets();
}
elseif($mode=="SyncOutlets"){
	$region_id=$_REQUEST['region_id'];
		
	getUnSyncedOutlets($region_id);
	}
	elseif($mode==3){
		
		getUnSyncedcheckins($user_id);
		} elseif($mode=="SyncProducts"){
			getUnSyncedProducts();}
			elseif($mode==5){
				
				getUnSyncedOrders($user_id);
				}
				elseif($mode==6){
					
					getUnSyncedOrdersDetails($user_id);}
					elseif($mode==7){
						getUnSyncedregions();
						}elseif($mode=="getUnSyncedStock_levels"){
							getUnSyncedStock_levels($user_id);
							}elseif($mode=="syncOutletCategories"){
								getCategories();
								}
								elseif($mode=="syncRoutes"){
									$region_id=$_REQUEST['region_id'];
										getUnsyncedRoutes($region_id);
								}elseif($mode=="syncDistributors"){
									
										getunsyncedDistributors();
								}
								elseif($mode=="syncSurveyQuestions"){
								getUnsyncedSurveyQuestions();
								}
								elseif($mode=="syncUsers"){
								getUsers();
								}
								elseif($mode=="syncTargets"){
									//$user_id=$_REQUEST['user_id'];
								sync_targets();
								}
								elseif($mode=="syncSettings"){
									syncSettings();
								}
								elseif($mode=="syncAsset_types"){
									
									syncCommon("tbl_asset_types","");
								}
								elseif($mode=="syncQnOptions"){
									
									syncQnOptions();
								}
								
								elseif($mode==9){
								getUnsyncedPayments($user_id);
								}
elseif($mode=='sync_stock_availability_check'){
								stock_availability_check();
								}
	else{
		$r=array();
		
		$r['error']=true; $r['message']="error occured. Mode not set"; 
		
	    $json= json_encode($r);
		echo "[".$json."]";
		}
//................................
	function stock_availability_check(){ global $mysqli;
			   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
		
$result = $mysqli->query("SELECT  * FROM tbl_stock_availability_check WHERE status=0 ") or  die($mysqli->error);
if(mysqli_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysqli_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	$mysqli->close();
		}
	////////////////////////////////////////
	//................................
	function getUnSyncedAssets(){
		
		$role=$_REQUEST["role_id"];
	$user_id=$_REQUEST['user_id'];
	$where=" status=0 ";
	if($role==1){ $where="route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$user_id) and status=0";}
	else {
	$area=$_REQUEST['area_id'];
	$where="area_id=$area and status=0";
	}
	
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	  $result = mysql_query("SELECT  * FROM tbl_assets WHERE dealer_id in ( select dealer_id from tbl_dealers where $where ) and status=0 and sync_status=0") or  die(mysql_error());
if(mysql_num_rows($result)<=0){
	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }

		}

///*********************************************************************************************************************
  function getUnSyncedPlans($user_id) {
	  $date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*10);
	  $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	  $result = mysql_query("SELECT  * FROM tbl_route_plan WHERE assigned_to=".$user_id." and date(startdate)>'$date' and status=0 and syncStatus=0") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }
  }
  //***********************************************************************************************************************/
 function getunsyncedDistributors() {
	 $area_id=$_REQUEST['area_id'];
	  $date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*10);
	  $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	  $result = mysql_query("SELECT  * FROM tbl_distributors WHERE area_id=".$area_id." and status=0") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }
  }//*********************************************
  function getUnSyncedOutlets($region_id) {
	$role=$_REQUEST['role'];
	$user_id=$_REQUEST['user_id'];
	$where=" status=0 ";
	if($role==1){ $where="route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$user_id) and status=0";}
	else{
	$area=$_REQUEST['area_id'];
	$where="area_id=$area and status=0";
	}
	
	//$cluster_id=$_REQUEST['cluster_id'];
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");

$result = mysql_query("SELECT  * FROM tbl_dealers WHERE $where ") or  die(mysql_error());

if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
mb_convert_encoding($rows,'UTF-8','UTF-8');
echo json_encode($rows);
  }	
  }
  ///*********************************************************************
  function syncQnOptions() {
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");

$result = mysql_query("SELECT  * FROM tbl_question_options") or  die(mysql_error());

if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  } 
  ///*********************************************************************
  function syncCommon($table,$condition) {
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");

$result = mysql_query("SELECT  * FROM "+$table+"".$condition) or  die(mysql_error());

if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  } 
   ///*********************************************************************
  function sync_targets() {
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");

$result = mysql_query("SELECT  * FROM tbl_route_targets WHERE 1") or  die(mysql_error());

if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  }
  /////*******************************************************************************************************************/
   function syncSettings() {
		   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
		
$result = mysql_query("SELECT  * FROM tbl_settings WHERE status=0 ") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  }
  /////**********************************************************************************************************************
    function getUnSyncedProducts() {
		   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
		
$result = mysql_query("SELECT  * FROM tbl_products WHERE status=0 ") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  }
  //***********************************************************************************************************************/
function getUnSyncedcheckins($user_id) {
	$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*5);
	    $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	
$result = mysql_query( "SELECT  * FROM tbl_check_in WHERE  date(date_timein)> '$date' and syncStatus=0 and user_id=".$user_id) or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  }
  /////*******************************************************************************************************************/
  function getUnSyncedOrders($user_id) {
	$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*90);
	    $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	  global $mysqli;
$query = "SELECT  * FROM tbl_orders WHERE date(`date_made`)> '$date' and syncStatus=0 and `preordered_by`=".$user_id;
$result = mysql_query($query) or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	
  }   /////*******************************************************************************************************************/
  function getUnSyncedOrdersDetails($user_id) {
	$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*90);
	
$query = "SELECT  * FROM tbl_orders_details WHERE date(`date_added`)> '$date' and syncStatus=0 and `made_by`=".$user_id;
$result = mysqli_query($mysqli,$query) or  die(mysqli_error($mysqli));
$total_rows =  $result->num_rows;
if($result) 
{    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
echo json_encode($rows);		
  }
  /////*******************************************************************************************************************/
  function getUnSyncedregions() {
	$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*90);
	
	  global $mysqli;
$query = "SELECT * FROM `tbl_regions` WHERE 1";
$result = mysqli_query($mysqli,$query) or  die(mysqli_error($mysqli));
$total_rows =  $result->num_rows;
if($result) 
{    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
echo json_encode($rows);		
  } 
   /////*******************************************************************************************************************/
  function getUnSyncedStock_levels($user_id) {
	$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*90);
	
	  global $mysqli;
$query = "SELECT * FROM `tbl_stock_levels` WHERE `syncStatus`=0 and date(`date_added`)>'$date' and `user_id`=$user_id";
$result = mysqli_query($mysqli,$query) or  die(mysqli_error($mysqli));
$total_rows =  $result->num_rows;
if($result) 
{    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
echo json_encode($rows);		
  }
  ////////////////////////////
   function getCategories() {
		  global $mysqli;
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	$result = mysql_query("SELECT  * FROM tbl_outlet_channels WHERE status=0 ") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }		
  }
  ////////////////////////////
   function getUnsyncedRoutes($region_id) {
  
  $role_id=$_REQUEST['role_id'];
  $area_id=$_REQUEST['area_id'];
  $cluster_id=$_REQUEST['cluster_id'];
  $user_id=$_REQUEST['user_id'];
  switch($role_id){
	  case 2:fetch_routes4RM($region_id); break;//rm
	  case 3:fetch_routes4ARM($area_id); break;//arm
	  case 1:fetch_routes4AD($user_id); break;//account developer
	  case 13:fetch_routes4AD($user_id); break;//technician
		 
	  }
	 	
  }///////////////////////////////
  function fetch_routes4RM($region_id){ global $mysqli;
	    $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	$result = mysql_query("SELECT * FROM `tbl_routes` WHERE region_id=$region_id ") or  die(mysql_error());
if(mysql_num_rows($result)<=0){
	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }		
	  }
	  //////////////////for area retail manager
	  function fetch_routes4ARM($area_id){ global $mysqli;
	    $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	$result = mysql_query("SELECT * FROM `tbl_routes` WHERE area_id=$area_id ") or  die(mysql_error());
if(mysql_num_rows($result)<=0){
	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);

  }		
	  }/////////////////////for AD
	  function fetch_routes4AD($user_id){ global $mysqli;
	    $rows=array();
		$none=array("error"=>true,"err_msg"=>"No records found");
	$result = mysql_query("SELECT * FROM `tbl_routes` WHERE route_id IN (SELECT ra.`route_id` as a_rid FROM `tbl_assign_route2adcluster`ra LEFT JOIN tbl_adcluster_asignments adc ON ra.ad_cluster_id=adc.ad_cluster_id  WHERE adc.ad_id=$user_id)") or  die(mysql_error());
if(mysql_num_rows($result)<=0){
	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }		
	  }
  /////////////////////////////////////
     function getUnsyncedSurveyQuestions() {
		 $region_id=$_REQUEST['region_id'];
 global $mysqli;
	   $rows=array();
	  $none=array("error"=>true,"err_msg"=>"No records found");
	$result = mysql_query("SELECT * FROM `tbl_survey_questions` WHERE region=0 or region=$region_id") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{    $rows[] = $my_res;
}
echo json_encode($rows);
  }			
  }///////////////////////////////////////////
  function getUsers() {
 global $mysqli;
 $area=$_REQUEST['area_id']; $role_id=$_REQUEST['role_id'];$user_id=$_REQUEST['user_id'];

	   $rows=array();
	 $where="status=0";
if($role_id==1){ $where="(role=5 and area_id=$area and status=0) or user_id=$user_id ";}

else{ $where="status=0 and area_id=$area";}
	$result = mysql_query("SELECT * FROM `tbl_users` WHERE $where") or  die(mysql_error());
if(mysql_num_rows($result)<=0){

	echo json_encode($none);
	}
	else{
while($my_res=mysql_fetch_assoc($result)) 
{
    $rows[] = $my_res;
}
echo json_encode($rows);
  }	//end else		
  }
  ////////////////////////
  function getUnSyncedPayments($user_id) {
	$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*90);
	
	  global $mysqli;
$query = "SELECT * FROM `tbl_payments` WHERE date(date_time_made)>'$date' and `received_by`=$user_id and `syncStatus`=0";
$result = mysqli_query($mysqli,$query) or  die(mysqli_error($mysqli));
$total_rows =  $result->num_rows;
if($result) 
{    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
echo json_encode($rows);		
  } 
  
?>