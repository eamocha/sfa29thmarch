<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$date=date("Y-m-d",$_REQUEST['date']); $tsr=$_REQUEST['tsr']; 
$where=1;
if($tsr==0) 
{
	$where=1; }else{ $where="assigned_to=$tsr ";
 }

$i=1; $tt330can=0; $tt330btl=0; $tt500ml=0; $tt=0;
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` rp where DATE(startdate)='$date' and $where")or die(mysqli_error($mysqli));if(mysqli_num_rows($q)==0){?>
 <tr><td colspan="13">No details available for the criteria selected</td></tr><?php  } else{
							while($r=mysqli_fetch_array($q)){
								$assigned_to=$r['assigned_to'];
								$visited=$r["visted"];
								$dealer_id=$r['dealer_id'];
								$startdate=$r['startdate'];
								$date_visted=$r['date_visted'];
								$tt330btl+=new_listing_sales($dealer_id,27,$date);
								$tt330can+=new_listing_sales($dealer_id,28,$date);
								$tt500ml+=new_listing_sales($dealer_id,34,$date);
								
												
														
                               ?>
                                
                                 <tr>
                                  <td><?php echo  $i;?></td>
                                   <td><?php echo date_month_name($startdate);?></td>
                                    
                                  <td><?php echo business_name($dealer_id);?></td>
                                   <td><?php echo dealer_route($dealer_id);?></td>
                                  
                                  <td><?php echo yes_no($visited);?></td>
                                   <td><?php echo date("h:i:s",strtotime($date_visted))?></td>
                                  <td><?php echo outlet_last_visit($dealer_id) ?></td>
                                      <td><?php  period_btn_2dates($date_visted,outlet_last_visit($dealer_id))?></td>
                                      <td><?php //unschedule outlet ?></td>
                                   
                                   <td><?php echo new_listing_sales($dealer_id,27,$date)?></td>
                                  <td><?php echo new_listing_sales($dealer_id,34,$date) ?></td>
                                   <td><?php echo new_listing_sales($dealer_id,28,$date) ?></td>
                                   <td><?php echo new_listing_sales($dealer_id,27,$date)+new_listing_sales($dealer_id,28,$date)+new_listing_sales($dealer_id,34,$date)?></td>
                                  
                              </tr>
                           
                             <?php $i++; } ?>
							  <tr>
                                  <td colspan="9">Total</td>
                                  
                                   <td><?php echo $tt330btl?></td>
                                  <td><?php echo $tt500ml ?></td>
                                   <td><?php echo $tt330can ?></td>
                                   <td><?php echo $tt330btl+$tt330can+$tt500ml?></td>
                                </tr><?php }?>