<?php session_start();
date_default_timezone_set('Africa/Nairobi');
 require_once "assets/lib/config.php"; require_once "assets/lib/functions.php";
 $mode=$_REQUEST["mode"];
 $result = array();
 define('DATE_TIME','$today_constant');
 
if($mode=='change_pass'){
change_pass();
	}
	if($mode=='fetch_users'){
echo populate_selectionbox_users();
	}
	elseif($mode=='save_route2adCluster'){
 save_route2adCluster();
	}
	elseif($mode=='adcluster_asignment2AD'){
 adcluster_asignment2AD();
	}
else	if($mode=='fetch_area_for_editing'){
		$area_id=$_REQUEST['uid'];
 fetch_area_for_editing($area_id);
	}	if($mode=='area_contribution'){
 area_contribution();
	}
	elseif($mode=='region_contribution'){
 region_contribution();
	}
	if($mode=='distributor_contribution'){
 distributor_contribution();
	}
	if($mode=='route_contribution'){
 route_contribution();
	}
		else if($mode=='removeAdclusterFrmAD'){
			$adClusterId=clean($_REQUEST['ad_cluster_assignment_id']);
 removeAdclusterFrmAD($adClusterId);
	}
	else if($mode=='removeRouteFromCluster'){
		$user_id=clean($_REQUEST['user_id']);
			$route_id=clean($_REQUEST['route_id']);
 removeRouteFromADCluster($route_id,$user_id);
	}
	else if($mode=="fetch"){ 

global $mysqli; $result=array();
$res = mysqli_query($mysqli,"SELECT `user_id`, `full_name`, `email`, `password`,  `role`,`mobile`, `gender`, `logins`, `description`,  `date_registered`, `distributor_id` FROM tbl_users WHERE status = 0 and role=1 order by full_name") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('user_id' => $row['user_id'],'email' => $row['email'],'role' => $row['role'],'phone' => $row['mobile'],'name' => $row['full_name'], ); }
    echo json_encode($result);
	}
	else if($mode=='route_targets'){
 route_targets();
	}
	else if($mode=='reset_pass'){
 reset_pass();
	}
		else if($mode=='restore_user'){
 restore_user();
	}
	else if($mode=='delete_outlets'){
 delete_outlets();
	}
	else if($mode=='fill_area_select_list'){
 fill_area_select_list();
	}
	else if($mode=='fill_sub_area_select_list'){
 fill_sub_area_select_list();
	}
	else if($mode=='fill_route_select_list'){
 fill_route_select_list();
	}
	else if($mode=='unassign_adFromCluster'){
unassign_adFromCluster();
	}
	else if($mode=='assign_ad2Cluster'){
	assign_ad2Cluster();
	} else if($mode=='assign_route2adCluster'){
	assign_route2adCluster();
	} else if($mode=='unassign_routeFromAdCluster'){
	unassign_routeFromAdCluster();
	}
	if($mode=='load_all_regions_to_select_box'){
		echo load_all_regions_to_select_box(); }
		if($mode=="load_area_dropDown"){ $region_id=$_REQUEST['region'];
		load_area_dropDown($region_id);
		}
		if($mode=="load_clusters_dropDown"){ $area_id=$_REQUEST['area'];
		load_clusters_dropDown($area_id);
		}
		if($mode=="load_distributors_dropDown"){ $cluster_id=$_REQUEST['cluster'];
		load_distributors_dropDown($cluster_id);
		}
		if($mode=="load_routes_dropDown"){ $distributor_id=$_REQUEST['distributor'];
		load_routes_dropDown($distributor_id);
		}
	if($mode=='fetch_categories'){
 fetch_categories();
	}
	if($mode=='source_of_prod'){
		$source=$_REQUEST['selected']; if ($source=="stockist") $source=1; else $source=2;
		$oid=$_REQUEST['oid'];
 source_of_products($source,$oid);
	}
if($mode=='quick_plan'){
	$made_by=$_SESSION['u_id'];
	$date=date("Y-m-d");
	$did=$_REQUEST['id'];
make_plan($date,$did,$made_by,0);
echo 'success';
	}
	if($mode=='verify_outlet'){
	
	$did=$_REQUEST['id'];
verify_outlet($did);
echo 'success';
	}
	
	//populate routes select list
	if($mode=='select_routes'){
	
echo select_routes();
	}
	//outlets per specific day
if($mode=='outlets_in_day'){
$day=$_REQUEST['day'];
$user=$_REQUEST['user'];
 outlets_in_day($user);
	}
	//fetch trucks
else if($mode=='fetch_trucks'){
fetch_trucks();
	}/////////////////////////////////
	else if($mode=='fetch_user_roles'){
fetch_user_roles();
	}////////////////////////
	else if($mode=='load_outlets'){
load_outlets();
	}
else if($mode=='user_name')
	{ $uid=$_REQUEST['u_id'];
	users($uid);
		}
		//fetch domant routes
else if($mode=='fetch_dormancy')
	{ 
	$period=$_REQUEST['period'];$order_by=$_REQUEST['dormancy_order_by'];
	fetch_dormancy($order_by,$period);
		}
else if($mode=='add_client')
	{ add_client();
		}
		else if($mode=='add_prospecting')
	{ add_prospecting();
		}
else if($mode=='add_product')
	{ add_product();
		}
		else if($mode=='add_competitor')
	{ add_competitor();
		}
			else if($mode=='add_question_option')
	{ 
		$choice=clean($_REQUEST['choice']);
		$remarks=clean($_REQUEST['remarks']);
		$main_question_id=clean($_REQUEST['main_question_id']);
		
		add_question_option($choice,$main_question_id, $remarks);
		}
			else if($mode=='fetch_options')
	{ fetch_options();
		}
				else if($mode=='fetch_number_options')
	{ fetch_number_options();
		}
		else if($mode=='add_question')
	{ add_question();
		}
else if($mode=='fetch_clients')
	{ fetch_clients();
		}
		else if($mode=='fetch_unverified_clients_in_area')
	{ fetch_unverified_clients_in_area();
		}
		//check wheter a source has been selected
		else if($mode=='order_source_selected')
	{
		$id=$_REQUEST['id']; order_source_selected($id);
		}

		//regional clients
		else if($mode=='fetch_region_clients')
	{  $id=$_REQUEST['id'];
		 regional_clients($id);
		}////////////////
			else if($mode=='filter_clients')
	{  $id=$_REQUEST['id'];
		 clients_withfilters($id);
		}
		//user_ registered outlet_list
			else if($mode=='user_outlet_list')
	{ $id=$_REQUEST['user_id'];
		 user_outlet_list($id);
		 }
		 ///
		 else if($mode=='user_filtered_outlet_list')
	{ $id=$_REQUEST['user_id'];
		 user_filtered_outlet_list($id);
		 }
		////////////////////////
		if($mode=='fetch_category_clients')
	{ $id=$_REQUEST['category'];
		 category_clients($id);
		}
		//PRODUCTS
else if($mode=='fetch_product')
	{ fetch_product();
		}
		else if($mode=='fetch_competitors')
	{ fetch_competitors();
		}
			else if($mode=='fetch_couching_plans')
	{ fetch_couching_plans();
		}
		else if($mode=='fetch_question')
	{ fetch_question();
		}
		//checkin time
		else if($mode=='checkin_time')
	{ checkin_time_basedOn_outlets(); //checkin_time();
		}
else if($mode=='fetch_logs')

{ fetch_logs();
	}
	else if($mode=='fetch_my_logs')
{ 
$uid=$_REQUEST['id'];
fetch_my_logs($uid);
	}
else if($mode=='fetch_regions'){
echo fetch_regions();
	}
else if($mode=='add_user')
	{  add_users();
		}
		else if($mode=='add_level_user')
	{  add_level_user();
		}
else if($mode=='add_userroleForm')	{  add_userroleForm();}
		else if($mode=='add_asset_type')
	{  add_asset_type();
		}
else if($mode=='fetch_userslist')
	{ $status=$_REQUEST['status'];
	fetch_users($status);
		}
else if($mode=='update_user_record')
	{ update_user_record();
		}
else if($mode=='status_change')
	{ status_change($user_id,$changing_id,$status);
		}
		
		//edit user
		else if($mode=='fetch_user_for_editing')
	{ $uid=$_REQUEST['uid'];
		 fetch_user_for_editing($uid);
		}
	//fetch routes assigned on selecting user
	else if($mode=='fetch_assignments')
	{ $date=date('Y-m-d');
	$uid=$_REQUEST['uid'];
		 fetch_assignments($uid,$date);
		}
				//fetch orders
	else if($mode=='fetch_outlets_for_routing')
	{ 
		 fetch_outlets_for_routing();
		}
//fetch details of assigned orders
else if($mode=='fetch_assigned_rote_outlets')
	{ $rid=$_REQUEST['route_id'];
		 fetch_assigned_rote_outlets($rid);
		}
		//assign route
else if($mode=='assign_route')
	{ 	 assign_route();
		}
		///put a querry on or off 
		
		else if($mode=='on_of')
	{ 	 Put_on_off();
		}
