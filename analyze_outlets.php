  <?php 
  include 'assets/lib/config.php'; include 'assets/lib/functions.php'; 
 $demarcation_mode=clean($_REQUEST['demarcation_mode']);
 //////regions
 if($demarcation_mode=='regions_stats'){
  $i=1; $res=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` WHERE status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $region=$row['region_id'];
	?><tr><td><?php echo $i?></td><td><?php echo region_name($region) ?></td><td><a href="areas.php?region_id=<?php echo $region?>"><?php echo num_rows("tbl_areas", " status=0 and region_id=".$row['region_id']) ?></a></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","area_id"," region_id=$region and status=0 ".regions_filters_condition())?></td>
                                <td><a href="clusters.php?mode=region&region_id=<?php echo $region?>"><?php echo num_rows("tbl_clusters", " status=0 and region_id=".$region) ?></a></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","cluster_id"," region_id=$region and status=0 ".regions_filters_condition())?></td>
                                <td><a href="AD_clusters.php?mode=region&region_id=<?php echo $region?>"><?php echo num_rows("tbl_ad_clusters", " status=0 and region_id=".$region) ?></a></td>
                                <td></td>
                                <td><a href="distributors.php?mode=region&region_id=<?php echo $region?>"><?php echo  num_rows("tbl_distributors", " status=0 and region_id=".$row['region_id']) ?></a></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","distributor_id"," region_id=$region and status=0 ".regions_filters_condition())?></td>
    <td><a href="view_routes.php?mode=region&region_id=<?php echo $region?>"><?php echo  num_rows("tbl_routes", " status=0 and region_id=".$row['region_id']) ?></a></td>
 <td><?php echo get_distinct_rows("tbl_dealers","route_id"," region_id=$region and status=0 ".regions_filters_condition())?></td>
    <td><a href="region_outlets.php?mode=region&region_id=<?php echo $region?>"?><?php echo  num_rows("tbl_dealers", " status=0 and  route_id>0 and region_id=$region ".regions_filters_condition()) ?></a></td>
    <td><?php echo  num_rows("tbl_dealers", " status=0 and  route_id>0 and verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') and  region_id=$region ".regions_filters_condition()) ?></td>
    <td></td></tr>
                             
	<?php $i++; }?>
                         <tr>
                                <td colspan="2"><strong>Total</strong></td>
                                <td><?php echo num_rows("tbl_areas"," status=0")?></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","area_id"," status=0")?></td>
                                <td><?php echo num_rows("tbl_clusters"," status=0")?></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","cluster_id"," status=0")?></td>
                                <td><?php echo num_rows("tbl_ad_clusters"," status=0")?></td>
                                <td>&nbsp;</td>
                                <td><?php echo num_rows("tbl_distributors"," status=0")?></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","distributor_id"," status=0")?></td>
                                <td><?php echo num_rows("tbl_routes"," status=0")?></td>
                                <td><?php echo get_distinct_rows("tbl_dealers","route_id"," status=0")?></td>
                            <td><?php echo num_rows("tbl_dealers"," status=0 and  route_id>0 ".regions_filters_condition())?></td>
                                <td<?php echo num_rows("tbl_dealers"," status=0 and verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') AND  route_id>0 ".regions_filters_condition())?></td>
                                <td>&nbsp;</td>
                              </tr>   <?php }//end region...................................................................
							  //....start area........................
							  
							  if($demarcation_mode=='areas_stats'){
							$region_id=$_REQUEST['region_id'];
									  $i=1;
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE region_id=$region_id and  status=0 order by area_name") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $area_id=$row['area_id'];
	?><tr><td><?php echo $i?></td><td><?php echo get_area($area_id) ?></td><td><a href="clusters.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_clusters","status=0 and area_id=".$area_id)?></a></td><td><a  href="distributors.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_distributors","status=0 and area_id=".$area_id) ?></a></td>
    <td><a href="view_routes.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_routes"," status=0 and area_id=".$area_id)  ?></a></td><td><a href="region_outlets.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_dealers","status=0 and cluster_id>0 and area_id=$area_id ".regions_filters_condition())?></a></td><td><?php echo num_rows("tbl_dealers","status=0 and cluster_id>0 and  verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') and area_id=$area_id ".regions_filters_condition())?></td><td><a data-id="<?php echo $area_id?>" class='editAreaButton' href="javascript:void(0)" >Edit</a>|<a href="migrate.php?mode=area&id=<?php echo $area_id?>">Delete</a></td></tr>
	<?php $i++; }
	
	}/////end areas mode and start sub_areas_mode
	else if($demarcation_mode=='sub_areas_stats'){
		$id=clean($_REQUEST['id']); $where="";
		$mode=clean($_REQUEST['mode']); if($mode=='area'){$where="area_id=$id";} else if($mode=="region"){$where="region_id=$id";}
 $region_id=0;  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` WHERE $where and status=0 order by cluster_name") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { 
	$region_id=$row['region_id']; $cluster=$row['cluster_id'];$area=$row['area_id'];
	
	?><tr><td><?php echo $i?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><a href="AD_clusters.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_ad_clusters","status=0 and sub_area_id=".$cluster) ?></a></td> <td><a href="distributors.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_distributors","status=0 and cluster_id=".$cluster) ?></a></td>
                                <td><a href="view_routes.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_routes","status=0 and cluster_id=".$cluster) ?></a></td>
                               <td><a href="region_outlets.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_dealers","status=0 and cluster_id=$cluster ".regions_filters_condition()) ?></a></td><td><?php echo num_rows("tbl_dealers","status=0 and verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') and cluster_id=$cluster ".regions_filters_condition()) ?></td>
                                <td><a href="edit_sub_area.php?sub_area_id=<?php echo $cluster?>">Edit</a> | <a href="migrate.php?mode=subArea&id=<?php echo $cluster?>">Delete</a></td>
                              </tr>
	<?php $i++; }
	}//end sub areas
	///start distri
	else if($demarcation_mode=='distributors_stats'){
		
		$id=clean($_REQUEST['id']); $where="";
		$mode=clean($_REQUEST['mode']); if($mode=='area'){$where="area_id=$id";} else if($mode=="region"){$where="region_id=$id";}else if($mode=="cluster"){$where="cluster_id=$id";}
	 $i=1; $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE $where and  status=0 order by area_id, cluster_id,distributor_name ") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { 
	$d_id=$row['distributor_id'];
	?>
    
    <tr><td><?php echo $i?></td><td><a href="distributor_profile.php?mode=distributor&distributor_id=<?php echo $d_id; ?>"><?php echo $row['distributor_name'] ?></a></td><td><?php echo get_name($row['ad_incharge'])?></td>
     <td  class="edit_td" id="<?php echo $d_id; ?>"><span id="contr_<?php echo $d_id; ?>" class="text"><?php echo $row['distributor_contribution']*100; ?></span>
<input type="number" value="<?php echo  $row['distributor_contribution']*100; ?>" class="editbox" id="contr_input_<?php echo $d_id; ?>" /></td>
    <td><?php echo sub_area_name($row['cluster_id'])?></td><td><?php echo area_name($row['area_id'])?></td><td><?php echo region_name($row['region_id'])?></td><td><a  href="view_route.php?mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_routes',"status=0 and distributor_id=".$d_id) ?></a></td>
    <td><a href="region_outlets.php?mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_dealers'," status=0 and cluster_id>0 and route_id>0 and  distributor_id=$d_id ".regions_filters_condition()) ?></a></td><td><?php echo num_rows('tbl_dealers'," status=0 and cluster_id>0 and route_id>0 and verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') and  distributor_id=$d_id ".regions_filters_condition()) ?></td><td><?php echo $row['owner'] ?></td><td><?php echo $row['contact'] ?></td><td><?php echo $row['distributor_class'];?></td><td><?php echo $row['distributor_channel'];?></td><td><a href="edit_distributor.php?distributor_id=<?php echo $d_id?>"> Edit</a> | <a href="distributor_dosa.php?distributor_id=<?php echo $d_id?>">Dosa</a> |  <a href="migrate.php?mode=distributor&id=<?php echo $d_id?>">Delete</a> </td></tr>
	<?php $i++; }
		}///end distributors and start routes
								else if($demarcation_mode=='routes_stats'){
									$i=1;$id=clean($_REQUEST['id']); $where="";
		$mode=clean($_REQUEST['mode']); if($mode=='area'){$where="area_id=$id";} else if($mode=="region"){$where="region_id=$id";}else if($mode=="cluster"){$where="cluster_id=$id";}else if($mode=="distributor"){$where="distributor_id=$id";}
									
												 
							 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE status=0 and ".$where)or die(mysqli_error($mysqli));
							 if(mysqli_num_rows($q)==0){echo  "<tr><td colspan='6'>Empty list</td></tr>";}
							 else{
							while($r=mysqli_fetch_array($q)){
								$route_id=$r['route_id'];?> <tr>
                                  <td><?php echo $i?></td>
                                  <td><?php echo get_route($route_id);?></td>
                                       
                                                  <td><?php echo $r['route_contribution'];?></td>
                                                     <td><?php echo distributor_name($r['distributor_id']);?></td>
                                                          <td><?php echo sub_area_name($r['cluster_id']);?></td>
                                  <td><?php echo area_name($r['area_id']);?></td>
                                  <td><?php echo region_name($r['region_id']);?></td>
                                  <td>
                                  <a href="view_route_details.php?region=<?php echo $r['region_id']?>&rid=<?php echo $route_id?>"><?php echo num_rows('tbl_dealers'," status=0 and cluster_id>0 and route_id=$route_id ".regions_filters_condition());?></a>
                                  </td>
                                  
                                  <td><?php echo num_rows('tbl_dealers'," status=0 and verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') and cluster_id>0 and route_id=$route_id ".regions_filters_condition());?></td>
                                                             
                                   
                                   <td ><a href="edit_route.php?mode=route&id=<?php echo $r['route_id'];?>"> Edit</a> | <a href="route_map.php?route_id=<?php echo $r['route_id']?>">Map</a> | <a href="setRoute_targets.php?route_id=<?php echo $r['route_id']?>">Set targets</a> | <a href="assign_outlets_to_routes.php?region=<?php echo $r['region_id']?>&rid=<?php echo $r['route_id'];?>">Assign</a>|  <a href="migrate.php?mode=route&id=<?php echo $r['route_id'];?>">Delete</a> </td>
                              </tr><?php  $i++;}
							 }
									
									} 
