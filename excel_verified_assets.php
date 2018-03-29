<?php
include_once "assets/lib/config.php";

include_once "assets/lib/functions.php";


require 'assets/lib/php-export-data.class.php';




$u=mysqli_query($mysqli,"SELECT asset_id,a.dealer_id,model,code,serial,date_isued,a.reg_by,a.remarks,a.name,asset_number,asset_condition,latitute,longtitute, business_name, area_id,distributor_id,last_visited,asset_size  FROM `tbl_assets` a left join tbl_dealers b on a.dealer_id=b.dealer_id where a.status=0 and verification_status='verified' order by area_id,distributor_id asc") or die(mysqli_error($mysqli));
													   
				
                                 
// 'browser' tells the library to stream the data directly to the browser.
// other options are 'file' or 'string'
$what="Verified Assets";
$exporter = new ExportDataExcel('browser', $what.".xls");
$exporter->initialize(); // starts streaming data to web browser
///header
$exporter->addRow(array("No","Reg By","held by", "distributor", "area","longtitute","latitute","name","model","asset_size","asset_number","bar_code","last_visited","condition","remarks"));
// pass addRow() an array and it converts it to Excel XML format and sends 
// it to the browser
$i=1;
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
											  $dist= distributor_name($distributor);$area_name= area_name($area);	
															  
 $exporter->addRow(array($i, $by,$held_by,$dist,$area_name,$longtitute,$latitute,$name,$model,$asset_size,$asset_number,$bar_code,$last_visited,$condition,$remarks)); 
	$i++;
	}
$exporter->finalize(); // writes the footer, flushes remaining data to browser.
exit(); // all done
?>