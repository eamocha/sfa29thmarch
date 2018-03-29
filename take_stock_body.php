

<div class="col-lg-9 main-chart">
                 <?php include('submenu.php');?>
                     <table  width="100%"><tr><th><a href="routes.php">Go Back</a></th><th colspan="3"> <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <h3>Outlet Name:  
                          <?php 
					 				echo business_name($dealer_id)?>
                      </h3>
                      </div></th></tr>
                       <!--Deliver products-->
                       <tr class="deliver">
                         <td>Take stock</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                       </tr>
                       
  </table>
<div style="background-color:#FFF">
   <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='tblAppend'>
  <tr class="modal-header "  >
                        <th  >&nbsp;</th>
                        <th  >SKU</th>
                        <th >Pack </th>
                        <th>Type</th>
                        <th >Cases</th>
                        <th >Pieces</th>
                        <th>Action</th>
                      </tr>
                     
                    <?php $i=1; 
					$q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products` p where p.status=0 order by p.product desc  ")or die(mysql_error());
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product'];$available=$row['q_available']; $type=$row['pack_size']; $pack=$row['variant']; $pid=$row['product_id'];?>
                                     <form id="stock_form<?php echo $pid ?>" class="stock_form" action="save_stock.php?plan_id=<?php echo $plan_id?>" method="post">   <tr  >
                        <td ><?php echo $i.$pid?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                       <?php $qu=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `product_id`=$pid and Date(`date_added`)=Date(NOW()) and dealer_id=$dealer_id") or die(mysql_error());
					   $result=mysqli_fetch_array($qu); $stock_id=$result['stock_level_id']; $cases=$result['cases']; $singles=$result['singles']; if(mysqli_num_rows($qu)==1){?><td><?php echo $cases?></td><td><?php echo $singles?></td><td><a href="edit_stock.php?pid=<?php echo $stock_id?>">Edit</a></td><?php } else {?>
                       <td> <input class="validate[required]" type='text' name='crates' size="3" id='crates<?php echo $pid?>' value="0"></td><td><select  name='singles' id='singles<?php echo $pid?>'><script type="text/javascript">for(i=0;i<24; i++){
						   document.write("<option value='"+i+"'>"+ i+"</option>")}</script></select></td><input type="hidden" name="pid" value="<?php echo $pid?>" id="<?php echo $pid?>" /><input type="hidden" name="dealer_id" value="<?php echo $dealer_id?>" id="<?php echo $dealer_id?>" />
                        <td> <input name='save'  id="<?php echo $pid?>" type='submit' value='save'></td><?php }?>
                      </tr>
                 </form>
                     
                                        <?php
										$i++;	}?> 
                      
  </table>         
            <div style="height:auto; background-color:#FFF; float:right; ">
              <?php echo check_merchandized($plan_id,$dealer_id)?></div>        
                 
</div></div>
               