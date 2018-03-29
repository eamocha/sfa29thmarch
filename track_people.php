<?php

/* 
* Given longitude and latitude in North America, return the address using The Google Geocoding API V3
*
*/
 include('assets/lib/config.php'); include('assets/lib/functions.php');
 $q=mysqli_query($mysqli,"SELECT * from tbl_users WHERE status=0 order by full_name ")or die(mysqli_error());
 while($r=mysqli_fetch_array($q)){
	 where($r['user_id']);
	 }
 
 function where($id){
	 global $mysqli;
 $quer=mysqli_query($mysqli,"SELECT id, `time` as date_time, `user_id`, `lat`, `lon` FROM `tbl_locations` WHERE user_id=$id and `lon`!=0 AND `lat` !=0 order by id desc limit 1 ") or die(mysqli_error());
 $i=1;
while($coord_row=mysqli_fetch_array($quer)){
$lat=$coord_row['lat'];
$long=$coord_row['lon'];
$user=$coord_row['user_id'];
date_default_timezone_set('Africa/Nairobi');

$datetime=date('D, d M Y h:i:s',($coord_row['date_time']/1000));

?><div class="desc"><div class="thumb"><span class="badge bg-theme"><i class="fa fa-clock-o"></i></span></div> 
<div class="details"><p><muted><a href="track_me.php?uid=<?php echo $user?>"><?php echo get_name($user);?></a></muted><br/><?php echo ' was at ' ;
d( Get_Address_From_Google_Maps($lat, $long));
echo ' on '.$datetime; ?><br/></p></div></div>
<?php

$i++;}
 }
?>
