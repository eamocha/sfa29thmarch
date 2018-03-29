<?php

/* Find difference between two dates in days. PHP 5.2.x.  */

$d1 ="2017-09-04 05:19:38";
$d2 = "2017-09-04 09:11:56";
echo time_diff($d1, $d2);

function time_diff($date1, $date2) {
	if(strtotime($date1)>0 && strtotime($date2)>0){
		$diff = abs(strtotime($date2) - strtotime($date1));
		return date("H:i:s",$diff);
	}else return "-";
  
}
?>