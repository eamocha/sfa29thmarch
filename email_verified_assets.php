<?php  include_once 'assets/lib/config.php';
  include_once 'assets/lib/functions.php';
   $subject = 'Performance Report';
$from = 'eamocha@gmail.com';
 $today=date("Y-m-d");
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n". 'Reply-To: '.$from."\r\n" .   'X-Mailer: PHP/' . phpversion();
  $date=date("Y-m-d"); 
// Compose a simple HTML email message
ob_start();
?> <!DOCTYPE html>
<html>
<head>
<style>
body{
  font-size:11px;
	font-family: Calibri;
	}
	tfoot {color:black;
	font-size:14px;
	font-weight:bold;}
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
	
    text-align: left;
    padding: 8px;
	border:1px solid #CCC;
}
tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body> 
 
   <h2 style="text-align:center">Correctly verified assets.</h2><p><a rel="nofollow" href="http://almasisfa.com\excel_verified_assets.php"> Download the excel version here</a> </p>
  	 
                                 <style>body{font-size:11px; font-family: Calibri;	}
	tfoot {color:black;	font-size:14px;	font-weight:bold;}
table {    border-collapse: collapse;    width: 100%;}
th, td {    text-align: left;    padding: 8px;	border:1px solid #CCC;}
tr:nth-child(even){background-color: #f2f2f2}
</style>
		 <table  id="content_table" class="table table-bordered table-striped table-condensed" >
                              <thead> <tr>
 <th>#</th><th>Outlet</th><th>Distributor</th> <th>Area</th>  <th>Longtitute</th><th>latitute</th>   <th>Type</th> 
<th>Model</th><th>Size</th><th>Asset No</th><th>Bar Code</th><th>Ver. Date</th><th>Remarks</th>         </tr></thead>
                              <tbody id="">
		
										 <?php 
			
			$where=" a.status=0 ";
		
			 $i=1;
		$u=mysqli_query($mysqli,"SELECT asset_id,a.dealer_id,model,code,serial,date_isued,a.reg_by,a.remarks,a.name,asset_number,asset_condition,latitute,longtitute, business_name, area_id,distributor_id,last_visited,asset_size  FROM `tbl_assets` a left join tbl_dealers b on a.dealer_id=b.dealer_id where $where and verification_status='verified' order by area_id,distributor_id") or die(mysqli_error($mysqli));
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								 
								  $held_by=$asset_row['business_name'];//business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $last_visited=$asset_row['last_visited'];
								   $by=get_name($asset_row['reg_by']);
								  		$remarks=$asset_row['remarks'];
										$name=$asset_row['name'];
										 $asset_number=$asset_row['asset_number'];
										  $asset_size=$asset_row['asset_size'];
										 $distributor=$asset_row['distributor_id'];
										   $condition=$asset_row['asset_condition'];
										    $area=$asset_row['area_id'];
											 $latitute=$asset_row['latitute'];
											  $longtitute=$asset_row['longtitute'];								   
								 ?>
                              <tr>
                                 <td><?php echo $i?></td>  <td><?php echo $held_by?></td> <td><?php echo distributor_name($distributor)?></td>  <td><?php echo area_name($area)?></td>  <td><?php echo $longtitute?></td><td><?php echo $latitute?></td> <td><?php echo $name?></td>   <td><?php echo $model?></td><td><?php echo $asset_size?></td><td><?php echo $asset_number?></td> <td><?php echo $bar_code?></td> <td><?php echo $last_visited?></td>  <td><?php echo $remarks?></td> 
							     </tr>
								 <?php $i++;} 
		?>   </tbody>                                          
                          </table>
                <div style="text-align:center">The Server time the report was generated <?php echo date('Y-m-d h:i:s')?></dv>
                          
                          </body></html>
                          					  
                           <?php ////get all data for sending
						   $message=ob_get_clean(); echo $message;
// Sending email
 $send_to_q=mysqli_query($mysqli,"SELECT email FROM `tbl_users` WHERE status=0 and role IN(2,3,4,5)")or die(mysqli_error($mysqli)); while($result=mysqli_fetch_array($send_to_q)){
						  $to=$result['email']; $title='Correctly verified assets as at: '.$today_constant;
					send_email($message ,$title,$to); 
						  }?>