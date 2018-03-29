<?php include ("assets/lib/config.php"); include ("assets/lib/functions.php");
$q=mysql_query("SELECT * FROM `tbl_sessions` s LEFT JOIN tbl_users u on u.user_id=s.user_id WHERE session_status=1 order by session_id desc LIMIT 5") or die(mysql_error());
$rows=mysql_num_rows($q);
if($rows==0){ echo " You are the Only one online";}
 else{
while($r=mysql_fetch_array($q)){
	?>
	  <div class="desc">
                      	<div class="thumb">
                      		<img class="img-circle" src="assets/img/steve.jpg" width="35px" height="35px" align="">
                      	</div>
                      	<div class="details">
                      		<p><a href="profile.php?uid=<?php echo $r['user_id'];?>"><?php echo $r['full_name'];?></a><br/>
                      		   <muted>Available</muted>
                      		</p>
                      	</div>
                      </div><?php }}?>
