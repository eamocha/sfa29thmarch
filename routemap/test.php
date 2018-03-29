<?php
include_once "../assets/lib/functions.php";
include_once "../assets/lib/config.php";
$route_id=$_REQUEST['route_id'];
$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE latitute!=0 and  route_id=$route_id and status=0")or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)==0){ } else {
							while ($row = mysqli_fetch_array($q)) {
    $result[] = array('title' => $row['business_name'],'lat' => $row['latitute'],'lng' => $row['longtitute'],'description' => $row['owner_name']); }
    echo json_encode($result);
}
?>