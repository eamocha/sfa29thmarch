<?php

/* 
* Given longitude and latitude in North America, return the address using The Google Geocoding API V3
*
*/
 include('../assets/lib/config.php'); include('../assets/lib/functions.php');
 $quer=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` WHERE `longtitute`!=0 AND `latitute` !=0  order by checkin_id desc ") or die(mysqli_error($mysqli));
 $i=1;
while($coord_row=mysqli_fetch_array($quer)){
$lat=$coord_row['latitute'];
$long=$coord_row['longtitute'];
$user=$coord_row['user_id'];
$datetime=$coord_row['date_timein'];
echo $i. ' ' ; 
echo get_name($user);
echo ' was at ' ;
d( Get_Address_From_Google_Maps($lat, $long));
echo ' at '.$datetime.'<br/>';
$i++;}
?>