else if($mode=='unassign_route')
	{ 	 unassign_route();
		}
		else if($mode=='migrate_client')
	{ 	 migrate_client();
		}///
			else if($mode=='migrate_outlets_from_route_to_route')
	{ 	 migrate_outlets_from_route_to_route();
		}////
		else if($mode=='mapRouteOutlets'){
			mapRouteOutlets();
			
			}
			else if($mode=='edit_user'){
			$uid=$_REQUEST['uid'];
			edit_user($uid);
		}else if($mode=='add_setting'){
			add_setting();	
			}else if($mode=='fetch_settings'){
			fetch_settings();
			
			}else if($mode=='update_subArea'){
			update_subArea();
			
			}else if($mode=='update_subArea_route'){
			update_subArea_route();
			
			}else if($mode=='update_distributor'){
			update_distributor();
			
			}else if($mode=='delete_area')
	{ 	 delete_area();
		}
				else if($mode=='delete_sub_area')
	{ 	 delete_sub_area();
		}
				else if($mode=='delete_ad_cluster')
	{ 	 delete_ad_cluster();
		}
		else if($mode=='delete_distributor')
	{ 	 delete_distributor();
		}
		else if($mode=='delete_route')
	{ 	 delete_route();
		}////
		else if($mode=='edit_route')
	{ 	 edit_route();
		}//
				else if($mode=='delete_question')
	{ 	 delete_question();
		}
		else if($mode=='gmm_supervisor_remarks')
	{ gmm_supervisor_remarks();
		}
			else if($mode=='save_targets')
	{ save_targets();
		}
			else if($mode=='save_region_targets')
	{ save_region_targets();
		}
				else if($mode=='save_sku_contribution')
	{ save_sku_contribution();
		}
			else if($mode=='save_stock_availability_check')
	{ save_stock_availability_check();
		}
				else if($mode=='fetch_availabilitycheck')
	{ fetch_availabilitycheck();
		}
		else if($mode=='delete_stocking_standard')
	{ delete_stocking_standard();
		}
		
		///////////////////functions
		
		function  removeAdclusterFrmAD($ad_cluster_assignment_id){
			global $mysqli;
			$ad_id=clean($_REQUEST['ad_id']);
			$mysqli->query("DELETE FROM `tbl_adcluster_asignments` WHERE ad_cluster_assignment_id=$ad_cluster_assignment_id")or die($mysqli->error);
			$mysqli->query("DELETE FROM `tbl_assign_route2adcluster` WHERE ad_cluster_id in (SELECT ad_cluster_id from tbl_adcluster_asignments where  ad_id=$ad_id and  ad_cluster_assignment_id=$ad_cluster_assignment_id)")or die($mysqli->error);
			goback();
			}////////////////////////////////
			function  removeRouteFromADCluster($route_id,$user_id){
			global $mysqli;
			$mysqli->query("DELETE FROM `tbl_assign_route2adcluster` WHERE route_id=$route_id and ad_cluster_id in (SELECT ad_cluster_id from tbl_adcluster_asignments where ad_id=$user_id)")or die($mysqli->error);
			goback();
			}
			////////////////////////////////////
		function  delete_stocking_standard()
		{
			global $mysqli;
			$id=clean($_REQUEST['id']);
			//$mysqli->query('update tbl_stock_availability_check SET status=0 WHERE avail_check_id=$id')or die();
					$mysqli->query('delete  from tbl_stock_availability_check  WHERE avail_check_id='.$id)or die($mysqli->error);
			goback();
			
			}
		function save_stock_availability_check(){ 	global $mysqli;
		$uid=$_SESSION['u_id'];
		$today=strtotime(date("Y-m-d H:i:s")); 
			
$sku=clean($_REQUEST["sku"]);
$dealer_type=clean($_REQUEST["dealer_type"]);
$channel=clean($_REQUEST["channel"]);
$gqty=clean($_REQUEST["gqty"]);
$sqty=clean($_REQUEST["sqty"]);
$qtyb=clean($_REQUEST["qtyb"]);
$oqty=clean($_REQUEST["oqty"]);
$gscore=clean($_REQUEST["gscore"]);
$sscore=clean($_REQUEST["sscore"]);
$bscore=clean($_REQUEST["bscore"]);
$oscore=clean($_REQUEST["oscore"]);
//clean($_REQUEST[""]);
			$q=$mysqli->query("INSERT INTO `tbl_stock_availability_check`( `product_id`, `market_segment`, `market_channel`, `gold_score`, `silver_score`, `bronze_score`, `other_score`, `other_qty`, `bronze_qty`, `silver_qty`, `gold_qty`, `user_id`,sync_date) VALUES ($sku,'$dealer_type',$channel,$gscore,$sscore,$bscore,$oscore,$oqty,$qtyb,$sqty,$gqty,$uid,'$today') ON DUPLICATE KEY UPDATE `gold_score`='$gscore', `silver_score`='$sscore', `bronze_score`='$bscore', `other_score`='$oscore', `other_qty`='$oqty', `bronze_qty`='$qtyb', `silver_qty`='$sqty', `gold_qty`='$gqty' ") or die($mysqli->error);
						if($q){ echo "Success";}
			}///////////////////////////////
			function 	fetch_availabilitycheck(){
				global $mysqli;
				
				$result=$mysqli->query("SELECT `avail_check_id`, a.`product_id`, `market_segment`, `market_channel`, `gold_score`, `silver_score`, `bronze_score`, `other_score`, `other_qty`, `bronze_qty`, `silver_qty`, `gold_qty`, a.`user_id`,b.product,channel_name FROM (`tbl_stock_availability_check` a LEFT JOIN tbl_products b ON a.product_id=b.product_id) LEFT JOIN tbl_outlet_channels c on a.market_channel=c.channel_id WHERE a.status=0 ORDER BY market_segment,b.pack_size")or die($mysqli->error); 
				$data=array();
				while($row=$result->fetch_array(MYSQLI_ASSOC)){
					$data[]=$row;
					}
				echo json_encode($data);
				/* free result set */
$result->free();

/* close connection */
$mysqli->close();
				}
			/////////////
		function save_targets(){ 	global $mysqli;
		$uid=$_SESSION['u_id'];
		
			$field=clean($_REQUEST['field']);
			$value=clean($_REQUEST['value']);
			$boundary=clean($_REQUEST['boundary']);
			$boundary_id=clean($_REQUEST['boundary_id']);
			$pid=clean($_REQUEST['pid']);
			$today=date('Y-m-d');
			if($field=="qty"){$mysqli->query("INSERT INTO `tbl_targets`( `target_added_by`, `qty`, `market_boundary`, `market_boundary_id`, `product_id`, `target_month`) VALUES ($uid,$value,'$boundary',$boundary_id,$pid,'$today') ON DUPLICATE KEY UPDATE  qty=$value") or die($mysqli->error);}
			else{
				
			$mysqli->query("INSERT INTO `tbl_targets`( `target_added_by`, `remarks`, `market_boundary`, `market_boundary_id`, `product_id`, `target_month`) VALUES ($uid,'$value','$boundary',$boundary_id,$pid,'$today') ON DUPLICATE KEY UPDATE remarks='$value'") or die($mysqli->error);}
			}///////////////////////
			
			function save_region_targets(){ 	global $mysqli;
			$uid=$_SESSION['u_id'];
			$value=clean($_REQUEST['value']);
			$boundary=clean($_REQUEST['boundary']);
			$boundary_id=clean($_REQUEST['boundary_id']);
			$month=date("m"); $year=date("Y");
			$today=date('Y-m-d');//`boundary_target_id`, 
			$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('$boundary',$boundary_id,'$month','$year',$value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$value") or die($mysqli->error);
			//update regions
			general_update_function('tbl_regions',"this_month_target=$value","region_id=$boundary_id");
			
			///Insert for areas
			$qAreas=$mysqli->query("SELECT area_id,area_contribution from tbl_areas where region_id=$boundary_id");
			while($a_row=mysqli_fetch_array($qAreas)){
				$area_id=$a_row['area_id'];
				$area_contribution=$a_row['area_contribution'];
				$area_value=$area_contribution*$value;
				//update areas
				general_update_function('tbl_areas',"this_month_target=$area_value","area_id=$area_id");
				//save areas
				$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('area',$area_id,'$month','$year',$area_value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$area_value") or die($mysqli->error);
				///distributors
				$qDis=$mysqli->query("SELECT distributor_id,distributor_contribution from tbl_distributors where area_id=$area_id");
			while($d_row=mysqli_fetch_array($qDis)){
				$distributor_id=$d_row['distributor_id'];
				$distributor_contribution=$d_row['distributor_contribution'];
				$distributor_value=$distributor_contribution*$value;
				//update areas
				general_update_function('tbl_distributors',"this_month_target=$distributor_value","distributor_id=$distributor_id");
				//save distributors
				$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('distributor',$distributor_id,'$month','$year',$distributor_value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$distributor_value") or die($mysqli->error);
				
				
				//routes
			$qRoutes=$mysqli->query("SELECT route_id,route_contribution from tbl_routes where distributor_id=$distributor_id");
			while($r_row=mysqli_fetch_array($qRoutes)){
				$route_id=$r_row['route_id'];
				$route_contribution=$r_row['route_contribution'];
				$route_value=$route_contribution*$value;
				//update areas
				general_update_function('tbl_routes',"this_month_target=$route_value","route_id=$route_id");
				//save distributors
				$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('route',$route_id,'$month','$year',$route_value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$route_value") or die($mysqli->error);
			}//end routes
				}///end distributors
								
				}//end while area
				
			}/////////////////////// end region targets
			
			
function save_region_targets_based_onBoundaryTargets(){ 	global $mysqli;
		$uid=$_SESSION['u_id'];
			$value=clean($_REQUEST['value']);
			$boundary=clean($_REQUEST['boundary']);
			$boundary_id=clean($_REQUEST['boundary_id']);
			$month=date("m"); $year=date("Y");
			$today=date('Y-m-d');//`boundary_target_id`, 
			$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('$boundary',$boundary_id,'$month','$year',$value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$value") or die($mysqli->error);
			//update regions
			general_update_function('tbl_regions',"this_month_target=$value","region_id=$boundary_id");
			
			///Insert for areas
			$qAreas=$mysqli->query("SELECT area_id,area_contribution from tbl_areas where region_id=$boundary_id");
			while($a_row=mysqli_fetch_array($qAreas)){
				$area_id=$a_row['area_id'];
				$area_contribution=$a_row['area_contribution'];
				$area_value=$area_contribution*$value/100;
				//update areas
				general_update_function('tbl_areas',"this_month_target=$area_value","area_id=$area_id");
				//save areas
				$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('area',$area_id,'$month','$year',$area_value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$area_value") or die($mysqli->error);
				///distributors
				$qDis=$mysqli->query("SELECT distributor_id,distributor_contribution from tbl_distributors where area_id=$area_id");
			while($d_row=mysqli_fetch_array($qDis)){
				$distributor_id=$d_row['distributor_id'];
				$distributor_contribution=$d_row['distributor_contribution'];
				$distributor_value=$distributor_contribution*$area_value/100;
				//update areas
				general_update_function('tbl_distributors',"this_month_target=$distributor_value","distributor_id=$distributor_id");
				//save distributors
				$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('distributor',$distributor_id,'$month','$year',$distributor_value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$distributor_value") or die($mysqli->error);
				
				
				//routes
			$qRoutes=$mysqli->query("SELECT route_id,route_contribution from tbl_routes where distributor_id=$distributor_id");
			while($r_row=mysqli_fetch_array($qRoutes)){
				$route_id=$r_row['route_id'];
				$route_contribution=$r_row['route_contribution'];
				$route_value=$route_contribution*$distributor_value/100;
				//update areas
				general_update_function('tbl_routes',"this_month_target=$route_value","route_id=$route_id");
				//save distributors
				$mysqli->query("INSERT INTO `tbl_boundary_targets`(`boundary`, `boundary_id`, `target_month`, `target_year`, `qty`, `added_by`, `date_added`) VALUES ('route',$route_id,'$month','$year',$route_value,$uid,'$today') ON DUPLICATE KEY UPDATE  qty=$route_value") or die($mysqli->error);
			}//end routes
				}///end distributors
								
				}//end while area
				
			}/////////////////////// end region targets
			//////////////////////////////////////////////////////////////
				function save_sku_contribution(){ 	global $mysqli;
		$uid=$_SESSION['u_id'];
		$field=clean($_REQUEST['field']);
			$value=clean($_REQUEST['value']);
			$boundary=clean($_REQUEST['boundary']);
			$boundary_id=clean($_REQUEST['boundary_id']);
			$pid=clean($_REQUEST['pid']);
			$today=date('Y-m-d');

$mysqli->query("INSERT INTO `tbl_sku_contributions`(`contribution`, `sku_id`, `date_added`, `added_by`, `boundary`, `boundary_id` ) VALUES ($value,$pid,'$today',$uid,'$boundary',$boundary_id) ON DUPLICATE KEY UPDATE  contribution=$value") or die($mysqli->error);
			
			}///////////////////////
	function gmm_supervisor_remarks(){
		global $mysqli;
		$uid=$_SESSION['u_id'];
		$comments_by_supervisor=$_REQUEST['remarks'];
			$id=$_REQUEST['id'];
				$query=mysqli_query($mysqli,"UPDATE `tbl_good_morning_meeting` SET supervisor_id=$uid,comments_by_supervisor='$comments_by_supervisor' WHERE good_morning_meeting_id=$id") or die(mysqli_error($mysqli));			
				header("location: good_morning_meetings.php");}
function delete_outlets(){
	$dealer_id=$_REQUEST['dealer_id'];
	general_update_function(" tbl_dealers "," status=1 "," dealer_id=$dealer_id ");
		general_update_function(" tbl_assets "," status=1 "," dealer_id=$dealer_id ");
			general_update_function(" tbl_survey "," status=1 "," dealer_id=$dealer_id ");
			goback();
	}//////////////////////////////////
	function  fetch_area_for_editing($area_id){
		global $mysqli;
		
		
		$q=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE area_id=$area_id")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ } else {
							while ($row = mysqli_fetch_array($q))
							 { 
    $result[] = $row;
	}
    echo json_encode($result);
		}
	}////////////////////////////////////////
	
	function  area_contribution(){
		global $mysqli;
		$area_id=$_REQUEST['id'];
		$contr=(int)clean($_REQUEST['contr']);
		
		$q=mysqli_query($mysqli,"UPDATE `tbl_areas` set area_contribution=$contr WHERE area_id=$area_id")or die(mysqli_error($mysqli)); 
		if($q){fetch_area_for_editing($area_id); }
				
	}////////////////////////////////////////
	function  region_contribution(){
		global $mysqli;
		$area_id=$_REQUEST['id'];
		$contr=(int)clean($_REQUEST['contr']);
		
		$q=mysqli_query($mysqli,"UPDATE `tbl_regions` set region_contribution=$contr WHERE region_id=$area_id")or die(mysqli_error($mysqli)); 
		//if($q){fetch_area_for_editing($area_id); }
				
	}////////////////////////////////////////
	function  distributor_contribution(){
		global $mysqli;
		$area_id=$_REQUEST['id'];
		$contr=(int)clean($_REQUEST['contr']);
		
		$q=mysqli_query($mysqli,"UPDATE `tbl_distributors` set distributor_contribution=$contr WHERE distributor_id=$area_id")or die(mysqli_error($mysqli)); 
		//if($q){fetch_area_for_editing($area_id); }
				
	}////////////////////////////////////////
	function  route_contribution(){
		global $mysqli;
		$area_id=$_REQUEST['id'];
		$contr=(int)clean($_REQUEST['contr']);
		
		$q=mysqli_query($mysqli,"UPDATE `tbl_routes` set route_contribution=$contr WHERE route_id=$area_id")or die(mysqli_error($mysqli)); 
		//if($q){fetch_area_for_editing($area_id); }
				
	}////////////////////////////////////////
	
	
	function  fill_area_select_list(){
		global $mysqli;
		$region_id=$_REQUEST['id'];
		
		$q=mysqli_query($mysqli,"SELECT area_id,area_name FROM `tbl_areas` WHERE region_id=$region_id and status=0")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ } else {
							while ($row = mysqli_fetch_array($q))
							 { $id=$row['area_id'];
    $result[] = array('name' =>$row['area_name'] ,'id' => $id); 
	}
    echo json_encode($result);
		}
	}////////////////////////////////////
	function  fill_sub_area_select_list(){
		global $mysqli; $where=" status=0 ";
		$id=$_REQUEST['id'];
		$boundary=$_REQUEST['boundary']; 
		if($boundary=="region"){ $where=" region_id=$id and status=0 ";}
		if($boundary=="area"){ $where=" area_id=$id and status=0 ";}
		
		$q=mysqli_query($mysqli,"SELECT cluster_id,cluster_name FROM `tbl_clusters` WHERE $where")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ } else {
							while ($row = mysqli_fetch_array($q))
							 { $id=$row['cluster_id'];
    $result[] = array('name' =>$row['cluster_name'] ,'id' => $id); 
	}
    echo json_encode($result);
		}
	}
	///////////////////////
		function  fill_route_select_list(){
		global $mysqli; $where=" status=0 ";
		$id=$_REQUEST['id'];
		$boundary=$_REQUEST['boundary']; 
		if($boundary=="region"){ $where=" region_id=$id and status=0 ";}
		if($boundary=="area"){ $where=" area_id=$id and status=0 ";}
		if($boundary=="sub_area"){ $where=" cluster_id=$id and status=0 ";}
		
		$q=mysqli_query($mysqli,"SELECT route_id,route_name FROM `tbl_routes` WHERE $where")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ } else {
							while ($row = mysqli_fetch_array($q))
							 { $id=$row['route_id'];
    $result[] = array('name' =>$row['route_name'] ,'id' => $id); 
	}
    echo json_encode($result);
		}
	}
		/////////////////////////////////////////////////////////////////////
		function delete_qs(){ global $mysqli;
			$qid=$_REQUEST['qid'];
			
				$query=mysqli_query($mysqli,"UPDATE `tbl_survey_questions` SET status=1 WHERE survey_qID=$qid") or die(mysqli_error($mysqli));				goback();
			}
		function delete_route(){ global $mysqli;
			$to_delete=$_REQUEST['route_to_delete'];
			
				$new_route=$_REQUEST['move_to'];
				$new_distributor=getColumnName("tbl_routes","distributor_id","route_id=$new_route");
				$new_area=getColumnName("tbl_routes","area_id","route_id=$new_route");
				$new_sub_area=getColumnName("tbl_routes","cluster_id","route_id=$new_route");
				$new_region=getColumnName("tbl_routes","region_id","route_id=$new_route");
				
			
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes` set status=1 WHERE route_id=$to_delete") or die(mysqli_error($mysqli));	///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor,route_id=$new_route  WHERE route_id=$to_delete") or die(mysqli_error($mysqli));
			//update tbl_assign_route2adcluster table
				$query=mysqli_query($mysqli,"UPDATE `tbl_assign_route2adcluster` set route_id=$new_route  WHERE route_id=$to_delete") or die(mysqli_error($mysqli));
				//users
				//$query=mysqli_query($mysqli,"UPDATE `tbl_users` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor,route_id=$new_route WHERE route_id=$to_delete") or die(mysqli_error($mysqli));
				header("location:view_route.php?mode=distributor&distributor_id=$new_distributor");	
			}
			////update outlet
			function edit_route(){ global $mysqli; $now=strtotime(date("Y-m-d H:i:s"));
			$rid=clean($_REQUEST['id']);
				$name=clean($_REQUEST['route_name']);
				$new_distributor=clean($_REQUEST['distributor_id']);
				$new_area=clean($_REQUEST['area_id']);
				$new_sub_area=clean($_REQUEST['cluster_id']);
				$new_region=clean($_REQUEST['region_id']);
				$details=clean($_REQUEST['details']);
				
			
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes`  set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor,route_id=$rid,route_name='$name', details='$details',dateTimeModified=$now WHERE route_id=$rid") or die(mysqli_error($mysqli));	///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor,route_id=$rid  WHERE route_id=$rid") or die(mysqli_error($mysqli));
			//update tbl_assign_route2adcluster table
				$query=mysqli_query($mysqli,"UPDATE `tbl_assign_route2adcluster` set route_id=$rid  WHERE route_id=$rid") or die(mysqli_error($mysqli));
				//users
				//$query=mysqli_query($mysqli,"UPDATE `tbl_users` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor,route_id=$rid WHERE route_id=$rid") or die(mysqli_error($mysqli));
				header("location:view_route.php?mode=distributor&distributor_id=$new_distributor");	
			}
		
		function delete_distributor(){ global $mysqli;
			$dist_to_delete=$_REQUEST['dist_to_delete'];
				$new_distributor=$_REQUEST['move_to'];
				$new_area=getColumnName("tbl_distributors","area_id","distributor_id=$new_distributor");
				$new_sub_area=getColumnName("tbl_distributors","cluster_id","distributor_id=$new_distributor");
				$new_region=getColumnName("tbl_distributors","region_id","distributor_id=$new_distributor");
				
			$query=mysqli_query($mysqli,"UPDATE `tbl_distributors` set status=2  WHERE distributor_id=$dist_to_delete") ;//or die(mysqli_error($mysqli));
			///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor  WHERE distributor_id=$dist_to_delete") or die(mysqli_error($mysqli));
			//update routes table
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor  WHERE distributor_id=$dist_to_delete") or die(mysqli_error($mysqli));
				$query=mysqli_query($mysqli,"UPDATE `tbl_users` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor  WHERE distributor_id=$dist_to_delete") or die(mysqli_error($mysqli));
				header("location:distributors.php?mode=cluster&cluster_id=$new_sub_area");
			}/////////////////////////////////////////
			
			/////////////////////////////////////////////
			function delete_area(){ global $mysqli;
			$to_delete=$_REQUEST['area_to_delete'];
				$new_area=$_REQUEST['move_to'];
				$new_region=getColumnName("tbl_areas","region_id","area_id=$new_area");
				
				$query=mysqli_query($mysqli,"UPDATE `tbl_areas` set status=1  WHERE area_id=$to_delete") ;//
				///distributors
			$query=mysqli_query($mysqli,"UPDATE `tbl_clusters` set area_id=$new_area  WHERE area_id=$to_delete") or die(mysqli_error($mysqli));
			$query=mysqli_query($mysqli,"UPDATE `tbl_ad_clusters` set area_id=$new_area  WHERE area_id=$to_delete") or die(mysqli_error($mysqli));
				
			$query=mysqli_query($mysqli,"UPDATE `tbl_distributors` set area_id=$new_area  WHERE area_id=$to_delete") or die(mysqli_error($mysqli));
			///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set region_id=$new_region,area_id=$new_area  WHERE area_id=$to_delete") or die(mysqli_error($mysqli));
			//update routes table
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes` set region_id=$new_region,area_id=$new_area WHERE area_id=$to_delete") or die(mysqli_error($mysqli));
				$query=mysqli_query($mysqli,"UPDATE `tbl_users` set region_id=$new_region,area_id=$new_area  WHERE area_id=$to_delete") or die(mysqli_error($mysqli));
				header("location:areas.php?mode=region&region_id=$new_region");
			}
			///////////////////////////////////////////////
		
		function delete_sub_area(){ global $mysqli;
		
			$to_delete=$_REQUEST['subArea_to_delete'];
				$new_sub_area=$_REQUEST['move_to'];
				$new_area=getColumnName("tbl_clusters","area_id","cluster_id=$new_sub_area");
				//$new_sub_area=getColumnName("tbl_distributors","cluster_id","distributor_id=$new_distributor");
				$new_region=getColumnName("tbl_clusters","region_id","cluster_id=$new_sub_area");
			
				$query=mysqli_query($mysqli,"UPDATE `tbl_clusters` SET status=1 WHERE cluster_id=$to_delete") or die(mysqli_error($mysqli));
				
					$query=mysqli_query($mysqli,"UPDATE `tbl_ad_clusters` SET sub_area_id=$new_sub_area,area_id=$new_area  WHERE sub_area_id=$to_delete") or die(mysqli_error($mysqli));
		
				///distributors
			$query=mysqli_query($mysqli,"UPDATE `tbl_distributors` set cluster_id=$new_sub_area,area_id=$new_area  WHERE cluster_id=$to_delete") or die(mysqli_error($mysqli));
			///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area  WHERE cluster_id=$to_delete") or die(mysqli_error($mysqli));
			//update routes table
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes` set region_id=$new_region,area_id=$new_area,cluster_id=$new_sub_area WHERE cluster_id=$to_delete") or die(mysqli_error($mysqli));
				$query=mysqli_query($mysqli,"UPDATE `tbl_users` set region_id=$new_region,area_id=$new_area,cluster_id=$new_sub_area  WHERE cluster_id=$to_delete") or die(mysqli_error($mysqli));
				header("location:clusters.php?mode=area&area_id=$new_area");
			}////////////////////////////////////
			function update_subArea_route(){ global $mysqli;
			
				$sub_area=clean($_REQUEST['sub_area']);
				$route_id=clean($_REQUEST['route_id']);
					$dealer_id=clean($_REQUEST['dealer_id']);
				
				$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `cluster_id`=$sub_area,route_id=$route_id WHERE dealer_id=$dealer_id") or die(mysqli_error($mysqli));
				header("location: incomplete_outlets.php");
				}////////////////////////////////////
			function update_subArea(){ global $mysqli;
				$area=clean($_REQUEST['area_id']);
				$sub_area=clean($_REQUEST['sub_area']);
				$sub_id=clean($_REQUEST['sb_area_id']);
				$query=mysqli_query($mysqli,"UPDATE `tbl_clusters` SET `cluster_name`='$sub_area',area_id=$area WHERE cluster_id=$sub_id") or die(mysqli_error($mysqli));
				
				$query=mysqli_query($mysqli,"UPDATE `tbl_distributors` SET area_id=$area WHERE cluster_id=$sub_id") or die(mysqli_error($mysqli));
				
			
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes`  set area_id=$area WHERE cluster_id=$sub_id") or die(mysqli_error($mysqli));	///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set area_id=$area WHERE cluster_id=$sub_id") or die(mysqli_error($mysqli));
				
				header("location: clusters.php?mode=area&area_id=".$area);
				}
				function update_distributor(){ global $mysqli;
				
				$contact=clean($_REQUEST['contact']);
					$owner=clean($_REQUEST['owner']);
				$distributor_class=clean($_REQUEST['distributor_class']);
				$distributor_channel=clean($_REQUEST['distributor_channel']);
				$sub_area_id=clean($_REQUEST['sub_area_id']);
				$new_area=getColumnName("tbl_clusters","area_id","cluster_id=$sub_area_id");
				$distr_id=clean($_REQUEST['distributor_id']);
				$distributor=clean($_REQUEST['distributor']);
				$query=mysqli_query($mysqli,"UPDATE `tbl_distributors` SET `distributor_name`='$distributor',cluster_id=$sub_area_id,area_id=$new_area, distributor_channel='$distributor_channel',distributor_class='$distributor_class',contact='$contact',owner='$owner' WHERE distributor_id=$distr_id") or die(mysqli_error($mysqli));
				
				$cond="distributor_id=$distr_id";
				$updateString="cluster_id=$sub_area_id,area_id=$new_area";
				$query=mysqli_query($mysqli,"UPDATE `tbl_routes`  set $updateString WHERE $cond") or die(mysqli_error($mysqli));	///update dealers table
			$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set $updateString WHERE $cond") or die(mysqli_error($mysqli));
					
				header("location: distributors.php?mode=cluster&cluster_id=".$sub_area_id);
				}
			function assign_ad2Cluster(){ global $mysqli;
$ad_id=clean($_REQUEST['container_id']);	
$ad_cluster_id=clean($_REQUEST['item_id']);	$status=0;
$newPosition=clean($_REQUEST['newPosition']);	
$result = mysqli_query($mysqli,"INSERT INTO `tbl_adcluster_asignments`( `ad_id`, `ad_cluster_id`) VALUES ($ad_id,$ad_cluster_id) ON DUPLICATE KEY UPDATE `ad_id`=$ad_id, `ad_cluster_id`=$ad_cluster_id,status=$status" ) or die(mysqli_error($mysqli));
}/////////////////////////
function unassign_adFromCluster(){ global $mysqli;

$ad_id=clean($_REQUEST['container_id']);	
$ad_cluster_id=clean($_REQUEST['item_id']);	
//$deletedPosition=clean($_REQUEST['deletedPosition']);	
$result = mysqli_query($mysqli,"UPDATE `tbl_adcluster_asignments` SET status=1 WHERE `ad_id`=$ad_id and `ad_cluster_id`=$ad_cluster_id" ) or die(mysqli_error($mysqli));
}////////////////////////////////////////////////

function delete_ad_cluster(){ global $mysqli;
$dm=date("Y-m-d h:i:s");
$ad_cluster_id=clean($_REQUEST['ad_cluster']);	
//`ad_cluster_id`, `ad_cluster_name`, `assigned_ad_id`, `added_by`, `date_modified`, `region_id`, `area_id`, `sub_area_id`, `status`, `description` FROM `tbl_ad_clusters` WHERE 1
$result = mysqli_query($mysqli,"UPDATE `tbl_ad_clusters` SET status=1 WHERE `ad_cluster_id`=$ad_cluster_id" ) or die(mysqli_error($mysqli));

mysqli_query($mysqli,"UPDATE `tbl_adcluster_asignments` SET status=3 WHERE `ad_cluster_id`=$ad_cluster_id" ) or die(mysqli_error($mysqli));
goback();
}////////////////////////////////////////////////

	function assign_route2adCluster(){ global $mysqli;
$ad_cluster_id=clean($_REQUEST['container_id']);	
$route_id=clean($_REQUEST['item_id']);	$status=0;
$newPosition=clean($_REQUEST['newPosition']);	
$result = mysqli_query($mysqli,"INSERT INTO `tbl_assign_route2adcluster`( `route_id`, `ad_cluster_id`) VALUES ($route_id,$ad_cluster_id) ON DUPLICATE KEY UPDATE `route_id`=$route_id, `ad_cluster_id`=$ad_cluster_id,status=$status" ) or die(mysqli_error($mysqli));
}//////////////////////////////////////////////////////adcluster_asignment2AD

function adcluster_asignment2AD(){
	 global $mysqli;
$ad_cluster_id=clean($_REQUEST['clid']);	
$ad_id=clean($_REQUEST['user']);	$status=0;
$user_id=$_SESSION['u_id'];
$date = strtotime(date('Y-m-d H:i:s'));

$result = mysqli_query($mysqli,"INSERT INTO `tbl_adcluster_asignments`( `ad_id`, `ad_cluster_id`,last_modified,mod_by) VALUES ($ad_id,$ad_cluster_id,$date,$user_id) ON DUPLICATE KEY UPDATE status=1 ,last_modified=$date,mod_by=$user_id" ) or die(mysqli_error($mysqli));
if($result) echo json_encode(array("status"=>true,"message"=>"Successfully done."));

}

//////////////////////////////////////////////////////////////
function save_route2adCluster(){
	 global $mysqli;
$ad_cluster_id=clean($_REQUEST['clid']);	
$route_id=clean($_REQUEST['route']);	$status=0;
$user_id=$_SESSION['u_id'];
$date = strtotime(date('Y-m-d H:i:s'));

$result = mysqli_query($mysqli,"INSERT INTO `tbl_assign_route2adcluster`( `route_id`, `ad_cluster_id`,status,last_modified,added_by ) VALUES ($route_id,$ad_cluster_id,0,$date,$user_id) ON DUPLICATE KEY UPDATE `route_id`=$route_id, `ad_cluster_id`=$ad_cluster_id,status=$status,last_modified=$date,mod_by=$user_id" ) or die(mysqli_error($mysqli));
if($result) echo json_encode(array("status"=>true,"message"=>"Successfully done."));

}/////////////////////////
function unassign_routeFromAdCluster(){ global $mysqli;

$ad_cluster_id=clean($_REQUEST['container_id']);	
$route_id=clean($_REQUEST['item_id']);	
//$deletedPosition=clean($_REQUEST['deletedPosition']);	
$result = mysqli_query($mysqli,"DELETE FROM `tbl_assign_route2adcluster`WHERE `route_id`=$route_id and `ad_cluster_id`=$ad_cluster_id" ) or die(mysqli_error($mysqli));
if($result) return 'success!';
}////////////////////////////////////////////////
			
function add_setting(){
	$onOf	=clean($_REQUEST['onOf']);
$user_id	=$_SESSION['u_id'];
	
global $mysqli; 
$setting=clean($_REQUEST['setting']); $value=clean($_REQUEST['value']);$description=clean($_REQUEST['description']);$applies_to=clean($_REQUEST['appliesTo']);$description=clean($_REQUEST['value']);
$result = mysqli_query($mysqli,"INSERT INTO tbl_settings(`setting_name`, `setting_value`, `description`, on_off, `setting_user_id`, `setting_mod_date`)VALUES('$setting','$value','$description','$onOf',$user_id,'')" ) or die(mysqli_error($mysqli));

	}
	////////////////////////////
	function fetch_settings(){  global $mysqli;
	$result=array();
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_settings` WHERE status=0")or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($q)) {
		$id=$row['setting_id']; $setting=$row['setting_name'];
	$result[] = array("id"=>$id,'setting'=>$setting,'setting_value'=>$row['setting_value'],'setting_date_added'=>$row['setting_date_added'],'added_by'=>$row['setting_user_id'],'description'=>$row['description']);
	}
	echo json_encode($result);
	}
//////////////////////////////////////
function edit_user($uid){ global $mysqli;
	$fname  = clean($_REQUEST['full_name']);
	$email  = clean($_REQUEST['email']);
	$area_id  = clean($_REQUEST['area_id']);
	$region_id  = clean($_REQUEST['region_id']);
	$user_role  =clean($_REQUEST['role']);
	$tel  = clean($_REQUEST['tel']);
	$cluster_id=clean($_REQUEST['cluster_id']);
	$distributor_id=clean($_REQUEST['distributor']);
	$select=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `user_id`=$uid") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($select))
{
	$uid=$row['user_id'];
	if(strcmp($row['full_name'],$fname)!=0){log_details(8,'$row["full_name"]',$uid,2,$uid,'edited name');	}
	if(strcmp($row['email'],$email)!=0){log_details(8,'$row["email"]',$uid,3,$uid,'changed email');}
	if(strcmp($row['area_id'],$area_id)!=0){log_details(8,$row['area_id'],$uid,4,$uid,'changed area');}
	if(strcmp($row['region_id'],$region_id)!=0){log_details(8,$row['region_id'],$uid,6,$uid,'changed region');	}
	
} //edit
	
	$sql="update  `tbl_users`set`full_name`='$fname', `email`='$email', `area_id`=$area_id, `region_id`=$region_id, `role`='$user_role', `mobile`='$tel', `cluster_id`=$cluster_id,`distributor_id`=$distributor_id WHERE user_id=$uid";
$data=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
if($data) header("location:users.php"); else echo 'error'.mysqli_error($mysqli);

	}	/////////////////////////////////////////////////////////////// 
			function route_targets(){
	$where=" "; global $mysqli;
$q=mysqli_query($mysqli,"SELECT `target_id`, `target_user`, `target_added_by`, `date_added`, `number`, `remarks`, `sync_status`, `route_id`, `status` FROM `tbl_targets` WHERE status=0");
while ($row = mysqli_fetch_array($q)) { $id=$row['target_id'];
    $result[] = array('target_user' =>get_name($row['target_user']),'target_id' =>$id,'target_added_by' => get_name($row['target_added_by']),'date_added' => $row['date_added'],'number' => $row['number'],'route'=>get_route($row['route_id']),'number' => $row['number'],'remarks' => $row['remarks'], ); }
    echo json_encode($result);
 }
 /////////////////////////////
 	function region_targets(){
	$where=" "; global $mysqli;
$q=mysqli_query($mysqli,"SELECT `target_id`, `target_user`, `target_added_by`, `date_added`, `number`, `remarks`, `sync_status`, `route_id`, `status` FROM `tbl_targets` WHERE status=0");
while ($row = mysqli_fetch_array($q)) { $id=$row['target_id'];

    $result[] = array('target_user' =>get_name($row['target_user']),'target_id' =>$id,'target_added_by' => get_name($row['target_added_by']),'date_added' => $row['date_added'],'number' => $row['number'],'route'=>get_route($row['route_id']),'number' => $row['number'],'remarks' => $row['remarks'], ); }
    echo json_encode($result);
 }///////////////////////
	
function mapRouteOutlets(){ global $mysqli;
	$route_id=$_REQUEST['route_id'];
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE latitute!=0 and  route_id=$route_id and status=0")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ } else {
							while ($row = mysqli_fetch_array($q)) { $id=$row['dealer_id'];
    $result[] = array('outlet_name' =>$row['business_name'] ,'dealer_id' => $id,'lat' => $row['latitute'],'lng' => $row['longtitute'],'phone' => $row['phone'],'owner' => $row['owner_name']); }
    echo json_encode($result);
}
}///////////////////
		function Put_on_off(){
			$id=clean($_REQUEST['on_off_id']);
			$on_of=getColumnName("tbl_survey_questions","on_of"," survey_qID="+$id); 
			if($on_of==1)$on_of=0;else $on_of=1;
			
			$query=mysqli_query($mysqli,"UPDATE `tbl_survey_questions` SET `on_of`=$on_of WHERE survey_qID='$id'") or die(mysqli_error($mysqli));
			if($query==1) echo "done";
			}
		//////////////////////////////////////////////////////////////////////		functins
		function verify_outlet($did){global $mysqli;
	
	$q=mysqli_query($mysqli,"update tbl_dealers set verified=1 where dealer_id=$did")or die(mysqli_error($mysqli));
	if($q){ echo "Verified!";}
	
	}
		function migrate_client(){
			global $mysqli;
			if(isset($_REQUEST['myArray']) &&isset($_REQUEST['region_id']))
 { $region_id=clean($_REQUEST['region_id']);
	 $arraytext= explode(",",$_REQUEST['myArray']);
 for ($i=0; $i < count($arraytext);$i++) {
              $myArray=$arraytext[$i];
			  $first=$arraytext[0];
	
$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `region_id`=$region_id WHERE dealer_id='$myArray'") or die(mysqli_error($mysqli));
      	   
		      }
			  if(!$query){
		   echo mysqli_error($mysqli);
		   } else echo "done";
	 }
	 
	
}////////////////////////////////////////

