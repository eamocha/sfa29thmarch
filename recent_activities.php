<?php 
//include ("assets/lib/config.php"); include ("assets/lib/functions.php");

//$result=array();
$q=mysqli_query($mysqli,"SELECT l.date_time as dt, u.full_name as name, l.description as descr,u.user_id as uid FROM `tbl_logs` l LEFT JOIN tbl_users u on l.user_id=u.user_id order by log_id desc LIMIT 5") or die(mysqli_error($mysqli));
if($q->num_rows>0){
	 while($row=mysqli_fetch_array($q)){
	
?><div class="desc"><div class="thumb"><span class="badge bg-theme"><i class="fa fa-laptop"></i></span>                      	</div> <div class="details"><p><muted><?php echo nicetime($row['dt']);?></muted><br/><a href="my_logs.php?uid=<?php echo $row['uid']?>"><?php echo $row['name']?></a> <?php echo $row['descr']?><br/></p></div></div>
<?php }
} //if the suer type is warehouse, display the tracking stock table
if($_SESSION['user_role']==3){ 
?>


<div class="desc" style="background-color:#FFF; padding:1px">

<h3> Tracking Stock</h3>

<table class="table"><thead><tr><th>Product</th><th>Avai</th><td>Today sales</td></thead>
<tbody>
<?php $tot=0; $q=mysqli_query($mysqli,"SELECT * FROM `tbl_products` WHERE status=0 order by product")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$pid=$r['product_id'];
								$tot+=$r['q_available']
								?>
								<tr><td><?php echo $r['product'] ?></td><td><?php echo $r['q_available']?></td><td><?php echo $r['q_available']?></td><td></td></tr><?php
							}?>
                            <tr><td colspan="2">Totals</td><td><?php echo $tot?></td></tr></tbody></table>
</div><?php }
 ?>
 

                      		