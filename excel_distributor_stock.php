<?php
include_once "assets/lib/config.php";

include_once "assets/lib/functions.php";

require 'assets/lib/php-export-data.class.php';
$today=date("Y-m-d");
$exc_empties =" product_id NOT IN $EMPTIES";
$daysArr=array();
$tdy=date("d");  $daysInMonth=daysInMonth(date('Y'),date('m'));

for($day=1; $day<=$tdy; $day++) { $daysArr[]=$day;}
//print_r($daysArr);
$firstPart=array("No","DISTRIBUTOR","AD IN CHARGE", "CONTRIBUTION", "MONTH TARGET","DAILY TARGET","4 DAYS STOCK","7 DAYS TGT");
$columns=array_merge($firstPart,$daysArr);

$u=mysqli_query($mysqli," SELECT distributor_name,distributor_id,distributor_contribution,this_month_target,ad_incharge FROM tbl_distributors WHERE status=0 order by region_id, area_id ") or die(mysqli_error($mysqli));
													   
				
                                 
// 'browser' tells the library to stream the data directly to the browser.
// other options are 'file' or 'string'
$what="Distributor Stocks for ".date("F");
$exporter = new ExportDataExcel('browser', $what.".xls");
$exporter->initialize(); // starts streaming data to web browser
///header
$exporter->addRow($columns);
// pass addRow() an array and it converts it to Excel XML format and sends 
// it to the browser
$i=1; 	

  while($drow=mysqli_fetch_array($u)){
								  $id=$drow['distributor_id'];
								  $distributor_name=$drow['distributor_name'];
								 $distributor_id=$drow['distributor_id'];
								 $contr=$drow['distributor_contribution'];
								  $target=$drow['this_month_target'];
								  $dailyTarget= number_format($drow['this_month_target']/$daysInMonth,1);
								  $ad=getColumnName("tbl_users","full_name","user_id=".$drow['ad_incharge']);
							$stock1stPart=array($i, $distributor_name,$ad,$contr,$target,$dailyTarget,4*$dailyTarget,7*$dailyTarget);
								 $stock=array();
								  for($day=1; $day<=$tdy; $day++) { $stock[]=sum_columns("tbl_distributor_stock_levels","qty","distributor_id=$distributor_id and $exc_empties and  date(date_taken)='".date("Y-m-$day")."'"); }
								$contentRow=array_merge($stock1stPart,$stock);
																								  
 $exporter->addRow($contentRow); 
	$i++;
	}
$exporter->finalize(); // writes the footer, flushes remaining data to browser.
exit(); // all done
?>


							     </tr>	