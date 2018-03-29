<?php session_start(); require '../assets/lib/functions.php';
 require '../assets/lib/config.php';
 $mode=$_REQUEST['mode'];
 //defaults 
 $year=$_REQUEST['year'];
 $month=$_REQUEST['month'];
 if($month<1) $month=date("m");  if($year<2000)  $year=date("Y");

 						 $exc_empties =" sku_id NOT IN $EMPTIES";
 						 $daysInMonth=daysInMonth(date('Y'),date('m'));$tarehe=date('d'); 
						$role=$_SESSION['user_role']; 
						 $myregion=$_SESSION['region_id'];
						  $myArea=$_SESSION['area_id'];
						  $cluster_id=$_SESSION['cluster_id'];
						  $distributor_id=$_SESSION['distributor_id'];
						  
						  ////////////////////////////////////////////////////////////////////////////////////////////////////////////
						
						  $where="a.status=0 and a.region_id=$myregion AND a.area_id=$myArea";
						 
	switch($role){
		case 4: $where=$where; break;//cm
		case 2: $where=" a.region_id=$myregion and a.status=0 and area_id=$myArea "; break;//rm
		case 3: $where=" a.area_id=$myArea and a.status=0 "; break;//arm
		case 1: $where=" a.cluster_id=$cluster_id and a.status=0 "; break;//AD
		case 7: $where=" a.distributor_id=$distributor_id and a.status=0 ";//AD
		 }
						 
 if(isset($_REQUEST['region']) and $_REQUEST['region']>0 )
{   $area_id=$_REQUEST['area'];
    $region_id = $_REQUEST['region']; 
	 if($area_id<1){$where="a.status=0 and a.region_id=$region_id ";} 
	 else if($area_id>0){ $where="a.status=0 and a.region_id=$region_id and a.area_id=$area_id";}
	else if(isset($_REQUEST['route_id']) && $_REQUEST['route_id']>0){ $route_id=$_REQUEST['route'];$where="a.status=0 and a.route_id=$route_id";}
		else if(isset($_REQUEST['distributor']) and $_REQUEST['distributor']>0){ $distributor_id=$_REQUEST['distributor'];$where="a.status=0 and a.distributor_id=$distributor_id";}
	   }
				
				//////////////////////////// route sales
				  if($mode=='route_sales'){		 
		$dq=mysqli_query($mysqli,"SELECT distributor_name,a.distributor_id,ad_incharge FROM tbl_distributors a WHERE $where order by a.region_id,a.area_id") or die(mysqli_error($mysqli));
							  while($dr=mysqli_fetch_array($dq)){ 
							  $d=1;
								  $id=$dr['distributor_id'];
								 $ttjuzi=0; $ttjana=0; $ttleo=0;
		$rq=$mysqli->query("SELECT route_name,route_id,route_contribution,this_month_target FROM tbl_routes WHERE status=0 AND distributor_id=$id order by route_name") or die(mysqli_error($mysqli));
								while($r=mysqli_fetch_array($rq))
								{
								  $rid=$r['route_id'];

								   ?>
                              <tr>
                                 <td><?php echo $d?></td>  <td><a href="route_profile.php?route_id=<?php echo $rid?>"><?php echo $r['route_name']?></a></td> <td><?php //echo get_name($r['ad_incharge'])?></td>  <td><?php echo $r['this_month_target']?></td>  <td><?php echo $dailyTarget= number_format($r['this_month_target']/$daysInMonth,1)?></td><td><?php echo $dailyTarget*$tarehe;?></td> <?php for($day=1; $day<=$tarehe; $day++) {?> <td><?php  echo sum_columns("tbl_route_sales","qty_sold"," `route_id`=$rid and date(date_sold)='".date($year.'-'.$month.'-'.$day)."' and status=0 and $exc_empties")?></td><?php }?>
							    <td><a href="raw_data.php?mode=sellout&route_id=<?php echo $rid?>">View</a></td> </tr>
								 <?php $d++;} 
		?> <tr class="red_tr" style="background-color:#F00 !important; font-weight:bold; color:#FFF; text-transform:uppercase;" ><td class="red" colspan="2"><?php echo $dr['distributor_name']?></td><td class="red" colspan="4"><?php ?></td> <?php for($day=1; $day<=$tarehe; $day++) {?> <td class="red"><?php  echo sum_columns("tbl_route_sales","qty_sold"," `distributor_id`=$id and date(date_sold)='".date($year."-".$month."-".$day)."' and status=0 and $exc_empties")?></td><?php }?><td class="red" ></td> </tr>
        
         <?php }//end area		 
		 
						  }///end mode route sales
