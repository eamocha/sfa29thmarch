  <?php
   include_once("assets/lib/config.php");
     include_once("assets/lib/functions.php");
   $mode=$_REQUEST['mode']; $distributor_id=$_REQUEST['distributor_id'];
   ////////////region details
   if($mode=="distributor_summary"){
	   $distributor_id=$_REQUEST['distributor_id'];
	   $query=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE `distributor_id`=$distributor_id and status=0")or die (mysqli_error($mysqli)); 
	   while($row=mysqli_fetch_array($query)){
		  $route_id=$row['route_id'];
		  $deliveries_todate= deliveries_in_a_month_per_jurisdiction(date('m'),date('Y'),'route',$route_id);
		  ?><tr>
    <td scope="col"><?php echo get_route($row['route_id'])?></td>
    <td scope="col"><?php echo num_rows('tbl_dealers',"route_id=$route_id")?></td>
    
    <td scope="col"><?php echo total_assets("route",$route_id,1,'')?></td>
    <td scope="col"><?php echo  $row['route_contribution']?></td>
    <td scope="col"><?php // echo  number_format(get_sum_of_route_targets($route_id,0)/(daysInMonth(date("Y"),date("m"))-month_holidays_todate()),1)?></td>
    <td scope="col"><?php //echo  get_sum_of_route_targets($route_id,0)?></td>
    <td scope="col"><?php // echo  get_sum_of_area_targets($route_id,0)*26;?></td>
    <td scope="col"><?php echo $deliveries_todate; ?></td>
    <td scope="col"><?php  if(get_sum_of_route_targets($route_id,0)*26>0)echo number_format($deliveries_todate/get_sum_of_route_targets($area_id,0)*26,1); else echo '<span title="Wrong Targets">N/A</span>' ?></td>
    <td scope="col"><?php  echo total_assets("route",$route_id,1,'All')?></td>
    <td scope="col"> <?php echo suckers_in_jurisdiction('route','$route_id')?></td>
    <td scope="col"><?php echo num_rows('tbl_competitor_survey'," dealer_id IN(SELECT dealer_id from tbl_dealers where route_id=$route_id) and busted='yes'")?></td>
   <td scope="col"><?php $assiggned_to_q= mysqli_query($mysqli,"SELECT assigned_to,user_id FROM `tbl_route_assignments` r LEFT JOIN tbl_users u on u.user_id=r.assigned_to WHERE r.route_id=$route_id and u.role=5")or die(mysqli_error()); 
   while($assiggned_to_row=mysqli_fetch_array($assiggned_to_q)){ echo '<li>'. get_name($assiggned_to_row['assigned_to'])."</li>";}?></td>
    <td scope="col"><?php $assiggned_to_q= mysqli_query($mysqli,"SELECT assigned_to,user_id FROM `tbl_route_assignments` r LEFT JOIN tbl_users u on u.user_id=r.assigned_to WHERE r.route_id=$route_id and u.role=7")or die(mysqli_error()); 
  while($assiggned_to_row=mysqli_fetch_array($assiggned_to_q)){ echo '<li>'. get_name($assiggned_to_row['assigned_to'])."</li>";}?></td>
   
  </tr>
  <?php  }///if condition 
   }////////////////mode
    elseif($mode=="distributor_volume_perfomance"){
		$current_year=date('Y'); $prev_year=$current_year-1; $distributor_id=$_REQUEST['distributor_id'];
		for($i=1;$i<13; $i++ ){
			$this_year_actual=deliveries_in_a_month_per_jurisdiction($i,$current_year,"distributor",$distributor_id);
			$last_year_actual=deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"distributor",$distributor_id);
			$last_year_actual1=deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"distributor",$distributor_id);
			
		?>
        <tr>
    <th scope="col"><?php echo getMonthString($i)?></th>
    <th scope="col"><?php echo get_distributor_targets_per_month($distributor_id,$i,$prev_year,'')?></th>
    <th scope="col"><?php echo deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"distributor",$distributor_id);?></th>
    <th scope="col"><?php echo number_format(deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"distributor",$distributor_id)*100/get_distributor_targets_per_month($distributor_id,$i,$prev_year,1),1);?></th>
  <th scope="col"><?php echo get_distributor_targets_per_month($distributor_id,$i,$current_year,'')?></th>
    <th scope="col"><?php echo deliveries_in_a_month_per_jurisdiction($i,$current_year,"distributor",$distributor_id);?></th>
    <th scope="col"><?php echo number_format(deliveries_in_a_month_per_jurisdiction($i,$current_year,"distributor",$distributor_id)*100/get_distributor_targets_per_month($distributor_id,$i,$current_year,1),1);?></th>
    <th scope="col"> <?php if($last_year_actual==0) $last_year_actual=1;  echo number_format($this_year_actual*100/$last_year_actual,1)?></th>
    <th scope="col"><?php echo number_format(($this_year_actual-$last_year_actual1)*100/$last_year_actual,1)?></th>
    <th scope="col">-</th>
  </tr>	      
   
  
  <?php } //end for and start the total footer
  ?>	<tr>
    <th scope="row">YTD</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
      <td>&nbsp;</td>
    
  </tr><?php
  }/////end tyhe  elseif($mode=="region_volume_perfomance"){ mode
   elseif($mode=="distributor_assets"){
   $distributor_id=$_REQUEST['distributor_id'];
  ?>
       <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Outlet</td><td>Name</td><td>Model</td><td>Serial</td><td>Bar code</td><td>Barcode Format</td><td>Reg. Date</td><td>Remarks</td><td>Last Check</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` WHERE dealer_id IN (SELECT dealer_id FROM tbl_dealers where distributor_id=$distributor_id)")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="5">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo business_name($asset['dealer_id'])?></td><td><?php echo $asset['name']?></td><td><?php echo $asset['model']?></td><td><?php echo $asset['serial']?></td><td><?php echo $asset['code']?></td><td><?php echo $asset['code_format']?></td><td><?php echo record_date($asset['date_isued'])?></td><td><?php echo $asset['remarks']?></td><td>-</td></tr>                  
                                       
                                       <?php $n++; }
		}?></table>
 
  <?php  ///if condition 
	   }
	   ////////////////////////mode
	    elseif($mode=='distributor_gmm'){    $distributor_id=$_REQUEST['distributor_id'];
		   ?> <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th rowspan="2" >No</th>
                                  <th rowspan="2" >Where held</th>
                                  <th rowspan="2">Route</th>
                               <!-- <th rowspan="2">Distributor</th>-->
                                  <th rowspan="2">Sub ARea</th>
                                  <th rowspan="2">Area</th>
                                 <th colspan="3">Previus Day Sales</th>
                                  <th colspan="2" >Corrective Actions Tracker</th>
                                  <th colspan="2" >Today Plan</th>
                                  <th rowspan="2" >Date Added</th>
                                  <th rowspan="2" >Added By</th>
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
			$q=mysqli_query( $mysqli,"SELECT `good_morning_meeting_id`, location,`taken_by`, `date_added`, `region`, `area`, `cluster`, `route`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`, `pd_target`, `actual_sales`, `comments_by_supervisor`, `pd_corrective_action_plan`, `challanges_experienced`,distributor, `supervisor_id`, `dsm_incharge`, `attendance_details`, `status` FROM `tbl_good_morning_meeting` WHERE distributor=$distributor_id order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){ $id=$r['good_morning_meeting_id'];
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td ><?php echo $r['location']?></td>
                                  
                                   <td ><?php echo get_route($r['route']);?></td>
                                <!--    <td ><?php //echo distributor_name($r['distributor']);?></td>-->
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
                                      <td ><?php echo get_name($r['taken_by']);?></td>
                                      <td ><?php echo $r['comments_by_supervisor'];?></td>
                                      <td ><?php echo get_name($r['supervisor_id']);?></td>
                                       <td ><?php echo $r['dsm_incharge'];?></td>
                                      <td ><a href="goodmm_remarks.php?id=<?php echo $id?>"><?php ?> Add remarks</a></td>
                                       </tr>   
                                <?php $i++; }?>
                                
                          
                              </tbody>
                               
                          </table><?php
			
	   }
	   ///////////////////////////////
	    elseif($mode=='pervolume'){
	   } elseif($mode=='outlets'){
		   echo "None Listed yet";
	   }  elseif($mode=='deliveries'){
		   echo "No info";
	   }
	    elseif($mode=='staff'){
	   }
	   /////////////////////////////// end region details start distributor
	   
	    if($mode=="eds"){
	   $distributor_id=$_REQUEST['distributor_id'];
	   $query=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE `distributor_id`=$distributor_id and status=0")or die (mysqli_error($mysqli)); 
	   while($row=mysqli_fetch_array($query)){
		  $route_id=$row['route_id'];
		  $month_target=num_rows('tbl_assets','asset_type_id=1 and status=0 and dealer IN(SELECT dealer_id FROM tbl_dealers WHERE route_id='.$route_id.' and status=0)');
  ?><tr>
    <th scope="row"><?php echo $row['route_name'];?></th>
    <td><a href="report_sections/view_route_details.php?region=0&amp;rid=<?php echo $route_id?>"><?php echo num_rows('tbl_dealers',' route_id='.$route_id.' and status=0')?></a></td>
     <td><?php echo rand(1,20)?></td>
    <td><?php echo rand(1,20)?>% </td>
    <td><?php echo rand(1,10)?></td>
     <td><a href="report_sections/assets.php"><?php echo $month_target ?></a></td>
     <td><?php if(is_numeric($month_target)){ echo number_format($month_target/30,1);} else echo "N/A";?></td>
    <td><?php //echo getColumnName('tbl_targets',' number ',' route_id='.$route_id);?></td>
   
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>-</td>
    <td>-</td>
    <td><?php echo get_name($row['route_assigned_to'])?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php  }///if condition 
   }////////////////mode
   elseif($mode=="regional_assets"){
	  	   $distributor_id=$_REQUEST['distributor_id'];
	  
	     ?>
      <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>Name</td><td>Outlet</td><td>Status</td><td>Last Check</td></tr></thead><?php
        $query=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` WHERE dealer_id IN (SELECT dealer_id FROM tbl_dealers where distributo_id=$distributor_id)")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="5">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $asset['asset_id']?></td><td><?php echo business_name($asset['dealer_id'])?></td><td><?php echo 'working';?></td><td>-</td></tr>                  
                                       
                                       <?php }
		}?></table>
  <?php  ///if condition 
	   }
	    elseif($mode=='regional_clusters'){
				   $distributor_id=$_REQUEST['distributor_id'];
			?>
			 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Cluster Name</th>
                                  <th>Description</th>
                                  <th>Distributors</th>
                                  <th>Outlets</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody class="regions_list">
                              <?php  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` WHERE distributor_id=$distributor_id and status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $cluster=$row['cluster_id'];$area=$row['area_id'];
	?>
    <tr><td><?php echo $i?></td><td><?php echo $row['cluster_name'] ?></td><td><?php echo $row['description'] ?></td><td><a href="distributors.php?cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_distributors","cluster_id=".$cluster) ?></a></td><td><a href="region_outlets.php?region_id=<?php echo $row['region_id']?>"><?php echo num_rows("tbl_dealers","cluster_id=".$cluster) ?></a></td><td></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table><?php
	   } elseif($mode=='regional_key_accounts'){
		   $i=1;
		  	   $distributor_id=$_REQUEST['distributor_id'];
		   	  $res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE distributor_id=$distributor_id and status =0  and key_account='yes' order by business_name asc");?>
			  <table  width="100%" class="table table-bordered  table-condensed" >
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
           
             <th>Channel</th>
          
              <th>Contact</th>
            <th>Phone</th>
            <th>Reg. by</th>
            <th>Reg. date</th>
            <th>Actions</th>
                  </tr>
                  </thead>
        <tbody>
       <?php
    while ($row = mysqli_fetch_array($res)) { ?>
		   
		   <tr>
            <td><?php echo $i?></td>
            <td><?php echo business_name($row['dealer_id'])?></td>
            <td><?php echo channel_type($row['channel'])?></td>
            <td><?php echo $row['owner_name']?></td>
            <td><?php echo $row['phone']?></td>
            <td><?php echo get_name($row['added_by'])?></td>
            <td><?php echo $row['reg_date']?></td>
            <td>&nbsp;</td>
          </tr><?php } ?>
		   </tbody>
      </table><?php
		  
	   }  elseif($mode=='distributor_red_score'){
		 	   $distributor_id=$_REQUEST['distributor_id'];
		 ?>
		 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Availabilty</th>
                                  <th>Activation </th>
                                  <th >Cooler</th>
                                  <th>Incharge</th>
                                  <th>Contact</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody >
                             
                              
                              </tbody>
                          </table> <?php }
	    elseif($mode=='new_outlets_MTD'){ 	   $distributor_id=$_REQUEST['distributor_id'];
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
							 $query=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE  MONTH(`reg_date`)='$yearmonth' and YEAR(`reg_date`)='$year' and status=0 and `distributor_id`=$distributor_id order by reg_date")or die(mysqli_error($mysqli));
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
				   $distributor_id=$_REQUEST['distributor_id'];
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
							 $query=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE  MONTH(`reg_date`)='$yearmonth' and YEAR(`reg_date`)='$year' and status=0 and `distributor_id`=$distributor_id and status=2 order by reg_date")or die(mysqli_error($mysqli));
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
			  elseif($mode=='distributor_stock'){	   $distributor_id=$_REQUEST['distributor_id'];
				  ?>
				  <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th>SKU</th>
                                 <?php $i=1; $days=daysInMonth(date('Y'),date('m')); $today=date("d");
								 for($day=1; $day<=$today; $day++) {?> <th><?php echo $day?></th><?php }?></tr> 
                                
                             <!--  <tr><td colspan="2"></td> <?php // for($day=1; $day<=$today; $day++) {?>  <th >Actual</th>
                                <th >Dif</th>      <?php //}?>   </tr>-->
                              </thead>
                            <tbody id="">
                            <?php $pq=mysqli_query($mysqli,"SELECT * from tbl_products where status=0")or die (mysqli_error($mysqli));
							
							while($prow=mysqli_fetch_array($pq)){
								?>
                               <tr><td ><?php echo $i?></td>
                                  <td ><?php echo $prow['product']?></td>
                                 <?php  
								 for($day=1; $day<=$today; $day++) {?> <td ><?php  echo $cur=get_distributor_stock_level($prow['product_id'],$distributor_id,date("Y-m-$day"))?></td><!--<td ><?php //echo ?> </td>--><?php }?>
                                 
                              </tr>
								<?php $i++; }
							?></tbody>
                             
                             
                          </table><?php } elseif($mode=='plant_orders'){ $distributor_id=$_REQUEST['distributor_id'];
							  ?>
                               <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th >Date Ordered</th>
                                  <th >Expected Delivery</th>
                                  <th >Cases</th>
                                  <th>Ordered by</th>
                                   <th>Status</th>
                                   <th >Options</th>
                                 
                                    
                              </tr>
                              </thead>
                            <tbody id="">
                            <?php $pq=mysqli_query($mysqli,"SELECT `distributor_order_id`, `date_ordered`, `expected_delivery_date`, `product_id`, `ordered_by`, sum(number) as number, `state_of_delivery`, `status` FROM `tbl_distributor_orders`  where distributor_id=$distributor_id  group by date_ordered,state_of_delivery   order by date_ordered desc")or die (mysqli_error($mysqli));
							$i=1;
							
							while($prow=mysqli_fetch_array($pq)){
								?>
                               <tr><td><?php echo $i?></td>
                                  <td ><?php echo $prow['date_ordered']?></td>
                                  <td ><?php echo $prow['expected_delivery_date']?></td>
								 <td ><?php echo $prow['number']?></td>
                                   <td ><?php echo get_name($prow['ordered_by'])?></td>
                                    <td ><?php echo $prow['state_of_delivery']?></td>
                                     <td><a href="">View More</a></td>
                              </tr>
								<?php $i++;}
							?></tbody>
                             
                             
                          </table>
							  
							  <?php }
							  elseif($mode=='distributor_staff'){ $distributor_id=$_REQUEST['distributor_id'];
						$i=1?>
			<table id="" class="table table-bordered table-striped table-condensed">
                              <thead>
   <tr>  <th>#</th> <th>Full Name</th>  <th >Email</th><th >Tel</th><th >Role</th>
                                  <th >Region</th><th >Area</th><th >Sub ARea</th></tr>
                              </thead>
                              <tbody id="">
                              <?php $userQ=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `distributor_id`=$distributor_id")or die(mysqli_error($mysqli)); while($user_row=mysqli_fetch_array($userQ)){?>
                              <tr> <td><?php echo $i?></th> <td><?php echo get_name($user_row['user_id'])?></th>  <td ><?php echo $user_row['email']?></th><td ><?php echo $user_row['mobile']?></th><td ><?php echo get_role($user_row['role'])?></th><td ><?php  echo region_name($user_row['region_id'])?></th> <td ><?php  echo area_name($user_row['area_id'])?></th> <td ><?php  echo sub_area_name($user_row['cluster_id'])?></th> </tr>
							  <?php }
							  ?>
                              </tbody>
                          </table>
		
			<?php   }?>
	 