<?php
/**
 * DB operations functions
 */
class DB_Functions {
 
    private $db;
     //put your code here
    // constructor
    function __construct() {
        require_once '../assets/lib/config.php';
        // connecting to mysql
      $this->db = mysqli_connect($db_host, $db_username, $db_password);
        // selecting database
        mysqli_select_db($this->db,$db_name);
 
        // return database handler
       // return $this->db;
    }
    // destructor
    function __destruct() {
	//	mysqli_close($this->db);
    } ///sync_distributor_stockLevel dist stock levels
	public function sync_distributor_stockLevel($taken_by,$distribution_stock_level_id,$product_id,$status,$date_taken,$distributor_id,$qty){
		///clean
		$taken_by=clear($taken_by);
		$distribution_stock_level_id=clear($distribution_stock_level_id);
		$product_id=clear($product_id);
		$status=clear($status);
		
			$distributor_id=clear($distributor_id);
				$qty=clear($qty);		
				///separate date and time
				$date=date("Y-m-d",strtotime($date_taken));	$time=date("H:i:s",strtotime($date_taken));
		 $result = mysqli_query($this->db,"INSERT INTO `tbl_distributor_stock_levels`(`distributor_id`, `product_id`, `date_taken`, `qty`, `taken_by`, `status`,time_taken) VALUES ($distributor_id,$product_id,'$date',$qty,$taken_by,$status,'$time') ON DUPLICATE KEY UPDATE `qty`=$qty, `status`=$status ") or die(mysqli_error($this->db));
		 
     $id= mysqli_insert_id($this->db);
	  if($id==0){ $id=$this->getItemId("tbl_distributor_stock_levels","distribution_stock_level_id","`distributor_id`=$distributor_id and `product_id`=$product_id and `date_taken`='$date' and `taken_by`=$taken_by and `status`=$status");
	 } else $id=mysqli_insert_id($this->db);
//	  mysqli_close($this->db);
	 return $id;
	
		}
		////////////////////////////////////////////////////////sync route sales
		public function sync_RouteSales($qty_sold,$distributor_id,$area_id,$date_sold,$status,$sku_id,$sold_by,$region_id,$route_id){
		$qty_sold=clear($qty_sold);
		$distributor_id=clear($distributor_id);
		$area_id=clear($area_id);
		$status=clear($status);
		
			$region_id=clear($region_id);
				$date_sold=clear($date_sold);$sku_id=clear($sku_id);$sold_by=clear($sold_by);	$route_id=clear($route_id);		
				///separate date and time
		
		 $result = mysqli_query($this->db,"INSERT INTO `tbl_route_sales`(`date_sold`, `qty_sold`, `sku_id`, `sold_by`, `route_id`, `distributor_id`, `area_id`, `region_id`, `status`) VALUES  ('$date_sold',$qty_sold,$sku_id,$sold_by,$route_id,$distributor_id,$area_id,$region_id,$status) ON DUPLICATE KEY UPDATE `qty_sold`=$qty_sold, `status`=$status ") or die(mysqli_error($this->db));
		 
     $id= mysqli_insert_id($this->db);
	  if($id==0){ $id=$this->getItemId("tbl_route_sales","route_sale_id","`distributor_id`=$distributor_id and `route_id`=$route_id and `date_sold`='$date_sold' and `sold_by`=$sold_by and `sku_id`=$sku_id");
	 } else $id=mysqli_insert_id($this->db);
//	  mysqli_close($this->db);
	 return $id;
	
		}
		
