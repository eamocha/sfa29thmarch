<?php
session_start();
 include ("assets/lib/functions.php"); include 'assets/lib/config.php'; include'profile_process.php';
  $user_id=clean($_SESSION['u_id']);
  $old_pass=clean($_REQUEST['old_pass']);
  $new_pass=clean($_REQUEST['new_pass']);

change_password($user_id,$old_pass,$new_pass);
goback();
?>