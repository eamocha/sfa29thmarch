<?php
 include ("assets/lib/config.php"); include ("assets/lib/functions.php");
 $mode=$_REQUEST['mode'];
if($mode=='delete'){
 if(isset($_REQUEST['myArray']))
 {
	 $arraytext= explode(",",$_REQUEST['myArray']);
 for ($i=0; $i < count($arraytext);$i++) {

              $myArray=$arraytext[$i];
			  $first=$arraytext[0];
	
$cr_inj="UPDATE `tbl_dealers` SET `status`=1 WHERE dealer_id='$myArray'" or die(mysqli_error($mysqli));
      $in= mysqli_query($mysqli,$cr_inj); 
	    
		      }
			  if(!$in){
		   echo mysqli_error($mysqli);
		   } else echo "done";
	 }
	 
	

}
//if resore
else if($mode=='restore'){
	 if(isset($_REQUEST['myArray']))
 {
	 $arraytext= explode(",",$_REQUEST['myArray']);
 for ($i=0; $i < count($arraytext);$i++) {

              $myArray=$arraytext[$i];
			  $first=$arraytext[0];
	
$cr_inj="UPDATE `tbl_dealers` SET `status`=0 WHERE dealer_id='$myArray'" or die(mysqli_error($mysqli));
      $in= mysqli_query($mysqli,$cr_inj); 
	    
		      }
			  if(!$in){
		   echo mysqli_error($mysqli);
		   } else echo "done";
	 }
	 
	 else{
	 //delete nomally
$cid=clean($_REQUEST['cid']);
$del=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `status`=0 WHERE `dealer_id`=$cid") or die(mysqli_error($mysqli));
if($del) header("location:".$_SERVER['HTTP_REFERER'].""); else echo 'error'.mysqli_error($mysqli);
}}
elseif (isset($_REQUEST['cid'])){
	 //delete nomally
$cid=clean($_REQUEST['cid']);
$del=mysqli_query($mysqli,"UPDATE `tbl_dealers` SET `status`=1 WHERE `dealer_id`=$cid") or die(mysqli_error($mysqli));
if($del) header("location:".$_SERVER['HTTP_REFERER'].""); else echo 'error'.mysqli_error($mysqli);
} 

?>