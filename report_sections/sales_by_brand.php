<div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td width="57"><div >
                       <a href="sales_by_brand_graph.php" class="btn btn-default">Graph</a> </div> <td width="6"></td><td width="37">&nbsp;</td>
                       <td width="6">From</td>
                       <td width="144"><input type="text" class="form-control dpd1" value="<?php echo date('Y-m-d');?>" name="date"></td>
                      <td width="126">&nbsp;</td><td width="62"><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div></span>
                  <!--start -->      <div>Report as at  <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                            <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='tblAppend'>
  <tr class="modal-header "  >
                        <th  >&nbsp;</th>
                        <th  >SKU</th>
                        <th >Pack </th>
                        <th>Type</th>
                        <th >Total</th>
                        <th >This Month</th>
                        <th>This week</th>
                        <th>Today</th>
                       
                      </tr>
                     
                    <?php $i=1; 
					$q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products` p where p.status=0 order by p.product_name desc  ")or die(mysqli_error(i));
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product_name'];$available=$row['q_available']; $type=$row['brand']; $pack=$row['product_code']; $pid=$row['product_id'];?>
                                     <form id="<?php echo $pid ?>" action="save_stock.php" method="post">   <tr  >
                        <td ><?php echo $i?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                       <td><?php echo sales_by_brand_all($pid)?></td>
                       <td><?php echo sales_by_brand_this_month($pid);?></td>
                       <td><?php echo sales_by_brand_this_week($pid);?></td>
                       <td><?php echo sales_by_brand_today($pid)?></td>
                       
                                     </tr>
                 </form>
                     
                                        <?php
										$i++;	}?> 
                      
  </table>         
                        </section>
 
                         
               