/****distributor sales******************************************************************/
						else  if($mode=='distributor_sales'){
								$o=1;	
																
						 		$dq=mysqli_query($mysqli,"SELECT area_name,full_name,a.area_id,adm_incharge,a.region_id,a.area_id FROM tbl_areas a RIGHT join tbl_users b on a.arm_incharge=b.user_id WHERE $where order by a.region_id,a.area_id") or die(mysqli_error($mysqli));
							  while($dr=mysqli_fetch_array($dq)){ $d=1; $id=$dr['area_id'];
								  $region_id=$dr['region_id']; 
								
		$rq=$mysqli->query("SELECT distributor_id,ad_incharge,distributor_name,distributor_contribution,this_month_target FROM tbl_distributors WHERE status=0 AND area_id=$id ") or die(mysqli_error($mysqli));
								while($r=mysqli_fetch_array($rq)){
								  $distributor_id=$r['distributor_id'];
								  									 
								   ?>
                              <tr>
                                 <td><?php echo $d?></td>  <td><?php echo distributor_name($r['distributor_id'])?></td> <td><?php echo get_name($r['ad_incharge'])?></td>  <td><?php echo $r['this_month_target']?></td>  <td><?php echo $dailyTarget= number_format($r['this_month_target']/$daysInMonth,1)?></td><td><?php echo $dailyTarget*$tarehe;?></td> <?php for($day=1; $day<=$tarehe; $day++) {?> <td><?php  echo sum_columns("`tbl_route_sales` a INNER JOIN tbl_routes b ON a.route_id=b.route_id","qty_sold"," b.`distributor_id`=$distributor_id and date(date_sold)='".date($year.'-'.$month.'-'.$day)."' and a.status=0 and $exc_empties")?></td><?php }?>
							     </tr>
								 <?php $d++;} 
		?> <tr class="red_tr" style="background-color:#F00 !important; font-weight:bold; color:#FFF; text-transform:uppercase;" ><td class="red" colspan="2"><?php echo $o.".".$dr['area_name']?></td><td class="red" colspan="4"><?php echo $dr['full_name']?></td> <?php for($day=1; $day<=$tarehe; $day++) {?> <td class="red" ><?php  echo sum_columns("tbl_route_sales","qty_sold"," `area_id`=$id and date(date_sold)='".date($year.'-'.$month.'-'.$day)."' and status=0  and $exc_empties")?></td><?php }?> </tr>
        
         <?php $o++; }
							  }///end distributor_sales
							  else if($mode=="raw_data"){ $b=1;
								  $date=date('Y-m-d');
					  if(isset($_REQUEST['date'])){$date=$_REQUEST['date'];} $where=$where." and date(date_sold)='$date'";
								  
								  $q1=$mysqli->query("SELECT product,full_name,route_name,a1.pack_size,qty_sold,date_sold FROM `tbl_route_sales` a LEFT JOIN tbl_products a1 on sku_id=a1.product_id LEFT JOIN tbl_users b on sold_by=b.user_id LEFT JOIN tbl_routes c on a.route_id=c.route_id WHERE $where order by c.route_id,c.distributor_id, c.area_id") or die($mysqli->error);
								  if(mysqli_num_rows($q1)<1){echo " <tr><td colspan=7>Empty List.. </td></tr>";}
								 while($r1=mysqli_fetch_array($q1)){  ?>
                                 <tr><td><?php echo $b?></td><td><?php echo $r1['product']?></td><td><?php echo $r1['qty_sold']?></td><td><?php echo $r1['date_sold']?></td><td><?php echo $r1['route_name']?></td><td><?php echo $r1['full_name']?></td><td><?php echo "View More"?></td></tr>
								  <?php
								$b++; }
								  }?> 
                                  