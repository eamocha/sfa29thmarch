<?php 
date_default_timezone_set('Africa/Nairobi');
////////////////////////////////////////////////
$EMPTIES="(107,106,105)";
function log_details($tbl_affected,$previus_data,$id_of_affected,$colum_affected,$user_id,$description)
{	global $mysqli;
	$today_constant=date("Y-m-d H:i:s"); //get the date and time from php
	$log=mysqli_query($mysqli, "INSERT INTO `tbl_logs`( table_affected, date_time, `previous_data`, `column_affected`,`id_of_affected`, `user_id`, `description`) VALUES ($tbl_affected, '$today_constant','$previus_data',$id_of_affected,$colum_affected,$user_id,'$description')")or die(mysqli_error($mysqli));
	}
	////////////////////////////////////////////////////////////////////////////
function update_route_plan(){ global $mysqli; 
 $q1=mysqli_query($mysqli,"SELECT p.id as id, checkin_id, date(startdate) as dt FROM `tbl_route_plan` p join tbl_check_in c on p.dealer_id=c.dealer_id WHERE p.`dealer_id`=c.`dealer_id` and date(`startdate`)=date(`date_timein`) and c.route_plan_id=0")or die(mysqli_error($mysqli));
 while($row1=mysqli_fetch_array($q1)){
	 $id=$row1['id']; $checkin_id=$row1['checkin_id']; $date=$row1['dt'];
	  $up1=mysqli_query($mysqli,"UPDATE `tbl_route_plan` SET  `date_visted`='$date' ,stock_taken=1,`merchandized`=1,color='#006410', `visted`=1 WHERE id=$id")or die(mysqli_error($mysqli));
	  //update 2
	  	  $up2=mysqli_query($mysqli,"UPDATE `tbl_check_in` SET `route_plan_id`=$id WHERE `checkin_id`=$checkin_id")or die(mysqli_error($mysqli));
	  	  //update 3 for the stock taking
		  $up3=mysqli_query($mysqli,"UPDATE `tbl_stock_levels` SET `route_plan_id`=$id WHERE date(`date_added`)='$date'")or die(mysqli_error($mysqli));

	 }
 }
 function update_active()
 {
	 $q="SELECT t1.dealer_id,t2.dealer_id,sales_fmcg,sales_coke_products,t2.answer,t2.q_id,do_you_sell_any_bevs,stocked_coke_inthePast FROM tbl_dealers1 t1 INNER JOIN tbl_survey t2 ON t1.dealer_id = t2.dealer_id WHERE t2.answer>0 and t2.q_id=108 AND sales_fmcg='Yes'  AND t1.sales_coke_products='' and do_you_sell_any_bevs='yes' 
ORDER BY `t2`.`answer` ASC LIMIT 100";
//fisrt based in number of cases
$up1="UPDATE tbl_dealers t1 INNER JOIN tbl_survey t2 ON t1.dealer_id = t2.dealer_id SET t1.sales_coke_products = 'Yes'  WHERE t2.answer>0 and (t2.q_id=108 OR t2.q_id=109 OR t2.q_id=110 OR t2.q_id=111 OR t2.q_id=112 OR t2.q_id=113 OR t2.q_id=114 OR t2.q_id=115 OR t2.q_id=116 OR t2.q_id=117 OR t2.q_id=118 OR t2.q_id=119 OR t2.q_id=120 OR t2.q_id=121 ) AND sales_fmcg='Yes'  AND t1.sales_coke_products='' and do_you_sell_any_bevs='yes' ";
/////
$up2="UPDATE tbl_dealers t1 INNER JOIN tbl_survey t2 ON t1.dealer_id = t2.dealer_id SET t1.sales_coke_products = 'Yes'  WHERE (t2.answer=423 or t2.answer=424 or t2.answer=425 or t2.answer=426) and t2.q_id=135 AND sales_fmcg='Yes'  AND t1.sales_coke_products='' and do_you_sell_any_bevs='yes' ";

$up3="UPDATE tbl_dealers t1 INNER JOIN tbl_survey t2 ON t1.dealer_id = t2.dealer_id SET t1.sales_coke_products = 'Yes'  WHERE (t2.answer=429 or t2.answer=430 or t2.answer=431 or t2.answer=432 or t2.answer=433) and t2.q_id=137 AND sales_fmcg='Yes'  AND t1.sales_coke_products='' and do_you_sell_any_bevs='yes' ";

$up4="UPDATE tbl_dealers t1 INNER JOIN tbl_survey t2 ON t1.dealer_id = t2.dealer_id SET t1.sales_coke_products = 'Yes'  WHERE (t2.answer=178 or t2.answer=179 or t2.answer=180 or t2.answer=181 or t2.answer=496 or t2.answer=497 or t2.answer=498 or t2.answer=545) and t2.q_id=97 AND sales_fmcg='Yes'  AND t1.sales_coke_products='' and do_you_sell_any_bevs='yes' ";
////update from another table
//UPDATE tbl_dealers a INNER JOIN tbl_dealers_march21st2017 b on a.dealer_id=b.dealer_id SET a.sales_coke_products=b.sales_coke_products WHERE a.region_id=2

////UPDATE tbl_dealers a INNER JOIN tbl_dealers5am2ndapril b on a.dealer_id=b.dealer_id SET a.stocked_coke_inthePast=b.stocked_coke_inthePast WHERE a.stocked_coke_inthePast='N/A' and b.stocked_coke_inthePast IS NOT NULL
////No
$up41="UPDATE tbl_dealers t1 INNER JOIN tbl_survey t2 ON t1.dealer_id = t2.dealer_id SET t1.sales_coke_products = 'No'  WHERE (t2.answer=178 or t2.answer=179 or t2.answer=180 or t2.answer=181 or t2.answer=496 or t2.answer=497 or t2.answer=498 or t2.answer=545) and t2.q_id=97 AND sales_fmcg='Yes'  AND t1.sales_coke_products='' and do_you_sell_any_bevs='yes' ";
	 }
  function update_orders_done(){ global $mysqli; 
 $q1=mysqli_query($mysqli,"SELECT p.id as id FROM `tbl_route_plan` p join tbl_orders c on p.dealer_id=c.dealer_id WHERE p.`dealer_id`=c.`dealer_id` and date(`startdate`)=date(`date_made`)  ")or die(mysqli_error($mysqli));
 while($row1=mysqli_fetch_array($q1)){
	 $id=$row1['id']; 
	  $up1=mysqli_query($mysqli,"UPDATE `tbl_route_plan` SET  order_done=1 WHERE id=$id")or die(mysqli_error($mysqli));
	 
	 }
 }
 
 ////////////////////
 function update_dealers(){ global $mysqli; 
 $q1=mysqli_query($mysqli,"SELECT added_by FROM tbl_dealers WHERE cluster_id=0 ")or die(mysqli_error($mysqli));
 while($row1=mysqli_fetch_array($q1)){
	 $id=$row1['added_by']; 
	 $cluster=getColumnName('tbl_users','cluster_id', 'user_id='.$id);
	 if($cluster>0)
	  $up1=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET cluster_id=$cluster WHERE added_by=$id")or die(mysqli_error($mysqli));
	 
	 }
 }
  function update_dealer_sub_areas(){ global $mysqli; 
  //UPDATE tbl_dealers SET tbl_dealers.cluster_id = ( SELECT tbl_routes.cluster_id FROM tbl_routes WHERE tbl_routes.route_id = tbl_dealers.route_id )
 $q1=mysqli_query($mysqli,"SELECT route_id FROM tbl_dealers WHERE cluster_id=0 ")or die(mysqli_error($mysqli));
 while($row1=mysqli_fetch_array($q1)){
	 $id=$row1['route_id']; 
	 $cluster=getColumnName('tbl_routes','cluster_id', 'route_id='.$id);
	 if($cluster>0)
	  $up1=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET cluster_id=$cluster WHERE route_id=$id and cluster_id=0")or die(mysqli_error($mysqli));
	 
	 }
 }
function  general_update_function($table,$columns,$condiition){
	global $mysqli;
	$q=mysqli_query($mysqli,"UPDATE $table SET $columns WHERE $condiition")or die(mysqli_error($mysqli));
	}
 /////////////////////////////////////
function  titleCase1($string)  { 
        $len=strlen($string); 
        $i=0; 
        $last= ""; 
        $new= ""; 
        $string=strtoupper($string); 
        while  ($i<$len): 
                $char=substr($string,$i,1); 
                if  (preg_match( "[A-Z]",$last)): 
                        $new.=strtolower($char); 
                else: 
                        $new.=strtoupper($char); 
                endif; 
                $last=$char; 
                $i++; 
        endwhile; 
        return($new); 
}; 


//Function to sanitize values to numeric only

function strip_no($string)

{
     // This regex pattern means anything that is not a number
     $pattern = '/[^0-9]/';
     // preg_replace searches for the pattern in the string and replaces all instances with an empty string
     return preg_replace($pattern, '', $string);
}

function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date         = strtotime($date);
    
       // check validity of date
    if(empty($unix_date)) {    
        return "Invalid date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}
// Generate LOG ID
function genRandomString() {
    $length = 26;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = "";    

    for ($p = 1; $p < $length; $p++) {
        $string .=$characters[mt_rand(0, strlen($characters))-1];
    }

    return $string;
	}
	    // Returns only the file extension (without the period).
    function file_ext($filename) {
        if( !preg_match('/./', $filename) ) return '';
        return preg_replace('/^.*./', '', $filename);
    }
    // Returns the file name, less the extension.
    function file_ext_strip($filename){
        return preg_replace('/.[^.]*$/', '', $filename);
    }
	function genRandomString_small() {
    $length = 6;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))-1];
    }

    return $string;
	}
	
 function reduce_str($text, $size)
 {
  
 $length = strlen($text);
  
 if($length>$size)
  {
 $length_fin = substr($text, 0, $size);
  
  $text = $length_fin."..."; 
  
 }
// 3  $string = "This is a sentence that is fairly long"; 
//4  reduce_str($string, 20);
  return($text);
 
 }
 //php extension and file aname
 function chopExtension($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return preg_replace('/\.' . preg_quote($ext, '/') . '$/', '', $filename);
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
 // divide array
 

    function array_divide($array, $segmentCount) {
        $dataCount = count($array);
        if ($dataCount == 0) return false;
        $segmentLimit = ceil($dataCount / $segmentCount);
        $outputArray = array_chunk($array, $segmentLimit);
     
        return $outputArray;
    }
//get days in a specific month
 function daysInMonth($year, $month)
{
return date("t", strtotime($year . "-" . $month . "-01"));
}
function month_holidays_todate() {
		///$daysinMonth=daysInMonth(date("Y"), date("m"));//days in a month 
		$from=date("01-m-Y");  $to=date("d-m-Y");
	
    $workingDays = array(7); # date format = N (1 = Monday, ...)
    $holidayDays = array('1-12-25', '2-01-01', '2013-12-23'); # variable and fixed holidays
    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);
    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}
function month_work_days_todate(){
	$all_days=date("d")-month_holidays_todate();
		}
////////////////
function getSundaysInMonth($y,$m){ 
    $date = "$y-$m-01";
    $first_day = date('N',strtotime($date));
    $first_day = 7 - $first_day + 1;
    $last_day =  date('t',strtotime($date));
    $days = array();
    for($i=$first_day; $i<=$last_day; $i=$i+7 ){
        $days[] = $i;
    }
    return  $days;
}

//week number

