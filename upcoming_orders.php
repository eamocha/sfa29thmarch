
<?php 
$uid=$_SESSION['u_id'];
$i=1; $q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` WHERE DATE(`date_due`)>=date(now()) and `preordered_by`=$uid and DATE(date_supplied)='0000-00-00'") or die(mysqli_error());
?><div class="desc" style="background-color:#FFF; padding:1px">
<table style="padding:0px" class="table"><thead><tr><th>No</th><th>Name</th><th>Made</th><th>Due</th><th>View</th></tr></thead>  <tbody>
<?php
if(mysqli_num_rows($q)==0){
	echo '<tr><td colspan=5>List empty</td></tr>';
	}else{
		 while($row=mysqli_fetch_array($q)){
?><tr><td><?php echo $i?></td><td><?php echo business_name($row['dealer_id'])?></td><td><?php echo date("d.m",strtotime($row['date_made']));?></td><td><?php echo date("d.m.Y",strtotime($row['date_due']));?></td><td><a href="preorder.php?dealer_id=<?php echo $row['dealer_id'];?>&oid=<?php echo $row['order_id'];?>">View</a></td></tr> 
<?php $i++; } 
}
 ?> </tbody></table></div>

 <div class="donut-main">   <h4 class="centered mt">Dormant Outlets</h4></div>
   <form id="dormancy_form" name="" action="" method="post">
    L. Visit<select id='period' name='period' class="dormancy_field"><option value="">Never</option><option value="1">1 day ago</option><option value="2">2 days ago</option><option value="3">3 days ago</option><option value="4">1 week ago</option><option value="5">2 Weeks ago</option><option value="6">3 weeks ago</option><option value="7">1 Month ago</option><option value="8">2 Months</option><option value="9">3 Months ago</option><option value="10">1 Year ago</option></select>
    Order by<select id='dormancy_order_by' name='dormancy_order_by' class="dormancy_field"><option value="1">Name</option><option value="2">Date</option></select>
    </form>
<div class="desc" id="dormancy_div" style="background-color:#FFF; padding:1px"> 
<table style="padding:0px" class="table"><thead><tr><th>No</th><th>Name</th><th>Last Vist</th></tr></thead><tbody id='dormancy_body'>

</tbody></table></div>
<script type="text/javascript">
$(document).ready(function(e) {
	fetch_dormancy();
   $('.dormancy_field').change(function(){
	   $("#dormancy_body").empty();
			    $("#dormancy_body").append("<tr><td colspan=3><img width=30% src='assets/img/loading.gif'></td></tr>");
	  fetch_dormancy();
	   });
});
function fetch_dormancy(){
	var dataset= $("#dormancy_form").serialize();
	   $.ajax({
		   type:"POST",
		   url:"read.php",
		   dataType:"json",
		   data:dataset+'&mode=fetch_dormancy',
		   cache:false,
		   success: function(data){
			   
			   $("#dormancy_body").empty();
			   for(var i=0;i<data.length; i++){
				   n=i+1;
				 $("#dormancy_body").append("<tr><td>"+ n +"</td><td>"+data[i].bname+"</td><td>"+data[i].date_visted+"</td></tr>");
				   }
			   }
		   });}
</script>
  
                  