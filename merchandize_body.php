<table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='tblAppend'>
  <tr>
    <th scope="col">NO</th>
    <th scope="col">Date</th>
    <th scope="col">O. ad</th>
    <th scope="col">I. ad</th>
    <th scope="col">Merch</th>
    <th scope="col">Chilled</th>
    <th scope="col">Cooler Purity</th>
    <th scope="col">Glasses</th>
    <th scope="col">N. Signs</th>
    <th scope="col">L. panels</th>
    <th scope="col">Promotion</th>
    <th scope="col">Shelf Display</th>
  </tr>
  <?php $i=1;  include_once("assets/lib/config.php");include_once("assets/lib/functions.php");
  $dealer_id=$_REQUEST['dealer_id']; 
$query=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` WHERE dealer_id=$dealer_id order by checkin_id desc")or die(mysqli_error($mysqli)) ;
   if(mysqli_num_rows($query)!=0) {
	   while($checkin_row=mysqli_fetch_array($query)){
		  $day=date("Y-m-d",strtotime($checkin_row['date_timein']));
		    $checkin_date=$checkin_row['date_timein'];
						  $checkout_date=$checkin_row['date_timeout'];
						  $inside_advert='';
						  $outside_advert='';
						  $mechandize='';
						  $has_light_pannels='';
						  $promotion='';
						  $has_glasses='';
						  $fridge='';
						 $has_coasters='';
						  $bar_r='';
						  $has_neon_signs='';
						  $remarks_checkin='';
						  $img1='';
							$img2='';
							$img3='';
							$lat=$checkin_row['latitute'];
							$long=$checkin_row['longtitute'];
							$by=$checkin_row['user_id'];
		  
	 ?>
  <tr>
    <th  ><?php echo $i?></th>
    <th  ><?php echo record_date($day)?></th>
    <td><?php echo survey_history($inside_advert); ?></td>
    <td><?php echo survey_history($outside_advert); ?></td>
    <td><?php echo survey_history($mechandize); ?></td>
    <td><?php echo survey_history($fridge); ?></td>
    <td><?php echo survey_history($bar_r); ?></td>
     <td><?php echo survey_history($has_glasses); ?></td>
     <td><?php echo survey_history($has_neon_signs); ?></td>
    <td><?php echo survey_history($has_light_pannels); ?></td>
    <td><?php echo survey_history($promotion); ?></td>
    <td><?php echo survey_history($has_coasters); ?></td>
  </tr>
  <?php $i++; }}?>
</table>
