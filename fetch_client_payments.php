                 
<table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead><tr>
                              <th width="17"></th>
                              <th width="104">Dealer/Outlet</th> <th width="53">Total Payments</th><th width="33" class='hidden-phone'>Total confirmed</th><th width="58" class='hidden-phone'>T. Unconfirmed</th> <th width="64" class='hidden-phone'>Options</th></tr></thead>
                             <tbody> <?php $i=1; $pay_query=mysqli_query($mysqli,"SELECT * FROM `tbl_payments` WHERE dealer_id=$dealer_id ")or die(mysqli_error($mysqli)); if(mysqli_num_rows($pay_query)==0){ echo "<tr><td colspan='7'>I have Never recieved any payment transactions </td></tr>";}
							 else{ while($row=mysqli_fetch_array($pay_query)){
								 ?><tr><td><?php echo $i?></td><td><?php $deal= $row['dealer_id']; echo get_client($deal)?></td><td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $tt=dealer_total_payments($deal)?></td><td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $conf=dealer_total_confirmed($deal)?></td><td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $tt-$conf?></td><td>
 <a href="collect_cash.php?cid=<?php echo $deal;?>">View</a></td></tr>
								 <?php $i++; }}?>
                              </tbody>
                                </table>