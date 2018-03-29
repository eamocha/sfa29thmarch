<?php session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php';
 $category=clean($_REQUEST['category']);
delete_category($category);
?>