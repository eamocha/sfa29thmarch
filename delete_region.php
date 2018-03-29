<?php session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
 $region=clean($_REQUEST['region_id']);
delete_region($region);
?>