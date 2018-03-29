<?php
include_once("assets/lib/config.php");
     include_once("assets/lib/functions.php");
   $mode=$_REQUEST['mode']; 
   $thisMonth=date("m"); $thisYear=date("Y");
   ////////////region details
   if($mode=="region_summary"){
	   $region_id=$_REQUEST['region_id'];
	   $query=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE `region_id`=$region_id and status=0")or die (mysqli_error($mysqli)); 
	   while($row=mysqli_fetch_array($query)){
		  $area_id=$row['area_id']; 
		  $deliveries_todate= deliveries_in_a_month_per_jurisdiction($thisMonth,$thisYear,'area',$area_id);
		  ?><tr>
      <td scope="col"><?php echo area_name($row['area_id'])?></td>
    <td scope="col"> <?php echo num_rows('tbl_clusters',"area_id=$area_id and status=0")?></td>
    <td scope="col"> <?php echo num_rows('tbl_distributors',"area_id=$area_id and status=0")?></td>
    <td scope="col"> <?php echo num_rows('tbl_routes',"area_id=$area_id and status=0")?></td>
    <td scope="col"> <?php echo num_rows('tbl_dealers',"area_id=$area_id and status=0")?></td>
    <td scope="col"> <?php echo total_assets("area",$area_id,1,'')?></td>
    <td scope="col"><?php echo $row['area_contribution']?></td>
    <td scope="col"><?php echo  number_format(get_sum_of_area_targets($area_id,0)/(daysInMonth(date("Y"),date("m"))-4),1)?></td>
    <td scope="col"><?php echo  get_sum_of_area_targets($area_id,0)?></td>
    <td scope="col"><?php echo  get_sum_of_area_targets($area_id,0)*26;?></td>
    <td scope="col"><?php echo $deliveries_todate; ?></td>
    <td scope="col"><?php  if(get_sum_of_area_targets($area_id,0)*26>0)echo number_format($deliveries_todate/get_sum_of_area_targets($area_id,0)*26,1); else echo '<span title="Wrong Targets">N/A</span>' ?></td>
    <td scope="col"><?php echo total_assets("area",$area_id,1,'All')?></td>
    <td scope="col"> <?php echo suckers_in_jurisdiction('area','area_id')?></td>
    <td scope="col"><?php echo num_rows('tbl_competitor_survey'," dealer_id IN(SELECT dealer_id from tbl_dealers where area_id=$area_id) and busted='yes'")?></td>
  
   
  </tr>
  <?php  }///if condition 
   }////////////////mode
    elseif($mode=="region_volume_perfomance"){
		$current_year=$thisYear; $prev_year=$current_year-1;
		for($i=1;$i<13; $i++ ){
		?>
	      
        <tr>
    <th scope="row"><?php echo getMonthString($i)?></th>
     <th scope="row"><?php echo $current_year-1?></th>
    <td><?php echo deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"area","area_id");?></td>
    <td><?php echo $current_year?></td>
    <td>%perfomance</td>
    <td>%perf Vs plan</td>
   
  </tr>
  
  <?php } //end for and start the total footer
  ?>	<tr>
    <th scope="row">YTD</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr><?php
  }/////end tyhe  elseif($mode=="region_volume_perfomance"){ mode
   elseif($mode=="assets"){
	   
		
  ?>
      <table width="100%" class="table table-bordered  table-condensed">
                                       <tr><td>Name</td><td>Outlet</td><td>Status</td><td>Last Check</td></tr>
                                       </table>
  <?php  ///if condition 
	   }
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
	   $region_id=$_REQUEST['region_id'];
	  
	     ?>
      <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Outlet</td><td>Name</td><td>Model</td><td>Serial</td><td>Bar code</td><td>Barcode Format</td><td>Reg. Date</td><td>Remarks</td><td>Last Check</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` WHERE dealer_id IN (SELECT dealer_id FROM tbl_dealers where region_id=$region_id)")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="5">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo business_name($asset['dealer_id'])?></td><td><?php echo $asset['name']?></td><td><?php echo $asset['model']?></td><td><?php echo $asset['serial']?></td><td><?php echo $asset['code']?></td><td><?php echo $asset['code_format']?></td><td><?php echo record_date($asset['date_isued'])?></td><td><?php echo $asset['remarks']?></td><td>-</td></tr>                  
                                       
                                       <?php $n++; }
		}?></table>
  <?php  ///if condition 
	   }
	    elseif($mode=='regional_clusters'){
			$region_id=$_REQUEST['region_id'];
			?>
			 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th></th>
                                  <th>Sub Area</th>
                                  <th>Area</th>
                                  <th>Distributors</th>
                                  <th>Outlets</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody class="regions_list">
                              <?php  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` WHERE region_id=$region_id and status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $cluster=$row['cluster_id'];$area=$row['area_id'];
	?>
    <tr><td><?php echo $i?></td><td><?php echo $row['cluster_name'] ?></td><td><?php echo area_name($row['area_id']) ?></td><td><a href="distributors.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_distributors"," status=0 and cluster_id=".$cluster) ?></a></td><td><a href="region_outlets.php?region_id=<?php echo $row['region_id']?>"><?php echo num_rows("tbl_dealers"," status=0 and cluster_id=".$cluster) ?></a></td><td></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table><?php
	   } elseif($mode=='regional_key_accounts'){
		   $i=1;
		   $region_id=$_REQUEST['region_id'];	
		   	  $res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE region_id=$region_id and status =0  and key_account='yes' order by business_name asc");?>
			  <table width="100%"  class="table table-bordered table-striped table-condensed">
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
          </tr><?php $i++; } ?>
		   </tbody>
      </table><?php
		  
	   }  elseif($mode=='region_distributors'){
		   $region_id=$_REQUEST['region_id'];
		 ?>
		 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Distributor</th>
                                   <th>Area</th>
                                  <th>sub Area</th>
                                  <th>Routes</th>
                                  <th >Outlets</th>
                                    <th >Outlets Verified</th>
                                  <th>Incharge</th>
                                  <th>Contact</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody >
                              <?php  $i=1; $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE region_id=$region_id and  status=0") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { $d_id=$row['distributor_id'];
	?><tr><td><?php echo $i?></td><td><?php echo distributor_name($d_id)?></td><td><?php echo area_name($row['area_id']) ?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><a  href="view_route.php?mode=distributor&mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_routes',"  status=0 and distributor_id=".$d_id) ?></a></td>
    <td><?php echo num_rows('tbl_dealers',"  status=0 and distributor_id=".$d_id) ?></td><td><?php echo num_rows('tbl_dealers',"  status=0 and verified=1 and distributor_id=".$d_id) ?></td><td><?php echo $row['owner'] ?></td><td><?php echo $row['contact'] ?></td><td><button>Delete</button></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table> <?php }
	    elseif($mode=='regional_staff'){
			
			$region_id=$_REQUEST['region_id'];?>
			
			<table id="" class="table table-bordered table-striped table-condensed">
                              <thead>
   <tr>  <th>#</th> <th>Full Name</th>  <th >Email</th><th >Tel</th><th >Role</th>
                                  <th >Region</th><th >Area</th><th >Sub ARea</th></tr>
                              </thead>
                              <tbody id="">
                              <?php $i=1;$userQ=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `region_id`=$region_id")or die(mysqli_error($mysqli)); while($user_row=mysqli_fetch_array($userQ)){?>
                              <tr> <td><?php echo $i?></th> <td><?php echo get_name($user_row['user_id'])?></th>  <td ><?php echo $user_row['email']?></th><td ><?php echo $user_row['mobile']?></th><td ><?php echo get_role($user_row['role'])?></th><td ><?php  echo region_name($user_row['region_id'])?></th> <td ><?php  echo area_name($user_row['area_id'])?></th> <td ><?php  echo sub_area_name($user_row['cluster_id'])?></th> </tr>
							  <?php $i++; }
							  ?>
                              </tbody>
                          </table><?php
	   }
	    elseif($mode=='regional_gmm'){ 		
			$region_id=$_REQUEST['region_id'];?>
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
			$q=mysqli_query( $mysqli,"SELECT `good_morning_meeting_id`, location,`taken_by`, `date_added`, `region`, `area`, `cluster`, `route`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`, `pd_target`, `actual_sales`, `comments_by_supervisor`, `pd_corrective_action_plan`, `challanges_experienced`,distributor, `supervisor_id`, `dsm_incharge`, `attendance_details`, `status` FROM `tbl_good_morning_meeting` WHERE region=$region_id order by date_added desc")or die(mysqli_error($mysqli));
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
                                      <td ><?php echo get_name($r['taken_by']);?></td>
                                      <td ><?php echo $r['comments_by_supervisor'];?></td>
                                      <td ><?php echo get_name($r['supervisor_id']);?></td>
                                       <td ><?php echo $r['dsm_incharge'];?></td>
                                      <td ><a href="goodmm_remarks.php?id=<?php echo $id?>"><?php ?> Add remarks</a></td>
                                       </tr>   
                                <?php $i++; }?>
                                
                          
                              </tbody>
                               
                          </table>
		
			<?php   }
	   /////////////////////////////////////////////////////////////////////////////////////////
	  // AREAS Details*********************************************/
	   /////////////////////////////////////////////////////////////////////////////////////////
	   if($mode=="area_summary"){
	   $area_id=$_REQUEST['area_id'];
	   $query=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` WHERE `area_id`=$area_id and status=0")or die (mysqli_error($mysqli)); 
	   while($row=mysqli_fetch_array($query)){
		  $cluster_id=$row['cluster_id']; 
		  $deliveries_todate= deliveries_in_a_month_per_jurisdiction($thisMonth,$thisYear,'cluster',$cluster_id);
		  ?><tr>
      <td scope="col"><?php echo sub_area_name($cluster_id)?></td>
  
    <td scope="col"> <?php echo num_rows('tbl_distributors'," status=0 and cluster_id=$cluster_id")?></td>
    <td scope="col"> <?php echo num_rows('tbl_routes'," status=0 and cluster_id=$cluster_id")?></td>
    <td scope="col"> <?php echo num_rows('tbl_dealers'," status=0 and cluster_id=$cluster_id")?></td>
    <td scope="col"> <?php echo total_assets("cluster",$cluster_id,1,'')?></td>
    <td scope="col"><?php //echo // number_format(get_sum_of_cluster_targets($cluster_id,0)/get_sum_of_area_targets($area_id,1),1)*100 ?></td>
    <td scope="col"><?php echo  number_format(get_sum_of_cluster_targets($cluster_id,0)/(daysInMonth(date("Y"),date("m"))-4),1)?></td>
    <td scope="col"><?php echo  get_sum_of_cluster_targets($cluster_id,0)?></td>
    <td scope="col"><?php echo  get_sum_of_cluster_targets($cluster_id,0)*26;?></td>
    <td scope="col"><?php echo $deliveries_todate; ?></td>
    <td scope="col"><?php  if(get_sum_of_cluster_targets($cluster_id,0)*26>0)echo number_format($deliveries_todate/get_sum_of_cluster_targets($cluster_id,0)*26,1); else echo '<span title="Wrong Targets">N/A</span>' ?></td>
    <td scope="col"><?php echo total_assets("cluster",$cluster_id,1,'All')?></td>
    <td scope="col"> <?php echo suckers_in_jurisdiction('cluster','cluster_id')?></td>
    <td scope="col"><?php echo num_rows('tbl_competitor_survey'," dealer_id IN(SELECT dealer_id from tbl_dealers where cluster_id=$cluster_id) and busted='yes'")?></td>
  
   
  </tr>
  <?php  }///if condition 
   }////////////////mode
    elseif($mode=="area_volume_perfomance"){
		$current_year=$thisYear; $prev_year=$current_year-1;
		for($i=1;$i<13; $i++ ){
		?>
	      
        <tr>
    <th scope="row"><?php echo getMonthString($i)?></th>
     <th scope="row"><?php echo $current_year-1?></th>
    <td><?php echo deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"cluster","cluster_id");?></td>
    <td><?php echo $current_year?></td>
    <td>-</td>
    <td>-</td>
   
  </tr>
  
  <?php } //end for and start the total footer
  ?>	<tr>
    <th scope="row">YTD</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr><?php
  }/////end tyhe  elseif($mode=="region_volume_perfomance"){ mode
   elseif($mode=="assets"){
	   
		
  ?>
      <table width="100%" class="table table-bordered  table-condensed">
                                       <tr><td>Name</td><td>Outlet</td><td>Status</td><td>Last Check</td></tr>
                                       </table>
  <?php  ///if condition 
	   }
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
    <td><a href="report_sections/view_route_details.php?region=0&rid=<?php echo $route_id?>"><?php echo num_rows('tbl_dealers',' route_id='.$route_id.' and status=0')?></a></td>
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
   elseif($mode=="area_assets"){
	   $area_id=$_REQUEST['area_id'];
	  
	     ?>
     <table width="100%"  class="table table-bordered table-striped table-condensed">
      
	  <thead><tr><td>No</td><td>Outlet</td><td>Name</td><td>Model</td><td>Serial</td><td>Bar code</td><td>Barcode Format</td><td>Reg. Date</td><td>Remarks</td><td>Last Check</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` WHERE dealer_id IN (SELECT dealer_id FROM tbl_dealers where area_id=$area_id)")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="5">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo business_name($asset['dealer_id'])?></td><td><?php echo $asset['name']?></td><td><?php echo $asset['model']?></td><td><?php echo $asset['serial']?></td><td><?php echo $asset['code']?></td><td><?php echo $asset['code_format']?></td><td><?php echo record_date($asset['date_isued'])?></td><td><?php echo $asset['remarks']?></td><td>-</td></tr>                  
                                       
                                       <?php $n++; }
		}?></table>
  <?php  ///if condition 
	   }
	    elseif($mode=='area_clusters'){
			$area_id=$_REQUEST['area_id'];
			?>
			 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Sub Area</th>
                                  <th>Area</th>
                                  <th>Distributors</th>
                                  <th>Outlets</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody class="regions_list">
                              <?php  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` WHERE area_id=$area_id and status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $cluster=$row['cluster_id'];$area=$row['area_id'];
	?>
    <tr><td><?php echo $i?></td><td><?php echo $row['cluster_name'] ?></td><td><?php echo area_name($row['area_id']) ?></td><td><a href="distributors.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_distributors","  status=0 and cluster_id=".$cluster) ?></a></td><td><a href="region_outlets.php?region_id=<?php echo $row['region_id']?>"><?php echo num_rows("tbl_dealers","  status=0 and cluster_id=".$cluster) ?></a></td><td></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table><?php
	   }
	   ///////////////////////////////////////////////////////////////////mode
	    elseif($mode=='area_gmm'){ 		
			$area_id=$_REQUEST['area_id'];?>
                                 <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th rowspan="2" >No</th>
                                  <th rowspan="2" >Where held</th>
                                  <th rowspan="2">Route</th>
                                  <th rowspan="2">Distributor</th>
                                  <th rowspan="2">Sub ARea</th>
                               <!--   <th rowspan="2">Area</th>-->
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
			$q=mysqli_query( $mysqli,"SELECT `good_morning_meeting_id`, location,`taken_by`, `date_added`, `region`, `area`, `cluster`, `route`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`, `pd_target`, `actual_sales`, `comments_by_supervisor`, `pd_corrective_action_plan`, `challanges_experienced`, distributor,`supervisor_id`, `dsm_incharge`, `attendance_details`, `status` FROM `tbl_good_morning_meeting` WHERE area=$area_id order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){ $id=$r['good_morning_meeting_id'];
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td ><?php echo $r['location']?></td>
                                  
                                   <td ><?php echo get_route($r['route']);?></td>
                                  <td ><?php echo distributor_name($r['distributor']);?></td>
                                    <td ><?php echo sub_area_name($r['cluster']);?></td>
                                   <!--  <td ><?php echo area_name($r['area']);?></td>-->
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
                               
                          </table>
		
			<?php   }
	   
	   //////////////////////////////////////////////////////mode
	   
	    elseif($mode=='area_ad_clusters'){
		   $i=1;
		   $area_id=$_REQUEST['area_id'];	$cl_id=array();
		   	  $ADclustersq = mysqli_query($mysqli,"SELECT ad_cluster_id,ad_cluster_name FROM `tbl_ad_clusters` WHERE area_id=$area_id and status=0") or die($mysqli->error);
			  $cols=mysqli_num_rows($ADclustersq); ?>
			  <table width="100%"  class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>Route</th>
            <th>Distributor</th>
         <th> Total Outlets</th>
          <?php while ($col = mysqli_fetch_array($ADclustersq)) {
			  $cl_id[]=$col['ad_cluster_id']; ?>
            <th><?php echo $col['ad_cluster_name'] ?></th><?php }?>
                       </tr>
                  </thead>
        <tbody>
       <?php 
	   	  $routeq = mysqli_query($mysqli,"SELECT a.route_id,a.distributor_id, count(dealer_id) as tt FROM `tbl_routes` a inner join tbl_distributors b on a.distributor_id=b.distributor_id left join tbl_dealers c on a.route_id=c.route_id WHERE a.area_id=$area_id and a.status=0 group by c.route_id order by a.distributor_id,a.route_name") or die($mysqli->error); 
    while ($row = mysqli_fetch_array($routeq)) { 
		   $route=$row['route_id'];
		   $distributor=$row['distributor_id'];?>
		   <tr>
            <td><?php echo $i?></td>
            <td><?php echo get_route($route)?></td>
            <td><?php echo distributor_name($distributor)?></td>
            <td><?php echo $row['tt'];?></td>
          <?php for($n=0;$n<$cols;$n++){ $clid=$cl_id[$n]; $checked="";if(num_rows("tbl_assign_route2adcluster","route_id=$route and ad_cluster_id=$clid and status=0")>0) $checked="checked=checked";else $checked ?> 
           <td><?php echo " <input onclick='save_route2adcluster($clid,$route)' class='assign_route2adcluster' type='radio' name='$route' $checked value='".$route.'_'.$clid."' />"?></td>
		   <?php }?>
            
          </tr><?php $i++; } ?>
		   </tbody>
      </table>
	  
	<?php
		  
	   } 
	   
	   elseif($mode=='area_distributors'){
		   $area_id=$_REQUEST['area_id'];
		 ?>
		 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Distributor</th>
                                   <th>Area</th>
                                  <th>sub Area</th>
                                  <th>Routes</th>
                                  <th >Outlets</th>
                                   <th >Verified Outlets</th>
                                  <th>Incharge</th>
                                  <th>Contact</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody >
                              <?php  $i=1; $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE area_id=$area_id and  status=0") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { $d_id=$row['distributor_id'];
	?><tr><td><?php echo $i?></td><td><?php echo distributor_name($d_id)?></td><td><?php echo area_name($row['area_id']) ?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><a  href="view_route.php?mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_routes',"  status=0 and distributor_id=".$d_id) ?></a></td>
    <td><?php echo num_rows('tbl_dealers',"  status=0 and distributor_id=".$d_id) ?></td> <td><?php echo num_rows('tbl_dealers',"  status=0 and verified=1 and distributor_id=".$d_id) ?></td><td><?php echo $row['owner'] ?></td><td><?php echo $row['contact'] ?></td><td><button>Delete</button></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table> <?php }
						  elseif($mode=='area_routes'){
		   $area_id=$_REQUEST['area_id'];
		 ?>
		 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Route</th>
                                  <th>Distributor</th>
                                   <th>Area</th>
                                  <th>sub Area</th>
                                    <th >AD cluster</th>
                                   <th >Outlets</th>
                                   <th >Verified Outlets</th>
                                   <th>Incharge</th>
                                  <th>Contact</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody >
                              <?php  $i=1; $res=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE area_id=$area_id and  status=0") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { $rid=$row['route_id'];
	?><tr><td><?php echo $i?></td><td><?php echo get_route($rid); ?></td><td><?php echo distributor_name($row['distributor_id']) ?></td><td><?php echo area_name($row['area_id']) ?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><?php echo getColumnName("tbl_assign_route2adcluster a inner join tbl_ad_clusters b on a.ad_cluster_id=b.ad_cluster_id","ad_cluster_name", "a.route_id=$rid") ?></td>
    <td><?php echo num_rows('tbl_dealers',"  status=0 and route_id=".$rid) ?></td> <td><?php echo num_rows('tbl_dealers',"  status=0 and verified=1 and route_id=".$rid) ?></td> <td><?php //echo $row['owner'] ?></td><td><?php //echo $row['contact'] ?></td><td><button>Delete</button></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table> <?php }
	    elseif($mode=='area_ad_assignments'){
			   $i=1;
		   $area_id=$_REQUEST['area_id'];	$cl_id=array();
		   	  $ADclustersq = mysqli_query($mysqli,"SELECT ad_cluster_id,ad_cluster_name FROM `tbl_ad_clusters` WHERE area_id=$area_id and status=0") or die($mysqli->error);
			  $cols=mysqli_num_rows($ADclustersq); ?>
			  <table width="100%"  class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>email</th>
         <th>Last login</th>
          <?php while ($col = mysqli_fetch_array($ADclustersq)) {
			  $cl_id[]=$col['ad_cluster_id']; ?>
            <th><?php echo $col['ad_cluster_name'] ?></th><?php }?>
                       </tr>
                  </thead>
        <tbody>
       <?php 
	   	  $routeq = mysqli_query($mysqli,"SELECT `user_id`, `full_name`, `email`, `mobile`, `logins`, `description`,  `date_registered`, `appVersion`, `leave_from`, `leave_to` FROM `tbl_users` WHERE area_id=$area_id and status=0") or die($mysqli->error); 
    while ($row = mysqli_fetch_array($routeq)) { 
		   $id=$row['user_id'];
		   ?>
		   <tr>
            <td><?php echo $i?></td>
            <td><?php echo get_name($id)?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['logins'];?></td>
          <?php for($n=0;$n<$cols;$n++){ $clid=$cl_id[$n]; $checked="";if(num_rows("tbl_adcluster_asignments","ad_id=$id and ad_cluster_id=$clid and status=0")>0) $checked="checked=checked";else $checked ?> 
           <td><?php echo " <input onclick='adcluster_asignments($clid,$id)' class='adcluster_asignments' type='checkbox' name='$id' $checked value='".$id.'_'.$clid."' />"?></td>
		   <?php }?>
            
          </tr><?php $i++; } ?>
		   </tbody>
      </table>
	  <?php
			
			
	   }
	  /*//////////
	   <!-------------------------------------------------!>
	   
	   Cluster profile details
       */
	  
	    if($mode=="cluster_summary"){
	   $cluster_id=$_REQUEST['cluster_id'];
	   $query=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE `cluster_id`=$cluster_id and status=0")or die (mysqli_error($mysqli)); 
	   while($row=mysqli_fetch_array($query)){
		  $distributor_id=$row['distributor_id']; 
		  $deliveries_todate= deliveries_in_a_month_per_jurisdiction($thisMonth,$thisYear,'distributor',$distributor_id);
		  ?><tr>
      <td scope="col"><?php echo distributor_name($distributor_id)?></td>
 
    <td scope="col"> <?php echo num_rows('tbl_routes',"  status=0 and  distributor_id=$distributor_id")?></td>
    <td scope="col"> <?php echo num_rows('tbl_dealers'," status=0 and distributor_id=$distributor_id")?></td>
    <td scope="col"> <?php echo total_assets("distributor",$distributor_id,1,'')?></td>
    <td scope="col"><?php echo  $row['distributor_contribution']?></td>
    <td scope="col"><?php echo  number_format(get_sum_of_distributor_targets($distributor_id,0)/(daysInMonth(date("Y"),date("m"))-4),1)?></td>
    <td scope="col"><?php echo  get_sum_of_distributor_targets($distributor_id,0)?></td>
    <td scope="col"><?php echo  get_sum_of_distributor_targets($distributor_id,0)*26;?></td>
    <td scope="col"><?php echo $deliveries_todate; ?></td>
    <td scope="col"><?php  if(get_sum_of_distributor_targets($distributor_id,0)*26>0)echo number_format($deliveries_todate/get_sum_of_distributor_targets($distributor_id,0)*26,1); else echo '<span title="Wrong Targets">N/A</span>' ?></td>
    <td scope="col"><?php echo total_assets("distributor",$distributor_id,1,'All')?></td>
    <td scope="col"> <?php echo suckers_in_jurisdiction("distributor",$distributor_id)?></td>
    <td scope="col"><?php echo num_rows('tbl_competitor_survey'," dealer_id IN(SELECT dealer_id from tbl_dealers where distributor_id=$distributor_id) and busted='yes'")?></td>
  
   
  </tr>
  <?php  }///if condition 
   }////////////////mode
    elseif($mode=="cluster_volume_perfomance"){
		//$distributor_id=$_REQUEST['distributor_id'];
		$current_year=$thisYear; $prev_year=$current_year-1;
		for($i=1;$i<13; $i++ ){
		?>
	      
        <tr>
    <th scope="row"><?php echo getMonthString($i)?></th>
     <th scope="row"><?php echo $current_year-1?></th>
    <td><?php //echo deliveries_in_a_month_per_jurisdiction($i,$current_year-1,"distribtor",0);?></td>
    <td><?php echo $current_year?></td>
    <td>-</td>
    <td>-</td>
   
  </tr>
  
  <?php } //end for and start the total footer
  ?>	<tr>
    <th scope="row">YTD</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr><?php
  }/////end tyhe  elseif($mode=="region_volume_perfomance"){ mode
   elseif($mode=="assets"){
	   
		
  ?>
      <table width="100%" class="table table-bordered  table-condensed">
                                       <tr><td>Name</td><td>Outlet</td><td>Status</td><td>Last Check</td></tr>
                                       </table>
  <?php  ///if condition 
	   }
	    elseif($mode=='pervolume'){
	   } elseif($mode=='outlets'){
		   echo "None Listed yet";
	   }  elseif($mode=='deliveries'){
		   echo "No info";
	   }
	    elseif($mode=='staff'){
	   }
	    elseif($mode=='cluster_gmm'){ 		
			$cluster_id=$_REQUEST['cluster_id'];?>
                                 <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th rowspan="2" >No</th>
                                  <th rowspan="2" >Where held</th>
                                  <th rowspan="2">Route</th>
                                  <th rowspan="2">Distributor</th>
                                 <!-- <th rowspan="2">Sub ARea</th>-->
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
			$q=mysqli_query( $mysqli,"SELECT `good_morning_meeting_id`, location,`taken_by`, `date_added`, `region`, `area`, `cluster`, `route`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`,distributor, `pd_target`, `actual_sales`, `comments_by_supervisor`, `pd_corrective_action_plan`, `challanges_experienced`, `supervisor_id`, `dsm_incharge`, `attendance_details`, `status` FROM `tbl_good_morning_meeting` WHERE cluster=$cluster_id order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){ $id=$r['good_morning_meeting_id'];
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td ><?php echo $r['location']?></td>
                                  
                                   <td ><?php echo get_route($r['route']);?></td>
                                   <td ><?php echo distributor_name($r['distributor']);?></td>
                                  <!--  <td ><?php //echo sub_area_name($r['cluster']);?></td>-->
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
                               
                          </table>
		
			<?php   }
	   /////////////////////////////// end region details start distributor
	   
	    if($mode=="cluster_eds"){
	   $distributor_id=$_REQUEST['distributor_id'];
	   $query=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE `distributor_id`=$distributor_id and status=0")or die (mysqli_error($mysqli)); 
	   while($row=mysqli_fetch_array($query)){
		  $route_id=$row['route_id'];
		  $month_target=num_rows('tbl_assets','asset_type_id=1 and status=0 and dealer IN(SELECT dealer_id FROM tbl_dealers WHERE route_id='.$route_id.' and status=0)');
  ?><tr>
    <th scope="row"><?php echo $row['route_name'];?></th>
    <td><a href="report_sections/view_route_details.php?region=0&rid=<?php echo $route_id?>"><?php echo num_rows('tbl_dealers',' route_id='.$route_id.' and status=0')?></a></td>
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
   elseif($mode=="cluster_assets"){
	   $cluster_id=$_REQUEST['cluster_id'];
	  
	     ?>
      <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Outlet</td><td>Name</td><td>Model</td><td>Serial</td><td>Bar code</td><td>Barcode Format</td><td>Reg. Date</td><td>Remarks</td><td>Last Check</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` WHERE dealer_id IN (SELECT dealer_id FROM tbl_dealers where cluster_id=$cluster_id)")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="5">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo business_name($asset['dealer_id'])?></td><td><?php echo $asset['name']?></td><td><?php echo $asset['model']?></td><td><?php echo $asset['serial']?></td><td><?php echo $asset['code']?></td><td><?php echo $asset['code_format']?></td><td><?php echo record_date($asset['date_isued'])?></td><td><?php echo $asset['remarks']?></td><td>-</td></tr>                  
                                       
                                       <?php $n++; }
		}?></table>
  <?php  ///if condition 
	   }
	    elseif($mode=='cluster_distributors'){
			$cluster_id=$_REQUEST['cluster_id'];
			?>
			 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th></th>
                                  <th>Sub Area</th>
                                  <th>Area</th>
                                  <th>Distributors</th>
                                  <th>Outlets</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody class="regions_list">
                              <?php  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE cluster_id=$cluster_id and status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $distributor_id=$row['distributor_id'];$cluster_id=$row['cluster_id'];
	?>
    <tr><td><?php echo $i?></td><td><?php echo $row['distributor_name'] ?></td><td><?php echo area_name($row['area_id']) ?></td><td><a href="distributors.php?mode=cluster&cluster_id=<?php echo $cluster_id?>"><?php echo num_rows("tbl_distributors"," status=0 and cluster_id=".$cluster_id) ?></a></td><td><a href="region_outlets.php?region_id=<?php echo $row['region_id']?>"><?php echo num_rows("tbl_dealers","  status=0 and cluster_id=".$cluster_id) ?></a></td><td></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table><?php
	   } elseif($mode=='cluster_routes'){
			$cluster_id=$_REQUEST['cluster_id'];
			?>
			 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th></th>
                                  <th>Route</th>
                                  <th>Distributor</th>
                                  <th>Sub Area</th>
                                  <th>Area</th>
                                   <th>Outlets</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody >
                              <?php  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE cluster_id=$cluster_id and status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $route_id=$row['route_id'];
	?>
    <tr><td><?php echo $i?></td><td><?php echo $row['route_name'] ?></td><td><?php echo distributor_name($row['distributor_id']) ?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><?php echo area_name($row['area_id']) ?></td><td><a href="region_outlets.php?mode=route&route_id=<?php echo $route_id?>"><?php echo num_rows("tbl_dealers"," status=0 and route_id=".$route_id) ?></a></td><td></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table><?php
	   } elseif($mode=='cluster_key_accounts'){
		   $i=1;
		   $cluster_id=$_REQUEST['cluster_id'];	
		   	  $res = mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE cluster_id=$cluster_id and status =0  and key_account='yes' order by business_name asc");?>
			  <table width="100%"  class="table table-bordered table-striped table-condensed">
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
          </tr><?php $i++; } ?>
		   </tbody>
      </table><?php
		  
	   }  elseif($mode=='cluster_distributors'){
		   $cluster_id=$_REQUEST['cluster_id'];
		 ?>
		 <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Distributor</th>
                                   <th>Area</th>
                                  <th>sub Area</th>
                                  <th>Routes</th>
                                  <th >Outlets</th>
                                  <th>Incharge</th>
                                  <th>Contact</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody >
                              <?php  $i=1; $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE cluster_id=$cluster_id and  status=0") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { $d_id=$row['distributor_id'];
	?><tr><td><?php echo $i?></td><td><a href="distributor_profile.php"><?php echo $row['distributor_name'] ?></a></td><td><?php echo area_name($row['area_id']) ?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><a  href="view_route.php?mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_routes',"  status=0 and distributor_id=".$d_id) ?></a></td>
    <td><?php echo num_rows('tbl_dealers'," status=0 and distributor_id=".$d_id) ?></td><td><?php echo $row['owner'] ?></td><td><?php echo $row['contact'] ?></td><td><button>Delete</button></td></tr>
	<?php $i++; }?>
                              
                              </tbody>
                          </table> <?php }
	    elseif($mode=='cluster_staff'){
			
			$cluster_id=$_REQUEST['cluster_id'];?>
			
			<table id="" class="table table-bordered table-striped table-condensed">
                              <thead>
   <tr>  <th>#</th> <th>Full Name</th>  <th >Email</th><th >Tel</th><th >Role</th>
                                  <th >Region</th><th >Area</th><th >Sub ARea</th></tr>
                              </thead>
                              <tbody id="">
                              <?php $i=1;$userQ=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `cluster_id`=$cluster_id")or die(mysqli_error($mysqli)); while($user_row=mysqli_fetch_array($userQ)){?>
                              <tr> <td><?php echo $i?></th> <td><?php echo get_name($user_row['user_id'])?></th>  <td ><?php echo $user_row['email']?></th><td ><?php echo $user_row['mobile']?></th><td ><?php echo get_role($user_row['role'])?></th><td ><?php  echo region_name($user_row['region_id'])?></th> <td ><?php  echo area_name($user_row['area_id'])?></th> <td ><?php  echo sub_area_name($user_row['cluster_id'])?></th> </tr>
							  <?php   $i++; }
							  ?>
                              </tbody>
                          </table><?php
	
	   }
	   /*//////////////////////////////assets
	   ***********************************************************************
	   ////////////////////////////////////////////////////*/
	 else  if($mode=='asset_summary'){
		   $asset_id=$_REQUEST['asset_id'];
		   ?>
		    <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Outlet</td><td>Name</td><td>Model</td><td>Serial</td><td>Bar code</td><td>Barcode Format</td><td>Reg. Date</td><td>Remarks</td><td>Last Check</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` WHERE asset_id=$asset_id")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="5">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo business_name($asset['dealer_id'])?></td><td><?php echo $asset['name']?></td><td><?php echo $asset['model']?></td><td><?php echo $asset['serial']?></td><td><?php echo $asset['code']?></td><td><?php echo $asset['code_format']?></td><td><?php echo record_date($asset['date_isued'])?></td><td><?php echo $asset['remarks']?></td><td>-</td></tr>                  
                                       
                                       <?php $n++; }
									   }
									   }
  else if($mode=="asset_visit_details"){
	  $asset_id=$_REQUEST['asset_id'];
		   ?>
		    <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Date Checked</td><td>Checked By</td><td>Status</td><td>Acted Upon</td><td>Action Taken</td><td>Acted upon by</td><td>Date repaired</td><td>Remarks</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli," SELECT `asset_status_id`, `asset_id`, `date_checked`, `checked_by`, `remarks`, `state`, `acted_upon`, `action_taken`, `acted_upon_by`, `date_acted_on`, `sync_date`, `status` FROM `tbl_asset_status` WHERE asset_id=$asset_id")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="6">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo $asset['date_checked']?></td><td><?php echo get_name($asset['checked_by'])?></td><td><?php echo $asset['state']?></td><td><?php echo $asset['acted_upon']?></td><td><?php echo $asset['action_taken']?></td><td><?php echo get_name($asset['acted_upon_by'])?></td><td><?php echo ($asset['date_acted_on'])?></td><td><?php echo $asset['remarks']?></td></tr>                  
                                       
                                       <?php $n++; }
									   }
	 
	  }
	  ///////////
	   else if($mode=="asset_repair"){
	  $asset_id=$_REQUEST['asset_id'];
		   ?>
		    <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Faulty details</td><td>Technician Assigned</td><td>Approx. Cost</td><td>Date Repaired</td><td>Remarks On repair</td><td>Repaired_by</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli," SELECT `repair_plan_id`, `asset_status_id`, `assigned_to`, `fault_details`, `approx_cost`, `date_to_be_repaired`, `date_repaired`, `remarks_on_repair`, `repaired_by`, `status` FROM `tbl_asset_repair_plan` WHERE asset_status_id IN (select asset_status_id from tbl_asset_status where asset_id=$asset_id)")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="6">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo $asset['fault_details']?></td><td><?php echo get_name($asset['assigned_to'])?></td><td><?php echo $asset['approx_cost']?></td><td><?php echo $asset['date_repaired']?></td><td><?php echo $asset['remarks_on_repair']?></td><td><?php echo get_name($asset['repaired_by'])?></td></tr>                  
                                       
                                       <?php $n++; }
									   }
		  }
	/////////////////////////
	
	 else if($mode=="asset_movement"){
	  $asset_id=$_REQUEST['asset_id'];
		   ?>
		    <table width="100%" class="table table-bordered  table-condensed">
	  <thead><tr><td>No</td><td>Date Moved</td><td>Recommended_by</td><td>Moved by</td><td>From</td><td>To</td><td>Reason</td><td>Remarks</td></tr></thead><?php $n=1;
        $query=mysqli_query($mysqli," SELECT `move_id`, `date_moved`, `asset_id`, `from_outlet`, `to_outlet`, `recommended_by`, `approved_by`, `authorized_by`, `moved_by`, `date_recommended`, `reason`, `remarks`, `status` FROM `tbl_asset_movement` WHERE asset_id=$asset_id")or die (mysqli_error($mysqli)); 
		if(mysqli_num_rows($query)<1){?>
		 <tr><td colspan="7">None</td></tr>
		<?php } else{
		while($asset=mysqli_fetch_array($query)){?>
                     <tr><td><?php echo $n?></td><td><?php echo $asset['date_moved']?></td><td><?php echo get_name($r['recommended_by'])?></td><td><?php echo get_name($asset['moved_by'])?></td><td><?php echo business_name($asset['from_outlet'])?></td><td><?php echo business_name($asset['to_outlet'])?></td><td><?php echo $asset['reason']?></td><td><?php echo $asset['remarks']?></td></tr>                  
                                       
                                       <?php $n++; }
									   }
	 
	  }								   