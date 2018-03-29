<?php  include_once 'assets/lib/config.php';
  include_once 'assets/lib/functions.php';
   $subject = 'Per AD in all regions';
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
  font-size:10px;
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
  <h1 style="text-align:center">The Server time the report was generated <?php echo date('Y-m-d h:i:s')?></h1>
   <h2 style="text-align:center">Commercial Routines Tracker: 
  </h2>
   <h3>The table lists the last time an AD logged into the system, the app version they used, the total number of outlets in their cluster(s), the total verified outlets in their clusters among others. The report also gives details about ADs who logged in id red,sellout,gmm,kd stock and kd OG for the specific day.</h3><b>NOte</b> This report will be auto-generated every day at 6pm and sent to all managers<table cellpadding="1px" cellspacing="1px" width="90%" style="border:#666 solid 1px; "  >
                              <thead>
                              <tr>
                                  <th>No. </th>
                                  <th>AD</th>
                                   <th>Last LoggIn</th><th>AppVer.</th>
                                    <th>Area</th>
                                    
                                 <th>Total outlets</th>
                                      <th>Outlets Verified</th>
                                      <th>Total Assets</th>
                                             <th>Assets  Verified</th>
                                      <th>RED</th>
                                      <th>sellout</th>
                                      <th> GMM </th>
                                      <th>KD OG</th>
                                    <th>KD. Stock</th>
                                     
                                     </tr>
                              </thead>
                              
                              <tbody >
                              <?php $i=1; 
                              $q=mysqli_query($mysqli,"SELECT full_name, user_id,area_id,logins,appVersion from tbl_users  WHERE status=0 and role=1 order by region_id,area_id,appVersion")or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($q)) {
		$uid=$row['user_id'];
	
	?>  <tr>
                                  <td><?php echo $i?></td>
                               <td><?php echo $row['full_name']?></td>
                                 
                                    <td><?php echo $row['logins']?></td>
                                    <td><?php echo $row['appVersion']?></td>
                                     <td><?php echo area_name($row['area_id'])?></td>
                                    <td><?php echo  num_rows("tbl_dealers","route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$uid) and status=0 ")?></td>
                                    <td><?php echo  num_rows("tbl_dealers","route_id IN(SELECT a.route_id from tbl_assign_route2adcluster a inner join tbl_adcluster_asignments b on a.ad_cluster_id=b.ad_cluster_id where b.ad_id=$uid) and status=0 AND verified=1 AND type_of_class in ('Bronze','Silver','Gold','Other')")?></td>
                                     <td><?php echo  num_rows("tbl_assets a INNER JOIN tbl_dealers b ON b.dealer_id=a.dealer_id INNER JOIN tbl_assign_route2adcluster d ON d.`route_id`=b.route_id INNER JOIN tbl_adcluster_asignments c ON c.ad_cluster_id=d.ad_cluster_id","c.ad_id=$uid and a.status=0")?></td>
                                        <td><?php echo  num_rows("tbl_assets a INNER JOIN tbl_dealers b ON b.dealer_id=a.dealer_id INNER JOIN tbl_assign_route2adcluster d ON d.`route_id`=b.route_id INNER JOIN tbl_adcluster_asignments c ON c.ad_cluster_id=d.ad_cluster_id","c.ad_id=$uid and a.status=0 and verification_status='Verified'")?></td>
                                     <td><?php echo commercialRoutineCheck("tbl_route_plan","made_by=$uid  and date(startdate)='$today'")?></td>
                                     <td>sellout</td>
                                     <td><?php echo commercialRoutineCheck("tbl_good_morning_meeting","taken_by=$uid and date(date_added)='$today'")?></td>
                                     <td>KDOG</td>
                                     
                                       
                                      
                                      
                                       <td><?php echo commercialRoutineCheck("tbl_distributor_stock_levels","taken_by=$uid  and date(date_taken)='$today'")?></td>
                            
                              </tr>
	
	<?php //accumulate the totals
	
	$i++;
	}?>
    
                              
                              </tbody>
                       
                          </table></body></html>
                          					  
                           <?php ////get all data for sending
						   $message=ob_get_clean(); echo $message;
// Sending email
 $send_to_q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE status=0 and role IN (2,3,5,4)")or die(mysqli_error($mysqli)); while($result=mysqli_fetch_array($send_to_q)){
						  $to=$result['email']; $title='Daily Commercial Routines Tracker report: '.$subject;
					send_email($message ,$title,$to); 
						  }
						  
						 ?>