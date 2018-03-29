 
                  <div class="col-lg-3 ds">
                   
                      <div  class="donut-main">     <h4 >Stock Tracking</h4></div>
                     <div class="desc" style="background-color:#FFF; padding:1px"> <table class="table">
<thead><tr><th>SKU</th><th>Given</th><th>Sold</th></tr></thead>
<?php $date=date("Y-m-d"); $yu=$_SESSION['u_id'];
 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_products` WHERE `status`=0") or die(mysql_error());
if(mysqli_num_rows($q)==0){ echo "<tr><td colspan='3'>No product</td></tr>";
	}else{
		 while($prod=mysqli_fetch_array($q)){  
	$pid=$prod['product_id']; $name= $prod['product'];
	echo "<tr><td>".$name.' '. $prod['flavour']." ". $prod['pack_size']."</td><td>".stock_given($pid,$yu,$date)."</td><td>".brand_amount_sold($pid,$yu,$date)."</td></tr>";
	}
		} ?></table></div>

                      <!-- RECENT ACTIVITIES SECTION -->
                        <div  class="donut-main">     <h4 class="centered mt">Order Generation</h4></div>
                      <!-- First Activity -->
                         <?php include ('upcoming_orders.php');?>
                      <!-- Second Activity -->
                        <!-- USERS ONLINE SECTION -->
                        <div  class="donut-main">     <h4 class="centered mt">Online Staff</h4></div>
                      <!-- First Member -->
              <?php    
               $q=mysqli_query($mysqli,"SELECT distinct(s.user_id) as user_id,pport,full_name FROM `tbl_sessions` s LEFT JOIN tbl_users u on u.user_id=s.user_id WHERE session_status=1 and s.user_id !=$yu order by session_id desc LIMIT 12") or die(mysqli_error($mysqli));
$rows=mysqli_num_rows($q);
if($rows==0){ echo "<div> You are the Only one online</div>";}
 else{
while($r=mysqli_fetch_array($q)){
	?>
	  <div class="desc">
                      	<div class="thumb">
                      		<img class="img-circle" src="<?php echo $r['pport'] ?>" width="35px" height="35px" align="">
                      	</div>
                            	<div class="details donut-main" >
                      		<p><a href="profile.php?uid=<?php echo $r['user_id'];?>"><?php echo $r['full_name'];?></a><br/>
                      		   <muted>Available</muted>
                      		</p>
                      	</div>
                      </div><?php }}?>                 
                             <!-- CALENDAR-->
                        
                      
                  </div><!-- /col-lg-3 -->