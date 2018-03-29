<section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th> Route Name</th>
                                  <th> Description</th>
                                  <th>Assigned to</th>
                                   <th>Assisted by</th>
                                  <th >Date created</th>
                                  <th class="numeric">Dealers</th>
                                  <th>Options</th>
                              </tr>
                              </thead>
                              <tbody>
                             <?php $q=mysqli_query($mysqli,"SELECT r.route_id as rid,r.`route_name` as r_name,r.`details` as descr,`created_by`,`route_assigned_to` as sales_rep,`Assistant_sales` as ass_rep,r.`due_date` as dt_due,`date_created`as dc,r.`status`as status,count(order_id) as orders FROM `tbl_routes` r LEFT JOIN tbl_orders o on o.route_id=r.route_id group by o.route_id")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){?> <tr>
                                  <td><?php echo $r['rid'];?></td>
                                  <td><?php echo $r['dt_due'].'-'; get_name($r['sales_rep']);?></td>
                                  <td><?php echo $r['descr'];?></td>
                                  <td><?php get_name( $r['sales_rep']);?></td>
                                  <td><?php get_name($r['ass_rep']);?></td>
                                  <td ><?php echo $r['dc'];?></td>
                                 <td class="numeric"><?php echo $r['orders'];?></td>
                                   <td ><a href="view_orders.php?rid=<?php echo $r['rid'];?>">Assign</a>|<a href="view_route_details.php?rid=<?php echo $r['rid'];?>">View</a></td>
                              </tr><?php }?>
                               </tbody>
                          </table>
                          </section>