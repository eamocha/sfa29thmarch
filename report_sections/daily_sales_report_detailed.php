<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$date=date("Y-m-d",$_REQUEST['date']); $tsr=$_REQUEST['tsr']; 
	 $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" od.status=0 ";
	
if($tsr==0) 
{
		switch($role){
		case 4: $where=" od.status=0 "; break;//cm
		case 2: $where=" d.region_id=$myregion and od.status=0 "; break;//rm
		case 3: $where=" d.area_id=$myArea and od.status=0 "; break;//arm
		case 1: $where=" d.cluster_id=$cluster_id and od.status=0 "; break;//AD
		case 7: $where=" d.distributor_id=$distributor_id and od.status=0 ";//AD
	}
	 }else{ $where=" made_by=$tsr ";
 }

$i=1; $tt330can=0; $tt330btl=0; $tt500ml=0; $tt=0;
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders_details` od right join tbl_dealers d on od.dealer_id=d.dealer_id  WHERE  date(date_added)='$date' and $where order by date_added ")or die(mysqli_error($mysqli));if(mysqli_num_rows($q)==0){?>
 <tr><td colspan="12">No details available for the criteria selected</td></tr><?php  } else{
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
                                  <td><?php echo get_name($r['added_by']);?></td>
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