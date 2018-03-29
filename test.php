<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $area_id=$_SESSION['area_id'];
	$today=date("Y-m-d");
  $jana=date("Y-m-d",strtotime("-1 days")); $juzi=date('Y-m-d',strtotime("-2 days")); 
  $daysInMonth=daysInMonth(date('Y'),date('m'));$tarehe=date('d'); 
  
   $today=date("Y-m-d");
  $date=date("Y-m-d"); 
  $area_id=$_SESSION['area_id'];  $where=" status=0 and role=1";
if(isset($_REQUEST['submit']))
{ $area_id=$_REQUEST['area']; $where=" status=0 and role=1 and area_id=$area_id ";
   // $date = $_REQUEST['date']; 
	//$date2=$_REQUEST['date2'];
   }?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
     
  <script type="text/javascript" >
      $(window).load(function(e) {
		    writeMonthOptions('#month',"l");
		  boundary_filters();
		//get excel
		var dt=new Date();
		
		var w_name=dt.getFullYear()+'.'+ dt.getMonth()+1+'.'+ dt.getDate()+' '+ dt.getHours()+'-'+ dt.getMinutes();
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
               , filename: w_name
            });
        });
		
		 });
 
		 </script>
  </head>
<body> 

   <h2 style="text-align:center">Commercial Routines Tracker: 
  </h2><p>The table lists the last time an AD logged into the system, the app version they used, the total number of outlets in their cluster(s), the total verified outlets in their clusters among others. kindly use this to know the status of verification according to the varius ADs and adjust accordingly.</p><b>NOte</b> This report will be auto-generated every day at 6pm and sent to all managers
  <div><form action="<?php $_SERVER['PHP_SELF']?>" method="post"> Select area <select class="form-control" name="area" id="area"> <?php echo area_selection();?> </select>      <button class="btn btn-small btn-success" type="submit" name="submit" >Search</button> </form><h3> Tracker for <?php echo area_name($area_id)?></h3></div>
  <table cellpadding="1px" cellspacing="1px" width="90%" style="border:#666 solid 1px; "  >
                              <thead>
                              <tr>
                                  <th>No. </th>
                                  <th>Name</th>
                                   <th>Last LoggIn</th><th>AppVer.</th>
                                    <th>Area</th>
                                       <th>Total outlets</th>
                                      <th>Outlets Verified</th>
                                      <th>V.this week</th>
                                      <th>Total Assets</th>
                                       <th>Assets  Verified</th>
                                       <th>V. this week</th>
                                      <th>Planned</th>
                                       <th>Visited</th>
                                       <th>Sold</th>                                     
                                      <th>GMM</th>
                                    <th>KD Stock</th>
                                     
                                     </tr>
                              </thead>
                              
                              <tbody >
                              <?php $i=1; 
                              $q=mysqli_query($mysqli,"SELECT full_name, user_id,area_id,logins,appVersion from tbl_users  WHERE $where order by region_id,area_id,appVersion limit 10")or die(mysqli_error($mysqli));
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
                                       <td><?php echo commercialRoutineCheck("tbl_good_morning_meeting","taken_by=$uid and date(date_added)='$today'")?></td>
                                     
                                       
                                      
                                      
                                       <td><?php echo commercialRoutineCheck("tbl_distributor_stock_levels","taken_by=$uid  and date(date_taken)='$today'")?></td>
                            
                              </tr>
	
	<?php //accumulate the totals
	
	$i++;
	}?>
    
                              
                              </tbody>
                       
                          </table></body></html>
                          					  
                         