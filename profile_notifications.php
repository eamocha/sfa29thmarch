<?php 
$sel=mysqli_query("SELECT n.`title` as about, n.priority as pr, n.description as details, u.full_name as full_name, n.date_time as dt FROM `tbl_notification` n left join tbl_users u on u.user_id= n.`from` WHERE n.`status`=0 and user_id=$user_id")or die(mysqli_error($mysqli));
 $num=mysqli_num_rows($sel);
 while($r=mysqli_fetch_array($sel)) {?> 
  <div class="group-rom">
<?php if($num%2==0){?>  <div class="first-part odd"><?php } else {?>  <div class="first-part"<?php } echo $r['about']; ?></div>
  <div class="second-part"><?php echo $r['details'] ?></div>
 <div class="third-part"><?php echo $r['dt'];?></div>
 </div><?php }
 ?>
                    
                    
                    