function db_error($query,$mysql_errno,$mysql_error)
{
   $info=debug_backtrace();
   //This return array containing file name, line number function name etc
   //your rest code to display errors
}
function goback()
{
	$refer= $_SERVER['HTTP_REFERER'];
    header("Location:$refer");
  
}
 //fetching the naame of user when given the id
 	function get_name($user_id){
		global $mysqli;
		if($user_id==0 or $user_id==''){ return "No name"; } else{
		 $res = mysqli_query($mysqli,"SELECT user_id,full_name FROM tbl_users WHERE user_id=".$user_id) or die(mysqli_error($mysqli)) ;
		 if(mysqli_num_rows($res)==0){ return "No name";} else{
 $row = mysqli_fetch_array($res);
   return '<a href="user_profile.php?user_id='.$user_id.'">'.$row['full_name'].'</a>';}}
   }///////
   	function get_competitor($id){
		global $mysqli;
		if($id==0 or $id==''){ return "No name"; } else{
		 $res = mysqli_query($mysqli,"SELECT com_id,com_name FROM tbl_competitors WHERE com_id=".$id) or die(mysqli_error($mysqli)) ;
		 if(mysqli_num_rows($res)==0){ return "No name";} else{
 $row = mysqli_fetch_array($res);
   return "<a href='competitor_profile.php?com_id=".$row['com_id']."'>".$row['com_name']."</a>";}}
   }
   function get_asset_name($id){
		global $mysqli;
		
		 $res = mysqli_query($mysqli,"SELECT `asset_id`, `asset_size`, `asset_number`, `model`, `name`, `code`, `code_format`, `serial`, `date_isued`, `reg_by`, `dealer_id`, `sync_status`, `sync_date`, `remarks`, `asset_condition`, `last_visited`, `verification_status`, `status` FROM `tbl_assets` WHERE asset_id=$id") or die(mysqli_error($mysqli)) ;
		 if(mysqli_num_rows($res)==0){ return "No name";} else{
 $row = mysqli_fetch_array($res);
   return "<a href='asset_profile.php?id=".$id."'>".$row['name']."</a>";}
   }
   	function get_role($role_id){
		global $mysqli;
		$res = mysqli_query($mysqli,"SELECT role_name FROM tbl_roles WHERE role_id=".$role_id) or die(mysqli_error($mysqli)) ;
		 if(mysqli_num_rows($res)==0){ return "No role";} else{
 $row = mysqli_fetch_array($res);
   return $row['role_name'];}
		
   }
   function get_area($id){
		global $mysqli;
		$res = mysqli_query($mysqli,"SELECT area_id,area_name FROM tbl_areas WHERE area_id=".$id) or die(mysqli_error($mysqli)) ;
		 if(mysqli_num_rows($res)==0){ return "No role";} else{
 $row = mysqli_fetch_array($res);
 $area_id=$row['area_id'];
   return "<a href='area_profile.php?area_id=$area_id'>".$row['area_name']."</a>";}
		
   }//////////////
    function get_route_linked($rid){ global $mysqli;
	   	if($rid==0 or $rid==''){ echo "<b>Name unavailable</b>"; } else{
	 $res = mysqli_query($mysqli,"SELECT route_name,route_id FROM `tbl_routes` left JOIN tbl_users on user_id=route_assigned_to WHERE `route_id`=$rid") or die(mysqli_error($mysqli)) ;
 $row = mysqli_fetch_array($res);
   return "<a href=route_profile.php?route_id=$rid>".$row['route_name'].'</a>';
   }}
   //////////////////
    	function get_client($c_id){ global $mysqli;
			if($c_id==0 or $c_id==''){ echo "Name unavailable"; } else{
		 $res = mysqli_query($mysqli,"SELECT business_name,dealer_id FROM `tbl_dealers` WHERE `dealer_id`=$c_id") or die(mysqli_error($mysqli)) ;
 $row = mysqli_fetch_array($res);
   return "<b >". $row['business_name'].'</b>';
   }
   }
   //get the name of the trip
 function get_route($rid){ global $mysqli;
	   	if($rid==0 or $rid==''){
			return "<b>Name unavailable</b>"; } else{
	 $res = mysqli_query($mysqli,"SELECT route_id,route_name FROM `tbl_routes` left JOIN tbl_users on user_id=route_assigned_to WHERE `route_id`=$rid") or die(mysqli_error($mysqli)) ;
 $row = mysqli_fetch_array($res);
   return "<a href=route_profile.php?route_id=$rid>".$row['route_name'].'</a>';
   }}
   ///////////////////////
   
 function dealer_route ($did){ global $mysqli;
	 
	   	if($did==0 or $did==''){ return "<b>Not in Route</b>"; } else{
	 $res = mysqli_query($mysqli,"SELECT route_name FROM tbl_dealers d RIGHT JOIN `tbl_routes` r on d.route_id=r.route_id  WHERE d.`dealer_id`=$did") or die(mysqli_error($mysqli)) ;
 $row = mysqli_fetch_array($res);
   return "<b>".$row['route_name'].'</b>';
   }}
function route_crates($rid)
  { global $mysqli;
	  $q=mysqli_query($mysqli,"SELECT sum(`cases`) as crates FROM `tbl_orders` o left join tbl_orders_details od on o.order_id=od.dealer_id WHERE route_id=$rid");
	 $i=mysqli_fetch_array($q);
	 return $i['crates'];	
}
  
  function order_crates ($did){ global $mysqli;
	   $q=mysqli_query($mysqli,"SELECT sum(cases) as crates,o.date_made as dm FROM `tbl_orders` o left join tbl_orders_details od on o.order_id=od.dealer_id WHERE o.`dealer_id`=$did group by DATE(dm)") or die( mysqli_error($mysqli));
	 $i=mysqli_fetch_array($q);
	 return $i['crates'].' Crates of Drinks on '.$i['dm'];
	  }
	  
function kinds_of_crates($did,$pid){ global $mysqli;
	if($pid==0|| $pid==''||$did==0||$did==''){ echo 'Not specified';} else{
	   $q=mysqli_query($mysqli,"SELECT sum(cases) as crates, product FROM `tbl_orders` o left join tbl_orders_details od on o.order_id=od.dealer_id LEFT JOIN tbl_products p on p.product_id=od.product_id WHERE o.`dealer_id`=$did and od.product_id=$pid ") or die(mysqli_error($mysqli));
	 $i=mysqli_fetch_array($q);
	 return $i['crates'].' Crates of '.$i['product'];}
	  }
 function price_calc($oid){ global $mysqli;
	  $total=0;
	   $q=mysqli_query($mysqli,"SELECT  o.`cases` as qty,cases, p.s_price as pr,o.`made_by` as mby, o.`date_added` as da, o.`order_id` as oid, o.`dealer_id` as did, o.`date_supplied` as sd, o.`supplied_by` as sby FROM `tbl_orders_details` o LEFT JOIN tbl_products p on p.product_id=o.product_id WHERE `order_id`=$oid") or die(mysqli_error($mysqli));
	 while($i=mysqli_fetch_array($q)){ 
	 $preorder=$i['qty']-$i['cases'];
	  $total+=$preorder*$i['pr'];
	 }
	 return $total;
	 
	  }
function  business_name($did){global $mysqli;
	if($did==0) return 'unaivaible'; else{
		$q=mysqli_query($mysqli,"SELECT `business_name`,dealer_id FROM `tbl_dealers` WHERE `dealer_id`=$did LIMIT 1") or die(mysqli_error($mysqli));
		$r=mysqli_fetch_array($q);
		$id=$r['dealer_id'];
		return '<a href="client_details.php?dealer_id='.$id.'" > <b >'.$r['business_name'].'</b></a>';
		  }}
		  //outlet place Name
		  function outlet_position($id){ global $mysqli;
			  $q=mysqli_query($mysqli,"SELECT longtitute,latitute FROM `tbl_dealers` WHERE `dealer_id`=$id LIMIT 1") or die(mysqli_error($mysqli));
		$r=mysqli_fetch_array($q);
		$lat=$r['latitute'];
			 $long=$r['longtitute']; return d( Get_Address_From_Google_Maps($lat, $long));
			  }
			  
			  //////////////////////
			  function outlet_coords($id,$colm){ global $mysqli;
			$q=mysqli_query($mysqli,"SELECT $colm FROM `tbl_dealers` WHERE `dealer_id`=$id LIMIT 1") or die(mysqli_error($mysqli));if($r=mysqli_num_rows($q)>0){
		$r=mysqli_fetch_array($q);
	 	  return $r[$colm];
			  } else return "0";
			  }
		  //get name of product given the id of the product
function product_name($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT `product` FROM `tbl_products` WHERE `product_id`=$id LIMIT 1") or die(mysqli_error($mysqli));
		$r=mysqli_fetch_array($q);
		
		return '<a href="product_details.php?product_id='.$id.'">'.$r['product'].'</a>';
		  }

	function order_details($order_id){ global $mysqli;
		$q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders_details` o LEFT JOIN tbl_products p on p.product_id=o.product_id WHERE `order_id`=$order_id and o.status !=3") or die(mysqli_error($mysqli));
		if(mysqli_num_rows($q)==0) echo 'No products';
		while($r=mysqli_fetch_array($q)){
			$req=$r['cases']; 
			$sup=$r['cases']; 
			$qty=$req-$sup; if($qty==0){} else{
			$ms=' cases of '; if($qty==1) $ms=' case of '; 
		echo  $qty.$ms.$r['product'].'('.$r['product_code']. ' ' .$r['brand'].'), ';}
		}
		}
		function edit_product($pid){
			 global $mysqli;
			 $uid=$_SESSION['u_id'];
			 $description=	$_REQUEST['description'];
$flavour	=$_REQUEST['flavour'];

$pack_size=$_REQUEST['pack_size']	;
$pack_type	=$_REQUEST['pack_type'];
$product	=$_REQUEST['product'];
$s_price	=$_REQUEST['s_price'];
$sku_type	=$_REQUEST['sku_type'];
$variant	=$_REQUEST['variant'];
$units_in_case	=$_REQUEST['units_in_a_case'];
		$q=mysqli_query($mysqli,"UPDATE `tbl_products` SET `product`='$product',`variant`='$variant', `flavour`='$flavour',`pack_size`='$pack_size',`pack_type`='$pack_type',`sku_type`='$sku_type',`units_in_a_case`=$units_in_case,`s_price`=$s_price,`product_desc`='$description',`date_modified`=Now(),`modified_by`=$uid WHERE product_id=$pid") or die(mysqli_error($mysqli));
		
		header("location:all_stock_details.php");
		
		
		}
function is_order_available($order_name)
		{
			global $mysqli;
			$q=mysqli_query($mysqli,"SELECT * FROM tbl_orders WHERE order_name='".$order_name."'") or die('Error checking availability of order'); 
		if(mysqli_num_rows($q)){
			return true;
			}	
			}
function mode_of_payment($i){
 switch ($i){
	 case 1:
	 echo 'Cash';
	 break;
	 case 2:
	 echo 'Cheque';
	 break;
	 case 3:
	 echo 'Mpesa';
	 break;
	 case 4:
	 echo 'Credit Card';
	 break;
	 
	 }
}
//dealer's total payments
function dealer_total_payments ($did){global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT sum(`amount`) as tt FROM `tbl_payments` WHERE `dealer_id`=$did");
 $res=mysqli_fetch_array($d_q);
 return $tt=$res['tt'];
}
function dealer_total_paymentsInAday($date,$did){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT sum(`amount`) as tt FROM `tbl_payments` WHERE `dealer_id`=$did and Date(date_time_made)='$date'");
 $res=mysqli_fetch_array($d_q);
 return $res['tt'];
}
function user_paymentsInAday($date,$uid){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT sum(`amount`) as tt FROM `tbl_payments` WHERE `received_by`=$uid and Date(date_time_made)='$date'");
 $res=mysqli_fetch_array($d_q);
 return $res['tt'];
}
function dealer_total_confirmed ($did){global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT sum(`amount`) as tt FROM `tbl_payments` WHERE `dealer_id`=$did and status=0");
 $res=mysqli_fetch_array($d_q);
 return $tt=$res['tt'];
}
function routes()
{ 
$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" status=0 ";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
	}
		
		global $mysqli; $routes=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE $where ")or die(mysqli_error($mysqli)); while($row=mysqli_fetch_array($routes)){?><option value="<?php echo $row['route_id']?>"><?php echo $row['route_name']?></option>
<?php }}
//end of the routes funstion

//get vehicle
function get_vehicle($vid){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_vehicles` WHERE `v_id`=$vid and status=0");
 $res=mysqli_fetch_array($d_q);
 return $res['reg_no'];
}
//get vehicle
function assigned_vehicle($user_id){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_vehicles` WHERE `added_by`=$user_id and status=0");
 if(mysqli_num_rows($d_q)==0){ return 'Unassigned';} else{
 $res=mysqli_fetch_array($d_q);
 return $res['reg_no'];}
}
	//all dealers in route		
function all_dealers_in_route($user_id,$date){ global $mysqli;
 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id and DATE(`startdate`)='$date'")or die(mysqli_error($mysqli)); return mysqli_num_rows($q);
}
function already_visted($user_id,$date){ global $mysqli;
 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id and DATE(`startdate`)='$date' and visted=1")or die(mysqli_error($mysqli)); $num=mysqli_num_rows($q);  if($num==0) return 0; else return '<a href="already_v.php">'.$num.'</a>';
}
function cancelled_route($user_id,$date){ global $mysqli;
 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id and DATE(`startdate`)='$date' and status=1")or die(mysqli_error($mysqli));  $num=mysqli_num_rows($q);  if($num==0) return 'none'; else return '<a href="cancelled.php">'.$num.'</a>';
}
//function to check whether there was a visit to an outlet
function check_visit($plan_id){ global $mysqli;
	$d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE id=$plan_id and visted=1 LIMIT 1") or die (mysqli_error($mysqli));
	if(mysqli_num_rows($d_q)==0){ return $visit_id=0;} 
 else{ 
 $tt=mysqli_fetch_array($d_q);
return $visit_id=$tt['id'];
}
}
 
function check_merchandized($plan_id,$dealer_id){ global $mysqli;
$d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE stock_taken=1 and id=$plan_id limit 1") or mysqli_error($mysqli);
$r=mysqli_fetch_array($d_q);
 if(mysqli_num_rows($d_q)==1) 
 return '<a class="btn btn-success btn-sm" href="mechandize.php?plan_id='.$plan_id.'&dealer_id='.$dealer_id.'">Merchandize>></a>'; 
 else if($r['merchandize']==1){

return '<a href="visit_report.php?plan_id='.$plan_id.'&dealer_id='.$dealer_id.'">Report</a>'; }
}

// fetch days' dealers
function today_dealers($user_id,$date){
	global $mysqli;
 $i=1; $rp_id=0;
$today=date("Y-m-d",strtotime($date));
  $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` rp LEFT JOIN tbl_dealers d on d.dealer_id=rp.dealer_id WHERE `assigned_to`=$user_id and DATE(`startdate`)='$today' and rp.status=0 and d.status=0")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ echo '<tr><td colspan=7>No assigned outlets today. Good day!</td><tr>';} else {
							while($r=mysqli_fetch_array($q)){ 
							$dealer_id=$r['dealer_id']; $rp_id=$r['id'];					  
							?>
                            <tr>
                                  <td><?php echo $i;?></td>
                                  <td ><?php echo business_name($dealer_id)?></td>
                                  <td><?php echo $r['town'];?></td>
                                  <td><?php echo $r['owner_name'].' '. $r['phone']?></td>
                                  
                                  <td><?php echo previus_visit_notes($dealer_id)?></td>
                                   <td ><?php visit_progress($dealer_id,$rp_id)?></td>
                              </tr><?php $i++; }} //end else and while
							  }