		///////////////////////////////// distributor orders

public function sync_distributor_orders($ordered_by,$product_id,$status,$state_of_delivery,$distributor_id,$sync_status,$number,$distributor_order_id,$date_ordered){
		///clean
		$ordered_by=clear($ordered_by);
		$product_id=clear($product_id);
		$status=clear($status);
		$status=clear($status);
		$state_of_delivery=clear($state_of_delivery);
			$distributor_id=clear($distributor_id);
				$sync_status=clear($sync_status);$number=clear($number);$date_ordered=clear($date_ordered);
		
		 $result = mysqli_query($this->db,"INSERT INTO `tbl_distributor_orders`(`distributor_id`, `date_ordered`, `product_id`, `ordered_by`, `number`, `status`) VALUES ($distributor_id,'$date_ordered',$product_id,$ordered_by,$number,$status) ON DUPLICATE KEY UPDATE `number`=$number, `status`=$status  ") or die(mysqli_error($this->db));
  
	 
	  $id=mysqli_insert_id($this->db); 
	 
	 if($id==0){ $id=$this->getItemId("tbl_distributor_orders","distributor_order_id","`distributor_id`=$distributor_id  and   `date_ordered`='$date_ordered'  and   `product_id`=$product_id  and   `ordered_by`=$ordered_by  and   `number`=$number  and   status=$status");
	 } else $id=mysqli_insert_id($this->db);
	 return $id;
	 
				}
				////////////////////////////////relocate asset
			/*goood morning*/
	public function sync_new_gmm($taken_by,$distribution_stock_level_id,$lon,$comments_by,$status,$today_plan_activity,$corrective_action_status,$today_plan_target,$corrective_action_plan,$actual_sales,$date_added,$route,$dsm_incharge,$pd_target,$comments,$lat,$location,$pd_corrective_action_plan){
		//get boundaries
		$dist=0;
		$area=0;$cluster=0;$region=0;
	$boundq=mysqli_query($this->db,"select distributor_id, area_id,cluster_id,region_id from tbl_routes where route_id=$route");
	if(mysqli_num_rows($boundq)>0){
		$bs=mysqli_fetch_array($boundq);
		 $dist=$bs['distributor_id'];$area=$bs['area_id'];$cluster=$bs['cluster_id'];$region=$bs['region_id'];}
		
		
		
				$pd_corrective_action_plan=clear($pd_corrective_action_plan);$taken_by=clear($taken_by);$location=clear($location);$lon=clear($lon);$comments_by=clear($comments_by);$status=clear($status);$today_plan_activity=clear($today_plan_activity);$corrective_action_status=clear($corrective_action_status);$today_plan_target=clear($today_plan_target);$corrective_action_plan=clear($corrective_action_plan); $actual_sales=clear($actual_sales);$date_added=clear($date_added);$route=clear($route);$dsm_incharge=clear($dsm_incharge);$dsm_incharge=clear($dsm_incharge);$comments=clear($comments);$lat=clear($lat);
		
		 $result = mysqli_query($this->db,"INSERT INTO `tbl_good_morning_meeting`(pd_corrective_action_plan,area,region,cluster, distributor,taken_by, `date_added`,  `status`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`, `pd_target`, `actual_sales`, `route`, `dsm_incharge`, `comments`,location) VALUES ('$pd_corrective_action_plan' ,$area, $region, $cluster, $dist, $taken_by, '$date_added', $status,'$lon','$lat','$today_plan_activity', '$corrective_action_status','$today_plan_target','$pd_target','$actual_sales',$route,'$dsm_incharge','$comments','$location') ON DUPLICATE KEY UPDATE `status`=$status, `today_plan_activity`='$today_plan_activity' , `corrective_action_status`='$corrective_action_status', `today_plan_target`=$today_plan_target,  `pd_target`=$pd_target, `actual_sales`=$actual_sales,pd_corrective_action_plan='$pd_corrective_action_plan', area=$area,region=$region,cluster=$cluster, distributor=$dist,`route`=$route, `dsm_incharge`='$dsm_incharge'") or die(mysqli_error($this->db));;
      $id=mysqli_insert_id($this->db); 
	  //`taken_by`, `date_added`, `lon`, `lat`, `route`, `distributor`
	 if($id==0){ $id=$this->getItemId("tbl_good_morning_meeting","good_morning_meeting_id","`taken_by`=$taken_by and `date_added`='$date_added' and `lon`='$lon' and lat='$lat' and `route`=$route and`distributor`=$dist");
	 } else $id=mysqli_insert_id($this->db);
	 return $id;
		} 
		
