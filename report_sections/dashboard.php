<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$date=date("Y-m-d",$_REQUEST['date']);
$i=1;
$tt1=0; $tt2=0;$tt3=0; $tt4=0;$tt5=0; $tt6=0; $tt7=0;
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `status`=0 and role=1 ")or die(mysqli_error($mysqli));if(mysqli_num_rows($q)==0){?> <tr><td colspan="12">No details for available</td></tr><?php } else{
							while($r=mysqli_fetch_array($q)){
								$uid=$r['user_id']; 
								$region_id=$r['region_id'];
								$tt1+regional_cases_sell_in($region_id,$date);
								$tt2+=regional_cases_sell_out($region_id,$date);
								$tt3+=actual_day_visits($uid,$date);
								$tt4+=percentage_conversion(actual_day_visits($uid,$date),expected_outlets_to_visit($uid,$date));
								$tt6+=	percentage_conversion(region_success_strike_outlets($region_id,$date),actual_day_visits($uid,$date));
								$tt7+=outlets_added_in_day($uid,$date);						
                               ?>
                                
                                 <tr>
                                  <td><?php echo region_name($region_id)?></td>
                                  <td ><?php echo $r['full_name'];?></td>
                                  <td><?php echo  regional_cases_sell_in($region_id,$date);?></td>
                                  <td><?php echo regional_cases_sell_out($region_id,$date); ?></td>
                                   <td><?php echo $actual=actual_day_visits($uid,$date)?></td>
                                  <td><?php echo percentage_conversion($actual,expected_outlets_to_visit($uid,$date)) ?></td>
                                   <td><?php $unscheduled=$actual-12; if ($unscheduled<12) echo $unscheduled= 0; else echo $unscheduled  ?></td>
                                  <td><?php echo percentage_conversion(region_success_strike_outlets($region_id,$date),$actual)?></td>
                                   <td><?php echo outlets_added_in_day($uid,$date);?></td>
                                  <td><?php echo region_new_outlet_sale_out_cases($region_id,$date) ?></td>
                                   <td><?php if($actual>0) echo number_format(regional_total_sales_in_aday($region_id,$date)/$actual,1); else echo 0 ?></td>
                                  <td>Nc<?php ?></td>
                                   <td>Nc<?php  ?></td>
                                   <td>Nc<?php ?></td>
                                  
                              </tr>
                           
                             <?php $i++; }?>
                             <tr><td colspan="2"> Total</td>
                                  <td><?php echo $tt1 ?></td>
                                  <td><?php echo $tt2?></td>
                                   <td><?php echo $tt3?></td>
                                  <td><?php echo $tt4?></td>
                                   <td><?php  echo $tt5 ?></td>
                                   <td><?php echo $tt6 ?></td>
                                   <td><?php echo $tt7?></td>
                                  <td><?php ?></td>
                                   <td><?php ?></td>
                                  <td><?php ?></td>
                                   <td><?php  ?></td>
                                   <td><?php ?></td>
                                  </tr><?php }?>
                                