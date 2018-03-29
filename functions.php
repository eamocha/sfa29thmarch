<?php 
date_default_timezone_set('Africa/Nairobi');
////////////////////////////////////////////////
function update_route_plan(){
 $q1=mysql_query("SELECT p.id as id, checkin_id, date(startdate) as dt FROM `tbl_route_plan` p join tbl_check_in c on p.dealer_id=c.dealer_id WHERE p.`dealer_id`=c.`dealer_id` and date(`startdate`)=date(`date_timein`) and c.route_plan_id=0")or die(mysql_error());
 while($row1=mysql_fetch_array($q1)){
	 $id=$row1['id']; $checkin_id=$row1['checkin_id']; $date=$row1['dt'];
	  $up1=mysql_query("UPDATE `tbl_route_plan` SET  `date_visted`='$date' ,stock_taken=1,`merchandized`=1,color='#006410', `visted`=1 WHERE id=$id")or die(mysql_error());
	  //update 2
	  	  $up2=mysql_query("UPDATE `tbl_check_in` SET `route_plan_id`=$id WHERE `checkin_id`=$checkin_id")or die(mysql_error());
	  	  //update 3 for the stock taking
		  $up3=mysql_query("UPDATE `tbl_stock_levels` SET `route_plan_id`=$id WHERE date(`date_added`)='$date'")or die(mysql_error());

	 }
 }
  function update_orders_done(){
 $q1=mysql_query("SELECT p.id as id FROM `tbl_route_plan` p join tbl_orders c on p.dealer_id=c.dealer_id WHERE p.`dealer_id`=c.`dealer_id` and date(`startdate`)=date(`date_made`)  ")or die(mysql_error());
 while($row1=mysql_fetch_array($q1)){
	 $id=$row1['id']; 
	  $up1=mysql_query("UPDATE `tbl_route_plan` SET  order_done=1 WHERE id=$id")or die(mysql_error());
	 
	 }
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

//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
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
//week number
$mysql_errno=mysql_errno();
$mysql_error=mysql_error();
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
		if($user_id==0 or $user_id==''){ echo "No name"; } else{
		 $res = mysql_query("SELECT * FROM tbl_users WHERE user_id=".$user_id) or die(mysql_error()) ;
		 if(mysql_num_rows($res)==0){ return "No name";} else{
 $row = mysql_fetch_array($res);
   return $row['full_name'];}}
   }
   	function get_role($role_id){
		switch($role_id){
			case 1: return 'TSR'; break;case 2: return 'RAD'; break; case 3: return 'DSR'; break; case 4: return 'Operations Mgr'; break; default: return 'unknown';
			}
   }
    	function get_client($c_id){
			if($c_id==0 or $c_id==''){ echo "Name unavailable"; } else{
		 $res = mysql_query("SELECT * FROM `tbl_dealers` WHERE `dealer_id`=$c_id") or die(mysql_error()) ;
 $row = mysql_fetch_array($res);
   return "<b style='text-transform:uppercase;'>". $row['business_name'].'</b>';
   }
   }
   //get the name of the trip
 function get_route($rid){
	   	if($rid==0 or $rid==''){ echo "<b>Name unavailable</b>"; } else{
	 $res = mysql_query("SELECT * FROM `tbl_routes` left JOIN tbl_users on user_id=route_assigned_to WHERE `route_id`=$rid") or die(mysql_error()) ;
 $row = mysql_fetch_array($res);
   echo "<b style='text-transform:uppercase !important'>".$row['route_name'].'</b>';
   }}
 function dealer_route($did){
	 
	   	if($did==0 or $did==''){ return "<b>Not in Route</b>"; } else{
	 $res = mysql_query("SELECT * FROM tbl_dealers d RIGHT JOIN `tbl_routes` r on d.route_id=r.route_id  WHERE d.`dealer_id`=$did") or die(mysql_error()) ;
 $row = mysql_fetch_array($res);
   return "<b style='text-transform:uppercase !important'>".$row['route_name'].'</b>';
   }}
function route_crates($rid)
  {
	  $q=mysql_query("SELECT sum(`cases`) as crates FROM `tbl_orders` o left join tbl_orders_details od on o.order_id=od.dealer_id WHERE route_id=$rid");
	 $i=mysql_fetch_array($q);
	 return $i['crates'];	
}
  
  function order_crates($did){
	   $q=mysql_query("SELECT sum(cases) as crates,o.date_made as dm FROM `tbl_orders` o left join tbl_orders_details od on o.order_id=od.dealer_id WHERE o.`dealer_id`=$did group by DATE(dm)") or die( mysql_error());
	 $i=mysql_fetch_array($q);
	 return $i['crates'].' Crates of Drinks on '.$i['dm'];
	  }
	  
