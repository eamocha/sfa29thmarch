<table  class="table table-bordered table-striped table-condensed" id="tblExport">
                              <thead>
                              <tr>
                                  <th rowspan="2">Region</th>
                                  <th rowspan="2">Person</th>
                                  <th rowspan="2">Role</th>
                                  <th colspan="3">Week1</th>
                                  <th colspan="3">Week2</th>
                                  <th colspan="3" >Week3</th>
                                  <th colspan="3" >Week4</th>
                                  <th colspan="3" >Week5</th>
                                  <th colspan="3" >Totals</th>
                                </tr>
                              <tr>
                                <th >R.Cmp</th>
                                <th >S.Rate</th>
                                <th >S.Out</th>
                                <th >R.Cmp</th>
                                <th >S.Rate</th>
                                <th >S.Out</th>
                                <th >R.Cmp</th>
                                <th >S.Rate</th>
                                <th >S.Out</th>
                                <th >R.Cmp</th>
                                <th >S.Rate</th>
                                <th >S.Out</th>
                                <th >R.Cmp</th>
                                <th >S.Rate</th>
                                <th >S.Out</th>
                                <th >R.Cmp</th>
                                <th >S.Rate</th>
                                <th >S.Out</th>
                                </tr>
                             
                              </thead>
                              <tbody>
                              
                              <?php 
							
							  $q=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` WHERE  status=0") or die(mysqli_error($mysqli));
							  while($region_row=mysqli_fetch_array($q)){ $r_id=$region_row['region_id']; $pple= check_number_of_pple_in_region($r_id)
								  ?>    <tr>
                                <td valign="top" rowspan="<?php echo $pple+1?>"><?php echo region_name($r_id)?></td>
                                 <?php if($pple+1>1){ //if the region has users then proceed
								$user_query=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE region_id=$r_id order by role")or die (mysqli_error($mysqli));
								while($user=mysqli_fetch_array($user_query)){ $user_id=$user['user_id'];$role=$user['role']; 
																
								?>
                                <td><?php echo get_name($user_id)?></td>
                                <td><?php echo get_role($role)?></td>
                                <?php for($count=0;$count<5; $count++){?><td ><?php echo percent_weekly($date,$count+1,$user_id)?></td>
                                <td><?php echo percentage_weekly_strike_rate($date,$count+1,$user_id) ?></td>
                                <td>&nbsp;</td><?php }?>
                                <td>&nbsp;</td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                              </tr><?php }// end the while
							   }//end the # pple?>
                              <tr>
                                <td>Total</td>
                                <td >&nbsp;</td>
                                <?php for($tc=0; $tc<5; $tc++){?><td><span style="color:blue"><?php echo region_weekly($date,$tc+1,$r_id)?></span></td>
                                <td><span style="color:blue"><?php  echo  regional_strike_rate_weekly($date,$tc+1,$r_id)?></span></td>
                                <td >&nbsp;</td>
                               <?php } ?>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                                <td >&nbsp;</td>
                              </tr>
                              
                             <?php
								  }?>
                                  
                              </tbody>
                          </table>