function previus_visit_notes ($did){global $mysqli;
	$message=""; //and date(date_timein)!='$today'
	$merc_q=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` WHERE `dealer_id`=$did order by checkin_id  desc limit 1") or die(mysqli_error($mysqli));$m_row= mysqli_fetch_array($merc_q); $message.=$m_row['description'];
	//getc orders and preorders
	
	return $message;
	}
	//ast vist date
	function last_visit_date ($did){global $mysqli;
	$lastV=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `dealer_id`=$did and visted=1 order by id  desc limit 1") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($lastV)==0){ return "Never";} else {
		$m_row= mysqli_fetch_array($lastV); $date=$m_row['date_visted'];
	
	return $date;}
	}
	////////////next visit
	function next_visit_date($did,$today){ global $mysqli;
	$lastV=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `dealer_id`=$did and date(date_visted)>'$today' order by id  desc limit 1") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($lastV)==0){ return "N/A";} else {
		$m_row= mysqli_fetch_array($lastV); $date=$m_row['startdate'];
	
	return $date;}
	}
	//////////////////
 function check_visit_status($did,$date){ global $mysqli;
	 $lastV=mysqli_query($mysqli,"SELECT visted  FROM `tbl_route_plan` WHERE `dealer_id`=$did and date(startdate)='$date' and status=0 order by id  desc limit 1") or die(mysqli_error($mysqli));
	 if(mysqli_num_rows($lastV)==0){ return survey_history(0);} else{
	 $r=mysqli_fetch_array($lastV);
	 return survey_history($r["visted"]);
	 }
	 
	 }
function visits_per_outlet_per_month($outlet,$date){ global $mysqli;
	 $lastV=mysqli_query($mysqli,"SELECT visted  FROM `tbl_route_plan` WHERE `dealer_id`=$did and date(startdate)='$date' and status=0 order by id  desc limit 1") or die(mysqli_error($mysqli));
	 if(mysqli_num_rows($lastV)==0){ return survey_history(0);} else{
	 $r=mysqli_fetch_array($lastV);
	 return survey_history($r["visted"]);
	 }
	}
							  //end
function visit_progress($dealer_id,$rp_id){ global $mysqli;
	 $q=mysqli_query($mysqli,"SELECT `stock_taken`,merchandized,order_done FROM `tbl_route_plan` WHERE `id`=$rp_id limit 1")or die(mysqli_error($mysqli));
	 $stock=mysqli_fetch_array($q);
	 if($stock["stock_taken"]==0){  echo '<a href="take_stock.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Take Stock</a>'; } else {
		 //check mechndizing
		 
		  if($stock["stock_taken"]==1 && $stock["merchandized"]==0){
		echo '<a href="take_stock.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Stock</a>|<a href="mechandize.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Merchandize</a>';}
		else if($stock["merchandized"]==1){
			echo '<a href="take_stock.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Stock</a>|<a href="mechandize.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Merchandize</a>|<a href="create_order.php?dealer_id= '.$dealer_id.' &plan_id='.$rp_id.'">Make order</a>|<a href="visit_report.php?dealer_id='.$dealer_id .'&plan_id='.$rp_id.'">Report</a>';} }
	
	}
							  
function stock($did,$package,$pid,$date){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT cases,singles FROM `tbl_stock_levels` WHERE `dealer_id`=$did and DATE(`date_added`)='$date'and product_id=$pid ");
 if(mysqli_num_rows($d_q)==0) return '-';;
$tt=mysqli_fetch_array($d_q);
if($package=='cases')  return $tt['cases']; else return $tt['singles'];
}
function stock_taking_report($did,$package,$pid,$plan_id){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did and route_plan_id=$plan_id and product_id=$pid ");
 if(mysqli_num_rows($d_q)==0) return '-';;
$tt=mysqli_fetch_array($d_q);
if($package=='cases')  return $tt['cases']; else return $tt['singles'];
}
function stock_take_per_outlet($did,$date){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT sum(cases) as cases, sum(singles) as pcs FROM `tbl_stock_levels` WHERE `dealer_id`=$did and date(date_added)='$date' ");
$tt=mysqli_fetch_array($d_q);
  return number_format($tt['cases']+ $tt['pcs']/24,1);
}
	
//function to show case the number of products by a tsr in a certain day
function stock_individual($did,$package,$pid,$date,$uid){ global $mysqli;
 $d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did and DATE(`date_added`)='$date'and product_id=$pid and user_id=$uid");
 if(mysqli_num_rows($d_q)==0) return '-';;
$tt=mysqli_fetch_array($d_q);
if($package=='cases')  return $tt['cases']; else return $tt['singles'];
}
function survey($did,$col,$date){ global $mysqli;
	 $d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` WHERE date(`date_timein`)='$date' AND `dealer_id`=$did ");
 if(mysqli_num_rows($d_q)==0) return '-';
$tt=mysqli_fetch_array($d_q);
if($col=="description") echo $tt['description']; else{
if($tt[$col]==1)echo '<i class=" fa fa-check"></i>'; else  echo '<i class=" fa fa-times"></i>';}
}
function survey_history($col){
if($col==1){return '&#10003;';} else  return '<span style="color:red">&times;</span>';
}
function survey_percentage($r){
	$count_p=0;$count_n=0;
if($r==1) $count_p++; else  echo $count_n++;
return $count_p*100/($count_n+$count_p);
}
//routes completion
function expected_outlets_to_visit($uid,$date ){
	global $mysqli;
	 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$uid and DATE(`startdate`)='$date' and status=0")or die(mysqli_error($mysqli));
	return mysqli_num_rows($q);
}
function first_day_of_week($date){
	$day_given=date("D",strtotime($date));
	$sunday=$date;
	switch($day_given)
	{
	case 'Mon':
	$sunday=date("Y-m-d",strtotime($date)-86400);
	break;
	case 'Tue':
	$sunday=date("Y-m-d",strtotime($date)-86400*2);
	break;
	case 'Wed':
	$sunday=date("Y-m-d",strtotime($date)-86400*3);
	break;
	case 'Thu':
	$sunday=date("Y-m-d",strtotime($date)-86400*4);
	break;
	case 'Fri':
	$sunday=date("Y-m-d",strtotime($date)-86400*5);
	break;
	case 'Sat':
	$sunday=date("Y-m-d",strtotime($date)-86400*6);
	break;
	case 'Sun':
	$sunday=date("Y-m-d",strtotime($date)-86400*7);
	break;
	default: $sunday;
	
		}
		return $sunday;
	}
function actual_day_visits($uid,$date ){ global $mysqli;
	 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE date(`date_visted`)='$date' and status=0 and `visted`=1 and `assigned_to`=$uid")or die(mysqli_error($mysqli));
	return mysqli_num_rows($q);
	}
	
function visted_outlets($user_id,$d_w_started,$date1 ){
	global $mysqli;
	//start of week/sunday
	$d_w_started=first_day_of_week($d_w_started);// getting the date of the previus sunday. in form of Y-m-d
	$add=0;
	if($date1=='mon') $add=86400; else if($date1=='tue') $add=86400*2;else if($date1=='wed') $add=86400*3;else if($date1=='thur') $add=86400*4;else if($date1=='fri') $add=86400*5;else if($date1=='sat') $add=86400*6;else if($date1=='sun') $add=86400*7;
	$specific_day=date('Y-m-d',strtotime($d_w_started)+$add);
//get visit details
 $q=mysqli_query($mysqli,"SELECT distinct(dealer_id) as did FROM `tbl_stock_levels` WHERE DATE(date_added)='$specific_day' and `user_id`=$user_id")or die(mysqli_error($mysqli));
	return mysqli_num_rows($q);
}
//workbook
function find_week_dates($date,$week,$col){
	$year=date("Y",strtotime($date)); $month=date("M",strtotime($date));
	$days=daysInMonth($year,$month);
	$w1=date('Y-m-1',strtotime($date)); //get wek 1(1 to 7)
	$w2=date("Y-m-d",strtotime($w1)+86400*6);//get week 2(7 to 14)
	$w3=date("Y-m-d",strtotime($w2)+86400*7);//get week 3 (14 to 21)
	$w4=date("Y-m-d",strtotime($w3)+86400*7);//get week 4((21 to 28))
	$w5=date("Y-m-d",strtotime($w4)+(86400*7));//get week 5
	$days_remaining=$days-28; //strtotime($w4);
	$last_day=date("Y-m-$days",strtotime($date));
	 $between=0;

	//check week number and select from db
	if($week==1){$between="date($col)>'$w1' and date($col)<'$w2'";} else if($week==2){$between="date($col)>'$w2' and date($col)<'$w3'";}else if($week==3){$between="date($col)>'$w3' and date($col)<'$w4'";}else if($week==4){$between="date($col)>'$w4' and date($col)<'$w5'";} else if($week==5){$between="date($col)>'$w5' and date($col)<'$last_day'";}
	return $between;
	}