function kinds_of_crates($did,$pid){
	if($pid==0|| $pid==''||$did==0||$did==''){ echo 'Not specified';} else{
	   $q=mysql_query("SELECT sum(cases) as crates, product_name FROM `tbl_orders` o left join tbl_orders_details od on o.order_id=od.dealer_id LEFT JOIN tbl_products p on p.product_id=od.product_id WHERE o.`dealer_id`=$did and od.product_id=$pid ") or die(mysql_error());
	 $i=mysql_fetch_array($q);
	 return $i['crates'].' Crates of '.$i['product_name'];}
	  }
 function price_calc($oid){
	  $total=0;
	   $q=mysql_query("SELECT  o.`cases` as qty,pieces, p.s_price as pr,o.`made_by` as mby, o.`date_added` as da, o.`order_id` as oid, o.`dealer_id` as did, o.`date_supplied` as sd, o.`supplied_by` as sby FROM `tbl_orders_details` o LEFT JOIN tbl_products p on p.product_id=o.product_id WHERE `order_id`=$oid") or die(mysql_error());
	 while($i=mysql_fetch_array($q)){ 
	 $preorder=$i['qty']-$i['pieces'];
	  $total+=$preorder*$i['pr'];
	 }
	 return $total;
	 
	  }
function  business_name($did){
	if($did==0) return 'unaivaible'; else{
		$q=mysql_query("SELECT `business_name`,dealer_id FROM `tbl_dealers` WHERE `dealer_id`=$did LIMIT 1") or die(mysql_error());
		$r=mysql_fetch_array($q);
		$id=$r['dealer_id'];
		return '<a href="client_details.php?dealer_id='.$id.'" ><b style="text-transform:uppercase !important">'.$r['business_name'].'</b></a>';
		  }}
		  //outlet place Name
		  function outlet_position($id){
			  $q=mysql_query("SELECT longtitute,latitute FROM `tbl_dealers` WHERE `dealer_id`=$id LIMIT 1") or die(mysql_error());
		$r=mysql_fetch_array($q);
		$lat=$r['latitute'];
			 $long=$r['longtitute']; return d( Get_Address_From_Google_Maps($lat, $long));
			  }
		  //get name of product given the id of the product
function product_name($id){
	$q=mysql_query("SELECT `product_name` FROM `tbl_products` WHERE `product_id`=$id LIMIT 1") or die(mysql_error());
		$r=mysql_fetch_array($q);
		
		return '<a href="product_details.php?dealer_id='.$id.'">'.$r['product_name'].'</a>';
		  }

	function order_details($order_id){
		$q=mysql_query("SELECT * FROM `tbl_orders_details` o LEFT JOIN tbl_products p on p.product_id=o.product_id WHERE `order_id`=$order_id and o.status !=3") or die(mysql_error());
		if(mysql_num_rows($q)==0) echo 'No products';
		while($r=mysql_fetch_array($q)){
			$req=$r['cases']; 
			$sup=$r['pieces']; 
			$qty=$req-$sup; if($qty==0){} else{
			$ms=' cases of '; if($qty==1) $ms=' case of '; 
		echo  $qty.$ms.$r['product_name'].'('.$r['product_code']. ' ' .$r['brand'].'), ';}
		}
		}
