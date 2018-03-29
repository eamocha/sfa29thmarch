<?php
//Util arrays to create response JSON
$a=array();
$b=array();

include_once 'db_functions.php';

//Create Object for DB_Functions clas
$db = new DB_Functions(); 


if(isset($_REQUEST["getAndroidPlans"])){
//Get JSON posted by Android Application
$json = stripslashes($_REQUEST["getAndroidPlans"]);

//Remove Slashes
//Decode JSON into an Array
$data = json_decode($json);

$myfile = fopen("plans.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);
//print_r($json);

for($i=0; $i<count($data) ; $i++)
{
$online_id=0;	if(isset($data[$i]->online_id)) $online_id=$data[$i]->online_id;
$d_visited='0000-00-00 00:00:00'; if(isset($data[$i]->date_visted))$d_visited=$data[$i]->date_visted;
$remarks=''; if(isset($data[$i]->remarks))$remarks=$data[$i]->remarks;
$outlet_closed=''; if(isset($data[$i]->outlet_closed))$outlet_closed=$data[$i]->outlet_closed;
$time_out='0000-00-00 00:00:00'; if(isset($data[$i]->time_out))$time_out=$data[$i]->time_out;
$time_in='0000-00-00 00:00:00'; if(isset($data[$i]->time_in))$time_in=$data[$i]->time_in;
$lon=0; if(isset($data[$i]->lon))$lon=$data[$i]->lon;
$lat=0; if(isset($data[$i]->lat))$lat=$data[$i]->lat;
$when_scheduled=0; if(isset($data[$i]->when_scheduled))$when_scheduled=$data[$i]->when_scheduled;
$distance_from_visit_point=0; if(isset($data[$i]->distance_from_visit_point))$distance_from_visit_point=$data[$i]->distance_from_visit_point;

$res = $db->storePlans($online_id,$data[$i]->online_dealer_id,$data[$i]->made_by,$data[$i]->assigned_to,$data[$i]->visted,$d_visited,$data[$i]->startdate,$data[$i]->enddate,$data[$i]->status,$data[$i]->color,$data[$i]->merchandized,$data[$i]->stock_taken,$data[$i]->order_done,$time_out,$time_in,$lon,$lat,$outlet_closed,$remarks,$when_scheduled,$distance_from_visit_point);

    //Based on insertion, create JSON response
    if($res>0){
        $b["plan_id"] = $data[$i]->plan_id;
        $b["online_plan_id"] = $res;
        array_push($a,$b);
    }else{
        $b["plan_id"] = $data[$i]->plan_id;
        $b["online_plan_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
} 
//********************************************************************************************************************
else if(isset($_REQUEST["getnewoutlts"]))
{
	$json =stripslashes($_REQUEST["getnewoutlts"]);
	//Remove Slashes
//Decode JSON into an Array
$data = json_decode($json);

////////////////////////////////////////
$myfile = fopen("outlets.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


///////////////////////////////

//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{ $remarks=''; if(isset($data[$i]->remarks)) $remarks=$data[$i]->remarks;
	$res = $db->insert_outlet($data[$i]->online_id,$data[$i]->business_name,$data[$i]->channel,$data[$i]->owner_name,$data[$i]->designation,$data[$i]->town,$data[$i]->longtitute,$data[$i]->latitute,$data[$i]->phone,$data[$i]->added_by,$data[$i]->region_id,$data[$i]->cluster_id,$data[$i]->reg_date,$data[$i]->route_id,$data[$i]->route_order,$data[$i]->distributor_id,$data[$i]->area_id,$data[$i]->location_occassions,$data[$i]->opening_time,$data[$i]->closing_time,$data[$i]->sales_fmcg,$data[$i]->willing_to_stock_coke,$data[$i]->willingness_remarks,$data[$i]->do_you_sell_coke_prds,$data[$i]->stocked_coke_inthePast,$data[$i]->verified,$data[$i]->landmark_building,$data[$i]->dealer_has_asset,$data[$i]->status,'',$data[$i]->why_dd_yu_stop_stocking_coke,$data[$i]->do_you_sell_any_bevs,'',$remarks, $data[$i]->type_of_class,$data[$i]->last_visisted);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["dealer_id"] = $data[$i]->dealer_id;
        $b["status"] =1;
		 $b["online_id"] = $res;
        array_push($a,$b);
    }else{
        $b["dealer_id"] = $data[$i]->dealer_id;
        $b["online_id"] = $data[$i]->online_id;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
	/*********************************************************************************************/
	
	else if(isset($_REQUEST["sync_RouteSales"]))
{
	$json =$_REQUEST["sync_RouteSales"];
	//Remove Slashes

//Decode JSON into an Array
$data = json_decode(stripslashes($json));;

////////////////////////////////////////
$myfile = fopen("sync_RouteSales.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{ 
$res = $db->sync_RouteSales($data[$i]->qty_sold,$data[$i]->distributor_id,$data[$i]->area_id,$data[$i]->date_sold,$data[$i]->status,$data[$i]->sku_id,$data[$i]->sold_by,$data[$i]->region_id,$data[$i]->route_id);

    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->route_sale_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->route_sale_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
} echo json_encode($a);
}
/*********************************************************************************************/	
	else if(isset($_REQUEST["sync_distributor_stockLevel"]))
{
	$json =$_REQUEST["sync_distributor_stockLevel"];
	//Remove Slashes

//Decode JSON into an Array
$data = json_decode(stripslashes($json));;

////////////////////////////////////////
$myfile = fopen("distributor_stockLevels.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


///////////////////////////////

//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{ 
$res = $db->sync_distributor_stockLevel($data[$i]->taken_by,$data[$i]->distribution_stock_level_id,$data[$i]->product_id,$data[$i]->status,$data[$i]->date_taken,$data[$i]->distributor_id,$data[$i]->qty);

    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->distribution_stock_level_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->distribution_stock_level_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
} echo json_encode($a);
}
	//********************************************************************************************************************
//assets 
else if(isset($_REQUEST["sync_new_assets"]))
{
	$json =$_REQUEST["sync_new_assets"];
	//Remove Slashes

//Decode JSON into an Array
$data = json_decode(stripslashes($json));;

////////////////////////////////////////
$myfile = fopen("assets.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


///////////////////////////////

//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{  $type="Fridge";
if(isset($data[$i]->asset_type)){ $type=$data[$i]->asset_type; } //some people have this others dont
$sync_date="";if(isset($data[$i]->sync_date)){$sync_date=$data[$i]->sync_date;}

$res = $db->sync_new_assets($data[$i]->asset_online_id, $data[$i]->serial, $data[$i]->bar_code, $data[$i]->code_format, $data[$i]->remarks, $data[$i]->status, $data[$i]->online_dealer_id, $data[$i]->date_issued, $data[$i]->issued_by, $data[$i]->model, $data[$i]->asset_number, $data[$i]->cooler_size,  $data[$i]->name, $data[$i]->sync_date, $data[$i]->asset_condition, $data[$i]->verification_status, $data[$i]->last_visit);

    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->asset_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->asset_id;
        $b["mysql_id"] = $data[$i]->asset_online_id;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}////////////////////////////////////////////////////
	//assets 
else if(isset($_REQUEST["sync_new_asset_relocation"]))
{
	$json =$_REQUEST["sync_new_asset_relocation"];
	//Remove Slashes

//Decode JSON into an Array
$data = json_decode(stripslashes($json));;

////////////////////////////////////////
$myfile = fopen("sync_new_asset_relocation.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


///////////////////////////////

//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{ 


$res = $db->sync_new_asset_relocation($data[$i]->to_outletOnlineId,$data[$i]->moved_by,$data[$i]->reason,$data[$i]->aaset_id,$data[$i]->recommended_by,$data[$i]->date_recommended,$data[$i]->asset_onlineId,$data[$i]->date_moved,$data[$i]->from_outletOnlineId,$data[$i]->from_outlet,$data[$i]->to_outlet);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->move_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->move_id;
        $b["mysql_id"] = $data[$i]->move_online_id;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}////////////////////////////////////////////////////
	
	
	
	else if(isset($_REQUEST['sync_new_gmm'])){
		$json =stripslashes($_REQUEST["sync_new_gmm"]);
	//Remove Slashes
//Decode JSON into an Array
$data = json_decode($json);

////////////////////////////////////////
$myfile = fopen("gmm.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


///////////////////////////////

//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{
	$res = $db->sync_new_gmm($data[$i]->taken_by,$data[$i]->distribution_stock_level_id,$data[$i]->lon,$data[$i]->comments_by,$data[$i]->status,$data[$i]->today_plan_activity,$data[$i]->corrective_action_status,$data[$i]->today_plan_target,$data[$i]->corrective_action_plan,$data[$i]->actual_sales,$data[$i]->date_added,$data[$i]->route,$data[$i]->dsm_incharge,$data[$i]->pd_target,"",$data[$i]->lat,$data[$i]->location,$data[$i]->corrective_action_plan);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->distribution_stock_level_id;
        $b["status"] =1;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->distribution_stock_level_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
	echo json_encode($a);
}
//Post JSON response back to Android Application
echo json_encode($a);
		}
		//////////////////////////////////////////////distributor orders
		else if(isset($_REQUEST['sync_distributor_orders'])){
		$json =stripslashes($_REQUEST["sync_distributor_orders"]);
	//Remove Slashes
//Decode JSON into an Array
$data = json_decode($json);

////////////////////////////////////////
$myfile = fopen("distributor_orders.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);


///////////////////////////////

//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{
	$res = $db->sync_distributor_orders($data[$i]->ordered_by,$data[$i]->product_id,$data[$i]->status,$data[$i]->state_of_delivery,$data[$i]->distributor_id,$data[$i]->sync_status,$data[$i]->number,$data[$i]->distributor_order_id,$data[$i]->date_ordered);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->distributor_order_id;
        $b["status"] =1;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->distributor_order_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
	echo json_encode($a);
}
//Post JSON response back to Android Application
echo json_encode($a);
		}
	//********************************************************************************************************************
else if(isset($_REQUEST["sync_stock_levels"]))

{
	$json =$_REQUEST["sync_stock_levels"];


$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{ 
//check if the values are more than 0 before inseting the and where they are -1 insert 
$cases=$data[$i]->cases;$singles=$data[$i]->singles;
$cases=formatStockNum($cases); $singles=formatStockNum($singles);
	
$res = $db->sync_stock_levels($data[$i]->online_id,$data[$i]->online_route_id,$data[$i]->product_id,$data[$i]->stock_online_dealer_id,$cases,$singles,$data[$i]->users_id,$data[$i]->date_added);
    //Based on inserttion, create JSON response
	
    if($res>0){
        $b["sqlite_id"] = $data[$i]->level_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->level_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);

}
	//********************************************************************************************************************
else if(isset($_REQUEST["sync_locations"]))
{
	$json = $_REQUEST["sync_locations"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{
$res = $db->sync_locations($data[$i]->location_online_id,$data[$i]->location_time,$data[$i]->user_id,$data[$i]->latitute,$data[$i]->longtitute);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->location_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->location_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
	
	
	
	//********************************************************************************************************************
else if(isset($_REQUEST["sync_checkin"]))
{
	$json = $_REQUEST["sync_checkin"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{	//{"checkin_id":"1","plan_route_id":"1","online_dealer_id":"1027","dealer_id":"2","checkin_online_id":"0","online_plan_route_id":"788","date_timein":"2016-08-10 02:29:17","latitude":"65.9667","longtitute":"-18.5333","user_id":"123"}
$res = $db->sync_checkin($data[$i]->checkin_online_id,$data[$i]->online_dealer_id,$data[$i]->online_plan_route_id,$data[$i]->user_id,$data[$i]->date_timein,'',$data[$i]->longtitute,$data[$i]->latitude,"");
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->checkin_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->checkin_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
			//********************************************************************************************************************
else if(isset($_REQUEST["sync_orders"]))
{
	$json = $_REQUEST["sync_orders"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{// 
$res = $db->sync_orders($data[$i]->online_order_id,$data[$i]->order_name,$data[$i]->order_source,$data[$i]->preordered_by,$data[$i]->date_made,$data[$i]->due_date,$data[$i]->online_dealer_id,$data[$i]->assigned_by,$data[$i]->assigned_to,'','','','',$data[$i]->route_id,'');
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->order_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->order_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}

	//********************************************************************************************************************
else if(isset($_REQUEST["sync_order_details"]))
{
	$json = $_REQUEST["sync_order_details"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{ $cases=0;$pieces=0; if(isset($data[$i]->cases))$cases=$data[$i]->cases;else{$cases=0;} if(isset($data[$i]->pieces))$pieces=$data[$i]->pieces;else{$pieces=0;}
	
	
$res = $db->sync_order_details($data[$i]->order_details_online_id,$data[$i]->product_id,$cases,$pieces,$data[$i]->made_by,$data[$i]->date_added,$data[$i]->order_id,$data[$i]->online_dealer_id,$data[$i]->date_supplied,$data[$i]->made_by,$data[$i]->status,$data[$i]->route_id);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->order_details_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->order_details_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
	
	//********************************************************************************************************************
else if(isset($_REQUEST["sync_prospects"]))
{
	$json = $_REQUEST["sync_prospects"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{//sync_prospects($item_id,$dealer_id,$price,$remarks)

$res = $db->sync_prospects($data[$i]->prospect_online_id,$data[$i]->item_d,$data[$i]->online_dealer_id,$data[$i]->price,$data[$i]->remarks);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->prospect_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->prospect_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
		//********************************************************************************************************************
else if(isset($_REQUEST["sync_payments"]))
{
	$json = $_REQUEST["sync_payments"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{
	 
$res = $db->sync_payments($data[$i]->payment_online_id,$data[$i]->payment_date,$data[$i]->payment_receiver,$data[$i]->payment_cofirmed_by,$data[$i]->online_dealer_id,$data[$i]->payment_details,$data[$i]->amount,$data[$i]->currency,$data[$i]->payment_mode, $data[$i]->payment_ref, $data[$i]->confimation_date);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->payment_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->payment_id;
        $b["mysql_id"] = 0;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
	
	//********************************************************************************************************************
	//new stock given
else if(isset($_REQUEST["sync_new_stock_given"]))
{
	$json = $_REQUEST["sync_new_stock_given"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{
	
   //stock_returned -missing
$res = $db->sync_new_stock_given($data[$i]->stock_given_online_id,$data[$i]->number,$data[$i]->product_id,$data[$i]->given_by,$data[$i]->given_to,$data[$i]->edited,$data[$i]->date_given, $data[$i]->status, $data[$i]->sync_date);
    //Based on inserttion, create JSON response
    if($res>0){
        $b["sqlite_id"] = $data[$i]->stock_given_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->stock_given_id;
        $b["mysql_id"] = $data[$i]->stock_given_online_id;
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
	}
	//********************************************************************************************************************
	//
else if(isset($_REQUEST["sync_new_asset_maintanance"]))
{
	$json = $_REQUEST["sync_new_asset_maintanance"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{	//
$res = $db->sync_new_asset_maintanance($data[$i]->m_online_id,$data[$i]->asset_online_id,$data[$i]->date_checked,$data[$i]->m_by,$data[$i]->m_remarks,$data[$i]->state,$data[$i]->acted_upon,$data[$i]->action_taken, $data[$i]->acted_upon_by, $data[$i]->date_acted_on, $data[$i]->m_sync_date, $data[$i]->m_status);
    if($res>0){
        $b["sqlite_id"] = $data[$i]->m_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->m_id;
        $b["mysql_id"] = $data[$i]->m_online_id;
        array_push($a,$b);
    }
}
echo json_encode($a);
	}
	//********************************************************************************************************************
	//
else if(isset($_REQUEST["sync_new_outlet_sku"]))
{
	$json = $_REQUEST["sync_new_outlet_sku"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{
	//{"dealer_online_id":"33","added_by":"123","dealer_id":"2","status":"0","":"1","":"0","flag":"0"}
$res = $db->sync_new_outlet_sku($data[$i]->sku_online_id, $data[$i]->product_id, $data[$i]->dealer_online_id, $data[$i]->date_added,$data[$i]->added_by, "", 0, date("Y-m-d H:m"));
    if($res>0){
        $b["sqlite_id"] = $data[$i]->sku_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->sku_id;
        $b["mysql_id"] = $data[$i]->sku_online_id;
        array_push($a,$b);
    }
}
echo json_encode($a);
	}
	//********************************************************************************************************************
	//
else if(isset($_REQUEST["sync_new_objective"]))
{
	$json = $_REQUEST["sync_new_objective"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{
	$res = $db->sync_new_objective($data[$i]->objective_online_id, $data[$i]->details, $data[$i]->reviewed_objective, $data[$i]->dealer_online_id, $data[$i]->added_by, $data[$i]->date_added, $data[$i]->remarks, $data[$i]->status);
    if($res>0){
        $b["sqlite_id"] = $data[$i]->objective_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->objective_id;
        $b["mysql_id"] = $data[$i]->objective_online_id;
        array_push($a,$b);
    }
}
echo json_encode($a);
	}
	else if(isset($_REQUEST["sync_new_photo"]))
{
	$json = $_REQUEST["sync_new_photo"];

$data = json_decode(stripslashes($json));;
for($i=0; $i<count($data) ; $i++)
{
	$res = $db->sync_new_photos($data[$i]->photo_online_id, $data[$i]->dealer_online_id, $data[$i]->photo_details, $data[$i]->image, $data[$i]->photo_taken_by, $data[$i]->route_online_id, $data[$i]->date_taken, 0, $data[$i]->status);
    if($res>0){
        $b["sqlite_id"] = $data[$i]->sku_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->sku_id;
        $b["mysql_id"] = $data[$i]->sku_online_id;
        array_push($a,$b);
    }
}
echo json_encode($a);
	}/////////////////////////////////////////////////////////
	else if(isset($_REQUEST["sync_survey"]))
{
	$json = stripslashes($_REQUEST["sync_survey"]);
	
	$myfile = fopen("survey.txt", "a") or die("Unable to open file!");
fwrite($myfile, $json);
fclose($myfile);

$data = json_decode($json);;
for($i=0; $i<count($data) ; $i++)
{
	$res = $db->sync_survey($data[$i]->online_id,$data[$i]->survey_date, $data[$i]->q_id, $data[$i]->answer, $data[$i]->by, $data[$i]->online_plan_id, $data[$i]->online_dealer_id,0,$data[$i]->score,$data[$i]->dealer_type);
    if($res>0){
        $b["sqlite_id"] = $data[$i]->survey_id;
		 $b["mysql_id"] = $res;
        array_push($a,$b);
    }else{
        $b["sqlite_id"] = $data[$i]->survey_id;
        $b["mysql_id"] = $data[$i]->online_id;
        array_push($a,$b);
    }
}
echo json_encode($a);
	}
	//////////////////////////
	else{  $none=array("error"=>true,"err_msg"=>"Mode is not set.");
		echo json_encode($none);
		}
?>