function migrate_outlets_from_route_to_route(){
			global $mysqli;
			if(isset($_REQUEST['myArray']) &&isset($_REQUEST['route_id']))
 { $new_route=clean($_REQUEST['route_id']);
	 $arraytext= explode(",",$_REQUEST['myArray']);
 for ($i=0; $i < count($arraytext);$i++) {
              $myArray=clean($arraytext[$i]);
			  $first=$arraytext[0];
			  ///get the rest
$new_distributor=getColumnName("tbl_routes","distributor_id","route_id=$new_route");
				$new_area=getColumnName("tbl_routes","area_id","route_id=$new_route");
				$new_sub_area=getColumnName("tbl_routes","cluster_id","route_id=$new_route");
				$new_region=getColumnName("tbl_routes","region_id","route_id=$new_route");
				
					$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` set region_id=$new_region,cluster_id=$new_sub_area,area_id=$new_area, distributor_id=$new_distributor,route_id=$new_route  WHERE dealer_id='$myArray'") or die(mysqli_error($mysqli));
				
//$query=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `region_id`=$region_id WHERE dealer_id='$myArray'") or die(mysqli_error($mysqli));
      	   
		      }
			  if(mysqli_affected_rows($mysqli)<1){
		   echo "Error Occured, please whether you made any selection";
		   } else echo "Finished";
	 }
	 
	
}/////////////////////////////
function fetch_categories(){  global $mysqli;
	$result=array();
	$q=mysqli_query($mysqli,"SELECT `channel_id`, `added_by`, `date_added`, `channel_name`, `description`, `status`,member_of,applies_for FROM `tbl_outlet_channels` WHERE status=0")or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($q)) {
		$id=$row['channel_id']; $outlets=num_rows("tbl_dealers","status=0 and channel=".$id);
	$result[] = array("id"=>$id,'outlets'=>$outlets,'added_by'=>get_name($row['added_by']),'date_added'=>date_title($row['date_added']),'name'=>$row['channel_name'],'member_of'=>$row['member_of'],'applies_for'=>$row['applies_for'],'description'=>$row['description']);
	}
	echo json_encode($result);
	}
	
		
		function source_of_products($so, $oid){ global $mysqli;
			$q=mysqli_query($mysqli,"UPDATE `tbl_orders` SET `order_source`=$so WHERE `order_id`=$oid") or die(mysqli_error($mysqli));}
		//get the routes in a specific day
	function outlets_in_day($user){
		global $mysqli;
	
$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];
	$where=" status=0 and added_by=$user order by region_id, area_id";
	switch($role){
		case 4: $where=" status=0 and added_by=$user "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 and added_by=$user"; break;//rm
		case 3: $where=" area_id=$myArea and status=0 and added_by=$user"; break;//arm
		 }
		$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE $where")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ echo '<tr><td colspan=7>No assigned route this day. Good day!</td><tr>';} else {
							while ($row = mysqli_fetch_array($q)) {
    $result[] = array('d_id' => $row['dealer_id'],'bname' => $row['business_name'],'designation' => $row['designation'],'lon' => $row['longtitute'],'lat' => $row['latitute'],'opening_time' => $row['opening_time'],'closing_time' => $row['closing_time'],'channel' =>channel_type($row['channel']),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], 'added_by' => $row['added_by'],'verified'=>$row['verified']); }
    echo json_encode($result);
	} //end else and while
							  }
		//select_routes for the select list
function select_routes(){ $result=array(); global $mysqli;
	$q=mysqli_query($mysqli,"SELECT `route_id`, `route_name` FROM `tbl_routes` WHERE `status`=0") or die(mysqli_error($mysqli));
	while($r=mysqli_fetch_array($q)){
			$result[]=array('route_id'=>$r['route_id'],'route_name'=>$r['route_name']);
			 echo json_encode($result);
			}

	}
	function convert_period($period_ago){
		switch($period_ago){
			case 1: return 86400; break;	case 2: return 86400*2; break;	case 3: return 86400*3;	 break; case 4: return 86400*7; break;			case 5: return 86400*14;	 break; case 6: return 86400*21; break;	case 7: return 86400*30;  break;	case 8: return 86400*61;  break;
			case 9: return 86400*91;	 break; case 10: return 86400*365;  break;	case 11: return 86400*365*2;  break;
			 default: return '';
			}
			}
		//select outlets dormancy details
function fetch_test($order_by,$period){
	$regional_all=mysqli_query($mysqli,"")or die();}



 function fetch_dormancy($order_by,$period){  global $mysqli;
 $q='';
 $result=array();
$where='';//initialize where 
$reg_id=$_SESSION['region_id'];//region id
$arrange_by= 'business_name'; if($order_by==2) $arrange_by='date_visted';
$days_ago=convert_period($period); if($days_ago==''){  
$q=mysqli_query($mysqli,"SELECT distinct(`dealer_id`) as dealer_id,business_name FROM `tbl_dealers` WHERE status=0 and NOT EXISTS(SELECT id,`dealer_id`
    from tbl_route_plan rp
    where rp.`dealer_id` = tbl_dealers.`dealer_id` or DATE(`date_visted`)<'0000-00-00') AND region_id=$reg_id group  by dealer_id ORDER BY  business_name desc") or die(mysqli_error($mysqli));
	$date_visted='never'; $id=0;
	if(mysqli_num_rows($q)!=0){
while($r=mysqli_fetch_array($q)){
	$bn=business_name($r['dealer_id']);
$result[]=array('route_plan_id'=>$id,'bname'=>$bn,'dealer_id'=>$r['dealer_id'],'date_visted'=>$date_visted,);
 
}} else $result[]=array('route_plan_id'=>'','bname'=>'List is empty','dealer_id'=>'','date_visted'=>'',);;
echo json_encode($result);
//end the never visted and start visted


} else{
	$days_ago=convert_period($period);
$today=strtotime(date("Y-m-d"));
$ago=$today-$days_ago;
$date_ago=date('Y-m-d',$ago);
//where
$where="WHERE d.`region_id`=4 and rp.status=0 and DATE(date_visted)<='$date_ago' and DATE(date_visted)!='0000-00-00' GROUP BY rp.dealer_id ORDER BY $arrange_by desc";
$q=mysqli_query($mysqli,"SELECT rp.dealer_id as dealer_id,date_visted, business_name, id FROM `tbl_dealers` d RIGHT JOIN tbl_route_plan rp on d.dealer_id=rp.dealer_id  $where") or die(mysqli_error($mysqli));

if(mysqli_num_rows($q)!=0){
while($r=mysqli_fetch_array($q)){
	$bn=business_name($r['dealer_id']); $date_visted=record_date($r['date_visted']); $id=$r['id'];
$result[]=array('route_plan_id'=>$id,'bname'=>$bn,'dealer_id'=>$r['dealer_id'],'date_visted'=>$date_visted,);
 
}} else $result[]=array('route_plan_id'=>'','bname'=>'List is empty','dealer_id'=>'','date_visted'=>'',);;
echo json_encode($result);
 }


	}
//assign route
function assign_route(){ global $mysqli;
$user_id=clean($_REQUEST['uid']);
$rid=clean($_REQUEST['rid']);
$did=$_REQUEST['dealer_id'];
$update=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `route_id`=$rid WHERE `dealer_id`=$did") or die(mysqli_error($mysqli));
if($update)
{ echo 'yes';} 
else { echo mysql_errno();}
}
function unassign_route(){
$user_id=clean($_REQUEST['uid']); global $mysqli;

$did=$_REQUEST['dealer_id'];
$update=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `route_id`=0 WHERE `dealer_id`=$did") or die(mysqli_error($mysqli));
if($update)
{ echo 'yes';} 
else { echo mysql_errno();}
}
				//fetch routes assignments
function fetch_assignments($uid,$date){ global $mysqli;
		$result=array();//results required as an array object
		global $mysqli;
  $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$uid and DATE(`startdate`)='$date' AND status=0")or die(mysqli_error($mysqli)); 
  if(mysqli_num_rows($q)==0){ //echo $result[]= array('business_name'=> 'No assigned dealers today in this route',);
  } 
  else {
							while($r=mysqli_fetch_array($q)){ 
							$dealer_id=$r['dealer_id']; 
							$visit_id=$r['visted'];
							$plan_id=$r['id'];
							 $result[]= array('business_name'=>business_name($dealer_id),'plan_id'=>$plan_id,'visit_id'=> $visit_id,'dealer_id'=>$dealer_id,);
                           } 
						   }
							  
    echo json_encode($result);
	}
		///////////////
		function load_all_regions_to_select_box(){ global $mysqli;
	 $res = mysqli_query($mysqli,"SELECT * FROM tbl_regions WHERE status = 0");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('region_id' => $row['region_id'],'region_name' => $row['region_name'], ); }
    echo json_encode($result);
	}////////////////////////////////////////////
	function load_area_dropDown($region_id){ global $mysqli;
	 $res = mysqli_query($mysqli,"SELECT * FROM tbl_areas WHERE status=0 and region_id = $region_id");
	 if(mysqli_num_rows($res)==0){
		  $result[] = array('area_id' => "-1",'area_name' => "No area in Region" ); 
		 }else
		 {
    while ($row = mysqli_fetch_array($res)) 
	{
    $result[] = array('area_id' => $row['area_id'],'area_name' => $row['area_name'], ); 
	}
		 }//end else
	
    echo json_encode($result);
	}//populate
	function load_clusters_dropDown($area_id){ global $mysqli;
	$res = mysqli_query($mysqli,"SELECT * FROM tbl_clusters WHERE status=0 and area_id = $area_id");
	 if(mysqli_num_rows($res)==0){
		  $result[] = array('cluster_id' => "-1",'cluster_name' => "No Cluster in Area" ); 
		 }else
		 {
    while ($row = mysqli_fetch_array($res)) 
	{
    $result[] = array('cluster_id' => $row['cluster_id'],'cluster_name' => $row['cluster_name'], ); 
	}
		 }//end else
	
    echo json_encode($result);
	}////////////////////////////////////////////
	function load_distributors_dropDown($cluster_id){ global $mysqli;
	 $res = mysqli_query($mysqli,"SELECT * FROM tbl_distributors WHERE status=0 and cluster_id = $cluster_id");
	 if(mysqli_num_rows($res)==0){
		  $result[] = array('distributor_id' => "-1",'distributor_name' => "No Distributor in Cluster" ); 
		 }else
		 {
    while ($row = mysqli_fetch_array($res)) 
	{
    $result[] = array('distributor_id' => $row['distributor_id'],'distributor_name' => $row['distributor_name'], ); 
	}
		 }//end else
	
    echo json_encode($result);
	}/****************************************************/
	function load_routes_dropDown($distributor_id){ global $mysqli;
	 $res = mysqli_query($mysqli,"SELECT * FROM tbl_routes WHERE status=0 and distributor_id = $distributor_id");
	 if(mysqli_num_rows($res)==0){
		  $result[] = array('route_id' => "-1",'route_name' => "No Route inDistributor" ); 
		 }else
		 {
    while ($row = mysqli_fetch_array($res)) 
	{
    $result[] = array('route_id' => $row['route_id'],'route_name' => $row['route_name'], ); 
	}
		 }//end else
	
    echo json_encode($result);
	}
	/********************************************************/
function populate_selectionbox_users(){ 
$where=" ";
		$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; 
		$myArea=$_SESSION['area_id'];
		$cluster_id=$_SESSION['cluster_id'];
	$where=" status=0  order by region_id, area_id,cluster_id";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and role!=4 and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and role!=4 and role!=2 and status=0 ";break;//arm
		case 1: $where=" cluster_id=$cluster_id and role!=2 and role!=3 and status=0 "; break;//AD
		 }
	global $mysqli;
	 $res = mysqli_query($mysqli,"SELECT * FROM tbl_users WHERE $where order by full_name") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('user_id' => $row['user_id'],'name' => $row['full_name'], ); }
    echo json_encode($result);
	}
	/********************************************************/
	function add_userroleForm(){// echo 'eric atinga';
global $mysqli; $role_name=clean($_REQUEST['role_name']); $description=clean($_REQUEST['description']);
$result = mysqli_query($mysqli,"INSERT INTO tbl_roles(role_name, description) VALUES('$role_name', '$description') ON DUPLICATE KEY UPDATE role_name='$role_name', description='$description'") or die(mysqli_error($mysqli));
}
	//////////////////////////////////////////////////////////
	function reset_pass(){ 
	$user=$_REQUEST['uid'];
	global $mysqli;  $new_pass=md5(123456);
	 $res = mysqli_query($mysqli,"UPDATE tbl_users SET password='$new_pass',request_pass_change='No' WHERE user_id=$user") or die(mysqli_error($mysqli));
goback();
	}
	///////////
	function change_pass(){ 
	$pword=$_REQUEST['pword'];
	$user=$_REQUEST['uid'];
	
	global $mysqli;  $new_pass=md5($pword);
	 $res = mysqli_query($mysqli,"UPDATE tbl_users SET password='$new_pass',request_pass_change='No' WHERE user_id=$user") or die(mysqli_error($mysqli));
echo "done";
	}///////////////
	function restore_user(){ 
	$user=$_REQUEST['uid'];
	global $mysqli; 
	 $res = mysqli_query($mysqli,"UPDATE tbl_users SET status=0 WHERE user_id=$user") or die(mysqli_error($mysqli));
goback();
	}
	/////////////////////////
function fetch_user_roles(){ 
	global $mysqli; $result=array();
	 $res = mysqli_query($mysqli,"SELECT * FROM tbl_roles WHERE status = 0") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) { $role_id=$row['role_id'];
    $result[] = array('role' => $row['role_name'],'assignees' => num_rows('tbl_users','role='.$role_id),'kisii' => num_rows('tbl_users','region_id=1 and role='.$role_id), 'mtkenya' => num_rows('tbl_users','region_id=2 and role='.$role_id), 'rv' => num_rows('tbl_users','region_id=3 and role='.$role_id) ); }
    echo json_encode($result);
	}
	//fetch trucks
	function fetch_trucks(){ global $mysqli;
		 $res = mysqli_query($mysqli,"SELECT `v_id`, `reg_no`, `added_by`, full_name ,`capacity`, v.`description`, `date_added`, v.`status` FROM `tbl_vehicles` v left join tbl_users u on u.user_id=v.added_by ") or die(mysqli_error($mysqli)) ;
    while ($row = mysqli_fetch_array($res)) {
   $result[] = array('vid' => $row['v_id'],'reg_no' => $row['reg_no'],'added_by' => $row['full_name'],'capacity' => $row['capacity'],'description' => $row['description'],'date_added' => $row['date_added'],'status' => $row['status']); }
    echo json_encode($result);
   		}
	//function to search for users 
	function users($u_id){ 
		global $mysqli;
		 $res = mysqli_query($mysqli,"SELECT * FROM tbl_users WHERE user_id=".$u_id) or die(mysqli_error($mysqli)) ;
    while ($row = mysqli_fetch_array($res)) {
   echo $row['full_name'];
   }
   		}
		//function to search for users 
	function fetch_user_for_editing($u_id){
		global $mysqli;
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE user_id=".$u_id)or die(mysqli_error($mysqli));
while ($row = mysqli_fetch_array($q)) {
    $result[] = array('user_id' => $row['user_id'],'name' => $row['full_name'],'email' => $row['email'],'emp_id' => $row['emp_id'],'mobile' => $row['mobile'],'gender' => $row['gender'],'desc' => $row['description'],'status' => $row['status'],'role' => $row['role'], ); }
    echo json_encode($result);
	}
	
	
	function add_client(){ global $mysqli;
		$today_constant=date("Y-m-d H:i:s");
		$designation=clean($_REQUEST['designation']);
		$chanel=clean($_REQUEST['channel']);
		$bname=clean($_REQUEST['bname']);
		$owner=clean($_REQUEST['owner']);
		$type_of_outlet=clean($_REQUEST['type_of_outlet']);
		$phone=clean($_REQUEST['phone']);
	  if(isset($_REQUEST['long']))	$long=clean($_REQUEST['long']); else $long=0;
		if(isset($_REQUEST['lat']))$lat=clean($_REQUEST['lat']); else $lat=0;
		$town=clean($_REQUEST['town']);
		$pname=clean($_REQUEST['pname']);
		$region=clean($_REQUEST['region']);
		$user_id=$_SESSION['u_id'];
		
		$insert=mysqli_query($mysqli,"INSERT INTO `tbl_dealers`(`business_name`, reg_date,`channel`, `owner_name`, `designation`, `town`, `longtitute`, `latitute`, `phone`, `added_by`, region_id,type_of_outlet) VALUES ('$bname','$today_constant',$chanel,'$owner',$designation,'$town','$long','$lat','$phone',$user_id,$region,$type_of_outlet)")or die(mysqli_error($mysqli));
		if($insert){
		fetch_clients();
		}else{ echo 'failed';}	}
		
		//add prospect
		function add_prospecting(){ global $mysqli;
		$today_constant=date("Y-m-d H:i:s");
		$designation=clean($_REQUEST['designation']);
		$chanel=clean($_REQUEST['channel']);
		$bname=clean($_REQUEST['bname']);
		$owner=clean($_REQUEST['owner']);
		$phone=clean($_REQUEST['phone']);
	  if(isset($_REQUEST['long']))	$long=clean($_REQUEST['long']); else $long=0;
		if(isset($_REQUEST['lat']))$lat=clean($_REQUEST['lat']); else $lat=0;
		$town=clean($_REQUEST['town']);
		$pname=clean($_REQUEST['pname']);
		$region=clean($_REQUEST['region']);
		$user_id=$_SESSION['u_id'];
		
		$lite=$_REQUEST['lite'];$mult=$_REQUEST['mult'];
		$heineken=$_REQUEST['heineken'];
	
		$insert=mysqli_query($mysqli,"INSERT INTO `tbl_dealers`(`business_name`, reg_date,`channel`, `owner_name`, `designation`, `town`,  `longtitute`, `latitute`, `phone`, `added_by`, region_id,prospecting,status) VALUES ('$bname','$today_constant',$chanel,'$owner',$designation,'$town','$long','$lat','$phone',$user_id,$region,1,1)")or die(mysqli_error($mysqli));
		$did=mysqli_insert_id();
		if($insert){
			
			if(isset($_REQUEST['mult'])){prespect_details(1,$did,$mult);} 
			 if(isset($_REQUEST['lite'])){prespect_details(2,$did,$lite);}
			 if(isset($_REQUEST['heineken'])){prespect_details(3,$did,$heineken);}
			//make 
		make_plan($today_constant,$did,$user_id,1);
		fetch_prospecting();
		}else{ echo 'failed';}	}
		
		function prespect_details($item,$dealer,$amount){
			
			$insert_prices=mysqli_query($mysqli,"INSERT INTO `tbl_prospecting`(`item_id`, `dealer_id`, `price`) VALUES ($item,$dealer,'$amount')") or die(mysqli_error($mysqli));}
		//fetch prospecting
		function fetch_prospecting(){
			global $mysqli;
		//read data from db
		$user_id=$_SESSION['u_id'];
		$reg=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE user_id=$user_id limit 1") or die(mysql_error);
		$region=mysqli_fetch_array($reg);
		$reg_id=$region['region_id'];
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE   status=1 and prospecting=1  and region_id=$reg_id order by business_name desc");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('d_id' => $row['dealer_id'],'bname' => $row['business_name'],'designation' => $row['designation'],'email' => $row['email'],'desc' => $row['region_id'],'channel' => channel_type($row["channel"]),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], 'user_id' => $user_id,'channel' => channel_type($row["channel"]),'mult'=>prospect_prices($row['dealer_id'],1),'lite'=>prospect_prices($row['dealer_id'],2),'heineken'=>prospect_prices($row['dealer_id'],3),'visits'=>times_visited($row['dealer_id'],$mysqli)); }
    echo json_encode($result);
	}
				//clients
	function fetch_clients_all(){ global $mysqli;
		//read data from db
		$user_id=$_SESSION['u_id'];
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status =0 order by dealer_id desc");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('d_id' => $row['dealer_id'],'bname' => $row['business_name'],'designation' => $row['designation'],'email' => $row['email'],'desc' => $row['region_id'],'channel' => channel_type($row['channel']),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], 'user_id' => $user_id,'channel' => channel_type($row['channel']),); }
    echo json_encode($result);
	}/////////////////////////
	function fetch_unverified_clients_in_area(){ global $mysqli;
	
		$from=$_REQUEST['from'];
		$to=$_REQUEST['to'];
		$uid=$_REQUEST['user'];
		$area_id=$_SESSION['area_id'];
		
		$where=" area_id=$area_id and status=0 and DATE(reg_date)>'$from' and DATE(reg_date)<'$to' and verified=0 "; if($uid>0) $where = $where." and added_by=$uid";
		$result=array();
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE $where  order by dealer_id desc") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) {
		 $qns=num_rows(" tbl_survey ","dealer_id=".$row['dealer_id']);
		    $result[] = array('d_id' => $row['dealer_id'],'bname' => $row['business_name'],'designation' => $row['designation'],'route_id' => $row['route_id'],'opening_time' => $row['opening_time'],'channel' => channel_type($row['channel']),'town' => $row['town'],'phone' => $row['phone'],'qns'=>$qns, 'owner' => $row['owner_name'], 'user_id' => $row['added_by'],'closing_time' => $row['closing_time']); }
    echo json_encode($result);
	}
	////////////////////////////////////
		function fetch_clients(){
			global $mysqli; 	$user_id=$_SESSION['u_id'];
			$result=array();
		//read data from db
		$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];
	$where=" status=0 order by region_id, area_id";
	switch($role){
		case 4: $where=" status=0 and verified=1"; break;//cm
		case 2: $where=" region_id=$myregion and status=0 and verified=1 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 and verified=1 "; break;//arm
		 }
		 

	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE $where order by business_name desc") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('d_id' => $row['dealer_id'],'bname' => $row['business_name'],'designation' => $row['designation'],'lon' => $row['longtitute'],'lat' => $row['latitute'],'email' => $row['email'],'desc' => $row['region_id'],'channel' =>channel_type($row['channel'],$mysqli),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], 'user_id' => $user_id,'channel' => $row['channel'],'visits'=>times_visited($row['dealer_id'],$mysqli)); }
    echo json_encode($result);
	}
	
	function order_source_selected($id){ global $mysqli;
		//read data from db
		$result='';
	$res = mysqli_query($mysqli,"SELECT `order_source` FROM `tbl_orders` WHERE `order_id` =$id") or die(mysqli_error($mysqli));
  $row = mysqli_fetch_array($res);
    $result= $row["order_source"];
	 
    echo $result;
	}
				//regional clients
	function regional_clients($id){ global $mysqli; 
 $demarcation=clean($_REQUEST['demarcation']);
	 
	 $where="";
		$demarcation=clean($_REQUEST['demarcation']); 
		
		if($demarcation=='area'){$where="area_id=$id";} else if($demarcation=="region"){$where="region_id=$id";}else if($demarcation=="cluster"){$where="cluster_id=$id";}else if($demarcation=="distributor"){$where="distributor_id=$id";} else if($demarcation=='route'){$where="route_id=$id";}
		
		  $result=array();
		//read data from db
		$user_id=$_SESSION['u_id']; 
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status =0 and $where ".regions_filters_condition()." order by business_name desc") or die(mysqli_query($mysqli,$mysqli));
    while ($row = mysqli_fetch_array($res)) { $regby=get_name($row['added_by']); $channel=$row['channel'];
	
    $result[] = array('d_id' => $row['dealer_id'],'bname' => business_name($row['dealer_id']),'designation' => $row['designation'],'area' => get_area($row['area_id']),'distributor' => distributor_name($row['distributor_id']),'sub_area' => sub_area_name($row['cluster_id']),'route' => get_route($row['route_id']),'channel' => channel_type($channel),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], "user_id"=>$user_id, "land_mark"=>$row['landmark_building'],'reg_by' => $regby); }
    echo json_encode($result);
	}
	///////////////with filters
	function clients_withfilters($id){ global $mysqli; 
 $demarcation=clean($_REQUEST['demarcation']);
	 
	 $where="";
		$demarcation=clean($_REQUEST['demarcation']); 
		
		if($demarcation=='area'){$where="area_id=$id";} else if($demarcation=="region"){$where="region_id=$id";}else if($demarcation=="cluster"){$where="cluster_id=$id";}else if($demarcation=="distributor"){$where="distributor_id=$id";}
		
		  $result=array();
		//read data from db
		$user_id=$_SESSION['u_id'];  $i=1;
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status =0 and $where ".regions_filters_condition()." order by business_name desc") or die(mysqli_query($mysqli,$mysqli));
    while ($row = mysqli_fetch_array($res)) { $regby=get_name($row['added_by']); $channel=$row['channel'];
	
	$d_id =$row['dealer_id'];$bname= business_name($row['dealer_id']); $designation=$row['designation']; $area=get_area($row['area_id']); $distributor=distributor_name($row['distributor_id']); $sub_area=sub_area_name($row['cluster_id']); $route=get_route($row['route_id']); $channel=channel_type($channel); $town=$row['town']; $phone=$row['phone']; $owner=$row['owner_name']; $user_id=$user_id; $reg_by=$regby;
    echo "<tr><td>$i</td> <td>$bname</td><td>$route</td><td>$distributor</td><td>$sub_area</td><td>$area</td><td>$channel</td><td >$owner($designation)</td><td>$town</td><td >$phone</td> <td ><input name='list[]' class='migrate' type='checkbox' value='$d_id'></td> <td ><a href=create_order.php?dealer_id=$d_id> Order</a>|<a href=edit_clients.php?cid=$d_id>Edit</a><a>del</a></td> </tr>";$i++;
	 }
  
	}
	//user_outlet_list
	function user_outlet_list($id){ global $mysqli;
		//read data from db
		$user_id=$_SESSION['u_id']; 
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status =0 and added_by=$id order by business_name desc") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) { $regby=get_name($row['added_by']);
    $result[] = array('d_id' => $row['dealer_id'],'bname' => business_name($row['dealer_id']),'designation' => $row['designation'],'area' => get_area($row['area_id']),'distributor' => distributor_name($row['distributor_id']),'sub_area' => sub_area_name($row['cluster_id']),'route' => get_route($row['route_id']),'channel' => channel_type($row['channel']),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], "user_id"=>$user_id,"reg_date"=>$row['reg_date'],'reg_by' => $regby); }
    echo json_encode($result);
	}
	////////////////////////
	//user_outlet_list
	function user_filtered_outlet_list($id){ global $mysqli;
		//read data from db
		$user_id=$_SESSION['u_id'];  $i=1;
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status =0 and added_by=$id ".regions_filters_condition()."order by business_name desc") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) { $regby=get_name($row['added_by']); $channel=$row['channel'];
	
	$d_id =$row['dealer_id'];$bname= business_name($row['dealer_id']); $designation=$row['designation']; $area=get_area($row['area_id']); $distributor=distributor_name($row['distributor_id']); $sub_area=sub_area_name($row['cluster_id']); $route=get_route($row['route_id']); $channel=channel_type($channel); $town=$row['town']; $phone=$row['phone']; $owner=$row['owner_name']; $user_id=$user_id; $reg_by=$regby;
    echo "<tr><td>$i</td> <td>$bname</td><td>$route</td><td>$distributor</td><td>$sub_area</td><td>$area</td><td>$channel</td><td >$owner($designation)</td><td>$town</td><td >$phone</td> <td ><input name='list[]' class='migrate' type='checkbox' value='$d_id'></td> <td ><a href=create_order.php?dealer_id=$d_id> Order</a>|<a href=edit_clients.php?cid=$d_id>Edit</a><a>del</a></td> </tr>";$i++;}
	}
	//////////////////////
	function category_clients($id){ global $mysqli;
		//read data from db
		$user_id=$_SESSION['u_id'];
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status =0 and channel=$id order by business_name desc");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('d_id' => $row['dealer_id'],'bname' => business_name($row['dealer_id']),'designation' => $row['designation'],'email' => $row['email'],'desc' => $row['region_id'],'channel' => channel_type($row['channel']),'town' => $row['town'],'phone' => $row['phone'], 'owner' => $row['owner_name'], 'user_id' => $user_id,); }
    echo json_encode($result);
	}
function add_question(){
	
	 global $mysqli;
		$question=clean($_REQUEST['question']); 
		$query_type=clean($_REQUEST['query_type']);
		$category=clean($_REQUEST['category']);
		$region=clean($_REQUEST['region']);
		 $red_eds_dosa=clean($_REQUEST['red_eds_dosa']);
		$user_id=clean($_SESSION['u_id']);$date=date("Y-m-d H:i:s");
		$support_details=clean($_REQUEST['support_details']);
		$required=clean($_REQUEST['required']);
		$channel=clean($_REQUEST['channel']);
	
	//	$amnt_gold=clean($_REQUEST['amnt_gold']);
	//$amnt_silver=clean($_REQUEST['amnt_silver']);
	//$amnt_bronze=clean($_REQUEST['amnt_bronze']);
	$score_gold=clean($_REQUEST['score_gold']);
	$score_silver=clean($_REQUEST['score_silver']);
	$score_bronze=clean($_REQUEST['score_bronze']);
			
		$insert=mysqli_query($mysqli,"INSERT INTO `tbl_survey_questions`(`region`, `question`, `date_added`, `added_by`, `q_type`, `red_eds_dosa`,  `status`, `support_details`, `required`, `category`, `channel`, `score_gold`, `score_silver`, `score_bronze`, `sync_date`) value($region, '$question', '$date', $user_id, '$query_type', '$red_eds_dosa', 0, '$support_details', '$required', '$category', $channel, $score_gold, $score_silver, $score_bronze, '$date')")or die(mysqli_error($mysqli));
	
		if($insert){
			$id=mysqli_insert_id($mysqli);
			
			if(isset($_REQUEST['options'])and $_REQUEST['options']!=NULL){
				
					 $str=clean($_REQUEST['options']);
		
				$option=explode(";",$str);
				for($i=0;$i<=count($option)-1;$i++){
					if($option[$i]!=''){
					add_question_option($option[$i],$id, '');
					}
					}
				}
			
		fetch_question();
		}else{ echo '<script> alert("failed")</script>';}	}
		
		/////////////////////////////////
		function add_question_option($choice,$main_question_id, $remarks){ global $mysqli;
		 
		
		$insert=mysqli_query($mysqli,"INSERT INTO `tbl_question_options`(`option_name`, `remarks`,main_question_id) VALUES ('$choice','$remarks',$main_question_id)")or die(mysqli_error($mysqli));
		
		if($insert){
		fetch_options();
		}else{ echo '<script> alert("failed")</script>';}	}
		//////////////////////////////
		function fetch_options(){ global $mysqli;
		$question=$_REQUEST['question']; $result=array();
		//read data from db
	$res = mysqli_query($mysqli,"SELECT  `option_id`, `option_name`, `main_question_id`,status FROM `tbl_question_options` where status=0 and main_question_id=$question");
    while ($row = mysqli_fetch_array($res)) {
		$option_id = $row['option_id'];
		$option_counter= num_rows("tbl_survey","q_id=$question and answer=$option_id");
    $result[] = array('option_id' => $option_id,'name' => $row['option_name'],'counter' => $option_counter); }
    echo json_encode($result);
	}
function fetch_number_options(){ global $mysqli;
		$question=$_REQUEST['question']; $result=array();
		//read data from db
	$res = mysqli_query($mysqli,"SELECT count(answer) as num, answer FROM `tbl_survey` WHERE `q_id`=$question AND status=0 GROUP BY answer ");
    while ($row = mysqli_fetch_array($res)) {

		
    $result[] = array('answer' => $row['answer'],'counter' => $row['num']); }
    echo json_encode($result);
	}
	////////////////////////////////////
	function delete_question(){
		global $mysqli;
		$id=clean($_REQUEST['qid']);
		$q=$mysqli->query("update tbl_survey_questions set status=1 where survey_qID=$id ") or die($mysqli->err);
		goback();
		}
	/////////////////////////////////////////////
		function fetch_question(){ global $mysqli;
		
	$res = mysqli_query($mysqli,"SELECT survey_qID,question,red_eds_dosa,category,q_type,a.date_added,required, channel_name,category_group,region,region_name, `score_gold`, `score_silver`, `score_bronze` FROM (`tbl_survey_questions` a LEFT JOIN tbl_regions b on a.region=b.region_id) LEFT  JOIN tbl_outlet_channels c on a.channel=channel_id where a.status=0") or die(mysqli_error($mysqli));
    while ($row = mysqli_fetch_array($res)) {
		$qId=$row['survey_qID'];

    $result[] = array('id' => $qId,'question' => $row['question'],'red_eds_dosa' => $row['red_eds_dosa'],'category' => $row['category'],'q_type' => $row['q_type'],'required' => yes_no($row['required']),'channel' => $row['channel_name'],'score_gold' => $row['score_gold'],'score_silver' => $row['score_silver'],'score_bronze' => $row['score_bronze'],'region' => $row['region_name']); }
    echo json_encode($result);
	}
	function on_of($id){ if($id==0) return "on"; else return "Off";} function put_on_of($id){ if($id==0) return "Put off"; else return "Put on";}
	
//add product
function add_product(){ global $mysqli;
		
		//$container_type	=$_REQUEST['container_type'];
$description=	$_REQUEST['description'];
$flavour	=$_REQUEST['flavour'];
$pack_size=$_REQUEST['pack_size']	;
$pack_type	=$_REQUEST['pack_type'];
$product	=$_REQUEST['product'];
$s_price	=$_REQUEST['s_price'];
$sku_type	=$_REQUEST['sku_type'];
$user_id	=$_REQUEST['user_id'];
$variant	=$_REQUEST['variant'];
$units_in_a_case=$_REQUEST['units_in_a_case'];
		$insert=mysqli_query($mysqli,"INSERT INTO `tbl_products`( `product`, units_in_a_case,`variant`, `flavour`, `pack_size`, `pack_type`, `sku_type`, `s_price`,`product_desc`, `user_id`) VALUES ('$product',$units_in_a_case,'$variant','$flavour','$pack_size','$pack_type','$sku_type','$s_price','$description',$user_id)")or die(mysqli_error($mysqli));
		if($insert){
		fetch_product();
		}else{ echo 'failed';}	}
//fetch products
function fetch_product(){ global $mysqli;
		//read data from db
		$result =array();
	$res = mysqli_query($mysqli,"SELECT `product_id`, `product`, `variant`, `flavour`, `pack_size`, `pack_type`, `sku_type`, `units_in_a_case`, `s_price`,  `product_desc`,  `user_id`, `status` FROM `tbl_products` WHERE status=0  order by pack_size,sku_type ");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('pid' => $row['product_id'],'p_name' =>$row['product'],'variant' =>$row['variant'],'flavour' => $row['flavour'],'pack_size' => $row['pack_size'],'pack_type' => $row['pack_type'], 'sku_type' => $row['sku_type'],'units_in_case' => $row['units_in_a_case'],'s_price' => $row['s_price']);
	 }
    echo json_encode($result);
	}
	/////////////////////////////////////////////////////////
	function add_competitor(){ global $mysqli;
$code	=$_REQUEST['code'];
$company=$_REQUEST['company'];	
$description=$_REQUEST['description'];	
$name	=$_REQUEST['name'];

		//$container_type	=$_REQUEST['container_type'];

$user_id	=$_SESSION['u_id'];

		$insert=mysqli_query($mysqli,"INSERT INTO `tbl_competitors`(`com_name`,company, `com_description`, `reg_by`) VALUES ('$name','$company','$description',$user_id)")or die(mysqli_error($mysqli));
		if($insert){
		fetch_competitors();
		}else{ echo 'failed';}	}
		/////////////////////////////////////////
		function fetch_competitors(){ global $mysqli;
		//read data from db
		$result =array();
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_competitors` WHERE 1 ");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('comp_id' => $row['com_id'],'name' =>get_competitor($row['com_id']),'description' =>$row['com_description'],'company' => $row['company'],'reg_by' => get_name($row['reg_by']));
	 }
    echo json_encode($result);
	}//////////////////////////////////
	function fetch_couching_plans(){ global $mysqli;
		//read data from db
		$result =array();
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_couching_plans` WHERE 1 ");
    while ($row = mysqli_fetch_array($res)) {
    $result[] = array('plan_id' => $row['couch_plan_id'],'plan_date' =>$row['date_to_couch'],'place' =>$row['place_to_couch'],'justification' => $row['couch_justification'],'details'=>$row["details"],'participants' => $row['participants'],'scheduled_by'=>get_name($row['added_by']),'after_couching_report'=>$row['after_couching_report'],'rate_of_achievement'=>$row['rate_of_achievement']);
	
	 }
    echo json_encode($result);
	}
		
		////
	function checkin_time(){ global $mysqli;
		date_default_timezone_set('Africa/Nairobi');
		$date=date("Y-m-d");
	$res = mysqli_query($mysqli,"SELECT MIN(`date_timein`) AS d,`checkin_id`,`longtitute`,`latitute`,`dealer_id`,user_id FROM `tbl_check_in` WHERE date(`date_timein`)='$date' group by `user_id` ORDER BY `date_timein` ");
    while ($row = mysqli_fetch_array($res)) 
	{ $id=$row['dealer_id'];
    $result[] = array('name' => get_name($row['user_id']),'outlet_name' => business_name($row['dealer_id']),'checkin_time' => date("H:i:s",strtotime($row['d'])),'from'=>Get_Address_From_Google_Maps($row['latitute'], $row['longtitute']),'distance'=>distance($row['latitute'], $row['longtitute'],outlet_coords($id,"latitute"),outlet_coords($id,"longtitute"),"k")); 
	}
    echo json_encode($result);
	}///////////////////
	function checkin_time_basedOn_outlets(){ global $mysqli;
			$update_checkin=mysqli_query($mysqli,"UPDATE tbl_dealers SET reg_date=ADDTIME(reg_date,'0 12:00:00') WHERE TIME(reg_date)<'07:00:00'")or die(mysqli_error($mysqli));
		$result=array();
		$date=date("Y-m-d");
	$res = mysqli_query($mysqli,"SELECT MIN(`reg_date`) AS d,`business_name`,`longtitute`,`latitute`,`dealer_id`,added_by FROM `tbl_dealers` WHERE date(`reg_date`)='$date' group by `added_by` ORDER BY TIME(`reg_date`) ");
    while ($row = mysqli_fetch_array($res)) 
	{ $id=$row['dealer_id'];
    $result[] = array('name' => get_name($row['added_by']),	'outlet_name' =>"<a href='client_details.php?dealer_id=$id'>".$row['business_name']."</a>",'checkin_time' => date("H:i:s",strtotime($row['d'])),'from'=>Get_Address_From_Google_Maps($row['latitute'], $row['longtitute']),'distance'=>distance($row['latitute'], $row['longtitute'],outlet_coords($id,"latitute"),outlet_coords($id,"longtitute"),"k")); 
	}
    echo json_encode($result);
	}
	
	//fetch logs
function fetch_logs(){ global $mysqli;
		//read data from db `log_id`, `date_time`, `table_affected`, `previous_data`, `column_affected`, `id_of_affected`, `user_id`, `description`, `status`
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_logs` WHERE status=0 Order By `log_id` desc");
    while ($row = mysqli_fetch_array($res)) {
		
		
    $result[] = array('id' => $row['log_id'],'date_made' => record_date($row['date_time']),'table' => $row['table_affected'],'column_affected' => $row['column_affected'],'added_by' =>get_name($row['user_id']),'description' => $row['description'],); }
    echo json_encode($result);
	}
	//fetch mylogs
function fetch_my_logs($uid){ global $mysqli;
		//read data from db `log_id`, `date_time`, `table_affected`, `previous_data`, `column_affected`, `id_of_affected`, `user_id`, `description`, `status`
	$res = mysqli_query($mysqli,"SELECT * FROM `tbl_logs` WHERE status=0 and user_id=$uid Order By `log_id` desc");
    while ($row = mysqli_fetch_array($res)) {
		
		
    $result[] = array('id' => $row['log_id'],'date_made' => $row['date_time'],'table' => $row['table_affected'],'column_affected' => $row['column_affected'],'added_by' =>get_name($row['user_id']),'description' => $row['description'],); }
    echo json_encode($result);
	}
	function add_asset_type(){ global $mysqli;
		$name  = clean($_REQUEST['name']);
		$user_id=$_SESSION['u_id'];
		$date = date('Y-m-d H:i:s');
	$description=clean($_REQUEST['description']);
	$res=mysqli_query($mysqli,"INSERT INTO `tbl_asset_types`(`asset_name`, `description`, `date_added`, `by`) VALUES ('$name','$description','$date',$user_id)")or die(mysqli_error($mysqli));
if($res){ header("location: assetreports.php");
}
		}
		////////////////////////////////
		function add_level_user(){// echo 'eric atinga';
global $mysqli;

	//$ad_cluster_id=clean($_REQUEST['ad_cluster_id']);
	$area_id=$_SESSION['area_id'];$distributor_id=$_SESSION['distributor_id'];
	$region_id=$_SESSION['region_id'];
	
		if(isset($_REQUEST['area_id']))$area_id  =clean($_REQUEST['area_id']);
		if(isset($_REQUEST['region_id']))$region_id=clean($_REQUEST['region_id']);
if(isset($_REQUEST['cluster_id']));$cluster_id=clean($_REQUEST['cluster_id']);
	if(isset($_REQUEST['distributor_id']))$distributor_id=clean($_REQUEST['distributor_id']);

	$fname  = clean($_REQUEST['full_name']);
	$email  = clean($_REQUEST['email']);
	$password  = md5(clean($_REQUEST['password']));
	$user_role  =clean($_REQUEST['role']);
	$tel  = clean($_REQUEST['tel']);
	
	

	//check if email in db first
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users`where email='$email'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($q)>0){ die('Email Exists');}
	$sql="INSERT INTO `tbl_users`( `full_name`, `email`, `password`, `role`, `mobile`,region_id,cluster_id,area_id,distributor_id) VALUES ('$fname','$email','$password','$user_role','$tel',$region_id,$cluster_id,$area_id,$distributor_id) ";
$data=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
if($data) header("location: level_users.php"); else echo 'error'.mysqli_error($mysqli);
}////////////////////////////////
function add_users(){// echo 'eric atinga';
global $mysqli;

	$fname  = clean($_REQUEST['full_name']);
	$email  = clean($_REQUEST['email']);
	$password  = md5(clean($_REQUEST['password']));
	$area  =clean($_REQUEST['area']);
	$user_role  =clean($_REQUEST['role']);
	$tel  = clean($_REQUEST['tel']);
	$desc=clean($_REQUEST['description']);
	$empid=clean($_REQUEST['empno']);
	$region=clean($_REQUEST['region']);
$cluster=clean($_REQUEST['cluster']);
	$distributor=clean($_REQUEST['distributor']);
//$cluster=clean($_REQUEST['cluster']);
	//check if email in db first
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users`where email='$email'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($q)>0){ die('Email Exists');}
	$sql="INSERT INTO `tbl_users`( `full_name`, `email`, `password`, `emp_id`, `role`, `mobile`,`description`,region_id,cluster_id,area_id,distributor_id) VALUES ('$fname','$email','$password','$empid','$user_role','$tel','$desc',$region,$cluster,$area,$distributor) ";
$data=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
if($data) echo 'yes'; else echo 'error'.mysqli_error($mysqli);
}
function fetch_users($status){
	$date=date("Y-m-d");
	$where=" ";
	$region=$_REQUEST['region'];$area=$_REQUEST['area'];$todayLoin=$_REQUEST['todayLoin'];$role_filter=$_REQUEST['role_filter'];$order_by=$_REQUEST['order_by'];
		$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];
	$where=" status=$status  order by region_id, area_id,cluster_id ";
	switch($role){
		case 4: $where=" status=$status "; break;//cm
		case 2: $where=" region_id=$myregion and role!=4 and status=$status "; break;//rm
		case 3: $where=" area_id=$myArea and role!=4 and role!=2 and status=$status ";break;//arm
		case 1: $where=" cluster_id=$cluster_id and role!=2 and role!=3 and status=$status "; break;//AD
		 }
		 if($region>0) $where.=" and region_id=$region";
		  if($area>0) $where.=" and area_id=$area";
		  if($todayLoin=="logged")$where.=" and date(logins)='$date'";
		  if($todayLoin=="notlogged")$where.=" and date(logins)!='$date'";
		  
		   if($role_filter!=-1) $where.=" and role=$role_filter";
		   if($order_by!=-1) $where.="  order by $order_by";
	 global $mysqli; $result=array();
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` where $where order by region_id,area_id ") or die($mysqli->error);
while ($row = mysqli_fetch_array($q)) {// $num_outlets=num_rows("tbl_dealers"," added_by=".$row['user_id']);
    $result[] = array('user_id' => $row['user_id'],'name' => get_name($row['user_id']),'email' => $row['email'],'area' =>area_name($row['area_id']),'mobile' => $row['mobile'],'gender' => $row['gender'],'desc' => $row['description'],"num_outlets"=>"-",'district'=>region_name($row['region_id']),'logins'=>$row['logins'],'appVersion'=>$row['appVersion'],'sub_area'=>sub_area_name($row['cluster_id']),'status' => $row['status'],'role' =>get_role($row['role']), ); }
    echo json_encode($result);
 }
 function load_outlets(){ global $mysqli;
	 $region_id=$_SESSION['region_id'];
	 $role=$_SESSION['user_role'];
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE `region_id`=$region_id and `longtitute`=0 and `latitute`=0 and status=0 order by business_name");
if( $role>1){$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE `longtitute`=0 and `latitute`=0 and status=0 order by business_name"); }
while ($row = mysqli_fetch_array($q)) {
    $result[] = array('dealer_id' => $row['dealer_id'],'name' => $row['business_name'],'town' => $row['town'], ); }
    echo json_encode($result);
 }
 function update_user_record($user_id,$changing_id){ global $mysqli;
	$fname  = clean($_REQUEST['full_name']);
	$email  = clean($_REQUEST['email']);
	$password  = md5(clean($_REQUEST['password']));
	$gender  = clean($_REQUEST['gender']);
	$user_role  =clean($_REQUEST['role']);
	$tel  = clean($_REQUEST['tel']);
	$desc=clean($_REQUEST['desc']);
	$empid=clean($_REQUEST['empno']);
	$update=mysqli_query($mysqli,"UPDATE `tbl_users` SET `full_name`='$fname',`email`='$email',`password`='$password',`emp_id`='$empid',`role`='$user_role',`mobile`='$tel',`gender`='$gender',`description`='$desc' WHERE user_id=$user_id") or die(mysqli_error($mysqli));
	 }
	function status_change($user_id,$changing_id,$status){
		$update=mysqli_query($mysqli,"UPDATE `tbl_users` SET status`=$change WHERE user_id=$changing_id ")or die(mysqli_error($mysqli));
		}
		//create notifications