function weekly_plan($date,$week,$tsr){ global $mysqli; 
$between=find_week_dates($date,$week,'date_visted');
$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_route_plan` WHERE status=0 and $between and assigned_to=$tsr ")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return 0; else return $c;
	}
	//planned in a week
	function weekly_route_completion($date,$week,$tsr){  global $mysqli;
	 $between=find_week_dates($date,$week,'date_visted');
$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_route_plan` WHERE status=0 and visted=1 and $between and assigned_to=$tsr ")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return 0; else return $c;
	}
	function percent_weekly($date,$week,$tsr){
		if(weekly_plan($date,$week,$tsr)==0) return 0; else{
		return number_format( weekly_route_completion($date,$week,$tsr)/12*100,1).'%';}
		}
	function percentage_conversion($nominator,$denominator){
		if($denominator<=0) return 0;
		 else{
		return number_format( $nominator/$denominator*100).'%';
		}
		}
		//////
		function percentage_conversion_with_decimals($nominator,$denominator,$decimals){
		if($denominator<=0) return $denominator=1;
		 else{
		return number_format( $nominator/$denominator*100,$decimals);
		}
		}
	//total regional weekly plan
	function region_weekly($date,$week,$region){  global $mysqli;
	 $between=find_week_dates($date,$week,'date_visted');
	
$q=mysqli_query($mysqli,"SELECT count(id) as tt FROM `tbl_route_plan` p right join tbl_users u on u.user_id=p.assigned_to WHERE region_id=$region and p.status=0  and u.status=0 and $between and visted=1")or die(mysqli_error($mysqli));
$r_visted=mysqli_fetch_array($q);
	$c= $r_visted['tt'];
	
	 //get the unvisted
	 $planned_q=mysqli_query($mysqli,"SELECT count(id) as tt FROM `tbl_route_plan` p right join tbl_users u on u.user_id=p.assigned_to WHERE region_id=$region and p.status=0  and u.status=0 and $between ")or die(mysqli_error($mysqli));
$plan_row=mysqli_fetch_array($planned_q);
	$plans= $plan_row['tt'];
	if($plans==0)return 0; else{return number_format($c/66,3)*100 .'%';;
	}
	
	}
function weekly_strike_rate($date,$week,$tsr){ global $mysqli;
	$between =find_week_dates($date,$week,'date_made');
	
$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_orders` WHERE $between and `preordered_by`=$tsr and status!=3 group by order_id")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return 0; else return $c;
	}//%age weekly strike rate
	
	function day_outlet_sales($outlet, $date){
	global $mysqli;
$q=mysqli_query($mysqli,"SELECT COALESCE(SUM(cases), 0) as tt FROM `tbl_orders_details` WHERE DATE(date_added)='$date' and dealer_id=$outlet and status=0 ")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
	$c=$r['tt'];
	 if($c==0) return "-"; else return $c;
	}
	/////////////////
	function day_user_sales($user, $date){
	global $mysqli;
$q=mysqli_query($mysqli,"SELECT COALESCE(SUM(cases), 0) as tt FROM `tbl_orders_details` WHERE DATE(date_added)='$date' and made_by=$user and status=0 ")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
	$c=$r['tt'];
	 if($c==0) return "-"; else return $c;
	}//%age weekly strike rate
	
	function percentage_weekly_strike_rate($date,$week,$tsr){
		if(weekly_route_completion($date,$week,$tsr)==0) return 0; else{ return number_format(weekly_strike_rate($date,$week,$tsr)/weekly_route_completion($date,$week,$tsr),3)*100 .'%';}
		}

	//strike rate regional per week
	function regional_strike_rate_weekly($date,$week,$region){ global $mysqli;
	$between =find_week_dates($date,$week,'date_visted');
	//get the outlets visited that week
	$q=mysqli_query($mysqli,"SELECT count(id) as tt FROM `tbl_route_plan` p right join tbl_users u on u.user_id=p.assigned_to WHERE region_id=$region and p.status=0  and u.status=0 and $between and visted=1")or die(mysqli_error($mysqli));
$r_visted=mysqli_fetch_array($q);
$visited= $r_visted['tt'];

	$between =find_week_dates($date,$week,'date_made');
$q=mysqli_query($mysqli,"SELECT count(o.order_id) as tt FROM `tbl_orders` o right join tbl_dealers d on d.dealer_id=o.dealer_id WHERE $between  and o.status!=3 and region_id=$region")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($visited==0) return 0; else return number_format($c/$visited,3)*100 ."%";
	}
	
function debugResults($var, $strict = false) {
	if ($var != NULL) {
		if ($strict == false) {

			if( is_array($var) ||  is_object($var) ) {
				echo "<pre>";print_r($var);echo "</pre>";
			} else {
				echo $var;
			}

		} else {

			if( is_array($var) ||  is_object($var) ) {
				echo "<pre>";var_dump($var);echo "</pre>";
			} else {
				var_dump($var) ;
			}

		}

	} else {
		var_dump($var) ;
	}
}


function prepare_input($string) {
    return trim(addslashes($string));
}


function errorMessage($str) {
	return $str;	
}

function successMessage($str) {
	return $str	;
}


function simple_redirect($url) {

    echo "<script language=\"JavaScript\">\n";
    echo "<!-- hide from old browser\n\n";
    
    echo "window.location = \"" . $url . "\";\n";

    echo "-->\n";
    echo "</script>\n";

    return true;
}
//start anorher
function upload_image($img_file,$file,$temp ){
	$folderName = "merchandize_images/";
	$validExt = array("jpg", "png", "jpeg", "bmp", "gif");
	 $image_name='';
	if ($img_file == "") {
		$msg = errorMessage( "Attach an image");
	} elseif ($file <= 0 ) {
		 return $msg = errorMessage( "Image is not proper.");
		 exit();
	} else {
		$exploaded=explode(".", $img_file);
		$ext = strtolower(end($exploaded));
		
		if ( !in_array($ext, $validExt) )  {
			$msg = errorMessage( "Not a valid image file");
		} else {
			$filePath = $folderName. rand(10000, 990000). '_'. time().'.'.$ext;
			
			if ( move_uploaded_file( $temp, $filePath)) {
			 $image_name=prepare_input($filePath);			
			} else {
				$msg = errorMessage( "Problem in uploading file");
			}
			
		}
	}
	return $image_name; }//end of function//end of function
	
	/*..................................................................................................
	
google map functions	*/


//functions
function Get_Address_From_Google_Maps($lat, $lon) {
	if($lat==0){ } else{

$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";

// Make the HTTP request
$data = @file_get_contents($url);
// Parse the json response
$jsondata = json_decode($data,true);

// If the json data is invalid, return empty array
if (!check_status($jsondata))   return array();

$address = array(
    'country' => google_getCountry($jsondata),
    'province' => google_getProvince($jsondata),
    'city' => google_getCity($jsondata),
    'street' => google_getStreet($jsondata),
    'postal_code' => google_getPostalCode($jsondata),
    'country_code' => google_getCountryCode($jsondata),
    'formatted_address' => google_getAddress($jsondata),
);
//select the formated to be aable to get the addres formated only
return $address['formatted_address'];
}//end check for lat
}

function distance($lat1, $lon1, $lat2, $lon2,$unit)
 {
	$lat1=$lat1; $lon1=$lon1; $lat2=$lat2; $lon2=$lon2; $unit=$unit;
//if($lon2!=0 or $lon1!=0){
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit== "K") {//metres =k*1000
    return number_format(($miles * 1.609344),1);
  } else if ($unit== "N") {
      return  number_format(($miles * 0.8684),1);
    } else {
        return $miles;
      }
}//end if is zero
//else return 'incorrect';
//}
/* 
* Check if the json data from Google Geo is valid 
*/

function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

/*
* Given Google Geocode json, return the value in the specified element of the array
*/

function google_getCountry($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);
}
function google_getProvince($jsondata) {
    return Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
function google_getCity($jsondata) {
    return Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);
}
function google_getStreet($jsondata) {
    return Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
}
function google_getPostalCode($jsondata) {
    return Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);
}
function google_getCountryCode($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);
}
function google_getAddress($jsondata) {
    return $jsondata["results"][0]["formatted_address"];
}

/*
* Searching in Google Geo json, return the long name given the type. 
* (If short_name is true, return short name)
*/

function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
    foreach( $array as $value) {
        if (in_array($type, $value["types"])) {
            if ($short_name)    
                return $value["short_name"];
            return $value["long_name"];
        }
    }
}

/*
*  Print an array
*/

function d($a) {
    echo "<b> ";
    print_r($a);
    echo " </b>";
}/*.............................................................................................................................................*/
//date as a title
function date_title($date){
	return date('d M Y',strtotime($date));
	}
//date withing a report
function record_date($date){
	return date('d.m.y',strtotime($date));
	}
function date_month_name($date){
	if($date>0){
	return date('d-M',strtotime($date));
	} else return 'N/A';
	}
	//find date name today
function today_is($date){
//$today=$date; 
$today=date('l');//have used the current day
$day_number = date('N', strtotime($today));
$col='mon';
if($day_number==1) $col='mon'; else  if($day_number==2)$col='tue';else  if($day_number==3)$col='wed';else  if($day_number==4)$col='thur';else  if($day_number==5)$col='fri';else  if($day_number==6)$col='sat';else  if($day_number==7)$col='sun';
return $col;
	}
	//start date format function
function format_date($d){
$datex= explode("-", $d);
if(sizeof($datex) == 0){
$datex= explode("-", $d);
}
$year=$datex[2];
$month =$datex[0];
$day =$datex[1];
return $year.'-'.$month.'-'.$day;
}
//num of outlets in a region
function num_outlets($region_id){ global $mysqli;
$res=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE region_id=$region_id and status=0") or die(mysqli_error($mysqli));
	return mysqli_num_rows($res);
 	}
function num_outlets_gps($region_id){ global $mysqli;
$res=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE longtitute!=0 and region_id=$region_id and status=0") or die(mysqli_error($mysqli));
	return mysqli_num_rows($res);
 	}
 
function region_name($region_id)
{ global $mysqli;
$res=mysqli_query($mysqli,"SELECT region_name FROM `tbl_regions` WHERE region_id=$region_id and status=0 ") or die(mysqli_error($mysqli));
	if( $r=mysqli_fetch_array($res)){
	 return '<a  href="region_profile.php?region_id='.$region_id.'">'.$r['region_name'].'</a>';}else return "Unknown";
}
function area_name($id)
{ global $mysqli;
$res=mysqli_query($mysqli,"SELECT area_name FROM `tbl_areas` WHERE area_id=$id and status=0 ") or die(mysqli_error($mysqli));
	if( $r=mysqli_fetch_array($res)){
	 return '<a  href="area_profile.php?area_id='.$id.'">'.$r['area_name'].'</a>';}else return "Unknown";
}//////////////////////////////
function sub_area_name($id)
{ global $mysqli; if($id=='') $id=0;
$res=mysqli_query($mysqli,"SELECT cluster_name FROM `tbl_clusters` WHERE cluster_id=$id ") or die(mysqli_error($mysqli));
	if( $r=mysqli_fetch_array($res)){
	 return '<a  href="cluster_profile.php?cluster_id='.$id.'">'.$r['cluster_name'].'</a>';}else return "Unknown";
}///////////////////////////////////////////////
function distributor_name($id)
{ global $mysqli;
$res=mysqli_query($mysqli,"SELECT distributor_name,distributor_id FROM `tbl_distributors` WHERE distributor_id=$id ") or die(mysqli_error($mysqli));
	if( $r=mysqli_fetch_array($res)){
	 return '<a  href="distributor_profile.php?distributor_id='.$id.'">'.$r['distributor_name'].'</a>';}else return "Unknown";
}
////
function ad_cluster_name($id)
{ global $mysqli;
$res=mysqli_query($mysqli,"SELECT ad_cluster_name,ad_cluster_id FROM `tbl_ad_clusters` WHERE ad_cluster_id=375") or die(mysqli_error($mysqli));
	if( $r=mysqli_fetch_array($res)){
	 return '<a  href="ad_cluster_distributor_profile.php?ad_cluster_id='.$id.'">'.$r['ad_cluster_name'].'</a>';}else return "Unknown";
}
 
function get_region_no_link($region_id)
{ global $mysqli;
$res=mysqli_query($mysqli,"SELECT region_name,region_id FROM `tbl_regions` WHERE region_id=".$region_id) or die(mysqli_error($mysqli)."fetching region name");
	 $r=mysqli_fetch_array($res);
	 return $r['region_name'];
}
	function get_region_from_dealerID($dealer_id){ global $mysqli;
		$res=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE dealer_id=$dealer_id") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($res)>0){ $row=mysqli_fetch_array($res);
		return region_name($row['region_id']);
		}
		}
		function get_distributor_from_userID($id){ global $mysqli;
		$res=mysqli_query($mysqli,"SELECT distributor_id FROM `tbl_users` WHERE user_id=$id") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($res)>0){ $row=mysqli_fetch_array($res);
		return distributor_name($row['distributor_id']);
		}
		}
	function visited_today($uid,$date){global $mysqli;
		$q=mysqli_query($mysqli,"SELECT distinct(dealer_id) as num FROM `tbl_route_plan` WHERE `visted`=1 and date(`date_visted`)='$date' and `assigned_to`=$uid") or die();
		return mysqli_num_rows($q);
		}//////////////////////////////////
		function timeSpentinAnOutlet($outlet,$date){global $mysqli;
		$q=mysqli_query($mysqli,"SELECT time_in,time_out FROM `tbl_route_plan` WHERE `visted`=1 and date(`date_visted`)='$date' and `dealer_id`=$outlet") or die();
		$row=mysqli_fetch_array($q);
		$time_in=new DateTime($row['time_in']);$time_out=new DateTime($row['time_in']);
	
		return $time_in->diff($time_out); 
		}
		////////
		function timeSpentinAnOutletsByAD($ad,$date){global $mysqli; $total_time=0;
		$q=mysqli_query($mysqli,"SELECT time_in,time_out FROM `tbl_route_plan` WHERE `visted`=1 and date(`date_visted`)='$date' and `assigned_to`=$ad") or die();
		while($row=mysqli_fetch_array($q)){
		$time_in=new DateTime($row['time_in']);
		$time_out=new DateTime($row['time_in']);
		$total_time+=$time_in->diff($time_out); 
		}
		return $total_time;
		}///
		
		function visited_thisweek($uid){  global $mysqli; 
			
		$q=mysqli_query($mysqli,"SELECT distinct(dealer_id) as num FROM `tbl_route_plan` WHERE `visted`=1 and date(`date_visted`)>date(NOW()) date(`date_visted`)<date(now()) and  and `assigned_to`=$uid") or die();
		return mysqli_num_rows($q);
		}
	//delete region
	function delete_region($region_id){  global $mysqli; 
$res=mysqli_query($mysqli,"UPDATE `tbl_regions` SET `status`=1 WHERE `region_id`=$region_id") or die(mysqli_error($mysqli));
if($res){
	 goback();
}
 	}
		function delete_category($id){ global $mysqli;
$res=mysqli_query($mysqli,"UPDATE `tbl_outlet_channels` SET `status`=1 WHERE `channel_id`=$id") or die(mysqli_error($mysqli));
if($res){
	 goback();
}
 	}
		//region name 
	function region($id){  global $mysqli; 
$res=mysqli_query($mysqli,"SELECT region_name FROM `tbl_regions` WHERE `region_id`=$id") or die(mysqli_error($mysqli));
$row=mysqli_fetch_array($res);
return $row['region_name'];

}///
function distributor($id){  global $mysqli; 
$res=mysqli_query($mysqli,"SELECT distributor_name as name FROM `tbl_regions` WHERE `region_id`=$id") or die(mysqli_error($mysqli));
$row=mysqli_fetch_array($res);
return $row['name'];

}
function question_category_selection($red_eds_dosa){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT category FROM `tbl_survey_questions` where status=0 and red_eds_dosa='$red_eds_dosa' GROUP BY category") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
}
	}
	///
function days_selection(){
	?>
<option value="Monday">Monday</option>
                                   <option value="Tuesday">Tuesday</option>
                                   <option value="Wednesday">Wednesday</option>
                                   <option value="Thursday">Thursday</option>
                                   <option value="Friday">Friday</option>
                                   <option value="Satarday">Sartuday</option>
                                    <?php }
function region_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` where status=0") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['region_id'].'">'.$row['region_name'].'</option>';
}
	}
	function channel_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_outlet_channels` WHERE status=0 order by channel_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['channel_id'].'">'.$row['channel_name'].'</option>';
}
	}
		function outlet_class(){ 
echo '<option value="Gold">Gold</option><option value="Silver">Silver</option><option value="Bronze">Bronze</option><option value="Other">Other</option>';
}
	/////////////////////////
	function time_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT opening_time FROM `tbl_dealers` WHERE status=0 group by opening_time order by opening_time desc ") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['opening_time'].'">'.$row['opening_time'].'</option>';
}
	}
	/////////////////////////////////////////////////////////////////////
	function product_names($id){
		switch($id){
case 4: return "Soda";
case 2: return "Novida";
case 3: return "Minite Maid";
case 1: return "Dasani";			
default: "";
}}
	function product_type($id){
		switch($id){
case 1: return "Soda";
case 2: return "Fruit";
			
default: "";
}}
	function product_flavour($id){
switch($id){
case 1: return "CocaCola";
case 2: return "Diet Coke";
case 3: return "Coke Zero";
case 4: return "Coca Cola Life";
case 5: return "Cherry Coke";
case 6: return "Caffeine-free Diet Coke";
case 7: return "Vanilla Coke";
case 8: return "Cherry Coke Zero";
case 9: return "Dasani";
case 10: return "Minute maid";
case 11: return "Novida";
default: "";
}}
function pack_size($id){
switch($id){
case 1: return "200ml";
case 2: return "300ml";
case 3: return "500ml";
case 4: return "1L";
case 5: return " 1.2 L";
case 6: return "1.5L";
case 7: return "2L";
case 8: return "3L";
case 9: return "5L";
default: "";
}}
function pack_type($id){
switch($id){
case 1: return "RGB";
case 2: return "Plastick";

default: "";
}}
	function  flavours_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_product_flavours` where status=0") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['flavour_name'].'">'.$row['flavour_name'].'</option>';
}}
/////////////////////
function  pack_size_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_product_sizes` where status=0 ") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['size_ml'].'">'.$row['size'].'</option>';
}}///////////////////////
function  product_types_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_product_types` where status=0") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['type_name'].'">'.$row['type_name'].'</option>';
}}
////////////////
function  product_variant_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_products_variants` where status=0 ") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['variant'].'">'.$row['variant'].'</option>';
}}
	
	////////////////////////////////////////////////////////////////////////
	function roles_selection(){ global $mysqli; 
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_roles` where status=0") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['role_id'].'">'.$row['role_name'].'</option>';
}
	}
		function roles_selection_boundary($boundary){ global $mysqli; 
		$where=" status=0 ";
		switch($boundary){
			case 1:$where.=" and role_id=1 "; break;
			case 2:$where.=" and role_id!=4 and role_id!=2 "; break;
			case 3:$where.=" and role_id!=4 and role_id!=2 and role_id!=3"; break;
			case 4:$where.=" "; break;
			
			case 5:$where.=" and role_id!=4 and role_id!=2 and role_id!=3"; break;
			case 8:$where.=" and role_id=6"; break;
			default: $where.=" and role_id=0"; break;
			}
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_roles` where $where ORDER BY role_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['role_id'].'">'.$row['role_name'].'</option>';
}
	}
	function area_selection(){ global $mysqli; 
	$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];
	$where=" status=0 order by region_id, area_id";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		 }
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` where $where order by area_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['area_id'].'">'.$row['area_name'].'</option>';
}
	}
	function distributor_selection(){ global $mysqli; 
	$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];
	$where=" status=0  order by region_id, area_id,cluster_id,distributor_id";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 ";break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		 }
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` where $where ORDER BY distributor_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['distributor_id'].'">'.$row['distributor_name'].'</option>';
}
	}//////////////////////////////////////////////////////////
	function ad_cluster_selection(){ global $mysqli; 
	$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];
	$where=" status=0  order by region_id, area_id,cluster_id";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 ";break;//arm
		case 1: $where=" sub_area_id=$cluster_id and status=0 "; break;//AD
		 }
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_ad_clusters` where $where ORDER BY ad_cluster_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['ad_cluster_id'].'">'.$row['ad_cluster_name'].'</option>';
}
	}
