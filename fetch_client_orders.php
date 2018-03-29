  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                              <tr>
                                  <th width="34">No.</th>
                                  <th width="150">Client</th>
                                  <th width="150">Description</th>
                                   <th width="120" class="numeric">Date Made</th>
                                  <th width="146" >Due</th>
                                   <th width="146" >Status</th>
                                  <th width="64" class="numeric">Options</th>
                              </tr>
                             </thead>
                             <tbody>
                            <?php $i=1; $q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` WHERE dealer_id=$dealer_id  order by order_id desc") or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ echo "<tr><td colspan=7> No unprocessed Preorders.<a href='create_order.php?dealer_id=$dealer_id'> Make preorder</a></td></tr>";} else{ while($r=mysqli_fetch_array($q)){
								?>  <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo business_name($r['dealer_id'])?></td>
                                  <td class=""><?php echo order_details($r['order_id'])?></td>
                                  <td class=""><?php echo $r['date_made']?></td>
                                  <td class=""><?php echo $r['date_due']?></td>
                                  <td class=""><?php switch($r['status']){ 
								  case 0:
								  echo 'unconfirmed'; 
								  break;
								  case 1:
								  echo 'Delivered'; 
								  break;
								  case 2: 
								  echo 'Confirmed'; 
								  break;
								  case 3:
								  echo "Assigned to: ";
								  echo get_name($r['assigned_to']); 
								  break;
								  case 4: 
								  echo 'Rejected'; 
								  break;
								  case 5: 
								  echo 'Rejected'; 
								  break;
								  }?></td>
                                  <td class=""><a href="delivery_receipt.php?dealer_id=<?php echo $r['dealer_id'] ?>&oid=<?php echo $r['order_id'];?>">View</a></td>
                               </tr><?php $i++; } }//end the else?>
                                 </tbody>
                        </table>