<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$region=$_REQUEST['region_id'];$year=$_REQUEST['year'];  $month=$_REQUEST['month'];
                              
                              $days_in_month= cal_days_in_month(CAL_GREGORIAN, $month, $year);
							 $n=1;
							 $totalw1=0;$totalw1p=0; $totalw2=0; $week3=0; $week4=0; $week5=0;
							  $q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE  region_id=$region and status=0") or die(mysqli_error());
							  while($row=mysqli_fetch_array($q))
							  {  $dealer_id=$row['dealer_id'];
								  ?>   <tr><td><?php echo $n?></td>
                                <td><?php echo business_name($dealer_id)?></td>
                                  <td><?php echo channel_type($row['channel'])?></td>
                                <td><?php echo last_visit_date($dealer_id)?></td>
                             <?php for($i=0;$i<$days_in_month;$i++){ ?><td><?php $date=$year.'-'.$month.'-'.($i+1);
							echo  day_outlet_sales($dealer_id,$date);
							?></td><?php }?><td></td>
                              </tr><?php $n++;}// end the while
							  							  ?>
                                  <tr><td></td></tr>