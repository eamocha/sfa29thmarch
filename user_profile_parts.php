<?php
   include_once("assets/lib/config.php");
     include_once("assets/lib/functions.php");
	 
   $mode=$_REQUEST['mode']; $user_id=$_REQUEST['user_id'];
   $this_month=date("m");   $daysInMonth=daysInMonth(date('Y'),date('m'));$tarehe=date('d');
   
   ////////////region details
   if($mode=="user_summary"){

 $mysql_q=$mysqli->query("SELECT * from tbl_users where user_id=$user_id");
									$r=mysqli_fetch_array($mysql_q); $area_id=$r['area_id']; $sub_area_id=$r['cluster_id']; $area_id=$r['area_id']; $area_id=$r['area_id']; $leave_from=$r["leave_from"];$leave_to=$r["leave_to"];
									?>
									<table width="100%"class="table table-bordered table-striped table-condensed" >
                               <tr>
                               <td >Area</td>  <td width="15%"><?php echo area_name($area_id)?></td>
                               <td >Sub Area</td>
                               <td ><?php echo sub_area_name($sub_area_id)?></td>
                               <td >Ad clusters</td>
                               <td ><?php echo  num_rows("`tbl_ad_clusters` adc RIGHT JOIN tbl_adcluster_asignments ada on ada.ad_cluster_id=adc.ad_cluster_id","ada.ad_id=$user_id AND ada.status=0")?></td>
                               <td>Routes</td>
                               <td><?php echo  num_rows("tbl_routes","route_id IN(SELECT route_id FROM `tbl_assign_route2adcluster` adc RIGHT JOIN tbl_adcluster_asignments ada on ada.ad_cluster_id=adc.ad_cluster_id WHERE ada.ad_id=$user_id) and status=0")?></td>
                               </tr>
                             
                               <tr>
                                  <td>Total outlets</td>
                                 <td><?php echo  num_rows("tbl_dealers","route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$user_id) and status=0 ")?> </td>
                                  <td>Verified outlets </td>
                                 <td><?php echo  num_rows("tbl_dealers","route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$user_id) and status=0 AND verified=1 AND type_of_class in ('Bronze','Silver','Gold','Other')")?></td>
                                 <td>Total Assets</td>
                                 <td><?php echo  num_rows("tbl_assets a INNER JOIN tbl_dealers b ON b.dealer_id=a.dealer_id INNER JOIN tbl_assign_route2adcluster d ON d.`route_id`=b.route_id INNER JOIN tbl_adcluster_asignments c ON c.ad_cluster_id=d.ad_cluster_id","c.ad_id=$user_id and a.status=0")?></td>
                                 <td>Verified Assets</td>
                                 <td><?php echo  num_rows("tbl_assets a INNER JOIN tbl_dealers b ON b.dealer_id=a.dealer_id INNER JOIN tbl_assign_route2adcluster d ON d.`route_id`=b.route_id INNER JOIN tbl_adcluster_asignments c ON c.ad_cluster_id=d.ad_cluster_id","c.ad_id=$user_id and a.status=0 and verification_status='Verified'")?></td>
                               </tr>
                                 <tr>
                                 <td>Reg. Outlets</td>
                                 <td><?php echo  num_rows("tbl_dealers","added_by=$user_id")?></td>
                                 <td>Visited</td>
                                 <td><?php echo  num_rows("tbl_route_plan","visted=1 and  status=0 and made_by=$user_id")?></td>
                                 <td>Planned</td>
                                 <td><?php echo  num_rows("tbl_route_plan"," status=0 and made_by=$user_id")?></td>
                                 <td>Assets Reg</td>
                                 <td><?php echo  num_rows("tbl_assets","status=0 and reg_by=$user_id")?></td>
                                 </tr>
                               
                                
                                 <tr>
                                 <td>Percentage Contribution</td>
                                 <td><?php echo  sum_columns("tbl_routes","route_contribution","route_id IN(SELECT route_id FROM `tbl_assign_route2adcluster` adc RIGHT JOIN tbl_adcluster_asignments ada on ada.ad_cluster_id=adc.ad_cluster_id WHERE ada.ad_id=$user_id and ada.status=0 and adc.status=0) and status=0")*100?></td>
                                 <td>This Month Target</td>
                                 <td><?php echo sum_columns("tbl_routes","this_month_target","route_id IN(SELECT route_id FROM `tbl_assign_route2adcluster` adc RIGHT JOIN tbl_adcluster_asignments ada on ada.ad_cluster_id=adc.ad_cluster_id WHERE ada.ad_id=$user_id and ada.status=0 and adc.status=0) and status=0")?></td>
                                 <td>Sales MTD(Based On route saless)</td>
                                 <td><?php echo  sum_columns("tbl_route_sales","qty_sold"," status=0 AND Month(date_sold)='$this_month' and sold_by=$user_id and route_id IN(SELECT route_id FROM `tbl_assign_route2adcluster` adc RIGHT JOIN tbl_adcluster_asignments ada on ada.ad_cluster_id=adc.ad_cluster_id WHERE ada.ad_id=$user_id and ada.status=0 and adc.status=0) ")?></td>
                                 <td>Leave Days</td>
                                 <td><?php $leave_from." - ".$leave_to ?></td>
                                 </tr>
                               </table>
                               
                               
                               <table>
                               <tr>
                                 <td colspan="6"><strong>Monthly Perfomance</strong></td>
</tr></table>
                               <table class="table table-bordered table-striped table-condensed" width="100%">
                               <tr>
                                 <td><strong>Date</strong></td>
                                 <td><strong>Route</strong></td>
                                 <td><strong>New Outlets</strong></td>
                                 <td><strong>New Assets</strong></td>
                                 <td><strong>Visited</strong></td>
                                 <td>Stock Sold</td>
                               </tr>
                               <?php $q=$mysqli->query("SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$user_id group by startdate") or die(mysqli_error($mysqli));
							   while($row=$q->fetch_assoc()){
								   ?>
								   <tr>
                               
                                 <td><?php echo $row["startdate"]?></td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                               </tr><?php
								   }?>
                               

</table>
<?php
   }////////////////mode
   
  /////end tyhe  elseif($mode=="region_volume_perfomance"){ mode
     elseif($mode=="verified_outlets"){
		$i=1;
	 	$user_id=$_REQUEST['user_id'];//$uid=$_REQUEST['user_id']; 
		 $role=getColumnName('tbl_users','role', 'user_id='.$user_id);//
		 

	$where=" status=0 ";
	if($role==1){ $where="route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$user_id) and status=0";}
	else{
	 $area=getColumnName('tbl_users','area_id', 'user_id='.$user_id);//
	$where="area_id=$area and status=0";
	}
	 $query = "SELECT business_name,dealer_id,region_id,area_id, distributor_id,cluster_id,route_id,town,owner_name,phone,added_by,reg_date,channel,    sales_fmcg,do_you_sell_any_bevs,sales_coke_products,stocked_coke_inthePast,willing_to_stock_coke,type_of_class,willingness_remarks,why_dd_yu_stop_stocking_coke,last_visisted FROM tbl_dealers where $where and verified=1 and type_of_class IN ('Bronze','Silver','Gold','Other') order by dealer_id ";
  
    $query = mysqli_query($mysqli, $query) ;
    if (!$query){
		?><tr><td colspan="15">List empty</td></tr><?php } else{ 
		 while ($row = mysqli_fetch_array($query)){
			?><tr><td ><?php echo $i?></td><td ><?php echo business_name($row['dealer_id'])?></td><td ><?php echo region_name($row['region_id'])?></td><td ><?php echo get_area($row['area_id'])?></td><td ><?php echo sub_area_name($row['cluster_id'])?></td><td ><?php echo distributor_name($row['distributor_id'])?></td><td ><?php echo get_route( $row['route_id'])?></td><td ><?php echo $row['town']?></td><td ><?php echo $row['owner_name']." ". $row['phone']?></td><td ><?php echo channel_type($row['channel'])?></td><td ><?php echo $row['type_of_class']?></td><td ><?php echo $row['sales_fmcg']?></td><td ><?php echo $row['do_you_sell_any_bevs']?></td><td ><?php echo $row['sales_coke_products']?></td><td ><?php echo $row['last_visisted']?></td></tr><?php 
			$i++; }
		 }
  }
    elseif($mode=="user_outlets"){
		$i=1;
	 	$user_id=$_REQUEST['user_id'];//$uid=$_REQUEST['user_id']; 
		 $role=getColumnName('tbl_users','role', 'user_id='.$user_id);//
		 

	$where=" status=0 ";
	if($role==1){ $where="route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$user_id) and status=0";}
	else{
	 $area=getColumnName('tbl_users','area_id', 'user_id='.$user_id);//
	$where="area_id=$area and status=0";
	}
	 $query = "SELECT business_name,dealer_id,region_id,area_id, distributor_id,cluster_id,route_id,town,owner_name,phone,added_by,reg_date,channel,    sales_fmcg,do_you_sell_any_bevs,sales_coke_products,stocked_coke_inthePast,willing_to_stock_coke,type_of_class,willingness_remarks,why_dd_yu_stop_stocking_coke,last_visisted FROM tbl_dealers where $where and type_of_class IN ('0','1','2','3','Yes','')  order by dealer_id ";
  
    $query = mysqli_query($mysqli, $query) ;
    if (!$query){
		?><tr><td colspan="15">List empty</td></tr><?php } else{ 
		 while ($row = mysqli_fetch_array($query)){
			?><tr><td ><?php echo $i?></td><td ><?php echo business_name($row['dealer_id'])?></td><td ><?php echo region_name($row['region_id'])?></td><td ><?php echo get_area($row['area_id'])?></td><td ><?php echo sub_area_name($row['cluster_id'])?></td><td ><?php echo distributor_name($row['distributor_id'])?></td><td ><?php echo get_route( $row['route_id'])?></td><td ><?php echo $row['town']?></td><td ><?php echo $row['owner_name']." ". $row['phone']?></td><td ><?php echo channel_type($row['channel'])?></td><td ><?php echo $row['type_of_class']?></td><td ><?php echo $row['sales_fmcg']?></td><td ><?php echo $row['do_you_sell_any_bevs']?></td><td ><?php echo $row['sales_coke_products']?></td><td ><?php echo $row['last_visisted']?></td></tr><?php 
			$i++; }
		 }
  }
  elseif($mode=="user_routes"){
	$i=1;
		  $user_id=$_REQUEST['user_id'];
		 $role_id=getColumnName('tbl_users','role', 'user_id='.$user_id);
  $area_id=getColumnName('tbl_users','area_id', 'user_id='.$user_id);
  $cluster_id=getColumnName('tbl_users','region_id', 'user_id='.$user_id);
	
	$where=" a.status=0  and area_id=$area_id";
	
	if($role_id==1){$where="adc.ad_id=$user_id";
	}

	 	


	 $query = "SELECT * FROM `tbl_routes` a WHERE route_id IN (SELECT ra.`route_id` as a_rid FROM `tbl_assign_route2adcluster`ra LEFT JOIN tbl_adcluster_asignments adc ON ra.ad_cluster_id=adc.ad_cluster_id  WHERE $where ) ";
  
    $query = mysqli_query($mysqli, $query) or die($mysqli->error) ;
    if (!$query){
		?><tr><td colspan="15">List empty</td></tr><?php } else{ 
		 while ($row = mysqli_fetch_array($query)){
			?><tr><td ><?php echo $i?></td><td ><?php echo get_route( $row['route_id'])?></td><td ><?php echo region_name($row['region_id'])?></td><td ><?php echo get_area($row['area_id'])?></td><td ><?php echo sub_area_name($row['cluster_id'])?></td><td ><?php echo distributor_name($row['distributor_id'])?></td><td ><?php echo getColumnName('tbl_assign_route2adcluster a INNER JOIN tbl_ad_clusters adc on adc.ad_cluster_id=a.ad_cluster_id','ad_cluster_name', 'a.status=0 and route_id='.$row['route_id']);?></td><td ><?php echo num_rows("tbl_dealers", "route_id=".$row['route_id'])?></td><td ><?php echo num_rows("tbl_dealers", " verified=1 and type_of_class IN ('Bronze','Silver','Gold','Other') and route_id=".$row['route_id'])?></td><td><?php //echo $row['reg_date']?></td><td><a href="read.php?mode=removeRouteFromCluster&user_id=<?php echo $user_id?>&route_id=<?php echo $row['route_id']?>">Remove</a></td></tr><?php 
			$i++; }
		 }?>
       
                          
						  <?php
  }
  
   elseif($mode=="user_assets"){
	   
	   $i=1;
		  $user_id=$_REQUEST['user_id'];
		 $role=getColumnName('tbl_users','role', 'user_id='.$user_id);
  $area=getColumnName('tbl_users','area_id', 'user_id='.$user_id);
  
	  
	$where=" status=0 ";
	if($role==1){ $where=" c.ad_id=$user_id ";}
	else{
	
	$where="area_id=$area and status=0";
	}

  $u= $mysqli->query("SELECT a.`asset_id`, a.`asset_size`, a.`asset_number`, a.`model`, a.`name`, a.`code`, a.`code_format`, a.`serial`, a.`date_isued`, a.`reg_by`, a.`dealer_id`, a.`sync_status`, a.`remarks`, a.`status`,  b.dealer_id,b.area_id,b.route_id, c.`ad_id`, c.`ad_cluster_id`, d.`route_id`, d.`ad_cluster_id` FROM tbl_assets a INNER JOIN tbl_dealers b ON b.dealer_id=a.dealer_id INNER JOIN tbl_assign_route2adcluster d ON d.`route_id`=b.route_id INNER JOIN tbl_adcluster_asignments c ON c.ad_cluster_id=d.ad_cluster_id WHERE $where and a.verification_status!='Verified' GROUP by asset_id order by b.dealer_id ") or  die($mysqli->error);
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								  $name=$asset_row['name'];
								  $held_by=business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $date_ssued=$asset_row['date_isued'];
								   $by=get_name($asset_row['reg_by']);
								   $source="KO";//$asset_row['sourced_from'];
								    $condition=$asset_row['remarks'];
									$last_checked=$asset_row['date_isued'];
								   
								 ?>
								 <tr><td><?php echo $i?></td>
                                 <td><?php echo $name?></td>
								   <td><?php echo $held_by?></td>
								   <td><?php echo $model?></td>
                                   <td><?php echo $serial ?></td>
                                   <td><?php echo $bar_code ?></td>
                                    <td><?php echo $date_ssued ?></td>
                                     <td><?php echo $source ?></td>
                                   <td><?php echo $condition ?></td>
                                   <td><?php echo $last_checked ?></td>
							     </tr><?php $i++;}
								   ///if condition 
	   }
	    elseif($mode=="verified_assets"){
	   
	   $i=1;
		  $user_id=$_REQUEST['user_id'];
		 $role=getColumnName('tbl_users','role', 'user_id='.$user_id);
  $area=getColumnName('tbl_users','area_id', 'user_id='.$user_id);
  
	  
	$where=" status=0 ";
	if($role==1){ $where=" c.ad_id=$user_id ";}
	else{
	
	$where="area_id=$area and status=0";
	}

  $u= $mysqli->query("SELECT a.`asset_id`, a.`asset_size`, a.`asset_number`, a.`model`, a.`name`, a.`code`, a.`code_format`, a.`serial`, a.`date_isued`, a.`reg_by`, a.`dealer_id`, a.`sync_status`, a.`remarks`, a.`status`, a.last_visited,asset_condition, b.dealer_id,b.area_id,b.route_id, c.`ad_id`, c.`ad_cluster_id`, d.`route_id`, d.`ad_cluster_id` FROM tbl_assets a INNER JOIN tbl_dealers b ON b.dealer_id=a.dealer_id INNER JOIN tbl_assign_route2adcluster d ON d.`route_id`=b.route_id INNER JOIN tbl_adcluster_asignments c ON c.ad_cluster_id=d.ad_cluster_id WHERE $where and a.verification_status='Verified'  GROUP by asset_id order by b.dealer_id ") or  die($mysqli->error);
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								  $name=$asset_row['name'];
								  $held_by=business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $date_ssued=$asset_row['date_isued'];
								   $by=get_name($asset_row['reg_by']);
								 
								    $condition=$asset_row['remarks'];$asset_condition=$asset_row['asset_condition'];
									$last_checked=$asset_row['last_visited'];
								   
								 ?>
								 <tr><td><?php echo $i?></td>
                                 <td><?php echo $name?></td>
								   <td><?php echo $held_by?></td>
								   <td><?php echo $model?></td>
                                   <td><?php echo $serial ?></td>
                                   <td><?php echo $bar_code ?></td>
                                    <td><?php echo $date_ssued ?></td>
                                     <td><?php echo $asset_condition ?></td>
                                   <td><?php echo $condition ?></td>
                                   <td><?php echo $last_checked ?></td>
							     </tr><?php $i++;}
								   ///if condition 
	   }
	    elseif($mode=='route_sales'){
			?><table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">	
                      
                              <thead> 
  <tr>
   <th>#</th> <th>Route</th>
    <th >DSR in Charge</th>
    <th ><?php echo date("M Y") ?> Target</th>
    <th >Daily Target</th>
    <th >MTD Target</th><?php 
								 for($day=1; $day<=$tarehe; $day++) {?> <th><?php echo $day?></th><?php }?>

  </tr>
                     </thead>         <tbody>
		
										 <?php 		$d=1;	
		
		$rq=$mysqli->query("SELECT route_name,route_id,route_contribution,this_month_target FROM tbl_routes WHERE status=0 AND route_id IN(SELECT route_id FROM `tbl_assign_route2adcluster` adc RIGHT JOIN tbl_adcluster_asignments ada on ada.ad_cluster_id=adc.ad_cluster_id WHERE ada.ad_id=$user_id and ada.status=0) order by route_name") or die(mysqli_error($mysqli));
								while($r=mysqli_fetch_array($rq)){ 
								  $rid=$r['route_id'];
								  
								   ?>
                              <tr>
                                 <td><?php echo $d?></td>  <td><?php echo $r['route_name']?></td> <td><?php //echo get_name($r['ad_incharge'])?></td>  <td><?php echo $r['this_month_target']?></td>  <td><?php echo $dailyTarget= number_format($r['this_month_target']/$daysInMonth,1)?></td><td><?php echo $dailyTarget*$tarehe;?></td> <?php for($day=1; $day<=$tarehe; $day++) {?> <td><?php  echo sum_columns("tbl_route_sales","qty_sold"," `route_id`=$rid and date(date_sold)='".date('Y-m-'.$day)."' and status=0")?></td><?php }?>
							     </tr>
								 <?php $d++;} 
		?>  </tbody>                                          
                          </table>
						  <?php
	   } elseif($mode=='outlet_sales'){ $i=1;
	   $select_orders=$mysqli->query("SELECT a.`product_id`,`cases`,`pieces`,DATE(`date_added`) as d,`dealer_id`,b.product FROM `tbl_orders_details` a INNER JOIN tbl_products b on a.product_id=b.product_id WHERE made_by=$user_id ORDER BY date_added desc") or die($mysqli->error);
		   ?> 
          <table width="100%"class="table table-bordered table-striped table-condensed" >
		<thead> <tr><th>#</th><th>Outlet</th><th>SKU</th><th>Cases</th><th>Pieces</th><th>Date</th><th></tr></thead><tbody>
        <?php 
		while($r=mysqli_fetch_array($select_orders)){
			?>
        <tr><td><?php echo $i?></td><td><?php echo business_name($r['dealer_id'])?></td><td><?php echo $r['product']?></td><td><?php echo $r['cases']?></td><td><?php echo $r['pieces']?></td><td><?php echo $r['d']?></td></tr>
        
       <?php $i++; }?> </tbody></table>
		
		<?php
	   } 
	    elseif($mode=='distributor_stocks'){ $i=1;
			$select=$mysqli->query("SELECT distributor_id, date(date_taken) as d, SUM(qty) as qty FROM `tbl_distributor_stock_levels`  WHERE taken_by=$user_id and  product_id!=107 GROUP by distributor_id, date(date_taken) ORDER BY `date_taken` DESC")or die($mysqli->error);
		 ?>
		 <table width="100%"class="table table-bordered table-striped table-condensed" >
		<thead> <tr><th>#</th><th>Distributor</th><th>Qty Available</th><th>Date Time done</th></tr></thead><tbody>
        <?php while($row=mysqli_fetch_array($select)){?>
       <tr> <td><?php echo $i?></td> <td><?php echo distributor_name($row['distributor_id'])?></td> <td><?php echo $row['qty']?></td> <td><?php echo $row['d']?></td></tr>
       <?php $i++; }?> </tbody>
		 </table>
		 
		 <?php
	   }
	    elseif($mode=='asset_relocation'){ $n=1;
			$select=$mysqli->query("SELECT `move_id`, `date_moved`, code,serial, `asset_id`, `from_outlet`, `to_outlet`, `recommended_by`, `approved_by`, `authorized_by`, `moved_by`, `date_recommended`, `reason`, `remarks`, a.`status` FROM `tbl_asset_movement` a inner join tbl_assets b on a.asset_id=b.asset_id WHERE a.moved_by=$user_id")or die($mysqli->error);
		?> 
        <table width="100%"class="table table-bordered table-striped table-condensed" >
		<thead> <tr><th>#</th><th>Bar code</th><th>Serial</th><th>Serial</th><th>Approved_by</th><th>Authorized by</th><th>Reason for relocation</th><th>Remarks</th><th>From</th><th>To</th></tr></thead><tbody>
        <?php while($row=mysqli_fetch_array($select)){?>
       <tr> <td><?php echo $n?></td> <td><?php echo $row['code']?></td> <td><?php echo $row['serial']?></td> <td><?php echo get_name($row['approved_by'])?></td><td><?php echo get_name($row['authorized_by'])?></td><td><?php echo get_name($row['reason'])?></td><td><?php echo get_name($row['remarks'])?></td><td><?php echo business_name($row['outlet_from'])?></td><td><?php echo business_name($row['outlet_to'])?></td></tr>
       <?php $n++; }?> </tbody>
		 </table>
		 <?php	
	   }
	   /////////////////////////////// end region details start distributor
	   
  
	    elseif($mode=='new_outlets_MTD'){
			?>
             <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Outlet Name</th>
                                    <th >Channel</th>
                                  <th>Route</th>
                                  <th>Contacts</th>
                                  <th>Reg By</th>
                                  <th>Reg Date</th>
                                   
                                   <th>Visits</th>
                                  <th>class</th>
                                  <th>Key Account </th>
                                  <th>Verified </th>
                                  <th><input type="button" id="delete" value="delete"></th>
                                  
                              </tr></thead>   <tbody ><?php $i=1; $yearmonth=date('m'); $year=date("Y");
							 $query=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE  MONTH(`reg_date`)='$yearmonth' and YEAR(`reg_date`)='$year' and status=0 and `added_by`=$user_id order by reg_date")or die(mysqli_error($mysqli));
							while($row=mysqli_fetch_array($query)){
								$dealer_id=$row['dealer_id'];
								$route_id=$row['route_id'];
								$region_id=$row['region_id']; 
									$type_of_class=$row['type_of_class']; 
								$channel=$row['channel']; $coords='N/A'; if($row['latitute']!=0)$coords='Valid'; $phone=$row['phone']; $reg_by=$row['added_by']; $reg_date=$row['reg_date']; 
								?>
							
                              <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo business_name($dealer_id)?></td>
                                <td><?php echo channel_type($channel)?></td>
                                <td><?php echo get_route($row['route_id'])?></td>
                                <td><?php echo $phone?></td>
                                 <td><?php echo get_name($reg_by)?></td>
                                 <td><?php echo record_date($reg_date)?></td>
                                 <td><?php echo times_visited($dealer_id)?></td>
                                <td><?php   echo $type_of_class;?></td>
                                <td><?php echo $row['key_account']?></td>
                                <td><?php echo $row['verified']?></td>
                                <td><?php echo '<input type="checkbox" class="checkbox" value="'.$dealer_id.'" name="list[]">';?></td>
                              </tr> <?php $i++; }?>
                            </tbody>                              
                          </table>
			
			<?php }
	    elseif($mode=='closed_outlets'){
			
			?>
			   <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Outlet Name</th>
                                    <th >Channel</th>
                                  <th>Route</th>
                                  <th>Contacts</th>
                                  <th>Reg By</th>
                                  <th>Reg Date</th>
                                   
                                   <th>Visits</th>
                                  <th>class</th>
                                  <th>Key Account </th>
                                  <th>Verified </th>
                                  <th><input type="button" id="delete" value="Remove"></th>
                                  
                              </tr></thead>   <tbody ><?php $i=1; $yearmonth=date('m'); $year=date("Y");
							 $query=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE  MONTH(`reg_date`)='$yearmonth' and YEAR(`reg_date`)='$year' and status=1 and `added_by`=$user_id order by reg_date")or die(mysqli_error($mysqli));
							while($row=mysqli_fetch_array($query)){
								$dealer_id=$row['dealer_id'];
								$route_id=$row['route_id'];
								$region_id=$row['region_id']; 
									$type_of_class=$row['type_of_class']; 
								$channel=$row['channel']; $coords='N/A'; if($row['latitute']!=0)$coords='Valid'; $phone=$row['phone']; $reg_by=$row['added_by']; $reg_date=$row['reg_date']; 
								?>
							
                              <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo business_name($dealer_id)?></td>
                                <td><?php echo channel_type($channel)?></td>
                                <td><?php echo get_route($row['route_id'])?></td>
                                <td><?php echo $phone?></td>
                                 <td><?php echo get_name($reg_by)?></td>
                                 <td><?php echo record_date($reg_date)?></td>
                                 <td><?php echo times_visited($dealer_id)?></td>
                                <td><?php   echo $type_of_class;?></td>
                                <td><?php echo $row['key_account']?></td>
                                <td><?php echo $row['verified']?></td>
                                <td><?php echo '<input type="checkbox" class="checkbox" value="'.$dealer_id.'" name="list[]">';?></td>
                              </tr> <?php $i++; }?>
                            </tbody>                              
                          </table><?php
			}
			   elseif($mode=='asset_movements'){
				  ?>
                   <table id="content_table" class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr>
                                  
                                  <th>#</th>
                                      <th>Assect Code</th> 
                                       <th>Move from</th>
                                  <th>Move to</th>
                                  <th>Recommended by</th>
                                  <th>Aproved by</th>
                                   <th>Moved by</th>     
                                   <th>date recommended</th>
                                   <th>Reason</th>
                                    <th>Remarks</th>
                                  </tr>
                              </thead>
                              <tbody id="assets_list">
				    <?php $i=1;
	$where=" status=0 and  date_recommended=$user_id";
	
	$q=$mysqli->query("SELECT `move_id`, `date_moved`, `asset_id`, `from_outlet`, `to_outlet`, `recommended_by`, `approved_by`, `authorized_by`, `moved_by`, `date_recommended`, `reason`, `remarks`, `status` FROM `tbl_asset_movement` WHERE $where")or die($mysqli->error);
	while($r=mysqli_fetch_array($q))
	{?>
	<tr><td><?php echo $i?></td><td><?php echo get_asset_name ($r['asset_id'])?></td><td><?php echo business_name($r['from_outlet'])?></td><td><?php echo business_name ($r['to_outlet'])?></td><td><?php echo get_name($r['recommended_by'])?></td><td><?php echo get_name($r['approved_by'])?></td><td><?php echo get_name($r['moved_by'])?></td><td><?php echo ($r['date_recommended'])?></td><td><?php echo $r['reason']?></td><td><?php echo $r['remarks']?></td></tr><?php $i++;} ?>
                           
                              </tbody>
                            
                             
                             
                          </table>
						  <?php }
						  elseif($mode=='distributor_stock'){
				  ?>
				  <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th >SKU</th>
                                 <?php $days=daysInMonth(date('Y'),date('m')); 
								 for($day=1; $day<=$days; $day++) {?> <th ><?php echo $day?></th><?php }?>
                                 
                                  <th>Options</th>
                              </tr>
                              </thead>
                            <tbody id="">
                            <?php $pq=mysqli_query($mysqli,"SELECT * from tbl_products where 1")or die (mysqli_error($mysqli));
							
							while($prow=mysqli_fetch_array($pq)){
								?>
                               <tr><th>#</th>
                                  <th ><?php echo $prow['product']." ".$prow['pack_size']." ".$prow['pack_type']?></th>
                                 <?php  
								 for($day=1; $day<=$days; $day++) {?> <th ><?php echo $day?></th><?php }?>
                                 
                                  <th><a  href="">View More</a></th>
                              </tr>
								<?php }
							?></tbody>
                             
                             
                          </table><?php } elseif($mode=='adClusters'){							  ?>
                               <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th >AD Cluster</th>
                                  <th >Sub Area</th>
                                        <th >Area</th>
                                  <th >Regions</th>
                                  <th >Routes</th>
                                 
                                   <th>Outlets</th> <th>Verified</th> <th>Assigned to</th>
                                  
                                   <th >Options</th>
                                 
                                    
                              </tr>
                              </thead>
                            <tbody id="">
                            <?php
                             $i=1; 
							  $res=mysqli_query($mysqli," SELECT a.`ad_cluster_assignment_id`, a.`ad_id`, a.`ad_cluster_id`, a.`date_assigned`, a.`status`,region_id,sub_area_id,area_id,ad_cluster_name FROM `tbl_adcluster_asignments` a inner join `tbl_ad_clusters` b ON a.ad_cluster_id=b.ad_cluster_id   WHERE ad_id=$user_id   order by date_assigned ") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { 
	$region_id=$row['region_id'];
	 $cluster=$row['sub_area_id'];
	  $ad_cluster_id=$row['ad_cluster_id'];
	$area=$row['area_id']; $ad_cluster_assignment_id=$row['ad_cluster_assignment_id'];
	?><tr><td><?php echo $i?></td><td><?php echo $row['ad_cluster_name'] ?></td>
                               <td><?php echo sub_area_name($row['sub_area_id']);?></td>
                                  <td><?php echo area_name($row['area_id']);?></td>
                                  <td><?php echo region_name($row['region_id']);?></td>
                                <td><?php echo num_rows("tbl_assign_route2adcluster","ad_cluster_id= $ad_cluster_id")?></td>
                                <td><?php echo num_rows("tbl_dealers"," route_id IN (SELECT route_id from tbl_assign_route2adcluster where ad_cluster_id= $ad_cluster_id) ".regions_filters_condition())?></td>
                                    <td><?php  echo num_rows("tbl_dealers"," verified=1 and type_of_class IN ('Bronze','Silver','Gold','Other') and route_id IN (SELECT route_id from tbl_assign_route2adcluster where ad_cluster_id= $ad_cluster_id) ")?></td>
                                    <td><?php echo list_ADCluster_assignment($ad_cluster_id)?></td>
                              
                                <td><a href="">Edit</a> | <a href="read.php?mode=removeAdclusterFrmAD&ad_id=<?php echo $row['ad_id']?>&ad_cluster_assignment_id=<?php echo $ad_cluster_assignment_id?>">Delete</a></td>
                                </tr>
	<?php $i++; }?>
                            </tbody>
                             
                             
                          </table>
							  
							  <?php }
							  elseif($mode=='Meetings'){ ?>
                                 <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th rowspan="2" >No</th>
                                  <th rowspan="2" >Where held</th>
                                  <th rowspan="2">Route</th>
                                  <th rowspan="2">Distributor</th>
                                  <th rowspan="2">Sub ARea</th>
                                  <th rowspan="2">Area</th>
                                 <th colspan="3">Previus Day Sales</th>
                                  <th colspan="2" >Corrective Actions Tracker</th>
                                  <th colspan="2" >Today Plan</th>
                                  <th rowspan="2" >Date Added</th>
                                 <!-- <th rowspan="2" >Added By</th>-->
                                  <th rowspan="2" >Sup. Remarks</th>
                                   <th rowspan="2" >Supervisor</th>
                                   <th rowspan="2">DSR</th>
                                  <th rowspan="2" >Actions</th>
                              </tr>
                              <tr>
                                <th>TGT</th>
                                <th>ACT</th>
                                <th>VAR</th>
                                <th >Prior Day Plan</th>
                                <th >C. Status</th>
                                <th >Target</th>
                                <th >Activities</th>
                                </tr>
                             
                              </thead>
                              <tbody>
                             <?php  $i=1;
			$q=mysqli_query( $mysqli,"SELECT `good_morning_meeting_id`, `taken_by`, `date_added`, `region`, `area`, `cluster`, `route`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`, `pd_target`, `actual_sales`, `comments_by_supervisor`, `pd_corrective_action_plan`, `challanges_experienced`, location,distributor,`supervisor_id`, `dsm_incharge`, `attendance_details`, `status` FROM `tbl_good_morning_meeting` WHERE taken_by=$user_id order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){ $id=$r['good_morning_meeting_id'];
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td ><?php echo $r['location']?></td>
                                  
                                   <td ><?php echo get_route($r['route']);?></td>
                                    <td ><?php echo distributor_name($r['distributor']);?></td>
                                    <td ><?php echo sub_area_name($r['cluster']);?></td>
                                     <td ><?php echo area_name($r['area']);?></td>
                                      <td ><?php echo $r['pd_target'];?></td>
                                     <td ><?php echo $r['actual_sales'];?></td>
                                     <td ><?php echo $r['pd_target']-$r['actual_sales'];?></td>
                                      <td ><?php echo $r['pd_corrective_action_plan'];?></td>
                                      <td ><?php echo $r['corrective_action_status'];?></td>
                                     <td ><?php echo $r['today_plan_target'];?></td>           
                                     <td ><?php echo $r['today_plan_activity'];?></td>
                                       <td ><?php echo $r['date_added'];?></td>
                                    <!--  <td ><?php echo get_name($r['taken_by']);?></td>-->
                                      <td ><?php echo $r['comments_by_supervisor'];?></td>
                                      <td ><?php echo get_name($r['supervisor_id']);?></td>
                                       <td ><?php echo $r['dsm_incharge'];?></td>
                                      <td ><a href="goodmm_remarks.php?id=<?php echo $id?>"><?php ?> Add remarks</a></td>
                                       </tr>   
                                <?php $i++; }?>
                                
                          
                              </tbody>
                               
                          </table>
		
			<?php   }?>
	 