<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$date=date("Y-m-d",$_REQUEST['date']); $tsr=$_REQUEST['tsr']; 
$where=1;
if($tsr==0) 
{
	$where=1; }else{ $where=" made_by=$tsr ";
 }

$i=1; $tt330can=0; $tt330btl=0; $tt500ml=0; $tt=0;
$q=mysqli_query($mysqli,"SELECT distinct(od.dealer_id) as dealer_id,date_added,region_id, made_by FROM `tbl_orders_details` od right join tbl_dealers d on od.dealer_id=d.dealer_id  WHERE date(od.`date_added`) !=date(d.reg_date) and date(date_added)='$date' and $where order by business_name ")or die(mysqli_error($mysqli));if(mysqli_num_rows($q)==0){?>
 <tr><td colspan="12">No details available for the criterial selected</td></tr><?php  } else{
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								$date=$r['date_added']; //$mes='';
								//$state=$r['status']; 
							//	if ($state==1) $mes='Cancelled'; else $mes='&#10003;';
							$tt330btl+= new_listing_sales($did,27,$date);
                               $tt500ml+= new_listing_sales($did,34,$date);
                                  $tt330can+= new_listing_sales($did,28,$date);
								
                               ?>
                                
                                 <tr>
                                  <td><?php echo  $i;?></td>
                                   <td><?php echo date_month_name($r['date_added']);?></td>
                                    <td><?php echo  date("H:i:s",strtotime($r['date_added']));?></td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo region_name($r['region_id']);?></td>
                                  <td><?php echo get_name($r['made_by']);?></td>
                                   <td><?php echo new_listing_sales($did,27,$date)?></td>
                                  <td><?php echo new_listing_sales($did,34,$date) ?></td>
                                   <td><?php echo new_listing_sales($did,28,$date) ?></td>
                                   <td><?php echo new_listing_sales($did,27,$date)+new_listing_sales($did,28,$date)+new_listing_sales($did,34,$date)?></td>
                                  
                              </tr>
                           
                             <?php $i++; }?>
                              <tr>
                                  <td colspan="6">Total</td>
                                  
                                   <td><?php echo $tt330btl?></td>
                                  <td><?php echo $tt500ml ?></td>
                                   <td><?php echo $tt330can ?></td>
                                   <td><?php echo $tt?></td>
                                </tr><?php }?>