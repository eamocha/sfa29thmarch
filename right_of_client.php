                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                  	<div >
						<h4>Most Recent Orders</h4><?php //include('add_note.php');?></a> <a href="create_order.php?dealer_id=<?php echo $dealer_id?>" class="btn btn-success pull-right">Make Order</a>
					
                  	</div>
                  
                      <!--NEW EARNING STATS -->
                      <div class="panel terques-chart">
                          <div class="panel-body">
                              <div class="chart">
                                  <ul class="chat-available-user">
                      <?php $q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` o Left Join tbl_users u on u.user_id=o.`made_by` WHERE `dealer_id`=$dealer_id GROUP BY DATE(`date_made`)")or die(mysqli_error($mysqli));
					  if(mysqli_num_rows($q)==0){ echo "No preoders pending.  <a href='create_order.php?dealer_id=$dealer_id'>Please click here to make a preorder";} else
					  while($rows=mysqli_fetch_array($q)){
						  $oid=$rows['order_id'];
						  ?>
                          <li>
                              <a href="delivery_receipt.php?dealer_id=<?php echo $dealer_id ?>&oid=<?php echo $oid;?>">
                                 <?php echo date('d-m-Y',strtotime($rows['date_made'])).''.get_name($rows['preordered_by'])?>
                                  <span class="text-muted"><?php echo nicetime($rows['date_made'])?></span>
                              </a>
                          </li>
                         <?php  }?>
                      </ul>
                            </div></div>
                      </div>
                    
                      <!-- First Activity -->
                      <div><h4> Recent Activities</h4></div>
                      <?php include ('recent_activities.php');?>
                     
                          </div><!-- /col-lg-3 -->