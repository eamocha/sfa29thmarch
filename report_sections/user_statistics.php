<?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
$region=$_REQUEST['region_id'];$year=$_REQUEST['year'];  $month=$_REQUEST['month']; $area=$_REQUEST['area']; $sub_area=$_REQUEST['sub_area'];
                              
							  $condition="";
							  if($area==0){} else $condition=" area_id=$area and ";
							  if($sub_area==0){} else $condition." cluster_id=$sub_area and ";
                              $days_in_month= cal_days_in_month(CAL_GREGORIAN, $month, $year);
							 $n=1;
							 $totalw1=0;$totalw1p=0; $totalw2=0; $week3=0; $week4=0; $week5=0;
							  $q=mysqli_query($mysqli,"SELECT full_name,user_id,region_id,area_id FROM `tbl_users` WHERE  region_id=$region and role=1 and status=0") or die(mysqli_error($mysqli));
							  while($row=mysqli_fetch_array($q))
							  {  $user_id=$row['user_id'];
								  ?>    <tr><td><?php echo $n?></td>
                                <td><?php echo get_name($user_id)?></td>
                                 <td><?php echo num_rows1(" tbl_assets "," reg_by=$user_id and status=0 ")?></td>
                                 <td><?php echo num_rows1(" tbl_dealers "," $condition added_by=$user_id and status=0 and verified!=0")?></td>
                               
                             <?php for($i=0;$i<$days_in_month;$i++){ ?><td><?php $date=$year.'-'.$month.'-'.($i+1);
							 
							echo  num_rows1(" tbl_dealers "," $condition added_by=$user_id and status=0 and DATE(reg_date)='$date' ");
							
							 ?></td><?php }?><td><a href="user_outlets.php?user_id=<?php echo $user_id?>"><?php echo num_rows1(" tbl_dealers "," $condition status=0 and added_by=$user_id")?></a></td>
                              </tr><?php $n++;}// end the while
							  							  ?>
                                  <tr><td></td></tr><a href=user_outlets.php?user_id="+data[i].user_id+">"+data[i].num_outlets+"</a>