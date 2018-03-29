<?php

 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
$pid=clean($_REQUEST['pid']);

$q=mysql_query("DELETE FROM `tbl_stock_levels` WHERE `stock_level_id`=$pid")or die(mysql_error());
if($q)

{	goback();
	}
	else echo mysql_errno;
?>