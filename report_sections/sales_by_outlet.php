   <?php include '../assets/lib/config.php'; include('../assets/lib/functions.php');
   
    $i=1; $all_sales=0 ;$twomonths_ago=0 ;$onemonth_ago=0 ;$present_month=0 ;$count5=0 ;$count6=0 ;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` where status=0")or die(mysqli_error($mysqli));
			$number=mysqli_num_rows($q);
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
	
							$all_sales+=sales_by_outlet_total($did); $twomonths_ago+=sales_by_outlet_month(date('Y-m-d', strtotime(date('Y-m-d')." -2 month")),$did);$onemonth_ago+=sales_by_outlet_month(date('Y-m-d', strtotime(date('Y-m-d')." -1 month")),$did);$present_month+=sales_by_outlet_month(date('Y-m-d'),$did);
                               ?>
                                
                                 <tr>
                                  <td><?php echo $i;?></td>
                                  <td ><?php echo business_name($r["dealer_id"]);?></td>
                                  <td ><?php echo region_name($r["region_id"])?></td>
                                  <td ><?php echo $r["phone"]?></td>
                                  <td ><?php echo times_visited($did)?></td>
                                  <td ><?php echo sales_by_outlet_total($did);?></td>
                                  <td><?php echo sales_by_outlet_month(date('Y-m-d', strtotime(date('Y-m-d')." -2 month")),$did) ?></td>
                                  <td><?php echo sales_by_outlet_month(date('Y-m-d', strtotime(date('Y-m-d')." -1 month")),$did) ?></td>
                                  <td><?php echo sales_by_outlet_month(date('Y-m-d'),$did)?></td>
                                  <td><?php echo sales_by_outlet_lastvisit($did)?></td>
                                 
                                </tr>
                           
                             <?php $i++; }?>  <tr>
                                   <td>&nbsp;</td>
                                   <td >% summary</td>
                                   <td ></td>
                                   <td ></td>
                                   <td ><?php //echo $count4?></td>
                                   <td><?php //echo $count5?></td>
                                   <td >&nbsp;</td>
                                   <td >&nbsp;</td>
                                   <td >&nbsp;</td>
                                   <td >&nbsp;</td>
                               
                                 </tr>
                        
 