function create_notification(){ global $mysqli;
	$about  = clean($_REQUEST['about']);
	$note  = clean($_REQUEST['note']);
	$priority  = clean($_REQUEST['priority']);
	$to  = clean($_REQUEST['to']);
	$from  =clean($_REQUEST['from']);
	$insert=mysqli_query($mysqli,"INSERT INTO `tbl_notification`(`title`,date_time,`priority`, `from`, `to`, `description`) VALUES ('$about',DATE_TIME,$priority,$from,$to,'$note')") or die(mysqli_error($mysqli));
	}
	//delete notifications
function delete_notification($note_id,$uid){ global $mysqli;
$del=mysqli_query($mysqli,"UPDATE `tbl_notification` SET `status`=1 WHERE `notification_id`=$note_id")or die(mysqli_error($mysqli));
if($del){log_details(4,0,$note_id,0,$uid,'deleted notification');}
}
//edit_notifications
function edit_notification($note_id,$uid){ global $mysqli;
	$about  = clean($_REQUEST['about']);
	$note  = clean($_REQUEST['note']);
	$priority  = clean($_REQUEST['priority']);
	$to  = clean($_REQUEST['to']);
	$from  =clean($_REQUEST['from']);
	$select=mysqli_query($mysqli,"SELECT * FROM `tbl_notification` WHERE `notification_id`=$note_id") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($select))
{
	$row_id=$row['notification_id'];
	if(strcmp($row['about'],$about)!=0){
	log_details(4,'$about',$row_id,2,$uid,'changed title');	}
	if(strcmp($row['`description`'],$note)!=0){log_details(4,'$note',$row_id,7,$uid,'changed content');}
	if(strcmp($row['priority'],$priority)!=0){log_details(4,$priority,$row_id,3,$uid,'changed priority');}
	if(strcmp($row['to'],$to)!=0){log_details(4,$to,$row_id,6,$uid,'changed recipient');	}
}
	$edit=mysqli_query($mysqli,"UPDATE `tbl_notification` SET `title`='$about',`priority`=$priority,`to`=$to,`description`=$note WHERE `notification_id`=$note_id") or die(mysqli_error($mysqli));
	}	
	//view notifications
	function view_notifications($uid){ global $mysqli;
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_notification` WHERE `status`=0") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) {
    $result[] = array('note_id' => $row['notification_id'],'title' => $row['title'], 'priority' => $row['priority'],'date_time' => $row['date_time'],'from' => $row['from'], 'to' => $row['to'],'description' => $row['description'], ); }
    echo json_encode($result);
		}
/////////....deliveries///////////////
function make_delivery(){ global $mysqli;
	$outside_ad  = clean($_REQUEST['outside_ad']);
	$inside_ad  = clean($_REQUEST['inside_ad']);
	$user_id= clean($_REQUEST['user']);
	$client_id = clean($_REQUEST['client']);
	$route_id  =clean($_REQUEST['route_id']);
	$insert=mysqli_query($mysqli,"INSERT INTO `tbl_notification`(`title`, date_time,`priority`, `from`, `to`, `description`) VALUES ('$about',DATE_TIME,$priority,$from,$to,'$note')") or die(mysqli_error($mysqli));
	
	}
	
//view my routes
	
function view_my_routes($uid){ global $mysqli;
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` WHERE `supplied_by`=$uid") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) {
    $result[] = array('user_id' => $row['supplied_by'],'date_supplied' => $row['date_supplied'], 'cases_required' => $row['cases_required'],'preordered_by' => $row['preordered_by'], 'date_made' => $row['date_made'],'order_id' => $row['order_id'], 'product_id' => $row['product_id'],); }
    echo json_encode($result);
	}
	
		