function is_order_available($order_name)
		{$q=mysql_query("SELECT * FROM tbl_orders WHERE order_name='".$order_name."'") or die('Error checking availability of order'); 
		if(mysql_num_rows($q)){
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
function dealer_total_payments($did){
 $d_q=mysql_query("SELECT sum(`amount`) as tt FROM `tbl_payments` WHERE `dealer_id`=$did");
 $res=mysql_fetch_array($d_q);
 return $tt=$res['tt'];
}
function dealer_total_confirmed($did){
 $d_q=mysql_query("SELECT sum(`amount`) as tt FROM `tbl_payments` WHERE `dealer_id`=$did and status=0");
 $res=mysql_fetch_array($d_q);
 return $tt=$res['tt'];
}
function routes()
{ $routes=mysql_query("SELECT * FROM `tbl_routes` WHERE `status`=0")or die(mysql_error()); while($row=mysql_fetch_array($routes)){?><option value="<?php echo $row['route_id']?>"><?php echo $row['route_name']?></option>
<?php }}
//end of the routes funstion

//get vehicle
function get_vehicle($vid){
 $d_q=mysql_query("SELECT * FROM `tbl_vehicles` WHERE `v_id`=$vid and status=0");
 $res=mysql_fetch_array($d_q);
 return $res['reg_no'];
}
//get vehicle
function assigned_vehicle($user_id){
 $d_q=mysql_query("SELECT * FROM `tbl_vehicles` WHERE `added_by`=$user_id and status=0");
 if(mysql_num_rows($d_q)==0){ return 'Unassigned';} else{
 $res=mysql_fetch_array($d_q);
 return $res['reg_no'];}
}
	//all dealers in route		
function all_dealers_in_route($user_id,$date){
 $q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id and DATE(`startdate`)='$date'")or die(mysql_error()); return mysql_num_rows($q);
}
function already_visted($user_id,$date){
 $q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id and DATE(`startdate`)='$date' and visted=1")or die(mysql_error()); $num=mysql_num_rows($q);  if($num==0) return 0; else return '<a href="already_v.php">'.$num.'</a>';
}
function cancelled_route($user_id,$date){
 $q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id and DATE(`startdate`)='$date' and status=1")or die(mysql_error());  $num=mysql_num_rows($q);  if($num==0) return 'none'; else return '<a href="cancelled.php">'.$num.'</a>';
}
//function to check whether there was a visit to an outlet
function check_visit($plan_id){
	$d_q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE id=$plan_id and visted=1 LIMIT 1") or die (mysql_error());
	if(mysql_num_rows($d_q)==0){ return $visit_id=0;} 
 else{ 
 $tt=mysql_fetch_array($d_q);
return $visit_id=$tt['id'];
}
}
//visted dealers in a route
function merchandized($uid,$today){
 $d_q=mysql_query("SELECT count(*) as number FROM `tbl_check_in` WHERE `user_id`=$uid") or mysql_error();
 if(mysql_num_rows($d_q)==0) 
 return 1; 
 else{
$tt=mysql_fetch_array($d_q);
return $tt['number'];}
} 
function check_merchandized($plan_id,$dealer_id){
$d_q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE stock_taken=1 and id=$plan_id limit 1") or mysql_error();
$r=mysql_fetch_array($d_q);
 if(mysql_num_rows($d_q)==1) 
 return '<a class="btn btn-success btn-sm" href="mechandize.php?plan_id='.$plan_id.'&dealer_id='.$dealer_id.'">Merchandize>></a>'; 
 else if($r['merchandize']==1){

return '<a href="visit_report.php?plan_id='.$plan_id.'&dealer_id='.$dealer_id.'">Report</a>'; }
}

// fetch days' dealers
function today_dealers($user_id,$date){
 $i=1; $rp_id=0;
$today=date("Y-m-d",strtotime($date));
  $q=mysql_query("SELECT * FROM `tbl_route_plan` rp LEFT JOIN tbl_dealers d on d.dealer_id=rp.dealer_id WHERE `assigned_to`=$user_id and DATE(`startdate`)='$today' and rp.status=0 and d.status=0")or die(mysql_error()); if(mysql_num_rows($q)==0){ echo '<tr><td colspan=7>No assigned outlets today. Good day!</td><tr>';} else {
							while($r=mysql_fetch_array($q)){ 
							$dealer_id=$r['dealer_id']; $rp_id=$r['id'];					  
							?>
                            <tr>
                                  <td><?php echo $i;?></td>
                                  <td ><?php echo business_name($dealer_id)?></td>
                                  <td><?php echo $r['town'].' '.$r['place_name'];?></td>
                                  <td><?php echo $r['owner_name'].' '. $r['phone']?></td>
                                  
                                  <td><?php echo previus_visit_notes($dealer_id)?></td>
                                   <td ><?php visit_progress($dealer_id,$rp_id)?></td>
                              </tr><?php $i++; }} //end else and while
							  }
function previus_visit_notes($did){
	$message=""; //and date(date_timein)!='$today'
	
	$merc_q=mysql_query("SELECT * FROM `tbl_check_in` WHERE `dealer_id`=$did order by checkin_id  desc limit 1") or die(mysql_error());$m_row= mysql_fetch_array($merc_q); $message.=$m_row['description'];
	//getc orders and preorders
	
	return $message;
	}
	//ast vist date
	function last_visit_date($did){
		
	$lastV=mysql_query("SELECT * FROM `tbl_route_plan` WHERE `dealer_id`=$did and visted=1 order by id  desc limit 1") or die(mysql_error());
	if(mysql_num_rows($lastV)==0){ return "Never";} else {
		$m_row= mysql_fetch_array($lastV); $date=$m_row['date_visted'];
	
	return $date;}
	}
 function check_visit_status($did,$date){
	 $lastV=mysql_query("SELECT visted  FROM `tbl_route_plan` WHERE `dealer_id`=$did and date(startdate)='$date' and status=0 order by id  desc limit 1") or die(mysql_error());
	 if(mysql_num_rows($lastV)==0){ return survey_history(0);} else{
	 $r=mysql_fetch_array($lastV);
	 return survey_history($r["visted"]);
	 }
	 
	 }
function visits_per_outlet_per_month($outlet,$date){
	 $lastV=mysql_query("SELECT visted  FROM `tbl_route_plan` WHERE `dealer_id`=$did and date(startdate)='$date' and status=0 order by id  desc limit 1") or die(mysql_error());
	 if(mysql_num_rows($lastV)==0){ return survey_history(0);} else{
	 $r=mysql_fetch_array($lastV);
	 return survey_history($r["visted"]);
	 }
	}
							  //end
function visit_progress($dealer_id,$rp_id){
	 $q=mysql_query("SELECT `stock_taken`,merchandized,order_done FROM `tbl_route_plan` WHERE `id`=$rp_id limit 1")or die(mysql_error());
	 $stock=mysql_fetch_array($q);
	 if($stock["stock_taken"]==0){  echo '<a href="take_stock.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Take Stock</a>'; } else {
		 //check mechndizing
		 
		  if($stock["stock_taken"]==1 && $stock["merchandized"]==0){
		echo '<a href="take_stock.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Stock</a>|<a href="mechandize.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Merchandize</a>';}
		else if($stock["merchandized"]==1){
			echo '<a href="take_stock.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Stock</a>|<a href="mechandize.php?dealer_id='.$dealer_id.'&plan_id='.$rp_id.'">Merchandize</a>|<a href="create_order.php?dealer_id= '.$dealer_id.' &plan_id='.$rp_id.'">Make order</a>|<a href="visit_report.php?dealer_id='.$dealer_id .'&plan_id='.$rp_id.'">Report</a>';} }
	
	}
							  
function stock($did,$package,$pid,$date){
 $d_q=mysql_query("SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did and DATE(`date_added`)='$date'and product_id=$pid ");
 if(mysql_num_rows($d_q)==0) return '-';;
$tt=mysql_fetch_array($d_q);
if($package=='cases')  return $tt['cases']; else return $tt['singles'];
}
function stock_taking_report($did,$package,$pid,$plan_id){
 $d_q=mysql_query("SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did and route_plan_id=$plan_id and product_id=$pid ");
 if(mysql_num_rows($d_q)==0) return '-';;
$tt=mysql_fetch_array($d_q);
if($package=='cases')  return $tt['cases']; else return $tt['singles'];
}

	
//function to show case the number of products by a tsr in a certain day
function stock_individual($did,$package,$pid,$date,$uid){
 $d_q=mysql_query("SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did and DATE(`date_added`)='$date'and product_id=$pid and user_id=$uid");
 if(mysql_num_rows($d_q)==0) return '-';;
$tt=mysql_fetch_array($d_q);
if($package=='cases')  return $tt['cases']; else return $tt['singles'];
}

function survey($did,$col,$date){
	 $d_q=mysql_query("SELECT * FROM `tbl_check_in` WHERE date(`date_timein`)='$date' AND `dealer_id`=$did ");
 if(mysql_num_rows($d_q)==0) return '-';
$tt=mysql_fetch_array($d_q);
if($col=="description") echo $tt['description']; else{
if($tt[$col]==1)echo '<i class=" fa fa-check"></i>'; else  echo '<i class=" fa fa-times"></i>';}
}
function survey_history($col){
if($col==1){return '&#10003;';} else  return '&times;';
}
function survey_percentage($r){
	$count_p=0;$count_n=0;
if($r==1) $count_p++; else  echo $count_n++;
return $count_p*100/($count_n+$count_p);
}
//routes completion
function expected_outlets_to_visit($uid,$date ){
	 $q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$uid and DATE(`startdate`)='$date' and status=0")or die(mysql_error());
	return mysql_num_rows($q);
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
function actual_day_visits($uid,$date ){
	 $q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE date(`date_visted`)='$date' and status=0 and `visted`=1 and `assigned_to`=$uid")or die(mysql_error());
	return mysql_num_rows($q);
	}
	
function visted_outlets($user_id,$d_w_started,$date1 ){
	//start of week/sunday
	$d_w_started=first_day_of_week($d_w_started);// getting the date of the previus sunday. in form of Y-m-d
	$add=0;
	if($date1=='mon') $add=86400; else if($date1=='tue') $add=86400*2;else if($date1=='wed') $add=86400*3;else if($date1=='thur') $add=86400*4;else if($date1=='fri') $add=86400*5;else if($date1=='sat') $add=86400*6;else if($date1=='sun') $add=86400*7;
	$specific_day=date('Y-m-d',strtotime($d_w_started)+$add);
//get visit details
 $q=mysql_query("SELECT distinct(dealer_id) as did FROM `tbl_stock_levels` WHERE DATE(date_added)='$specific_day' and `user_id`=$user_id")or die(mysql_error());
	return mysql_num_rows($q);
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
function weekly_plan($date,$week,$tsr){ 
$between=find_week_dates($date,$week,'date_visted');
$q=mysql_query("SELECT count(*) as tt FROM `tbl_route_plan` WHERE status=0 and $between and assigned_to=$tsr ")or die(mysql_error());
$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return 0; else return $c;
	}
	//planned in a week
	function weekly_route_completion($date,$week,$tsr){ 
	 $between=find_week_dates($date,$week,'date_visted');
$q=mysql_query("SELECT count(*) as tt FROM `tbl_route_plan` WHERE status=0 and visted=1 and $between and assigned_to=$tsr ")or die(mysql_error());
$r=mysql_fetch_array($q);
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
	//total regional weekly plan
	function region_weekly($date,$week,$region){ 
	 $between=find_week_dates($date,$week,'date_visted');
	
$q=mysql_query("SELECT count(id) as tt FROM `tbl_route_plan` p right join tbl_users u on u.user_id=p.assigned_to WHERE region_id=$region and p.status=0  and u.status=0 and $between and visted=1")or die(mysql_error());
$r_visted=mysql_fetch_array($q);
	$c= $r_visted['tt'];
	
	 //get the unvisted
	 $planned_q=mysql_query("SELECT count(id) as tt FROM `tbl_route_plan` p right join tbl_users u on u.user_id=p.assigned_to WHERE region_id=$region and p.status=0  and u.status=0 and $between ")or die(mysql_error());
$plan_row=mysql_fetch_array($planned_q);
	$plans= $plan_row['tt'];
	if($plans==0)return 0; else{return number_format($c/66,3)*100 .'%';;
	}
	
	}
function weekly_strike_rate($date,$week,$tsr){
	$between =find_week_dates($date,$week,'date_made');
	
$q=mysql_query("SELECT count(*) as tt FROM `tbl_orders` WHERE $between and `preordered_by`=$tsr and status!=3 group by order_id")or die(mysql_error());
$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return 0; else return $c;
	}//%age weekly strike rate
	
	function percentage_weekly_strike_rate($date,$week,$tsr){
		if(weekly_route_completion($date,$week,$tsr)==0) return 0; else{ return number_format(weekly_strike_rate($date,$week,$tsr)/weekly_route_completion($date,$week,$tsr),3)*100 .'%';}
		
		
		
		}

	//strike rate regional per week
	function regional_strike_rate_weekly($date,$week,$region){
	$between =find_week_dates($date,$week,'date_visted');
	//get the outlets visited that week
	$q=mysql_query("SELECT count(id) as tt FROM `tbl_route_plan` p right join tbl_users u on u.user_id=p.assigned_to WHERE region_id=$region and p.status=0  and u.status=0 and $between and visted=1")or die(mysql_error());
$r_visted=mysql_fetch_array($q);
$visited= $r_visted['tt'];

	$between =find_week_dates($date,$week,'date_made');
$q=mysql_query("SELECT count(o.order_id) as tt FROM `tbl_orders` o right join tbl_dealers d on d.dealer_id=o.dealer_id WHERE $between  and o.status!=3 and region_id=$region")or die(mysql_error());
$r=mysql_fetch_array($q);
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
	if($lat==0){ echo 'No co-ordinates'; } else{

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
function num_outlets($region_id){
$res=mysql_query("SELECT * FROM `tbl_dealers` WHERE region_id=$region_id and status=0") or die(mysql_error());
	return mysql_num_rows($res);
 	}
function num_outlets_gps($region_id){
$res=mysql_query("SELECT * FROM `tbl_dealers` WHERE longtitute!=0 and region_id=$region_id and status=0") or die(mysql_error());
	return mysql_num_rows($res);
 	}
 
function region_name($region_id)
{
$res=mysql_query("SELECT * FROM `tbl_regions` WHERE region_id=$region_id ") or die(mysql_error());
	 $r=mysql_fetch_array($res);
	 return '<a style="text-transform:uppercase !important" href="region_outlets.php?region_id='.$region_id.'">'.$r['region_name'].'</a>';
}
	function get_region_from_dealerID($dealer_id){
		$res=mysql_query("SELECT * FROM `tbl_dealers` WHERE dealer_id=$dealer_id") or die(mysql_error());
	if(mysql_num_rows($res)>0){ $row=mysql_fetch_array($res);
		return region_name($row['region_id']);
		}
		}
	function visited_today($uid,$date){
		$q=mysql_query("SELECT * FROM `tbl_check_in` WHERE date(`date_timein`)='$date' and `user_id`=$uid") or die();
		return mysql_num_rows($q);
		}
		function visited_thisweek($uid){
			
		$q=mysql_query("SELECT * FROM `tbl_check_in` WHERE date(`date_timein`)>date(NOW()) date(`date_timein`)<date(now()) and  and `user_id`=$uid") or die();
		return mysql_num_rows($q);
		}
	//delete region
	function delete_region($region_id){
$res=mysql_query("UPDATE `tbl_regions` SET `status`=1 WHERE `region_id`=$region_id") or die(mysql_error());
if($res){
	 goback();
}
 	}
		//region name 
	function region($id){
$res=mysql_query("SELECT * FROM `tbl_regions` WHERE `region_id`=$id") or die(mysql_error());
$row=mysql_fetch_array($res);
return $row['region_name'];

}
function region_selection(){
	$res=mysql_query("SELECT * FROM `tbl_regions` where status=0") or die(mysql_error());
while($row=mysql_fetch_array($res)){
echo '<option value="'.$row['region_id'].'">'.$row['region_name'].'</option>';
}
	}
function user_select_list($id){
	$return= "<select class='form-control' name='assign_to'><option value='".$id."'>My self</option>";
	$q=mysql_query("SELECT user_id,full_name FROM tbl_users WHERE status=0 ORDER BY full_name asc")or die(mysql_error());
	while($r=mysql_fetch_array($q)){
		$return.= "<option value='".$r['user_id']."'>".$r['full_name']."</option>";
		}
		$return.= "</select>";
		return $return;
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
  
   $header = "From:info@kingbeverage.co.ke\r\n";
  
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
   
   $header = "From:info@kingbevdms.com";
  
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
function get_product_name($pid){
	$q=mysql_query("SELECT `product_name` FROM `tbl_products` WHERE `product_id`=$pid LIMIT 1")or die(mysql_error());
	if(mysql_num_rows($q)==0){ return 'Unknown';
		} else{
			$row=mysql_fetch_array($q);
			return $row["product_name"];		
					}
	}
//functions to count number sals by brand
function sales_by_brand_all($id){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and status !=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//this month
	function sales_by_brand_this_month($id){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and MONTH(date_supplied)= MONTH(NOW()) and status!=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//this week
	function sales_by_brand_this_week($id){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and WEEK(date_supplied)= WEEK(NOW()) and status!=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		
		//this today
	function sales_by_brand_today($id){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `product_id`=$id and DATE(date_supplied)= DATE(NOW()) and status!=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//all by sals people
function sales_by_tsr_all($uid){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//	//present month by sales people
function sales_by_tsr_this_month($uid){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3 and MONTH(date_supplied)= MONTH(NOW())") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//	//current week sales by sales people
function sales_by_tsr_this_week($uid){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3 and week(date_supplied)= week(NOW())") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
				//	//current week sales by sales people
function sales_by_tsr_this_today($uid){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and status!=3 and date(date_supplied)= date(NOW())") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		
		//function total for sales for a outlet
function sales_by_outlet_total($id){
	$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `dealer_id`=$id and status!=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
		}
		//sales per outlet per month
function sales_by_outlet_month($date,$id){ 
$id=(int) $id;
$month=date('m', strtotime($date));
$year=date('Y',strtotime($date));
			$q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `dealer_id`=$id and MONTH(date_added)='$month'  and YEAR(date_added)='$year' and status!=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
			}
//last day of Visit
function sales_by_outlet_lastvisit($id){
	$q=mysql_query("SELECT dealer_id, date_added FROM `tbl_orders_details` WHERE `dealer_id`=$id and status!=3 ORDER BY order_details_id asc limit 1") or die(mysql_error());
	if(mysql_num_rows($q)==0) return '-'; else{
	$r=mysql_fetch_array($q);
	$c= date("d.m.Y",strtotime($r['date_added']));
	 if($c==0) return '-'; else return $c;
			}//else
			}
			
			
			//functions for summary report
			
function total_outlets_in_region($rid){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=0 and `region_id`=$rid") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//total outlets by category in a region
	function total_outlets_categories_in_region($rid,$category){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE channel=$category and region_id=$rid and `status`=0 and `region_id`=$rid") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	function total_deleted_in_region($rid){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=1 and `region_id`=$rid") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//total people on a certain region
	function check_number_of_pple_in_region($rid){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_users` WHERE `status`=0 and `region_id`=$rid") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '1'; else return $c;
	}
	//for outlets visted bewtween a certain period by a certain person
	function outlets_visted_per_time($uid,$start,$end ){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_check_in` WHERE `status`=0 and `user_id`=$uid and DATE(`date_timein`) BETWEEN '$start' AND '$end' and status=0") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//for outlets added between a caetain period
	function outlets_added_per_time($uid,$start,$end ){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=0 and `added_by`=$uid and DATE(`reg_date`) BETWEEN '$start' AND '$end'") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//outlets added in a day
	function outlets_added_in_day($uid,$day){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE `status`=0 and `added_by`=$uid and DATE(`reg_date`)='$day'") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	function prospecting_outlets_added_in_day($uid,$day){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE  `added_by`=$uid and prospecting=1 and DATE(`reg_date`)='$day'") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//out of the number of outlets visited how many did he sale
	function day_strike_rate($uid,$day){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_orders_details` WHERE cases,pieces!=0 and DATE(`date_added`)='$day' and `made_by`=$uid GROUP BY `dealer_id`") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//cases and pieces in outlet at specific day
	function days_stock_levels($uid,$day,$package){
	$q=mysql_query("SELECT sum($package) as tt FROM `tbl_stock_levels` WHERE DATE(`date_added`)='$day' AND `user_id`=$uid and `status`=0") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	//cases and pieces in outlet at specific day
	function days_orders_deliveries($uid,$day,$d_or_s){
	$q=mysql_query("SELECT sum($d_or_s) as tt FROM `tbl_orders_details` WHERE `made_by`=$uid and DATE(`date_added`)='$day' AND status=0") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	}
	
	//stock required
	function stock_required_per_period($uid,$start,$end){
	$q=mysql_query("SELECT SUM(`cases`) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and DATE(date_added BETWEEN '$start' AND '$end') AND status !=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//stock delivered in a certain perid
	//stock required
	function stock_supplied_per_period($uid,$start,$end){
	$q=mysql_query("SELECT SUM(cases,pieces) as qty FROM `tbl_orders_details` WHERE `made_by`=$uid and DATE(date_added BETWEEN '$start' AND '$end') AND status !=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//orders made depending on aount required vs amount supplied
	function orders_in_period($uid,$start,$end){
	$q=mysql_query("SELECT SUM(`cases`) as qty FROM `tbl_orders_details` WHERE pieces<cases AND `made_by`=$uid and DATE(date_added BETWEEN '$start' AND '$end') AND status !=3") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['qty'];
	 if($c==0) return '0'; else return $c;
	
	}
	//
	//orders made depending on aount required vs amount supplied
	function o_advert($uid,$start,$end){
	$q=mysql_query("SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `outside_advert`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' and status=0 ") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	
	function in_advert($uid,$start,$end){
	$q=mysql_query("SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `inside_advert`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' ") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	
	function fridge_av($uid,$start,$end){
	$q=mysql_query("SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `fridge`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' ") or die(mysql_error());
	$r=mysql_fetch_array($q);
	$c= $r['tt'];
	 if($c==0) return '0'; else return $c;
	
	}
	function fridge_na($uid,$start,$end){
	$q=mysql_query("SELECT COUNT(*) AS tt FROM `tbl_check_in` WHERE `ownership`=1 and user_id=$uid AND DATE(`date_timein`) BETWEEN '$start' AND '$end' ") or die(mysql_error());
	$r=mysql_fetch_array($q);
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
   }//end the section checking type
    
    
    } else {
      return 'Edited photo'; 
    } 
	
		}
function channel_type($channel){
				$query=mysql_query("SELECT * FROM `tbl_outlet_classification` WHERE `outlet_class_id`=$channel and status=0")or die(mysql_error());$row=mysql_fetch_array($query);
			return $row['class_name'];
						}
	function times_visited($dealer){
		$q=mysql_query("SELECT `dealer_id` FROM `tbl_route_plan` WHERE `dealer_id`=$dealer and visted=1")or die(mysql_error());
		return mysql_num_rows($q);
		}
		function times_visted_in_month($dealer,$month,$year){
		$q=mysql_query("SELECT `dealer_id` FROM `tbl_route_plan` WHERE `dealer_id`=$dealer and visted=1 and MONTH(startdate)='$month' and YEAR(startdate)='$year'")or die(mysql_error());
		return mysql_num_rows($q);
		}
	function outlet_last_visit($outlet_id){ //NB it is based on the cheeckin details
		$q=mysql_query("SELECT startdate FROM `tbl_route_plan` WHERE `dealer_id`=$outlet_id and visted=1  and status =0 order by id desc limit 1 ")or die(mysql_error());
		if(mysql_num_rows($q)==0){ return "Never Visted";} else {
		$r=mysql_fetch_array($q);
		return record_date($r["startdate"]);
		}//end else
	}
function stock_given($pid,$user,$date){
	 $q=mysql_query("SELECT number FROM `tbl_stock_given` WHERE DATE(`date_given`)='$date' and product_id=0 and given_to=$user");
	 if(mysql_num_rows($q)==0){ return 0;} else{
 $res=mysql_fetch_array($q);
 return $tt=$res['number'];}
	
		}
		
function num_registered_monthly($year_month,$region_id){
		
		$query=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE EXTRACT(YEAR_MONTH FROM `reg_date` )='$year_month' and status=0 and `region_id`=$region_id")or die(mysql_error());
		 $row=mysql_fetch_array($query); return "<a href='new_outlets_list.php?year_month=".$year_month."&region_id=".$region_id."'>".$row['tt']."</a>";
		} 
function brand_amount_sold($pid,$user,$date){
	 $q=mysql_query("SELECT sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `product_id`=$pid and `made_by`=$user and DATE(`date_added`)='$date'");
	 if(mysql_num_rows($q)==0){ return 0;} else{
 $res=mysql_fetch_array($q);
 return $tt=$res['qty'];}
	}
	//functions to count all orders including expired
	
	function all_orders_in_region($region_id){
		$exp_q=mysql_query("SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE d.region_id=$region_id") or die(mysql_error()); return  mysql_num_rows($exp_q);
		
		}
		//serviced orders
		function serviced_orders_in_region($region_id){
		$exp_q=mysql_query("SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE o.status=1 and d.region_id=$region_id") or die(mysql_error()); return  mysql_num_rows($exp_q);
		
		}
		function rejected_orders_in_region($region_id){
		$exp_q=mysql_query("SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE o.status=4 and d.region_id=$region_id") or die(mysql_error()); return  mysql_num_rows($exp_q);
		
		}
			
	function expired_orders($region_id){
		$exp_q=mysql_query("SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE date(`date_due`)<date(now()) and o.status=0 and d.region_id=$region_id") or die(mysql_error()); return  mysql_num_rows($exp_q);
		
		}
function upcoming_orders($region_id){
		$exp_q=mysql_query("SELECT * FROM `tbl_orders` o left Join `tbl_dealers` d on d.dealer_id=o.dealer_id WHERE date(`date_due`)>date(now()) and o.status=0 and d.region_id=$region_id") or die(mysql_error()); return  mysql_num_rows($exp_q);
		
		}
function years_in_orders()
{   
	$query=mysql_query("SELECT YEAR(`date_made`) as year FROM `tbl_orders` where  YEAR(`date_made`) !='' and YEAR(`date_made`) !=0 group by YEAR(`date_made`) ")or die(mysql_error());
	while($rw=mysql_fetch_array($query)){
		echo "<option value=".$rw['year'].">".$rw['year']."<option >";
		}
		
	}
	function make_plan($startdate,$did,$made_by,$vist_status){
	$uid=$_SESSION['u_id'];
	$today=date('Y-m-d');
	//check whether it has been scheduled before rescheduling again
	$q=mysql_query("SELECT * FROM tbl_route_plan  where dealer_id=$did and date(startdate)='$startdate' and status=0")or die(mysql_error());
	if(mysql_num_rows($q)==0){
	if(strtotime($startdate)>=strtotime($today)){
	$insert = mysql_query("INSERT INTO tbl_route_plan( `dealer_id`, visted,`made_by`, `assigned_to`, `startdate`, `enddate`, `allDay`) VALUES($did, $vist_status,$uid,$made_by,'$startdate','$startdate','false')");
	}}
	}
		function prospect_prices($dealer_id,$i){
			$q=mysql_query("SELECT `price`,`remarks` FROM `tbl_prospecting` WHERE `item_id`=$i and status=0 and `dealer_id`=$dealer_id") or die(mysql_error("error"));
			if(mysql_num_rows($q)==0){  return '-';} else{
			$r=mysql_fetch_array($q);
	$c= $r['price'];
	 if($c==0) return '-'; else return $c;}
			}
			
			//Sales to Key Distributors/Key Account
function regional_cases_sell_in($region_id,$date){
	$q=mysql_query("SELECT sum(cases,pieces) as tt FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE  date( `date_added`)='$date' and region_id=$region_id and `type_of_outlet`=1") or die(mysql_error());
	if(mysql_num_rows($q)==0){ return 0;}
	else{
			$row=mysql_fetch_array($q);
			return $row["tt"];
			}
	
	}

			//dashborad report functions
	function regional_cases_sell_out($region_id,$date){
		$q=mysql_query("SELECT sum(cases,pieces) as tt FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE  date( `date_added`)='$date' and region_id=$region_id and `type_of_outlet`=0") or die(mysql_error());
	if(mysql_num_rows($q)==0){ return  0;}
	else{
			$row=mysql_fetch_array($q);
			return $row["tt"];
			}
	
		
		}
	
function region_success_strike_outlets($region_id,$date){
	$q=mysql_query("SELECT count(*) as tt FROM `tbl_orders_details` od RIGHT JOIN tbl_dealers d on d.dealer_id=od.dealer_id WHERE date(`date_added`)='$date' and `region_id`=$region_id")or die(mysql_error());
	if(mysql_num_rows($q)==0){ return  0;}
	else{
			$row=mysql_fetch_array($q);
			return $row["tt"];
			}
	
	}

function regional_total_sales_in_aday($region_id,$date){
	$q=mysql_query("SELECT sum(pieces) as tt FROM `tbl_orders_details` od RIGHT JOIN tbl_dealers d on d.dealer_id=od.dealer_id WHERE date(`date_added`)='$date' and `region_id`=$region_id")or die(mysql_error());
	if(mysql_num_rows($q)==0){ return  0;}
	else{
			$row=mysql_fetch_array($q);
			return $row["tt"];
			}
	
	}	
	
function new_listing_sales($did,$pid,$date){
	$date=date("Y-m-d",strtotime($date));
	$q=mysql_query("SELECT * FROM `tbl_orders_details` WHERE `product_id`=$pid and date(`date_added`)='$date' and `dealer_id`=$did")or die(mysql_error());
	if(mysql_num_rows($q)==0){ return  0;
		}
		else{
			$row=mysql_fetch_array($q);
			return $row["pieces"];
			}
		
}

function region_new_outlet_sale_out_cases($region,$date){
	$date=date("Y-m-d",strtotime($date));
	$q=mysql_query("SELECT sum(pieces) as pieces FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE region_id=$region and date(`date_added`)='$date'")or die(mysql_error());
	if(mysql_num_rows($q)==0){ return  0;
		}
		else{
			$row=mysql_fetch_array($q);
			return $row["pieces"];
			}
		
}
function period_btn_2dates($date1,$date2){
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
	
function regional_repeat_sales_outlet($region_id, $date){
	$date=date("Y-m-d",strtotime($date));
	$q=mysql_query("SELECT count(distinct(od.dealer_id)) as tt FROM `tbl_orders_details` od right join tbl_dealers d on d.dealer_id=od.dealer_id WHERE region_id=$region_id and date(`date_added`)='$date'")or die(mysql_error());
	if(mysql_num_rows($q)==0){ return  0;
		}
		else{
			$row=mysql_fetch_array($q);
			return $row["tt"];
			}
		}
function save_classification()
{
		$date=date("Y-m-d");
		$uid=$_SESSION['u_id'];
		$class_name=clean($_REQUEST['category_name']);
		$descr=clean($_REQUEST['description']);
	$insert = mysql_query("INSERT INTO tbl_outlet_classification(`added_by`, `date_added`, `class_name`, `description`) values ($uid,'$date','$class_name','$descr')")or die(mysql_error());
	}
function category_select_list(){
	$q = mysql_query("SELECT * FROM tbl_outlet_classification where status=0")or die(mysql_error());
	while($row=mysql_fetch_array($q))
	{
	echo "<option value=".$row['outlet_class_id'].">".$row['class_name']."</option>";	}
	}
	function total_outlets_in_route($route_id){
		$q=mysql_query("SELECT count(*) as tt FROM `tbl_dealers` WHERE status=0 and `route_id`=$route_id")or die(mysql_error());
		$r=mysql_fetch_array($q);
		return $r['tt'];
		}
function get_user_region($user_id){
	$res=mysql_query("SELECT * FROM `tbl_users` WHERE user_id=$user_id ") or die(mysql_error());
	 $r=mysql_fetch_array($res);
	 return $r['region_id'];
	 }

?>