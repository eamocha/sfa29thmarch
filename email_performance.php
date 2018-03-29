<?php require 'header.php';  $user_id=$_SESSION['u_id']; 
//$to = 'eatinga@hotmail.com,eatinga@yahoo.com,eric.atinga@usalamaforum.org';
$subject = 'Performance Report';
$from = 'eamocha@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n". 'Reply-To: '.$from."\r\n" .   'X-Mailer: PHP/' . phpversion();
  $date=date("Y-m-d"); 
// Compose a simple HTML email message
ob_start();?>
<html><body style="margin: 0; font-family:Calibri,Arial, Helvetica, sans-serif; background:#eee; padding: 0;">
<div style="margin:15px; padding:10px; background:#FFF; ">
<img src="http://almasisfa.com/images/logo.png"  style="margin-left:40%" width="10%" alt="logo"  />
<h1 align="center" style=" border-top-style:none;border-right-style:none;border-bottom-style:double;border-left-style:none;border-width: 2px solid black;color:red"><strong>Perfomance report as at <?php echo date("l, d M Y H:i:s");?></strong></h1>
 <table cellpadding="0" cellspacing="0"  width="90%" align="center" style="border:0px solid red;  margin:auto border-collapse:collapse">	
              <thead>
              <tr>
                <th width="3%" rowspan="2" style="border:1px solid red; border-collapse:collapse; "><div align="center">No</div></th>
                <th width="20%" rowspan="2" style="border:1px solid red; border-collapse:collapse; "><div align="center">AD/User</div></th>
                <th colspan="3" style="border:1px solid red; border-collapse:collapse"><div align="center">Outlets</div></th>
                <th colspan="2" style="border:1px solid red; border-collapse:collapse"><div align="center">Outlet Stock status</div></th>
                <th style="border:1px solid red; border-collapse:collapse"><div align="center">Order Generated</div></th>
                <th style="border:1px solid red; border-collapse:collapse"><div align="center">Assets Verified/Visited</div></th>
                <tr>
                  <th width="13%" style="border:1px solid red; border-collapse:collapse"><div align="center">Visited</div></th>
                  <th width="12%" style="border:1px solid red; border-collapse:collapse"><div align="center">Added</div></th>
                  <th width="19%" style="border:1px solid red; border-collapse:collapse"><div align="center">Verified</div></th>
                  <th width="4%" style="border:1px solid red; border-collapse:collapse"><div align="center">Cases</div></th>
                  <th width="4%" style="border:1px solid red; border-collapse:collapse"><div align="center">Pieces</div></th>
                  <th width="9%" style="border:1px solid red; border-collapse:collapse"><div align="center"></div></th>
                  <th width="11%" style="border:1px solid red; border-collapse:collapse"><div align="center"></div></th>
               </tr>
               
                </thead> 
                  <?php $total_visted=0; $total_added=0; $strike_rate=0; $cases=0;$singles=0; $orders=0; $delivered=0;
							 $i=1; 
			$q=mysql_query("SELECT * FROM `tbl_users` WHERE `role`=1  and status=0")or die(mysql_error());
							while($r=mysql_fetch_array($q)){
								$uid=$r['user_id'];
								$reg_id=$r['region_id'];
								$total_visted += visited_today($uid,$date);
								$total_added +=outlets_added_in_day($uid,$date);
								//$strike_rate+=day_strike_rate($uid,$date);
								$cases+=days_stock_levels($uid,$date,'cases');
								$singles+=days_stock_levels($uid,$date,'singles');
							//	$orders+=days_orders_deliveries($uid,$date,'cases');
								$delivered+=days_orders_deliveries($uid,$date,'pieces')
								?>
                                 <tr>
                  <td style="border:1px solid red; border-collapse:collapse; "><?php echo $i;?></td>
                  <td style="border:1px solid red; border-collapse:collapse; "><?php echo $r['full_name'];?></td>
                  <td style="border:1px solid red; border-collapse:collapse"><?php echo visited_today($uid,$date)?></td>
                  <td style="border:1px solid red; border-collapse:collapse"><?php echo outlets_added_in_day($uid,$date)?></td>
                  <td style="border:1px solid red; border-collapse:collapse"><?php echo prospecting_outlets_added_in_day($uid,$date)?></td>
                  <td style="border:1px solid red; border-collapse:collapse"><?php echo days_stock_levels($uid,$date,'cases');?></td>
                  <td style="border:1px solid red; border-collapse:collapse"><?php echo days_stock_levels($uid,$date,'singles');?></td>
                  <td style="border:1px solid red; border-collapse:collapse"><?php echo days_orders_deliveries($uid,$date,'pieces')?></td>
                  <td style="border:1px solid red; border-collapse:collapse">&nbsp;</td></tr>
                         <?php $i++; }?>
                                                
   </table>
</body></html>
 <?php $message=ob_get_clean(); echo $message;
// Sending email
 $send_to_q=mysql_query("SELECT * FROM `tbl_users` WHERE status=0")or die(mysql_error()); while($result=mysql_fetch_array($send_to_q)){
						  $to=$result['email']; $title='Performance report: '.$subject;
					send_email($message ,$title,$to); 
						  }

?>