function fetch_recent_activity($uid){ global $mysqli;
	$res=mysqli_query($mysqli,"SELECT u.user_id as uid, l.`description` as description, date_time as ago  FROM `tbl_logs` l right join tbl_users u on l.user_id=u.user_id order by u.user_id desc limit 15") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) {
    $result[] = array('user_id' => $row['uid'],'description' => $row['description'], 'ago' => nicetime($row['ago']),); }
    echo json_encode($result);
		}
		//fetch oders
function fetch_outlets_for_routing(){ global $mysqli;
	$region=clean($_REQUEST['region_id']);
	$result=array();
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE `route_id`=0 and `status`=0 and `region_id`=$region order by business_name") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) {
    $result[] = array('dealer_id' => $row['dealer_id'],'bname' => business_name($row['dealer_id']),'town' => $row['town'],'phone' => $row['phone'], 'reg_date' =>date_title($row['reg_date']),'owner_name' => $row['owner_name'], ); }
    echo json_encode($result);
			}
//fetch assigned order details
function fetch_assigned_rote_outlets($rid){ global $mysqli;
	$result=array();
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE `route_id`=$rid and `status`=0 order by business_name") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) {
    $result[] = array('dealer_id' => $row['dealer_id'],'bname' => business_name($row['dealer_id']),'town' => $row['town'],'phone' => $row['phone'],'channel' =>channel_type($row['channel']),'reg_date' =>date_title($row['reg_date']),'owner_name' => $row['owner_name'], ); }
    echo json_encode($result);
			}
			
//fetch regions
function fetch_regions(){ global $mysqli;
	$result=array();
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` WHERE status=0") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) {
    $result[] = array('name' => $row['region_name'],'added_by' => get_name($row['added_by']),'date_added' => $row['date_time'],'description' => $row['description'],'outlets' => num_outlets($row['region_id']),'id' => $row['region_id'], ); }
    echo json_encode($result);
			}
		
		
					
?>

