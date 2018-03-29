   <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                              <tr>
                                  <th width="39">No.</th>
                                  <th width="208">Client</th>
                                   <th width="218" class="numeric">Description</th>
                                  <th width="182">Date delivered</th>
                                  <th width="139" >Amount (<?php echo $currency;?>)</th>
                                  <th width="138" >Remarks</th>
                                  <th width="66" class="numeric">Options</th>
                              </tr>
                             </thead>
                             <tbody>  <?php
							 //first check wheter filter is on
							 $where="`status`=1  and dealer_id=$dealer_id";
						
							  $i=1; $qs=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` WHERE $where;") or die (mysqli_error($mysqli)); $nu=mysqli_num_rows($qs); 
							  if($nu==0){ echo  '<tr><td colspan=7>No deliveries made </td><tr>';}
							   else{ while($r=mysqli_fetch_array($qs)){ 
							   
							   $order_id=$r["order_id"];
							     $did=$r["dealer_id"];
								 $supplied_d=$r["date_supplied"];  
							   ?><tr>
                                  <td><?php echo $i?></td>
                                  <td><?php echo  get_client($did)?></td>
                                  <td class="numeric"><?php  echo order_details($order_id); ?></td>
                                  <td class="numeric"><?php echo $supplied_d ; ?></td>
                                  <td class="numeric"><?php echo  price_calc($order_id) ?></td>
                                    <td class="numeric"><?php echo $r['delivery_remarks'] ?></td>
                                  <td class="numeric"><a href="delivery_receipt.php?dealer_id=<?php echo $did?>&oid=<?php echo $order_id?>">View</a></td>
                               </tr>
                             <?php $i++; }} ?>
                             </tbody>
                        </table>