//////////////////////////////////////////////////////////
	function route_selection(){ global $mysqli; 
	$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];
	$where=" status=0  order by region_id, area_id,cluster_id,route_id";
	switch($role){
		case 5: $where=" region_id=$myregion and status=0 "; break;//rm
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 ";break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		 }
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` where $where order by route_name ") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['route_id'].'">'.$row['route_name'].'</option>';
}
	}	///////////////////////////////////////////////////////////////
	function route_selection_region($region){ global $mysqli; 
	
	$where=" status=0 and region_id=$region order by route_name";
	
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` where $where ") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['route_id'].'">'.sub_area_name($row['cluster_id'])."-".$row['route_name'].'</option>';
}
	}///////////////////////
	
	function cluster_selection(){ global $mysqli; 
	
	$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];
	$where=" status=0 order by region_id, area_id,cluster_id ";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		
		 }
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` where $where ORDER BY cluster_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['cluster_id'].'">'.$row['cluster_name'].'</option>';
}
	}
		function cluster_selection_boundary($role,$boundary){ global $mysqli; 
		$where=" status=0 order by cluster_name ";
//	if($role==){}
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` where $where") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['cluster_id'].'">'.$row['cluster_name'].'</option>';
}
	}
	function areas_selection_boundary(){ global $mysqli; 
	
		
$user=$_SESSION['u_id']; $region=getColumnName('tbl_users','region_id', 'user_id='.$user);
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` where region_id=$region and status=0  ORDER BY area_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($res)){
echo '<option value="'.$row['area_id'].'">'.$row['area_name'].'</option>';
}
	}
function user_select_list($id){ global $mysqli;
	$return= "<select class='form-control' name='assign_to'><option value='0'>All</option>";
	$q=mysqli_query($mysqli,"SELECT user_id,full_name FROM tbl_users WHERE status=0 ORDER BY full_name asc")or die(mysqli_error($mysqli));
	while($r=mysqli_fetch_array($q)){
		$return.= "<option value='".$r['user_id']."'>".$r['full_name']."</option>";
		}
		$return.= "</select>";
		return $return;
	}
	//////////////////////////////////////////////////////////////
	function select_ARMs($region){ global $mysqli;
	$return= "";
	$q=mysqli_query($mysqli,"SELECT user_id,full_name FROM tbl_users WHERE region_id=$region and  role=3 and status=0 ORDER BY full_name asc")or die(mysqli_error($mysqli));
	while($r=mysqli_fetch_array($q)){
		$return.= "<option value='".$r['user_id']."'>".$r['full_name']."</option>";
		}
		//$return.= "</select>";
		return $return;
	}
///////////////////
function availability_check_skus(){
	global $mysqli; $list="SKU";
	$q=$mysqli->query("SELECT `product_id`,`variant`,`pack_size` , `pack_type` FROM `tbl_products` WHERE 1 order by `variant`,`pack_size` , `pack_type`") or die($mysqli->error);
	while($r=mysqli_fetch_array($q)){
		$list.= "<option value='".$r['product_id']."'>".$r['variant'].' '.$r['pack_size'].' '.$r['pack_type']."</option>";
		}
		return $list;
	}
	
	//get ip of client
	
	function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}

//send email
function send_email($ms,$subject,$to){
  
   $header = "From:info@almasibeverages.co.ke\r\n";
  
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";
  
    $retval = mail ($to,$subject,$ms,$header);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
}
//send email of weekly summary
function send_weekly_summary($to,$subject,$ms){
   
   $header = "From:info@almasibeverages.co.ke";
  
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";
  
    $retval = mail ($to,$subject,$ms,$header);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
}

//get the name of a product given the id
function get_product_name($pid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT `product` FROM `tbl_products` WHERE `product_id`=$pid LIMIT 1")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return 'Unknown';
		} else{
			$row=mysqli_fetch_array($q);
			return $row["product"];		
					}
	}
//functions to count number sals by brand
function sales_by_brand_all($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and status !=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//this month
	function sales_by_brand_this_month($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and MONTH(date_supplied)= MONTH(NOW()) and status!=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//this week
	function sales_by_brand_this_week($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and WEEK(date_supplied)= WEEK(NOW()) and status!=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		
		//this today 
	function sales_by_brand_today($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and DATE(date_supplied)= DATE(NOW()) and status!=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//all by sals people
function sales_by_tsr_all($uid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status=0") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//	//present month by sales people
function sales_by_tsr_this_month($uid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3 and MONTH(date_supplied)= MONTH(NOW())") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//	//current week sales by sales people
function sales_by_tsr_this_week($uid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3 and week(date_supplied)= week(NOW())") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
				//	//current week sales by sales people
function sales_by_tsr_this_today($uid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3 and date(date_supplied)= date(NOW())") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		
		//function total for sales for a outlet
function sales_by_outlet_total($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `dealer_id`=$id and status!=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//sales per outlet per month
function sales_by_outlet_month($date,$outlet_id){  global $mysqli;
$id=(int) $outlet_id;
$month=date('m', strtotime($date));
$year=date('Y',strtotime($date));
			$q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `dealer_id`=$id and MONTH(date_added)='$month'  and YEAR(date_added)='$year' and status!=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
			}
//last day of Visit
function sales_by_outlet_lastvisit($id){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT dealer_id, date_added FROM `tbl_orders_details` WHERE `dealer_id`=$id and status!=3 ORDER BY order_details_id asc limit 1") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0) return '-'; else{
	$r=mysqli_fetch_array($q);
	$c= record_date($r['date_added']);
	 if($c==0) return '-'; else return $c;
			}//else
			}
			
			
			//functions for summary report
			
function total_outlets_in_region($rid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=0 and `region_id`=$rid") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//total outlets by category in a region
	function total_outlets_categories_in_region($rid,$category){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE channel=$category and region_id=$rid and `status`=0 and `region_id`=$rid") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	function total_deleted_in_region($rid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=1 and `region_id`=$rid") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//total people on a certain region
	function check_number_of_pple_in_region($rid){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_users` WHERE `status`=0 and `region_id`=$rid") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '1'; else return $c;
	}
	//for outlets visted bewtween a certain period by a certain person
	function outlets_visted_per_time($uid,$start,$end ){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_route_plan` WHERE `status`=0 and `assigned_to`=$uid and DATE(`date_visted`) BETWEEN '$start' AND '$end' and status=0") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//for outlets added between a caetain period
	function outlets_added_per_time($uid,$start,$end ){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=0 and `added_by`=$uid and DATE(`reg_date`) BETWEEN '$start' AND '$end'") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//outlets added in a day
	function outlets_added_in_day($uid,$day){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=0 and `added_by`=$uid and DATE(`reg_date`)='$day'") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	function prospecting_outlets_added_in_day($uid,$day){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE  `added_by`=$uid and active_innactive=1 and DATE(`reg_date`)='$day'") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//out of the number of outlets visited how many did he sale
	function day_strike_rate($uid,$day){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_orders_details` WHERE `cases`!=0 and DATE(`date_added`)='$day' and `made_by`=$uid GROUP BY `dealer_id`") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//cases and pieces in outlet at specific day
	function days_stock_levels($uid,$day,$package){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT COALESCE(sum($package),0) as ct FROM `tbl_stock_levels` WHERE DATE(`date_added`)='$day' AND `user_id`=$uid and `status`=0") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	//$c= number_format($r['ct']+$r['pt']);
	  return $r['ct'];//'0'; else return $c;
	}
	//cases and pieces in outlet at specific day
	function days_orders_deliveries($uid,$day,$d_or_s){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT COALESCE(sum($d_or_s),0) as tt FROM `tbl_orders_details` WHERE `made_by`=$uid and DATE(`date_added`)='$day' AND status=0") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	  return  $r['tt'];;
	}
	function deliveries_in_a_month_per_jurisdiction($month,$year,$jurisdiction,$jurisdiction_id){ global $mysqli;
	$where="";
	if($jurisdiction=='area'){ $where="dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE area_id=$jurisdiction_id)";}
	else if($jurisdiction=='cluster'){ $where="dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE cluster_id=$jurisdiction_id)";}
else if($jurisdiction=='distributor'){ $where="dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE distributor_id=$jurisdiction_id)";}
else if($jurisdiction=='route'){ $where="dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE route_id=$jurisdiction_id)";}
else if($jurisdiction=='outlet'){ $where="dealer_id=$jurisdiction_id";}
	
	$q=mysqli_query($mysqli,"SELECT sum(cases) as tt FROM `tbl_orders_details` WHERE Month(date_supplied)='$month' and YEAR(date_supplied)='$year' and $where ") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c=='') return 0; else return $c;
	}
	///////////////////////////////////////
	
	
	//stock required
	function stock_required_per_period($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT SUM(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and DATE(date_added BETWEEN '$start' AND '$end') AND status !=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//stock delivered in a certain perid
	//stock required
	function stock_supplied_per_period($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT SUM(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and DATE(date_added BETWEEN '$start' AND '$end') AND status !=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//orders made depending on aount required vs amount supplied
	function orders_in_period($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT SUM(`cases`) as qty FROM `tbl_orders_details` WHERE cases<cases AND `made_by`=$uid and DATE(date_added BETWEEN '$start' AND '$end') AND status !=3") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//
	//orders made depending on aount required vs amount supplied
	function o_advert($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `outside_advert`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' and status=0 ") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	
	function in_advert($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `inside_advert`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' ") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	
	function fridge_av($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `fridge`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' ") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	function fridge_na($uid,$start,$end){ global $mysqli;
	$q=mysqli_query($mysqli,"SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `ownership`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' ") or die(mysqli_error($mysqli));
	$r=mysqli_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	//get image properties
	function image_properties($image){
		// Check if the variable is set and if the file itself exists before continuing
    if ((isset($image)) and (file_exists($image))) {
   $type = exif_imagetype($image);
   if ($type == (IMAGETYPE_JPEG || IMAGETYPE_GIF || IMAGETYPE_BMP)){
      // There are 2 arrays which contains the information we are after, so it's easier to state them both
      $exif_ifd0 = read_exif_data($image ,'IFD0' ,0);       
      $exif_exif = read_exif_data($image ,'EXIF' ,0);
      //error control
      $notFound = "Unavailable";
      // Make 
      if (@array_key_exists('Make', $exif_ifd0)) {
        $camMake = $exif_ifd0['Make'];
      } else { $camMake = $notFound; }
      // Model
      if (@array_key_exists('Model', $exif_ifd0)) {
        $camModel = $exif_ifd0['Model'];
      } else { $camModel = $notFound; }
           // orginal date
      if (@array_key_exists('FileDateTime ', $exif_ifd0)) {
        $camOrigDate = $exif_ifd0['FileDateTime '];
      } elseif (@array_key_exists('FileDateTime ', $exif_ifd0)){
	   $camOrigDate = $exif_ifd0['FileDateTime '];} 
	   elseif (@array_key_exists('DateTime', $exif_ifd0)){
	  $camOrigDate = $exif_ifd0['DateTime']; 
		   
	   } else $camOrigDate = $notFound;
      
     return $camOrigDate.' Camera used'.$camMake.' '.'model '. $camModel ;
   }//end the section checking typee
    
    
    } else {
      return 'Edited photo'; 
    } 
	
		}
function channel_type($channel){ global $mysqli;
				$query=mysqli_query($mysqli,"SELECT `channel_id`, `channel_name` FROM `tbl_outlet_channels` WHERE `channel_id`=$channel and status=0")or die(mysqli_error($mysqli));
				if(mysqli_num_rows($query)>0)
				{$row=mysqli_fetch_array($query);
			return $row['channel_name'];
						}
						else return 'N/A';
						}
	function times_visited($dealer){ global $mysqli;
		$q=mysqli_query($mysqli,"SELECT `dealer_id` FROM `tbl_route_plan` WHERE `dealer_id`=$dealer and visted=1")or die(mysqli_error());
		return mysqli_num_rows($q);
		}
		function times_visted_in_month($dealer,$month,$year){global $mysqli;
		$q=mysqli_query($mysqli,"SELECT `dealer_id` FROM `tbl_route_plan` WHERE `dealer_id`=$dealer and visted=1 and MONTH(startdate)='$month' and YEAR(startdate)='$year'")or die(mysqli_error($mysqli));
		return mysqli_num_rows($q);
		}
	function outlet_last_visit($outlet_id){ //NB it is based on the cheeckin details
	global $mysqli;
		$q=mysqli_query($mysqli,"SELECT startdate FROM `tbl_route_plan` WHERE `dealer_id`=$outlet_id and visted=1  and status =0 order by id desc limit 1 ")or die(mysqli_error($mysqli));
		if(mysqli_num_rows($q)==0){ return "Never Visted";} else {
		$r=mysqli_fetch_array($q);
		return record_date($r["startdate"]);
		}//end else
	}
function stock_given($pid,$user,$date){global $mysqli;
	 $q=mysqli_query($mysqli,"SELECT number FROM `tbl_stock_given` WHERE DATE(`date_given`)='$date' and product_id=0 and given_to=$user");
	 if(mysqli_num_rows($q)==0){ return 0;} else{
 $res=mysqli_fetch_array($q);
 return $tt=$res['number'];}
	
		}
		function stock_given_id_aday($user,$date){global $mysqli;
	 $q=mysqli_query($mysqli,"SELECT number FROM `tbl_stock_given` WHERE DATE(`date_given`)='$date' and given_to=$user");
	 if(mysqli_num_rows($q)==0){ return 0;} else{
 $res=mysqli_fetch_array($q);
 return $tt=$res['number'];}
	
		}
		
function num_registered_monthly($year_month,$region_id){global $mysqli;
		
		$query=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE EXTRACT(YEAR_MONTH FROM `reg_date` )='$year_month' and status=0 and `region_id`=$region_id")or die(mysqli_error($mysqli));
		 $row=mysqli_fetch_array($query); return "<a href='new_outlets_list.php?year_month=".$year_month."&region_id=".$region_id."'>".$row['tt']."</a>";
		} 
function brand_amount_sold($pid,$user,$date){global $mysqli;
	 $q=mysqli_query($mysqli,"SELECT sum(`cases`) as qty FROM `tbl_orders_details` WHERE `product_id`=$pid and `made_by`=$user and DATE(`date_added`)='$date'");
	 if(mysqli_num_rows($q)==0){ return 0;} else{
 $res=mysqli_fetch_array($q);
 return $tt=$res['qty'];}
	}
	//functions to count all orders including expired
	
	function all_orders_in_region($region_id){global $mysqli;
		$exp_q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE d.region_id=$region_id") or die(mysqli_error($mysqli)); return  mysqli_num_rows($exp_q);
		
		}
		//serviced orders
		function serviced_orders_in_region($region_id){global $mysqli;
		$exp_q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE o.status=1 and d.region_id=$region_id") or die(mysqli_error($mysqli)); return  mysqli_num_rows($exp_q);
		
		}
		function rejected_orders_in_region($region_id){global $mysqli;
		$exp_q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE o.status=4 and d.region_id=$region_id") or die(mysqli_error($mysqli)); return  mysqli_num_rows($exp_q);
		
		}
			
	function expired_orders($region_id){global $mysqli;
		$exp_q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE date(`date_due`)<date(now()) and o.status=0 and d.region_id=$region_id") or die(mysqli_error($mysqli)); return  mysqli_num_rows($exp_q);
		
		}
function upcoming_orders($region_id){global $mysqli;
		$exp_q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE date(`date_due`)>date(now()) and o.status=0 and d.region_id=$region_id") or die(mysqli_error($mysqli)); return  mysqli_num_rows($exp_q);
		
		}
function years_in_orders()
{   $r='';global $mysqli;
	$query=mysqli_query($mysqli,"SELECT YEAR(`startdate`) as year FROM `tbl_route_plan` where  YEAR(`startdate`) !='' and YEAR(`startdate`) !=0 group by YEAR(`startdate`) order by year")or die(mysqli_error($mysqli));
	while($rw=mysqli_fetch_array($query)){
		$r.= "<option value=".$rw['year'].">".$rw['year']."<option >";
		}
		return $r;
		
	}
	function make_plan($startdate,$did,$made_by,$vist_status){global $mysqli;
	$uid=$_SESSION['u_id'];
	$today=date('Y-m-d');
	//check whether it has been scheduled before rescheduling again
	$q=mysqli_query($mysqli,"SELECT * FROM tbl_route_plan  where dealer_id=$did and date(startdate)='$startdate' and status=0")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){
	if(strtotime($startdate)>=strtotime($today)){
	$insert = mysqli_query($mysqli,"INSERT INTO tbl_route_plan( `dealer_id`, visted,`made_by`, `assigned_to`, `startdate`, `enddate`, `allDay`) VALUES($did, $vist_status,$uid,$made_by,'$startdate','$startdate','false')");
	}}
	}
		function prospect_prices($dealer_id,$i){global $mysqli;
			$q=mysqli_query($mysqli,"SELECT `price`,`remarks` FROM `tbl_prospecting` WHERE `item_id`=$i and status=0 and `dealer_id`=$dealer_id") or die(mysql_error("error"));
			if(mysqli_num_rows($q)==0){  return '-';} else{
			$r=mysqli_fetch_array($q);
	$c= $r['price'];
	 if($c==0) return '-'; else return $c;}
			}
			
			//Sales to Key Distributors/Key Account
function regional_cases_sell_in($region_id,$date){global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(`cases`) as tt FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE  date( `date_added`)='$date' and region_id=$region_id and `type_of_outlet`=1") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return 0;}
	else{
			$row=mysqli_fetch_array($q);
			return $row["tt"];
			}
	
	}

			//dashborad report functions
	function regional_cases_sell_out($region_id,$date){global $mysqli;
		$q=mysqli_query($mysqli,"SELECT sum(`cases`) as tt FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE  date( `date_added`)='$date' and region_id=$region_id") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return  0;}
	else{
			$row=mysqli_fetch_array($q);
			return $row["tt"];
			}
	
		
		}
function user_sell_out_in_day($uid,$date){global $mysqli;
		$q=mysqli_query($mysqli,"SELECT sum(`cases`) as tt FROM `tbl_orders_details` od  WHERE  date( `date_added`)='$date' and made_by=$uid") or die(mysqli_error($mysqli));
	//if(mysqli_num_rows($q)==0){ return  0;}
	//else{
			$row=mysqli_fetch_array($q);
			return $row["tt"];
		//	}
	
		
		}
function outlet_sell_out_rate($outlet_id){global $mysqli;
	
		$q=mysqli_query($mysqli,"SELECT sum(`cases`) as tt FROM `tbl_orders_details` od  WHERE  date( `date_added`)>= DATE(NOW() - INTERVAL 3 MONTH) and dealer_id=$outlet_id") or die(mysqli_error($mysqli));
				$row=mysqli_fetch_array($q);
			return number_format($row["tt"]/90,1);	
		}
	
function region_success_strike_outlets($region_id,$date){global $mysqli;
	$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_orders_details` od RIGHT JOIN tbl_dealers d on d.dealer_id=od.dealer_id WHERE date(`date_added`)='$date' and `region_id`=$region_id")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return  0;}
	else{
			$row=mysqli_fetch_array($q);
			return $row["tt"];
			}
	
	}

function regional_total_sales_in_aday($region_id,$date){global $mysqli;
	$q=mysqli_query($mysqli,"SELECT sum(cases) as tt FROM `tbl_orders_details` od RIGHT JOIN tbl_dealers d on d.dealer_id=od.dealer_id WHERE date(`date_added`)='$date' and `region_id`=$region_id")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return  0;}
	else{
			$row=mysqli_fetch_array($q);
			return $row["tt"];
			}
	
	}	
	
function new_listing_sales($did,$pid,$date){global $mysqli;
	$date=date("Y-m-d",strtotime($date));
	$q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders_details` WHERE `product_id`=$pid and date(`date_added`)='$date' and `dealer_id`=$did")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return  0;
		}
		else{
			$row=mysqli_fetch_array($q);
			return $row["cases"];
			}
		
}

function region_new_outlet_sale_out_cases($region,$date){global $mysqli;
	$date=date("Y-m-d",strtotime($date));
	$q=mysqli_query($mysqli,"SELECT sum(cases) as cases FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE region_id=$region and date(`date_added`)='$date'")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return  0;
		}
		else{
			$row=mysqli_fetch_array($q);
			return $row["cases"];
			}
		
}
function period_btn_2dates($date1,$date2){global $mysqli;
	$date1=strtotime($date1);
	$date2=strtotime($date2);	
	
	if($date1>$date2) return number_format(($date1-$date2)/86400,1); else if($date1<$date2) return number_format(($date1-$date1)/86400,1); else if($date1==$date2)return 0;
	
	}
	
function yes_no ($number){
	switch($number)
	{
		case 1: return 'yes'; break;
		case 0: return "No"; break;
		
		}
	}
	
function regional_repeat_sales_outlet($region_id, $date){global $mysqli;
	$date=date("Y-m-d",strtotime($date));
	$q=mysqli_query($mysqli,"SELECT count(distinct(od.dealer_id)) as tt FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE region_id=$region_id and date(`date_added`)='$date'")or die(mysqli_error($mysqli));
	if(mysqli_num_rows($q)==0){ return  0;
		}
		else{
			$row=mysqli_fetch_array($q);
			return $row["tt"];
			}
		}
function save_classification()
{global $mysqli;
		$date=date("Y-m-d");
		$uid=$_SESSION['u_id'];
		$class_name=clean($_REQUEST['category_name']);
		$descr=clean($_REQUEST['description']);
		$member_of=clean($_REQUEST['member_of']);
		$applies_for=clean($_REQUEST['applies_for']);
		
	$insert = mysqli_query($mysqli,"INSERT INTO tbl_outlet_channels(`added_by`,applies_for,member_of, `date_added`, `channel_name`, `description`) values ($uid,'$applies_for','$member_of','$date','$class_name','$descr')")or die(mysqli_error($mysqli));
	}
function category_select_list(){ global $mysqli; 
	$q = mysqli_query($mysqli,"SELECT channel_name,channel_id FROM tbl_outlet_channels where status=0 order by channel_name")or die(mysqli_error($mysqli));
	while($row=mysqli_fetch_array($q))
	{
	echo "<option value=".$row['channel_id'].">".$row['channel_name']."</option>";	}
	}
	function total_outlets_in_route($route_id){global $mysqli;
		$q=mysqli_query($mysqli,"SELECT count(*) as tt FROM `tbl_dealers` WHERE status=0 and `route_id`=$route_id")or die(mysqli_error($mysqli));
		$r=mysqli_fetch_array($q);
		return $r['tt'];
		}
function get_user_region($user_id){global $mysqli;
	$res=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE user_id=$user_id ") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($res)>0){ $r=mysqli_fetch_array($res);
	 return $r['region_id'];}else return 0;
	 }
function get_distinct_rows($table,$column,$condition){global $mysqli;
	$res=mysqli_query($mysqli,"SELECT count(distinct($column)) as total FROM $table WHERE $condition ") or die(mysqli_error($mysqli));
	 $rq=mysqli_fetch_array($res);
	 $r=$rq['total'];
	 if($r=='')return 0; else return $r;
 
	 }
	 function num_rows($table,$condition){global $mysqli;
	$res=mysqli_query($mysqli,"SELECT count(1) as total FROM $table WHERE $condition ") or die(mysqli_error($mysqli));
	 $rq=mysqli_fetch_array($res);
	 $r=$rq['total'];
	 if($r<=0)return 0; else return $r;
 
	 }
	 function num_rows1($table,$condition){global $mysqli;
	$res=mysqli_query($mysqli,"SELECT status FROM $table WHERE $condition ") or die(mysqli_error($mysqli));
	 $r=mysqli_num_rows($res);
	 if($r>0) 
	return $r; else return;
 
	 }
	 function num_rows2($table,$condition){global $mysqli;
	$res=mysqli_query($mysqli,"SELECT count(*) as num FROM $table  WHERE $condition ") or die(mysqli_error($mysqli));
	 $r=mysqli_fetch_array($res);
 return $r['num']; 
 
	 }
function getColumnName($table,$column, $condition){global $mysqli;
	$column=clean($column);
	$res=mysqli_query($mysqli,"SELECT $column FROM $table WHERE $condition ") or die(mysqli_error($mysqli));
	if(mysqli_num_rows($res)>0){
$r=mysqli_fetch_array($res);
 return $r[$column]; }else return "N/A";
	 }
	 function getColumnNumber($table,$column, $condition){global $mysqli;
	$column=clean($column);
	$res=mysqli_query($mysqli,"SELECT $column FROM $table WHERE $condition ") or die(mysqli_error($mysqli));
	//
$r=mysqli_fetch_array($res);
if($r[$column]>0){
 return $r[$column]; }else return "-";
	 }
	  function get_sum_of_route_targets($route_id,$denominator){ global $mysqli;
	 $cont=mysqli_query($mysqli,"SELECT SUM(qty) as total_target FROM `tbl_targets` WHERE market_boundary ='route' and market_boundary_id=$route_id"); $tot=mysqli_fetch_array($cont); 
	 $number= $tot['total_target'];
	 if(!is_numeric($number) and $denominator==1){ return $number=1;} else return  $number;
	 }
	  function get_sum_of_distributor_targets($distributor_id,$denominator){ global $mysqli;
	 $cont=mysqli_query($mysqli,"SELECT SUM(qty) as total_target FROM `tbl_targets` WHERE market_boundary ='distributor' and market_boundary_id=$distributor_id"); $tot=mysqli_fetch_array($cont); 
	 $number= $tot['total_target'];
	if(!is_numeric($number) and $denominator==1){ return $number=1;} else return  $number;
	 }///
	 
	function time_diff($date1, $date2) {
	if(strtotime($date1)>0 && strtotime($date2)>0){
		$diff = abs(strtotime($date2) - strtotime($date1));
		return date("H:i:s",$diff);
	}else return "-";
  
}
	 ///////////////
	  function get_distributor_targets_per_month($distributor_id,$month,$year,$denominator){ global $mysqli;
	 $cont=mysqli_query($mysqli,"SELECT SUM(qty) as total_target FROM `tbl_targets` WHERE MONTH(target_month)='$month' AND YEAR(target_month)='$year' AND market_boundary ='distributor' and market_boundary_id=$distributor_id"); $tot=mysqli_fetch_array($cont); 
	 $number= $tot['total_target'];
	if(!is_numeric($number) and $denominator==1){ return $number=1;} else if($number=='') return 0; else return  $number;
	 }
	 //////////////////////////////////////
	 function get_sum_of_cluster_targets($cluster_id,$denominator){ global $mysqli;
	 $cont=mysqli_query($mysqli,"SELECT SUM(qty) as total_target FROM `tbl_targets` WHERE market_boundary ='cluster' and market_boundary_id=$cluster_id"); $tot=mysqli_fetch_array($cont); 
	 $number= $tot['total_target'];
	if(!is_numeric($number) and $denominator==1){ return $number=1;} else return  $number;
	 }
	 //////////////////////////////////////////////
	 function get_sum_of_area_targets($area_id,$denominator){ global $mysqli;
	 $cont=mysqli_query($mysqli,"SELECT SUM(qty) as total_target FROM `tbl_targets` WHERE market_boundary ='area' and market_boundary_id=$area_id"); $tot=mysqli_fetch_array($cont); 
	  $number= $tot['total_target'];
	if(!is_numeric($number) and $denominator==1){ return $number=0;} else return  $number;
	 }////////////////////////////////
	 function sum_columns($table,$column,$condition){
		 global $mysqli;
		 $cont=mysqli_query($mysqli,"SELECT SUM($column) as total FROM $table WHERE $condition") or die(mysqli_error($mysqli));
		  $tot=mysqli_fetch_array($cont); 
	 if($tot['total']>0)return $tot['total']; else return  "-";
		 }

	 
	  function get_sum_of_region_targets($region_id,$denominator){ global $mysqli;
	 $cont=mysqli_query($mysqli,"SELECT SUM(qty) as total_target FROM `tbl_targets` WHERE market_boundary ='region' and market_boundary_id=$region_id"); $tot=mysqli_fetch_array($cont); 
	  $number= $tot['total_target'];
	 if(!is_numeric($number) and $denominator==1){ return $number=1;} else return  $number;
	 }////////////////////////////
	 
	 function total_assets($jurisdiction,$jurisd_id, $asset_type_id,$sourced_from){ global $mysqli;
	 ///removed the asset type id filter cause we want all assets
	 $where=1;
	
	 ////considering everything in a jurisdiction aset type 0 implies all types of assets
	 if($jurisdiction=="region" and $asset_type_id!=0){ 
	 $where="WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE region_id=$jurisd_id) ";//and `asset_type_id`=$asset_type_id
	 } 
	else if($jurisdiction=="area"){  
	 $where="WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE area_id=$jurisd_id)";
	 } else if($jurisdiction=="cluster" ){ $where="WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE cluster_id=$jurisd_id) ";}//and `asset_type_id`=$asset_type_id
	 else if($jurisdiction=="distributor"){ $where="WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE distributor_id=$jurisd_id) ";}
	  else if($jurisdiction=="route" ){ $where="WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE route_id=$jurisd_id)";}
	    else if($jurisdiction=="outlet" ){ $where="WHERE dealer_id=$jurisd_id";}
	 
		 $q=mysqli_query($mysqli,"SELECT COUNT(asset_id) as num FROM `tbl_assets` $where" ); 
		 $n= mysqli_fetch_array($q); 
		 return $n['num'];
		 }
	 
	 ///////////////// sending email with attachment
	 function send_mail_withAttachment($filepath,$email,$message)
{

$from = "Backup <eamocha@gmail.com>";
$subject = "Subject";

$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = date("d-m-Y-hms "). "backup.zip";

//$pdfdoc is PDF generated by FPDF
$attachment = chunk_split(base64_encode(file_get_contents($filepath)));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "Find the attached file .".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
if (mail($email, $subject, $body, $headers)) {
    echo "sent!!";
   // header("refresh: 1; index.php");
} else {
    echo "Oops mail can not be send";
}
}
////////compress file before sending
function compress($filepath)

     {

         $zip = new ZipArchive();
  $file=$filepath.".zip";
 if($zip->open($file,1?ZIPARCHIVE::OVERWRITE:ZIPARCHIVE::CREATE)===TRUE)
 {
   // Add the files to the .zip file
   $zip->addFile($filepath);

   // Closing the zip file
   $zip->close();
 }
     } 
	 
	 ////////////////////////////getoutlet_type
	 function get_outlet_type($id){
	 switch ($id) {
                case 1:
                    return "Gold";
                case 2:
                    return "Silver";
                case 3:
                    return "Bronze";
                default:
                    return "Unknown";
            }}
			
			
			//////////////sending fpdf file to email
			
			function email_file($pdfdoc,$filename,$from,$to,$subject,$message)
{

$response = array("tag" => $message, "error" => FALSE);///rsponse to phone
// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
$attachment = chunk_split(base64_encode($pdfdoc));

// main header (multipart mandatory)
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol.$eol;

// message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$headers .= $message.$eol.$eol;

// attachment
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment.$eol.$eol;
$headers .= "--".$separator."--";

// send message
if(mail($to, $subject, "", $headers)){
	  $response["error"] = FALSE;
	  $response["message"] = "Successifully sent!!!. Check " .$to; 
	  echo json_encode($response);
	  } else{
		   $response["error"] = TRUE;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
		  }

}
/////////////////////////

function suckers_in_jurisdiction($jurisdiction,$jur_id){
	global $mysqli;
	$where ="";
	if($jurisdiction=='region'){$where=" WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE region_id=$jur_id)";}
	if($jurisdiction=='area'){$where=" WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE area_id=$jur_id)";}
	if($jurisdiction=='cluster'){$where=" WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE cluster_id=$jur_id)";}
	if($jurisdiction=='distributor'){$where=" WHERE dealer_id IN(SELECT dealer_id FROM tbl_dealers WHERE distributor_id=$jur_id)";}
	$q=mysqli_query($mysqli,"SELECT sum(`dealer_id`) as total FROM `tbl_competitor_survey` $where")or die(mysqli_error($mysqli));
	$rws=mysqli_fetch_array($q);
	$return= $rws['total'];	 if($return=='') return 0; else return $return;
	}
function getMonthString($m){
    if($m==1){
        return "January";
    }else if($m==2){
        return "February";
    }else if($m==3){
        return "March";
    }else if($m==4){
        return "April";
    }else if($m==5){
        return "May";
    }else if($m==6){
        return "June";
    }else if($m==7){
        return "July";
    }else if($m==8){
        return "August";
    }else if($m==9){
        return "September";
    }else if($m==10){
        return "October";
    }else if($m==11){
        return "November";
    }else if($m==12){
        return "December";
    }
}
function checkbox_answers($question){ global $mysqli;
					$arr=array();		//fetch results
				$qry=mysqli_query($mysqli,"SELECT `option_id`, `option_name` FROM `tbl_question_options` WHERE main_question_id=$question")or die($mysqli);
		while($row=mysqli_fetch_array($qry)){
			$arr[]=$row['option_name'];
			
			}
			return $arr;
			}
			///////////////////statistics with filters
	function regions_filters_condition(){

		$condition="";
if(isset($_REQUEST['has_electricity'])&&$_REQUEST['has_electricity']!=-1){  $condition .=" and has_electricity='".$_REQUEST['has_electricity']."'";}
if(isset($_REQUEST['sales_fmcg'])&&$_REQUEST['sales_fmcg']!=-1){  $condition .=" and sales_fmcg='".$_REQUEST['sales_fmcg']."'";}
if(isset($_REQUEST['neibourhood_income'])&&$_REQUEST['neibourhood_income']>=0){  $condition .=" and neibourhood_income='".$_REQUEST['neibourhood_income']."'";}
if(isset($_REQUEST['key_account'])&&$_REQUEST['key_account']!=-1){  $condition .=" and key_account='".$_REQUEST['key_account']."'";}
if(isset($_REQUEST['location_occassions'])&&$_REQUEST['location_occassions']!=-1){  $condition .=" and location_occassions='".$_REQUEST['location_occassions']."'";}
if(isset($_REQUEST['opening_time'])&&$_REQUEST['opening_time']!=-1){  $condition .=" and opening_time='".clean($_REQUEST['opening_time'])."'";}
if(isset($_REQUEST['closing_time'])&&$_REQUEST['closing_time']!=-1){  $condition .=" and closing_time='".clean($_REQUEST['closing_time'])."'";}
if(isset($_REQUEST['do_you_sell_any_bevs'])&&$_REQUEST['do_you_sell_any_bevs']!=-1){  $condition .=" and do_you_sell_any_bevs='".$_REQUEST['do_you_sell_any_bevs']."'";}
if(isset($_REQUEST['has_asset'])&&$_REQUEST['has_asset']!=-1){  $condition .=" and dealer_has_asset='".$_REQUEST['has_asset']."'";}
if(isset($_REQUEST['stocked_coke_inthePast'])&&$_REQUEST['stocked_coke_inthePast']!=-1){  $condition .=" and 	stocked_coke_inthePast='".$_REQUEST['stocked_coke_inthePast']."'";}
if(isset($_REQUEST['willing_to_stock_coke'])&&$_REQUEST['willing_to_stock_coke']!=-1){  $condition .=" and willing_to_stock_coke='".$_REQUEST['willing_to_stock_coke']."'";}
if(isset($_REQUEST['sales_coke_products'])&&$_REQUEST['sales_coke_products']!=-1){  $condition .=" and sales_coke_products='".$_REQUEST['sales_coke_products']."'";}
if(isset($_REQUEST['channel_id'])&&$_REQUEST['channel_id']!=-1){  $condition .=" and channel=".$_REQUEST['channel_id']." ";}

return $condition;
}
/////////////////////////////////////////////////
 function yesOrNo(){
					 echo '<option  value="-1">Select option </option><option value="Yes">Yes</option><option value="No">No</option>';
					 }
					 
function list_ADCluster_assignment($adcluster){
	global $mysqli;
	$q=$mysqli->query("SELECT  `ad_id`,user_id, a.`status`,b.status FROM `tbl_adcluster_asignments` a inner join tbl_users b on a.ad_id=b.user_id WHERE ad_cluster_id=$adcluster AND b.status=0 and a.status=0 group by ad_id")or die($mysqli->error());
	while($row=mysqli_fetch_array($q)){
		echo "<li>".get_name($row['ad_id'])."</li>";
		}
	}
	
	//////
	function select_distributor_channel(){
		?>
		<option value="Other">Other</option><option value="Rural OCCD">Rural OCCD</option><option value="Urban OCCD">Urban OCCD</option><option value="Transit">Transit</option>
        <option value="HVO">HVO</option></select>
		<?php }
		function select_distributor_class(){
		?>
		
		<option value="Other">Other</option><option value="Bronze">Bronze</option><option value="Silver">Silver</option><option value="Gold">Gold</option></select>
		<?php }
		function get_distributor_stock_level($product_id,$distributor_id,$date){
			global $mysqli;
			$qry=$mysqli->query("SELECT qty FROM `tbl_distributor_stock_levels` WHERE DATE(date_taken)='$date' and distributor_id=$distributor_id and product_id=$product_id AND status=0");
			$row=mysqli_fetch_array($qry);
			return $row['qty'];
			}
			
	//////////////////////////////
	function sum_cases_pieces($pid,$cases,$pieces){
		 $units=getColumnName('tbl_products','units_in_a_case', 'product_id='.$pid);
		 $pcs=0;
		 if($pieces!=0)$pcs=number_format($pieces/$cases,0);
		 return $cases+$pcs;
		 }
		 
		 	//////////////////////////////
	function commercialRoutineCheck($table,$condition){
		global $mysqli;
		
		$qry=$mysqli->query("SELECT status FROM $table WHERE $condition limit 1") or die($mysqli->error);
			$r=mysqli_num_rows($qry);
	 if($r>0) 
	return "Yes"; else return "-";
		 }
		 
	function dosa_per_area($area_id,$total_score){ 
	global $mysqli;
	//$month,$parameter
				$q=mysqli_query($mysqli,"SELECT COALESCE(sum(score),0) AS score, count(distinct(dealer_id)) as dealers FROM `tbl_survey` a LEFT JOIN tbl_distributors b ON a.dealer_id=b.distributor_id  WHERE  dealer_type='D' and a.status=0 and area_id=$area_id ") or die(mysqli_error($mysqli));
				$row=mysqli_fetch_array($q);
				$dealers=$row['dealers']; if($dealers<=0);$dealers=1;
				$score=$row['score']; $score=$score/$dealers;
				
				return percentage_conversion_with_decimals($score,$total_score,1);
		
		
		}
		///
	function area_dosa_per_parameter($area_id,$parameter,$param_score){ 
	global $mysqli;
	//$month,$parameter
				$q=mysqli_query($mysqli,"SELECT COALESCE(sum(score),0) AS score, count(distinct(dealer_id)) as dealers FROM (`tbl_survey` a LEFT JOIN tbl_distributors b ON a.dealer_id=b.distributor_id) inner join tbl_survey_questions c on a.q_id=survey_qID  WHERE  dealer_type='D' and a.status=0 and area_id=$area_id and category='$parameter' ") or die(mysqli_error($mysqli));
				$row=mysqli_fetch_array($q);
				$dealers=$row['dealers']; if($dealers<=0);$dealers=1;
				$score=$row['score']; $score=$score/$dealers;
				
				return percentage_conversion_with_decimals($score,$param_score,1);
		
		
		}
		
		function select_qn_categories(){
			?> 
            <option value="Activation">Activation</option>
            <option value="Availability">Availability</option>
            <option value="Cooler">Cooler</option>
                 <option value="Price Compliance">Price Compliance</option>
                                          <option value="Corrective Action">Corrective Action</option>
                                          <option value="Discussion of Opportunities">Discussion of Opportunities</option>
                                          <option value="Outlet Attributes">Outlet Attributes</option>
                                          <option value="Signage">Signage</option>
                                          <option value="Weekly sales">weekly sales</option>
                                          <option value="Brand variants">Brand variants</option>
                                          <option value="WareHousing">WareHousing</option>
                                          <option value="Admin/Operation">Admin/Operation</option>
                                          <option value="ManPower/Routing/Training/Automation">ManPower/Routing/ Training/Automation</option>
                                          <option value="Customer Service/Target Achievement">Customer Service/Target Achievement</option>
                                          
                                          
                                          <option value="All">All</option>
                                          <option value="other">Other</option>
										  <?php }
										  /////////////////////////////////////
										  
	function red_eds_dosa(){
			 ?><option value="eds">EDS</option>
               <option value="red">RED</option>
              <option value="dosa">Dosa</option>
            <option value="both">Both</option>
			<?php }
			
		 
?>