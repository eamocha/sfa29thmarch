<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$date=date("Y-m-d",$_REQUEST['date']); $tsr=$_REQUEST['tsr']; 


			 $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" u.status=0 ";


if($tsr==0) 
{
		switch($role){
		case 4: $where=" u.status=0 "; break;//cm
		case 2: $where=" u.region_id=$myregion and u.status=0 "; break;//rm
		case 3: $where=" u.area_id=$myArea and u.status=0 "; break;//arm
		case 1: $where=" u.cluster_id=$cluster_id and u.status=0 "; break;//AD
		case 7: $where=" u.distributor_id=$distributor_id and u.status=0 ";//AD
	}
	 }else{ $where=" made_by=$tsr ";
 }

$i=1; $tt330can=0; $tt330btl=0; $tt500ml=0; $tt=0;
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` u LEFT JOIN tbl_orders_details od on made_by=user_id where $where AND DATE(date_added)='$date'")or die(mysql_error());if(mysqli_num_rows($q)==0){?>
 <tr><td colspan="12">No details available for the criteria selected</td></tr><?php  } else{
							while($r=mysqli_fetch_array($q)){
								$uid=$r['user_id'];
								$region_id=$r['region_id'];							
														
                               ?>
                                
                                 <tr>
                                  <td><?php echo  $i;?></td>
                                   <td><?php echo date_month_name($r['date_added']);?></td>
                                    
                                  
                                  <td><?php echo region_name($region_id);?></td>
                                  
                                  <td><?php echo get_name($r['made_by']);?></td>
                                   <td><?php echo $expected=expected_outlets_to_visit($uid,$date)?></td>
                                  <td><?php echo $actual =actual_day_visits($uid,$date) ?></td>
                                   <td><?php echo percentage_conversion($actual,$expected); ?></td>
                                   <td><?php  $unscheduled=actual_day_visits($uid,$date)-12; if ($unscheduled<12) echo $unscheduled= 0; else echo $unscheduled?></td>
                                   <td><?php echo percentage_conversion($unscheduled,$actual)?></td>
                                   <td><?php echo $success_s_rate=region_success_strike_outlets($region_id,$date)?></td>
                                   <td><?php echo percentage_conversion($success_s_rate,$actual)?></td>
                                   <td ><?php echo number_format(regional_total_sales_in_aday($region_id,$date)/$actual,1);
								   ?></td>
                                  
                              </tr>
                           
                             <?php $i++; }
							  }?>