<?php require_once('assets/lib/config.php');
$query = mysql_query("select * from tbl_dealers");
while($fetch = mysql_fetch_array($query))
{
$output[] = array ($fetch[0],$fetch[1],$fetch[2],$fetch[3],$fetch[4],$fetch[5]);
}
echo json_encode($output);?>