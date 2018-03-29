<?php  include_once 'assets/lib/config.php';
  include_once 'assets/lib/functions.php';
   $subject = 'Status of asset/outlet verification';
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
 
<h2 style="text-align:center">Status of asset/outlet verification as at <?php echo $today_constant?>
</h2><p>Note that the report is based on areas whose staff have done verifications. Areas missing have not verified any outlet or have not syncronized their data.</p>
  
    <table cellpadding="1px" cellspacing="1px" width="90%" style="border:#666 solid 1px; "  >
                              <thead>
                              <tr>
                                  <th>No. </th>
                                   <th>Area</th>
                                    <th>Total outlets per area(s)</th>
                                   <th>Verified Outlets</th>
                                   <th>Percentage verified</th>
                                    <th>Total assets per area(s)</th>
                                     <th>Correctly Verified</th>
                                        <th>% of assets Verified</th>  
                              </tr>
                             
                              </thead>
                              
                              <tbody>
                              <?php $i=1; $outs=0;$v_outs=0;$assts=0;$v_assts=0;
							   $q=$mysqli->query("SELECT COUNT(*) as total,area_name,a.area_id FROM `tbl_dealers` a RIGHT JOIN tbl_areas b on a.area_id=b.area_id WHERE verified=1 AND (type_of_class='Gold' OR type_of_class='Silver' or type_of_class='Bronze') GROUP BY a.area_id,area_name ORDER BY total DESC") or die($mysqli->error);
							  while($r=mysqli_fetch_array($q)){
								 $v_outs+=$total_verified=$r['total'];
								    $area_id=$r['area_id'];
									  $area=$r['area_name'];
								   $outs+=$total_outlets=num_rows("tbl_dealers","area_id=$area_id and status=0 ");
									$outlet_perc=percentage_conversion($total_verified,$total_outlets);
									$assts+=$total_assets=num_rows("tbl_assets a left join tbl_dealers o on a.dealer_id=o.dealer_id","a.status=0 and area_id=$area_id");
									$v_assts+=$assets_verified=num_rows("tbl_assets a left join tbl_dealers o on a.dealer_id=o.dealer_id","a.status=0 and area_id=$area_id and verification_status='Verified'");
									$assets_perc=percentage_conversion($assets_verified,$total_assets);
							  ?>
                               <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $area ?></td>
                               <td><?php echo $total_outlets ?></td>
                                <td><?php echo $total_verified ?></td>
                                <td><?php echo $outlet_perc ?></td>
                                <td><?php echo $total_assets ?></td>
                                <td><?php echo $assets_verified ?></td>
                           <td><?php echo $assets_perc ?></td>     </tr>
                          
                             
                              <?php $i++;  }
							  ?></tbody>
                          <tfoot>
                               <tr>
                                 <td>&nbsp;</td>
                                 <td>Totals</td>
                                  <td><?php echo $outs?></td>
                                   <td><?php echo $v_outs?></td>
                                 <td><?php echo percentage_conversion($v_outs,$outs)?></td> 
                                 <td><?php echo $assts?></td>
                                 <td><?php echo $v_assts?></td>
                               <td><?php echo percentage_conversion($v_assts,$assts)?></td>
                                
                               </tr></tfoot>
                              </table>
  
  
  </body></html>
                          					  
                           <?php ////get all data for sending
						   $message=ob_get_clean(); echo $message;
// Sending email
 $send_to_q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE status=0 and role IN(2,3,4,5)")or die(mysqli_error($mysqli)); while($result=mysqli_fetch_array($send_to_q)){
						  $to=$result['email']; $title=' '.$subject;
					send_email($message ,$title,$to); 
						  }?>