    /**
     * Store plans from sqlite
     */
    public function storePlans($plan_id,$did,$uid,$assigned_to,$visted,$date_visted,$startdate,$enddate,$status,$color,$merchandize,$stock_take,$order_done,$time_out,$time_in,$lon,$lat,$outlet_closed,$remarks,$when_scheduled,$distance_from_visit_point) {
		
	$date_visted=clear($date_visted);$startdate=clear($startdate);$enddate=clear($enddate);$color=clear($color); $remarks=clear($remarks); $when_scheduled=clear($when_scheduled);
		
		//get today's date to use in the app
		$today=date("Y-m-d"); $updateString=" `made_by`=$uid, `assigned_to`=$assigned_to, `visted`=$visted, `date_visted`='$date_visted', `startdate`='$startdate', `enddate`='$enddate', `status`=$status, `color`='$color', `merchandized`=$merchandize, `stock_taken`=$stock_take, `order_done`=$order_done,time_out='$time_out',time_in='$time_in',lon=$lon,lat=$lat,outlet_closed='$outlet_closed',remarks='$remarks' ,when_scheduled='$when_scheduled',distance_from_visit_point='$distance_from_visit_point' ";
        if($this->islnDb("tbl_route_plan","id= ".$plan_id)==1){ //if the outlet is in db and the mobile app has the route id
			 $update = mysqli_query($this->db,"UPDATE `tbl_route_plan` SET `dealer_id`=$did, $updateString where id=$plan_id") or die(mysqli_error($this->db));
			 return $plan_id;
			}
			else if($this->islnDb("tbl_route_plan","dealer_id= ".$did." and date(startdate)='".$today."' and assigned_to=".$assigned_to)==1){//if the outlet is online but the mobile app has no id
				 $update = mysqli_query($this->db,"UPDATE `tbl_route_plan` SET $updateString where dealer_id= ".$did." and date(startdate)='".$today."'") or die(mysqli_error($this->db));
			 return $this->getItemId("tbl_route_plan","id","dealer_id= ".$did." and date(startdate)='".$today."'");
			 }
			 else{//if ot is completely not in the db
        $result = mysqli_query($this->db,"INSERT INTO `tbl_route_plan`(`dealer_id`, `made_by`, `assigned_to`, `visted`, `date_visted`, `startdate`, `enddate`, `allDay`, `status`, `color`, `merchandized`, `stock_taken`, `order_done`,syncStatus,time_out,time_in,lon,lat,outlet_closed,remarks,when_scheduled, distance_from_visit_point) VALUES ($did,$uid,$assigned_to,$visted,'$date_visted','$startdate','$enddate','false',$status,'$color',$merchandize,$stock_take,$order_done,1,'$time_out','$time_in',$lon,lat,'$outlet_closed','$remarks','$when_scheduled','$distance_from_visit_point') ON DUPLICATE KEY UPDATE $updateString") or die(mysqli_error($this->db));;
     return mysqli_insert_id($this->db);
		}
    }
     /**
     * Insert outlet
	      */
	////////////////////////////////////////
	 public function insert_outlet($id,$name,$channel,$owner_name,$designation,$town,$longtitute,$latitute,$phone,$added_by,$region_id,$cluster_id,$reg_date,$route_id,$route_order,$distributor_id,$area_id,$location_occassions,$opening_time,$closing_time,$sales_fmcg,$willing_to_stock_coke,$willingness_remarks,$do_you_sell_coke_prds,$stocked_coke_inthePast,$verified,$landmark_building,$dealer_has_asset,$status,$sync_date,$why_dd_yu_stop_stocking_coke,$do_you_sell_any_bevs,$has_electricity,$remarks,$type_of_class,$last_visisted) {
			
		$last_visisted=clear($last_visisted);
		$name=clear($name);$phone=clear($phone);$type_of_class=clear($type_of_class);
				$location_occassions=clear($location_occassions);
					$do_you_sell_coke_prds=clear($do_you_sell_coke_prds);
						$willingness_remarks=clear($willingness_remarks);
								$landmark_building=clear($landmark_building);
										$why_dd_yu_stop_stocking_coke=clear($why_dd_yu_stop_stocking_coke);
												//$name=clear($name);
													//	$name=clear($name);
														  $channel=clear(intval($channel));
		$owner_name=clear($owner_name); $designation=clear(intval($designation));
;		$town=clear($town);$longtitute=clear(floatval($longtitute));$latitute=floatval($latitute);$phone=$phone;$added_by=intval($added_by);$region_id=clear(intval($region_id));$reg_date=clear($reg_date);$route_id=clear(intval($route_id));
		$remarks=clear($remarks);
//make it compulsury that the demarcation must be in the outlet for it to be saved
if($route_id>0 and $cluster_id>0 and $area_id>0 and $distributor_id>0){
$similarity_condition=" business_name='$name' and reg_date='$reg_date' and added_by=$added_by";
//////*****************************temoprarrly fetch the cluster/subarea of the outlet using the route**/

		///check whether is duplicate
		$checkq=mysqli_query($this->db,"SELECT dealer_id FROM tbl_dealers WHERE dealer_id=$id");
		if(mysqli_num_rows($checkq)>0)
      {//if has been registered and outlet is mobile app has the id
	   
	   
		    $update = mysqli_query($this->db,"UPDATE `tbl_dealers` SET `business_name`='$name', `channel`=$channel, `owner_name`='$owner_name', `designation`=$designation, `town`='$town',  `longtitute`='$longtitute', `latitute`='$latitute', `phone`='$phone', `added_by`=$added_by, `region_id`=$region_id, area_id=$area_id,cluster_id=$cluster_id, `reg_date`='$reg_date', `route_id`=$route_id ,distributor_id=$distributor_id,`location_occassions`='$location_occassions', `opening_time`='$opening_time', `closing_time`='$closing_time', `has_electricity`='$has_electricity', `sales_fmcg`='$sales_fmcg', sales_coke_products='$do_you_sell_coke_prds',`do_you_sell_any_bevs`='$do_you_sell_any_bevs', `why_dd_yu_stop_stocking_coke`='$why_dd_yu_stop_stocking_coke', `dealer_has_asset`='$dealer_has_asset', `landmark_building`='$landmark_building', `stocked_coke_inthePast`='$stocked_coke_inthePast', `willing_to_stock_coke`='$willing_to_stock_coke', `willingness_remarks`='$willingness_remarks', remarks='$remarks',verified=$verified,type_of_class='$type_of_class',last_visisted='$last_visisted' WHERE dealer_id=$id") or die(mysqli_error($this->db));
			return $id;
		   		   }
		else if($this->islnDb("tbl_dealers",$similarity_condition)==1){//registered by mobile app has no id.itwill online take the id back
		   // $update = mysqli_query($this->db,"UPDATE `tbl_dealers` SET `business_name`='$name', `channel`=$channel, `owner_name`='$owner_name', `designation`=$designation, `town`='$town',  `longtitute`='$longtitute', `latitute`='$latitute', `phone`='$phone', `added_by`=$added_by, `region_id`=$region_id, area_id=$area_id,cluster_id=$cluster_id, `reg_date`='$reg_date', `route_id`=$route_id ,distributor_id=$distributor_id,`location_occassions`='$location_occassions', `opening_time`='$opening_time', `closing_time`='$closing_time', `has_electricity`='$has_electricity', `sales_fmcg`='$sales_fmcg', `do_you_sell_any_bevs`='$do_you_sell_any_bevs', `why_dd_yu_stop_stocking_coke`='$why_dd_yu_stop_stocking_coke', `dealer_has_asset`='$dealer_has_asset', `landmark_building`='$landmark_building', `stocked_coke_inthePast`='$stocked_coke_inthePast', `willing_to_stock_coke`='$willing_to_stock_coke', `willingness_remarks`='$willingness_remarks' WHERE ". $similarity_condition) or die(mysqli_error($this->db));
			return $this->getItemId("tbl_dealers",'dealer_id',$similarity_condition);
		   		   } else{
					   ///   [{"area_id":"9","phone":"0723498363","owner_name":"alice nakivono","cluster_id":"549","region_id":"1","designation":"Manager","sales_fmcg":"Yes","route_order":"0","longtitute":"34.7889092","reg_date":"2017-06-15 21:57:12","willing_to_stock_coke":"","type_of_class":"Yes","willingness_remarks":"","opening_time":" Not Provided ","added_by":"10299","do_you_sell_coke_prds":"Yes","stocked_coke_inthePast":"","verified":"0","route_id":"138","landmark_building":"kwa stage","dealer_has_asset":"Yes","status":"0","sync_date":"2017-06-15 21:57:12","distributor_id":"55","why_dd_yu_stop_stocking_coke":"","closing_time":" Not Provided ","online_id":"0","latitute":"-0.6806545","business_name":"asm test outlet","flag":"0","dealer_id":"1","location_occassions":"Transport","town":"Unnamed Road,Kisii,null, null,KE","channel":"1","do_you_sell_any_bevs":"Yes","dealer_checker":"293"}]

	    $result = mysqli_query($this->db,"INSERT INTO `tbl_dealers`(`business_name`, `channel`, `owner_name`, `designation`, `town`, `longtitute`, `latitute`,  `phone`, `added_by`, `reg_date`, `route_id`, `route_order`, `distributor_id`, `cluster_id`, `area_id`, `region_id`,  `verified`,  `location_occassions`, `opening_time`, `closing_time`, `has_electricity`, `sales_fmcg`,sales_coke_products, `do_you_sell_any_bevs`, `why_dd_yu_stop_stocking_coke`, `dealer_has_asset`, `landmark_building`, `stocked_coke_inthePast`, `willing_to_stock_coke`, `willingness_remarks`,remarks,type_of_class) VALUES ('$name',$channel,'$owner_name','$designation','$town','$longtitute','$latitute'	,'$phone',$added_by,'$reg_date',$route_id,$route_order,$distributor_id,$cluster_id,$area_id,$region_id,$verified,'$location_occassions','$opening_time','$closing_time','$has_electricity','$sales_fmcg','$do_you_sell_coke_prds','$do_you_sell_any_bevs','$why_dd_yu_stop_stocking_coke','$dealer_has_asset','$landmark_building','$stocked_coke_inthePast','$willing_to_stock_coke','$willingness_remarks','$remarks','$type_of_class')") or die(mysqli_error($this->db));
		
        return mysqli_insert_id($this->db);
	  //end else
				   }
				   }///end if compulsory
    }
/* sync_stock_levels///////////////////////////////////////////////////////////////////////////////////
	*/
		  public function sync_stock_levels($stock_level_id,$route_id,$product_id,$dealer_id,$cases,$singles,$user_id,$date_added) {
         if($this->islnDb("tbl_stock_levels","stock_level_id= ".$stock_level_id)==1)
		 {// the mobile app has the id of this item
			  $update = mysqli_query($this->db,"UPDATE `tbl_stock_levels` set `route_plan_id`=$route_id, `product_id`=$product_id, `dealer_id`=$dealer_id, `cases`=$cases, `singles`=$singles, `user_id`=$user_id, `date_added`='$date_added' where stock_level_id=$stock_level_id") or die(mysqli_error($this->db)); return $stock_level_id;
			 } 
			 else if($this->islnDb("tbl_stock_levels","route_plan_id= ".$route_id." and product_id=".$product_id." and dealer_id=".$dealer_id)==1)
		 {//the mobile app has no id of this item but it has been stored. to remove repetition
			  $update = mysqli_query($this->db,"UPDATE `tbl_stock_levels` set `route_plan_id`=$route_id, `product_id`=$product_id, `dealer_id`=$dealer_id, `cases`=$cases, `singles`=$singles, `user_id`=$user_id, `date_added`='$date_added' where stock_level_id=$stock_level_id") or die(mysqli_error($this->db));
			  
			   return $this->getItemId("tbl_stock_levels","stock_level_id","route_plan_id= ".$route_id." and product_id=".$product_id." and dealer_id=".$dealer_id);
			 }  else{
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_stock_levels`(`route_plan_id`, `product_id`, `dealer_id`, `cases`, `singles`, `user_id`, `date_added`) VALUES ($route_id,$product_id,$dealer_id,$cases,$singles,$user_id,'$date_added')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		 }
    }
	/* sync_checkin
	*/
		  public function sync_checkin($checkin_id,$dealer_id,$route_plan_id,$user_id,$date_timein,$date_time_out,$longtitute,$latitute,$description) { $description=clear($description);
			    if($this->islnDb("tbl_check_in","checkin_id= ".$checkin_id)==1)
		 {
			 $update = mysqli_query($this->db,"UPDATE `tbl_check_in` SET  `date_timeout`='$date_time_out', `longtitute`='$longtitute', `latitute`='$latitute', `description`='$description' WHERE checkin_id=$checkin_id") or die(mysqli_error($this->db));
			 return $checkin_id;
			 }
			  else if($this->islnDb("tbl_check_in","`dealer_id`=".$dealer_id." and `route_plan_id`=".$route_plan_id." and `user_id`=".$user_id." and `date_timein`='".$date_timein."'")==1)
		 {///if the item is in the db but not updated in the phone app
			 $update = mysqli_query($this->db,"UPDATE `tbl_check_in` SET  `dealer_id`=$dealer_id, `route_plan_id`=$route_plan_id, `user_id`=$user_id, `date_timein`='$date_timein', `date_timeout`='$date_time_out', `longtitute`='$longtitute', `latitute`='$latitute', `description`='$description' WHERE `dealer_id`=".$dealer_id." and `route_plan_id`=".$route_plan_id." and `user_id`=".$user_id." and `date_timein`='".$date_timein."'") or die(mysqli_error($this->db));
			   return $this->getItemId("tbl_check_in","checkin_id","`dealer_id`=".$dealer_id." and `route_plan_id`=".$route_plan_id." and `user_id`=".$user_id." and `date_timein`= '".$date_timein."'");
			 }
			  else{//new
          $result = mysqli_query($this->db,"INSERT INTO `tbl_check_in`( `dealer_id`, `route_plan_id`, `user_id`, `date_timein`, `date_timeout`, `longtitute`, `latitute`, `description`) VALUES ($dealer_id,$route_plan_id,$user_id,'$date_timein','$date_time_out','$longtitute','$latitute','$description')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		 }
    }
		/* sync_orders
	*/
		  public function sync_orders($order_id,$order_name,$order_source,$preordered_by,$date_made,$date_due,$dealer_id,$assigned_by,$assigned_to,$date_time_assigned,$date_supplied,$supplied_by,$pre_order_comment,$route_id,$delivery_remarks) {
       if($this->islnDb("tbl_orders","order_id= ".$order_id)==1){
		    $update = mysqli_query($this->db,"UPDATE `tbl_orders` SET `order_name`='$order_name', `order_source`=$order_source, `preordered_by`=$preordered_by, `date_made`='$date_made', `date_due`='$date_due', `dealer_id`=$dealer_id, `assigned_by`=$assigned_by, `assigned_to`=$assigned_to, `date_time_assigned`='$date_time_assigned', `date_supplied`='$date_supplied', `supplied_by`=$supplied_by, `pre_order_comment`='$pre_order_comment', `route_id`=$route_id, `delivery_remarks`='$delivery_remarks' WHERE order_id=$order_id ") or die(mysqli_error($this->db));
		   
		   return $order_id;
		   } else{
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_orders`(`order_name`, `order_source`, `preordered_by`, `date_made`, `date_due`, `dealer_id`, `assigned_by`, `assigned_to`, `date_time_assigned`, `date_supplied`, `supplied_by`, `pre_order_comment`, `route_id`, `delivery_remarks`) VALUES ('$order_name',$order_source,$preordered_by,'$date_made','$date_due',$dealer_id,$assigned_to,'$date_supplied',$supplied_by,'$pre_order_comment')") or die(mysqli_error($this->db));
		
        return mysqli_insert_id($this->db);
	   }
    }
	
