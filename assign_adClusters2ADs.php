<?php session_start()?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assignments</title>
  <style>
 #AD_Clusters {
    border: 1px solid #eee;
    width: 250px;
    min-height: 20px;
    list-style-type: none;
    margin: 10;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  	}
  .sortable li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
    list-style-type: none;
	  }
	li { cursor: pointer; cursor: hand; }
  #maincontainer{ margin-left:270px;}
	  
 .title {
	
	background-color:Red;
	border:0px solid #396;
	
	color:white;
	text-align:center}
	
	 .ul_container{ border: 1px solid #eee;
    width: 300px;
    min-height: 20px;
     margin: 10px;
      float: left;
    margin-right: 10px;}
	
  </style>
  <script  type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script  type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script type="text/javascript">
  $( function() { 	 
	  //////////////////////////
	  $( ".sortable" ).sortable({ 
   connectWith: '.sortable',cursor: 'move',
   placeholder: "widget-highlight",
   // Receive callback
   receive: function(event, ui) { 
     // The position where the new item was dropped
     var newIndex = ui.item.index();
	 var container_id=$(this).attr("id");//container id
	 var item_id=ui.item.attr("id");//the item id
     // Do some ajax action...

     $.post('read.php', {newPosition: newIndex,'item_id':item_id,"container_id":container_id,"mode":"assign_ad2Cluster"}, function(returnVal) {
        // Stuff to do on AJAX post success
     });
   },
   // Likewise, use the .remove event to *delete* the item from its origin list
   remove: function(event, ui) {
     var oldIndex = ui.item.index();
	  var container_id=$(this).attr("id");//container id
	 var item_id=ui.item.attr("id");//the item id
     $.post('read.php', {deletedPosition: oldIndex,'item_id':item_id,"container_id":container_id,"mode":"unassign_adFromCluster"}, function(returnVal) {
        // Stuff to do on AJAX post success
     });

   }
 });
   /////////////////////////
  } );
  </script>
</head>
<body>
 <span id="AD_Clusters"><div class="title"> AD clusers</div>
<ul class="sortable" id="adclusters" ><li> </li>
<?php  include_once "assets/lib/config.php"; include_once "assets/lib/functions.php";

 $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" status=0 ";
	
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		case 1: $where=" sub_area_id=$cluster_id and status=0 "; break;//AD
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
	}
	
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_ad_clusters` WHERE $where") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($q))
{
	$ad_cluster_id=$row['ad_cluster_id'];?>
   <li id="<?php echo $ad_cluster_id?>"><?php echo $row['ad_cluster_name']."(".num_rows("tbl_assign_route2adcluster"," `ad_cluster_id`=$ad_cluster_id and status=0 ")." routes)"?>  </li>
 <?php }?>
</ul></span>


<!-----End of the left wing and start of the main body------->
<div id="maincontainer">
<?php  
switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
	}
$select_users=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE $where and (role=1 or role=11 or role=8) ") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($select_users))
{ $user_id=$row['user_id'];?>
<span class="ul_container">
<div class="title"><?php echo $row['full_name']?></div>
<ul class="sortable"  id="<?php echo $user_id?>">
  <li> </li>
  
  <?php $assignments=mysqli_query($mysqli,"SELECT ad_cluster_name,a.ad_cluster_id as cId FROM `tbl_adcluster_asignments` a Left join tbl_ad_clusters c on a.ad_cluster_id=c.ad_cluster_id  WHERE `ad_id`=$user_id and a.status=0") or die(mysqli_error($mysqli));
while($r=mysqli_fetch_array($assignments))
{?>
   <li id="<?php echo $r['cId']?>"><?php echo $r['ad_cluster_name']?> </li>
   <?php }  ?>
  
   </ul>
</span>

<?php } ?>
</div>
 
 
</body>
</html>