////////////////////////////////////////

	else if($demarcation_mode=='ad_clusters_stats'){
		$role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];
		
		switch($role){
		case 4: $where=" status=0 and added_by=$user "; break;//cm
		case 2: $where=" region_id=$myregion and status=0"; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		 }
		 
		$id=clean($_REQUEST['id']); $where="";
		$mode=clean($_REQUEST['mode']); if($mode=='area'){$where="area_id=$id";} else if($mode=="region"){$where="region_id=$id";}else if($mode=="cluster"){$where="sub_area_id=$id";}else if($mode=="distributor"){$where="distributor_id=$id";}
		
  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_ad_clusters` WHERE $where and status=0 order by area_id,sub_area_id ") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { 
	$region_id=$row['region_id'];
	 $cluster=$row['sub_area_id'];
	  $ad_cluster_id=$row['ad_cluster_id'];
	$area=$row['area_id'];
	?><tr><td><?php echo $i?></td><td><?php echo $row['ad_cluster_name'] ?></td>
                               <td><?php echo sub_area_name($row['sub_area_id']);?></td>
                                  <td><?php echo area_name($row['area_id']);?></td>
                                  <td><?php echo region_name($row['region_id']);?></td>
                                <td><?php echo num_rows("tbl_assign_route2adcluster","ad_cluster_id= $ad_cluster_id")?></td>
                                <td><?php echo num_rows("tbl_dealers"," route_id IN (SELECT route_id from tbl_assign_route2adcluster where status=0 and ad_cluster_id= $ad_cluster_id) ".regions_filters_condition())?></td>
                                <td><?php echo list_ADCluster_assignment($ad_cluster_id)?></td>
                                <td><a href="edit_ad_cluster.php?ad_cluster_id=<?php echo $ad_cluster_id?>">Edit</a> | <a href="read.php?mode=delete_ad_cluster&ad_cluster=<?php echo $ad_cluster_id?>">Delete</a></td>
                                </tr>
	<?php $i++; }
	}//end ad clusters
	
		else if($demarcation_mode=='assets_list'){  session_start();
			$role=$_SESSION['user_role'];
			$region_id=$_SESSION['region_id'];
		$distributor_id=$_SESSION['distributor_id'];
		$area_id=$_SESSION['area_id'];
		$cluster_id=$_SESSION['cluster_id'];
			$where=" status=0 ";
		switch($role){
			case 1:$where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and region_id=$region_id)"; break;
			case 2:$where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and area_id=$area_id)"; break;
			case 3:$where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and area_id=$area_id)"; break;
			case 4:$where.=" "; break;
			
			case 5:$where.=" and role_id!=4 and role_id!=2 and role_id!=3"; break;
			case 8:$where.=" and role_id=6"; break;
			default: $where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and cluster_id=$cluster_id)"; break;
			}
			 $i=1; $u=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` where $where") or die(mysqli_error($mysqli));
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								 
								  $held_by=business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $date_isued=$asset_row['date_isued'];
								   $by=get_name($asset_row['reg_by']);
									$remarks=$asset_row['remarks'];
										$name=$asset_row['name'];
										 $asset_number=$asset_row['asset_number'];
										  $asset_cost=$asset_row['cost'];
										   $condition=$asset_row['asset_condition'];
								   
								 ?>
								 <tr>
                                 <td><?php echo $i?></td>
                                  <td><?php echo $name?></td>
                                  <td><?php echo $model?></td>
                                   <td><?php echo $asset_number?></td>
                                  <td><?php echo $serial?></td>
                                  <td><?php echo $bar_code?></td>
                                  <td><?php echo $date_isued?></td>
                                   <td><?php echo $asset_cost?></td>
                                                        
                                   <td><?php echo $held_by?></td>
                                   <td><?php ?></td>
                                     <td><?php echo $by?></td>
                                    <td><?php echo $condition?></td>
                                     <td><?php echo $remarks?></td>
                                   <td><a href="asset_profile.php?id=<?php echo $id?>">Profile</a></td>
							     </tr>
								 <?php $i++;} 
		}/////////////////////////////////////////////////////////////////////////////////////////////
								 else if($demarcation_mode=='verified_assets'){
									  ob_start();?>
                                 <style>body{font-size:11px; font-family: Calibri;	}
	tfoot {color:black;	font-size:14px;	font-weight:bold;}
table {    border-collapse: collapse;    width: 100%;}
th, td {    text-align: left;    padding: 8px;	border:1px solid #CCC;}
tr:nth-child(even){background-color: #f2f2f2}
</style>
		 <table  id="content_table" class="table table-bordered table-striped table-condensed" >
                              <thead> <tr>
 <th>#</th><th>AD</th> <th>Outlet</th><th>Distributor</th> <th>Area</th>  <th>Longtitute</th><th>latitute</th>   <th>Type</th> 
<th>Model</th><th>Size</th><th>Asset No</th><th>Bar Code</th><th>Ver. Date</th> <th>Condition</th><th>Remarks</th><th>&nbsp;</th>                      </tr></thead>
                              <tbody id="">
		
										 <?php session_start();
			$role=$_SESSION['user_role'];
			$region_id=$_SESSION['region_id'];
		$distributor_id=$_SESSION['distributor_id'];
		$area_id=$_SESSION['area_id'];
		$cluster_id=$_SESSION['cluster_id'];
			$where=" a.status=0 ";
		switch($role){
			case 1:$where.=" and  a.dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and region_id=$region_id)"; break;
			case 2:$where.=" and  a.dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and area_id=$area_id)"; break;
			case 3:$where.=" and  a.dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and area_id=$area_id)"; break;
			case 4:$where.=" "; break;
			
			case 5:$where.=" and role_id!=4 and role_id!=2 and role_id!=3"; break;
			case 8:$where.=" and role_id=6"; break;
			default: $where.="  and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where status=0 and cluster_id=$cluster_id)"; break;
			}
			 $i=1;
		$u=mysqli_query($mysqli,"SELECT asset_id,a.dealer_id,model,code,serial,date_isued,a.reg_by,a.remarks,a.name,asset_number,asset_condition,latitute,longtitute, business_name, area_id,distributor_id,last_visited,asset_size  FROM `tbl_assets` a left join tbl_dealers b on a.dealer_id=b.dealer_id where $where and verification_status='verified' order by area_id,distributor_id ") or die(mysqli_error($mysqli));
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								 
								  $held_by=$asset_row['business_name'];//business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $last_visited=$asset_row['last_visited'];
								   $by=get_name($asset_row['reg_by']);
								  		$remarks=$asset_row['remarks'];
										$name=$asset_row['name'];
										 $asset_number=$asset_row['asset_number'];
										  $asset_size=$asset_row['asset_size'];
										 $distributor=$asset_row['distributor_id']; if($distributor==''){$distributor=0;}
										   $condition=$asset_row['asset_condition'];
										    $area=$asset_row['area_id'];
											 $latitute=$asset_row['latitute'];
											  $longtitute=$asset_row['longtitute'];								   
								 ?>
                              <tr>
                                 <td><?php echo $i?></td>  <td><?php echo $by?></td> <td><?php echo $held_by?></td> <td><?php echo distributor_name($distributor)?></td>  <td><?php echo area_name($area)?></td>  <td><?php echo $longtitute?></td><td><?php echo $latitute?></td> <td><?php echo $name?></td>   <td><?php echo $model?></td><td><?php echo $asset_size?></td><td><?php echo $asset_number?></td> <td><?php echo $bar_code?></td> <td><?php echo $last_visited?></td> <td><?php echo $condition?></td> <td><?php echo $remarks?></td> <td><a href="asset_profile.php?id=<?php echo $id?>">Profile</a></td>
							     </tr>
								 <?php $i++;} 
		?></tbody>
                            
                             
                             
                          </table><?php }///end above
						    $message=ob_get_clean(); echo $message; if(isset($_REQUEST['send_email']))
						  { $send_to_q=$mysqli->query("SELECT email FROM `tbl_users` WHERE status=0 and (role=4 or role=3)")or die($mysqli->error);
						   while($result=mysqli_fetch_array($send_to_q)){
						  $to=$result['email']; $title='Correctly Verified assets as at  '.$today_constant;
					send_email($message ,$title,$to); 
						  }}//sending email?>
                          <!-------------------------end of verified-- -->