<?php 
$to="+254727755094@safaricomsms.com";
$from="eatinga@hotmail.com";
$message="This is an sms gateway";
$heahers="From: $from\n";
mail($to,"",$message,$heahers);
?>