		/* sync_order_details
	*/
		  public function sync_order_details($order_details_id,$product_id,$cases,$pieces,$made_by,$date_added,$order_id,$dealer_id,$date_supplied,$supplied_by,$status,$route_id) {
			        if($this->islnDb("tbl_orders_details","order_details_id= ".$order_details_id)==1){
						 $update = mysqli_query($this->db,"UPDATE `tbl_orders_details` SET `product_id`=$product_id, `cases`=$cases, pieces=$pieces, `made_by`=$made_by, `date_added`='$date_added', `order_id`=$order_id, `dealer_id`=$dealer_id, `date_supplied`='$date_supplied', `supplied_by`=$supplied_by WHERE order_details_id=$order_details_id") or die(mysqli_error($this->db));
						 return $order_details_id;
						}
						else if($this->islnDb("tbl_orders_details"," `product_id`=".$product_id." and `made_by`=".$made_by." and `date_added`='".$date_added."' and `dealer_id`=".$dealer_id)==1)
						{
						 $update = mysqli_query($this->db,"UPDATE `tbl_orders_details` SET `product_id`=$product_id, `cases`=$cases, pieces=$pieces, `made_by`=$made_by, `date_added`='$date_added', `order_id`=$order_id, `dealer_id`=$dealer_id, `date_supplied`='$date_supplied', `supplied_by`=$supplied_by WHERE `product_id`=".$product_id." and `made_by`=".$made_by." and `date_added`='".$date_added."' and `dealer_id`=".$dealer_id) or die(mysqli_error($this->db));
						
						  return $this->getItemId("tbl_orders_details","order_details_id"," `product_id`=".$product_id." and `made_by`=".$made_by." and `date_added`='".$date_added."' and `dealer_id`=".$dealer_id);
						} else{
       
	   	    $result = mysqli_query($this->db,"INSERT INTO `tbl_orders_details`(`product_id`, cases,pieces, `made_by`, `date_added`, `order_id`, `dealer_id`, `date_supplied`, `supplied_by`) VALUES ($product_id,$cases, $pieces,$made_by,'$date_added',$order_id,$dealer_id,'$date_supplied',$supplied_by)") or die(mysqli_error($this->db));
			
        return mysqli_insert_id($this->db);
					}
    }
		/* sync_locations
	*/
		  public function sync_locations($id,$time,$user_id,$lat,$lon) {
          if($this->islnDb("tbl_locations","id= ".$id)){
			     $update = mysqli_query($this->db,"UPDATE `tbl_locations` SET `time`=$time, `user_id`=$user_id, `lat`='$lat', `lon`='$lat' WHERE id=$id") or die(mysqli_error($this->db)==1);
        return $id;			  
			  } else{
			
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_locations`(`time`, `user_id`, `lat`, `lon`) VALUES ($time,$user_id,$lat,$lon)") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		  }
    }
	/* sync_prospects
	*/
		  public function sync_prospects($prospecting_id,$item_id,$dealer_id,$price,$remarks) {  
		   if($this->islnDb(" tbl_prospecting "," prospecting_id= ".$prospecting_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_prospecting` SET `item_id`=$item_id, `dealer_id`=$dealer_id, `price`='$price', `remarks`='$remarks' where prospecting_id=$prospecting_id") or die(mysqli_error($this->db));
				 return $prospecting_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_prospecting`(`item_id`, `dealer_id`, `price`, `remarks`) VALUES ($item_id,$dealer_id,'$price','$remarks')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
		/* sync_payments
	*/
		  public function sync_payments($payment_id,$date_time_made,$received_by,$confirmed_by,$dealer_id,$details,$amount,$currency,$mode_of_payment, $Refernce_no, $date_confirmed) { 
		   $date_time_made=clear($date_time_made);$details=clear($details);$amount=clear($amount);$currency=clear($currency);$mode_of_payment=clear($mode_of_payment); $Refernce_no=clear($Refernce_no); $date_confirmed=clear($date_confirmed);
        if($this->islnDb(" tbl_payments "," payment_id= ".$payment_id)==1){
			  $update = mysqli_query($this->db,"UPDATE `tbl_payments` SET `date_time_made`='$date_time_made', `received_by`=$received_by, `confirmed_by`=$confirmed_by, `dealer_id`=$dealer_id, `details`='$details', `amount`='$amount', `currency`='$currency', `mode_of_payment`=$mode_of_payment, `Refernce_no`='$Refernce_no', `date_confirmed`='$date_confirmed' WHERE payment_id=$payment_id") or die(mysqli_error($this->db));
			  return $payment_id;
			} else{
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_payments`( `date_time_made`, `received_by`, `confirmed_by`, `dealer_id`, `details`, `amount`, `currency`, `mode_of_payment`, `Refernce_no`, `date_confirmed`) VALUES ('$date_time_made',$received_by,$confirmed_by,$dealer_id,'$details','$amount','$currency',$mode_of_payment,'$Refernce_no','$date_confirmed')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
    }
	}	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  public function sync_new_routes($r_id,$route_name,$details,$route_assigned_to,$due_date,$assigned_vehicle_id,$status,$dateTimeModified,$sync_date) {   
	  $route_name=clear($route_name);$details=clear($details);
	  
		   if($this->islnDb(" tbl_routes "," route_id= ".$r_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_routes` SET route_name='$route_name',`details`='$details', `route_assigned_to`=$route_assigned_to where route_id=$r_id") or die(mysqli_error($this->db));
				 return $r_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_routes`(`route_name`, `details`, `route_assigned_to`,  `due_date`, `assigned_vehicle_id`, `status`, `dateTimeModified`, `sync_date`) VALUES ($r_id,$r_id,'$route_name','$details',$route_assigned_to,'$due_date',$assigned_vehicle_id,$status,'$dateTimeModified','$sync_date')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	///////////////////////////////
	  public function sync_survey($survey_id,$survey_date, $q_id, $answer, $by, $plan_id, $dealer_id,$status,$score,$dealer_type) {  
	  
	  
	  $answer=clear($answer);$score=clear($score);$dealer_type=clear($dealer_type);
	  $similar_condition=" `survey_date`='$survey_date' and `q_id`=$q_id and `answer`='$answer' and `by`=$by and `plan_id`=$plan_id and `dealer_id`=$dealer_id and `status`=$status";
	  
		   if($this->islnDb(" tbl_survey "," survey_id= ".$survey_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_survey` SET survey_date='$survey_date', q_id=$q_id, answer='$answer', `by`=$by, plan_id=$plan_id, dealer_id=$dealer_id,status=$status where survey_id=$survey_id") or die(mysqli_error($this->db));
				 return $survey_id;
			   } 
			     else if($this->islnDb(" tbl_survey ",$similar_condition)==1){
				   
				   $update = mysqli_query($this->db,"UPDATE `tbl_survey` SET  `survey_date`='$survey_date', `q_id`=$q_id, `answer`='$answer', `by`=$by, `plan_id`=$plan_id, `dealer_id`=$dealer_id,status=$status WHERE $similar_condition") or die(mysqli_error($this->db));
			return $this->getItemId("tbl_survey","survey_id",$similar_condition);
			}
			else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_survey`(`survey_date`, `q_id`, `answer`, `by`, `plan_id`, `dealer_id`,status,score,dealer_type) VALUES ('$survey_date', $q_id, '$answer', $by, $plan_id, $dealer_id,$status,$score,'$dealer_type')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  public function sync_new_stock_given($id,$number,$product_id,$given_by,$given_to,$edited,$date_given, $status, $sync_date) {  
		   if($this->islnDb(" tbl_stock_given "," id= ".$id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_stock_given` SET `number`=$number, `product_id`=$product_id, `given_by`=$given_by, `given_to`=$given_to,edited=$edited,date_given='$date_given',status= $status, sync_date='$sync_date' where id=$id") or die(mysqli_error($this->db));
				 return $id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_stock_given`( `number`, `product_id`, `given_by`, `given_to`, `edited`, `date_given`, `status`, `sync_date`) VALUES ($number,$product_id,$given_by,$given_to,$edited,'$date_given', $status, '$sync_date')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	   public function sync_new_assets($asset_id, $serial, $aaset_code, $asset_code_format, $asset_desc, $asset_status, $asset_dealer_id, $asset_date_issued, $asset_issued_by, $model,$asset_number,$cooler_size,$name, $sync_date, $asset_condition, $verification_status, $last_visit) {  
	  
		$serial=clear($serial);$aaset_code=clear($aaset_code);
		$last_visit=clear($last_visit);$verification_status=clear($verification_status);
		$asset_condition=clear($asset_condition);
		$sync_date=clear($sync_date);
				$asset_code_format=clear($asset_code_format);
						$asset_desc=clear($asset_desc);
								$asset_date_issued=clear($asset_date_issued);
										$model=clear($model);
										$asset_number=clear($asset_number);$model=clear($model);
										$cooler_size=clear($cooler_size);
										$name=clear($name);
									
										
										$similarity_condition=" model='$model' and name='$name' and serial='$serial' and reg_by=$asset_issued_by and remarks='$asset_desc' and dealer_id=$asset_dealer_id and code='$aaset_code' and code_format='$asset_code_format' and date_isued='$asset_date_issued'";
																												
		   if($this->islnDb(" tbl_assets "," asset_id= ".$asset_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_assets` SET `code`='$aaset_code', asset_size='$cooler_size',asset_number='$asset_number', `code_format`='$asset_code_format', status=$asset_status,`remarks`='$asset_desc',last_visited='$last_visit',verification_status='$verification_status',`asset_condition`='$asset_condition' where asset_id=$asset_id") or die(mysqli_error($this->db));
				 return $asset_id;
			   } 
			   else if($this->islnDb(" tbl_assets ",$similarity_condition)==1){
				   
				   $update = mysqli_query($this->db,"UPDATE `tbl_assets` SET  model='$model' , name='$name' , asset_number='$asset_number' , asset_size='$cooler_size' , serial='$serial', reg_by=$asset_issued_by , remarks='$asset_desc' , dealer_id=$asset_dealer_id,last_visited='$last_visit', verification_status='$verification_status',`asset_condition`='$asset_condition' WHERE $similarity_condition") or die(mysqli_error($this->db));
			return $this->getItemId("tbl_assets","asset_id",$similarity_condition);
			}
			   
			   else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_assets`( `model`, `name`, `code`, `code_format`, `serial`, `date_isued`, `reg_by`, `dealer_id`, `remarks`, `status`,asset_number,asset_size,`asset_condition`) VALUES ('$model','$name','$aaset_code','$asset_code_format','$serial','$asset_date_issued',$asset_issued_by,$asset_dealer_id,'$asset_desc',$asset_status,'$asset_number','$cooler_size','$asset_condition')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   } //mysqli_close($this->db);
    }
	public function sync_new_asset_relocation($to_outletOnlineId,$moved_by,$reason,$aaset_id,$recommended_by,$date_recommended,$asset_onlineId,$date_moved,$from_outletOnlineId,$from_outlet,$to_outlet){

		///clean
		$to_outletOnlineId=clear($to_outletOnlineId);
		$moved_by=clear($moved_by);
		$asset_id=clear($aaset_id);
		$recommended_by=clear($recommended_by);
		$date_recommended=clear($date_recommended);
			$asset_onlineId=clear($asset_onlineId);
				$date_moved=clear($date_moved);$from_outletOnlineId=clear($from_outletOnlineId);$from_outlet=clear($from_outlet);
				$to_outlet=clear($to_outlet);
		
		 $result = mysqli_query($this->db,"INSERT INTO `tbl_asset_movement`( `date_moved`, `asset_id`, `from_outlet`, `to_outlet`, `recommended_by`, `approved_by`, `authorized_by`, `moved_by`, `date_recommended`, `reason`) VALUES ('$date_moved',$asset_id,$from_outletOnlineId,$to_outletOnlineId,$recommended_by,0,0,$moved_by,'$date_recommended','$reason') ON DUPLICATE KEY UPDATE reason='$reason'") or die(mysqli_error($this->db));
  
	 
	  $id=mysqli_insert_id($this->db); 
	 
	 if($id==0){ $id=$this->getItemId("tbl_asset_movement","move_id","`from_outlet`=$from_outletOnlineId  and   `date_recommended`='$date_recommended'  and   `moved_by`=$moved_by ");
	 } else $id=mysqli_insert_id($this->db);
	 return $id;
	 
				}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  public function sync_new_asset_maintanance($asset_status_id,$asset_id,$date_checked,$checked_by,$remarks,$state,$acted_upon,$action_taken, $acted_upon_by, $date_acted_on, $sync_date, $status) {  
	  $date_checked=clear($date_checked);$remarks=clear($remarks);$state=clear($state);$acted_upon=clear($acted_upon);$action_taken=clear($action_taken);  $date_acted_on=clear($date_acted_on); $sync_date=clear($sync_date);
		   if($this->islnDb(" tbl_asset_status "," asset_status_id= ".$asset_status_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_asset_status` SET `asset_id`=$asset_id, `date_checked`='$date_checked', `checked_by`=$checked_by, `remarks`='$remarks',state='state',acted_upon='$acted_upon',action_taken='$action_taken', acted_upon_by=$acted_upon_by, date_acted_on='$date_acted_on', sync_date='$sync_date', status=$status where asset_status_id=$asset_status_id") or die(mysqli_error($this->db));
				 return $asset_status_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_asset_status`( `asset_id`, `date_checked`, `checked_by`, `remarks`, `state`, `acted_upon`, `action_taken`, `acted_upon_by`, `date_acted_on`, `sync_date`, `status`) VALUES ($asset_id,'$date_checked', $checked_by,'$remarks',$state,'$acted_upon','$action_taken', $acted_upon_by, '$date_acted_on', '$sync_date', $status)") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  public function sync_new_outlet_sku($sku_id, $product_id, $dealer_id, $date_added,$added_by, $description, $status, $sync_date) {  $description=clear($description);
	  
		   if($this->islnDb(" tbl_outlet_skus "," sku_id= ".$sku_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_outlet_skus` SET product_id=$product_id, dealer_id=$dealer_id, date_added='$date_added',added_by=$added_by, description='$description', status=$status, sync_date='$sync_date' where sku_id=$sku_id") or die(mysqli_error($this->db));
				 return $sku_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_outlet_skus`( `product_id`, `dealer_id`, `date_added`, `added_by`, `description`, `status`, `sync_date`) VALUES ($product_id, $dealer_id, '$date_added',$added_by, '$description', $status, '$sync_date')") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  public function sync_new_photos($photo_id, $dealer_id, $photo_details, $image, $photo_taken_by, $route_id, $date_taken, $sync_status, $status) {  $photo_details=clear($photo_details); $image=clear($image); $photo_taken_by=clear($photo_taken_by); $date_taken=clear($date_taken);
		   if($this->islnDb(" tbl_photos "," photo_id= ".$photo_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_photos` SET dealer_id=$dealer_id, photo_details='$photo_details', image='$image', photo_taken_by=$photo_taken_by, route_id=$route_id, date_taken='$date_taken', sync_status=$sync_status, status=$status where photo_id=$photo_id") or die(mysqli_error($this->db));
				 return $prospecting_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_photos`( `dealer_id`, `photo_details`, `image`, `photo_taken_by`, `route_id`, `date_taken`, `sync_status`, `status`) VALUES ($dealer_id, '$photo_details', '$image', $photo_taken_by, $route_id, '$date_taken', $sync_status, $status)") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  public function sync_new_objective($objective_id, $details, $reviewed_objective, $dealer_id, $added_by, $date_added, $remarks, $status) { 
	   $details= clear($details); $reviewed_objective=clear($reviewed_objective);$date_added= clear($date_added); $remarks=clear($remarks);
	   
	  
	  
		   if($this->islnDb(" tbl_objectives "," objective_id= ".$objective_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_objectives` SET details='$details',reviewed_objective='$reviewed_objective', dealer_id=$dealer_id, added_by=$added_by, date_added='$date_added', remarks='$remarks', status=$status where objective_id=$objective_id") or die(mysqli_error($this->db));
				 return $objective_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_objectives`(`details`, `reviewed_objective`, `dealer_id`, `added_by`, `date_added`, `remarks`, `status`) VALUES ('$details', '$reviewed_objective', $dealer_id, $added_by, '$date_added', '$remarks', $status)") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
		//  mysqli_close($this->db);
    }
	///////////////////////////////////////////////
	public function sync_new_survey($objective_id, $details, $reviewed_objective, $dealer_id, $added_by, $date_added, $remarks, $status) {  
		   if($this->islnDb(" tbl_objectives "," objective_id= ".$objective_id)==1){
			     $update = mysqli_query($this->db,"UPDATE `tbl_objectives` SET details'$details',reviewed_objective='$reviewed_objective', dealer_id=$dealer_id, added_by=$added_by, date_added='$date_added', remarks='$remarks', status=$status where objective_id=$objective_id") or die(mysqli_error($this->db));
				 return $objective_id;
			   } else{     
	    $result = mysqli_query($this->db,"INSERT INTO `tbl_objectives`(`objective_id`, `details`, `reviewed_objective`, `dealer_id`, `added_by`, `date_added`, `remarks`, `status`) VALUES ($details, $reviewed_objective, $dealer_id, $added_by, $date_added, $remarks, $status)") or die(mysqli_error($this->db));
        return mysqli_insert_id($this->db);
		   }
    }
	

    /**
     * Get Yet to Sync row Count
     */
    public function getUnSyncPlans($user_id) {
				$date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*5);
        $result = mysqli_query($this->db,"SELECT * FROM `tbl_route_plan` WHERE `syncStatus`=0 and date(startdate)>'$date' and status=0 and `assigned_to`=$user_id");
        return $result;
    }
	    /**
     *checking availability of an item to avoid repeat
     */
    public function islnDb($table,$condtion) {
	$result = mysqli_query($this->db,"SELECT * FROM $table WHERE $condtion ")or die(mysqli_error($this->db));
       if(mysqli_num_rows($result)>=1)
	    return 1;
		else return 2;
		// mysqli_close($this->db);
    }
	   public function getItemId($table,$id,$condtion) {
	$result = mysqli_query($this->db,"SELECT $id FROM $table WHERE $condtion ")or die(mysqli_error($this->db));
       if(mysqli_num_rows($result)>0){ $row=mysqli_fetch_array($result);
	    return $row[$id];
		}
		
		else return false;
		// mysqli_close($this->db);
    }


    /**
     * Update Sync status of rows
     */
    public function updateDealersSyncSts($id, $sts){
		$date=strtotime(date("Y-m-d h:i:s"));
        $result = mysqli_query($this->db,"UPDATE `tbl_dealers` SET `syncStatus`=$sts,`dateTimeModified`=$date WHERE `dealer_id`=$id") or die(mysqli_error($this->db));
        return $result;
    }
	////////////////////////////////////////****************************************************************************************************** route plans sync status
	 public function updatePlansSyncSts($id, $sts){
		$date=strtotime(date("Y-m-d h:i:s"));
        $result = mysqli_query($this->db,"UPDATE `tbl_route_plan` SET `syncStatus`=$sts,`dTModified`=$date WHERE `id`=$id")or die(mysqli_error($this->db));;
        return $result;
    }
	///////////////////////////// convert numbers to intergegers
	
}////////////////////////////////////

	function formatStockNum($num)
{ if($num<0){ return 0;} else return $num;
	}
 
?>