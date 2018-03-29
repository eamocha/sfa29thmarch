<?php

/* 
* Given longitude and latitude in North America, return the address using The Google Geocoding API V3
*
*/
$uid=$_REQUEST['uid'];
 include('assets/lib/config.php'); include('assets/lib/functions.php'); $date=date("Y-m-d");
 $quer=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` WHERE `longtitute`!=0 AND `latitute` !=0 and user_id=$uid order by checkin_id desc limit 200") or die(mysqli_error($mysqli));
 $i=1;
while($coord_row=mysqli_fetch_array($quer)){
$lat=$coord_row['latitute'];
$long=$coord_row['longtitute'];
$user=$coord_row['user_id'];
$datetime=$coord_row['date_timein'];

?><div class="desc"><div class="thumb"><span class="badge bg-theme"><i class="fa fa-clock-o"></i></span></div> 
<div class="details"><p><muted><a href="track_me.php?uid=<?php echo $user?>"><?php echo get_name($user);?></a></muted><br/><?php echo ' was at ' ;
d( Get_Address_From_Google_Maps($lat, $long));
echo ' at '.$datetime; ?><br/></p></div></div>
<?php

$i++;}
?>
