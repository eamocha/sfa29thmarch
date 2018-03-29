 <table class="table" style="margin:auto; padding:10px" width="">
 <?php   include_once("assets/lib/config.php");include_once("assets/lib/functions.php");
 $dealer_id=$_REQUEST['dealer_id'];
 
 $q=mysqli_query($mysqli,"SELECT `photo_id`, `dealer_id`, `photo_details`, `image`, `photo_taken_by`, `date_taken`, `sync_status`, `status` FROM `tbl_photos` WHERE  dealer_id=$dealer_id")or die(mysqli_error($mysqli)); 
 if(mysqli_num_rows($q)!=0){
	while($r=mysqli_fetch_array($q)){
		$img1=$r['image'];$img2=$r['image'];$img3=$r['image'];
		?>
		<tr><td style="margin:auto; padding:10px"><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo image_properties($img1)?>" href="<?php echo $img1?>"><img class="img-responsive" src="<?php echo $img1?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                      Date: <?php echo $r['photo_details']." ".$r['date_taken']?> </div></td><td style="margin:auto; padding:10px"><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php  echo image_properties($img2)?>" href="<?php echo $img2?>"><img class="img-responsive" src="<?php echo $img2?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div>Date: <?php echo $r['photo_details']." ".$r['date_taken']?></td><td style="margin:auto; padding:10px"><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo image_properties($img3)?>" href="<?php echo $img3?>"><img class="img-responsive" src="<?php echo $img3?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div><br/>
        Date: <?php echo  $r['photo_details']." ".$r['date_taken']?></td></tr>
		<?php
		
		 }
 }//end if
 else{
	 echo '<tr><td colspan="3"> No photo taken for this outlet</td></tr>';}
 
	?></table>
    