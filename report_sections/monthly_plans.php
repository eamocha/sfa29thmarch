<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$month=$_REQUEST['month']; $tsr=$_REQUEST['tsr'];  if($month<10) $month="0".$month;
$i=1;
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE `assigned_to`=$tsr and month(`startdate`)='$month' order by dealer_id,startdate ")or die(mysqli_error($mysqli));if(mysqli_num_rows($q)==0){?> <tr><td colspan="12">No details for <?php echo $month. get_name($tsr);?>  the month selected</td></tr><?php } else
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id']; $mes='';
								$state=$r['status']; 
								if ($state==1) $mes='Cancelled'; else $mes='&#10003;';
								
                               ?>
                                
                                 <tr>
                                  <td><?php echo $i;
								   ?></td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo $r['startdate'];?></td>
                                  <td><?php echo survey_history($r['merchandized']);?></td>
                                   <td><?php echo survey_history($r['stock_taken']);?></td>
                                  <td><?php echo survey_history($r['order_done']);?></td>
                                   <td><?php echo $mes; ?></td>
                                   <td><?php echo survey_history($r['visted']);?></td>
                                  
                              </tr>
                           
                             <?php $i++; }?>
                                