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
  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
         <?php include 'notifications.php'?>
        </header>
      <!--header end-->
     
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row" id="pdfthis">
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                      <span id="dontpdf">
                      <div class="border-head" >
                        <?php  include('submenu.php'); $area_id=$_SESSION['area_id']; date_default_timezone_set('Africa/Nairobi'); $date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)); $region_id=$_SESSION['region_id'];
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">Sellout per account developer in every distributor for <?PHP echo date("M Y")?> <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php 
					
					 ///end roles
					 $reg_name=region_name($_SESSION['region_id']); $ar_name="All areas";

?><form  method="post"><table   class="table"><tr><td>Region </td><td> <select  class="boundary_filters" name="region" id="region"><option value="-1">Select Region</option><?php echo region_selection();?></select></td><td>Area </td><td><select class="boundary_filters" name="area" id="area"> <option value="-1">Select area</option> <?php echo area_selection();?> </select></td><td> Month </td><td><select id="month" name="month"><option value="-1">Month</option></select> </td><td>Year</td><td><select id="year" name="year"><option value="2018">2018</option><option value="2017">2017</option></select></td><td><span class="btn btn-small btn-success"  id="submit" name="submit" >Search</span></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div> Region <?php echo $reg_name ?>   Area <?php echo $ar_name ?></div>
                     <!--start -->           </span>
                   <section id="unseen">
                          <table id="tblExport" class="table table-bordered table-striped table-condensed" width="100%">
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
                                      <th>Planned Itinerary</th>
                                     
                                      <th>Did GMM Today</th>
                                    <th>Sent Distr. Stock Today</th>
                                     
                                     </tr>
                              </thead>
                              
                              <tbody >
                              <?php $i=1; 
                              $q=mysqli_query($mysqli,"SELECT full_name, user_id,area_id,logins,appVersion from tbl_users  WHERE $where order by region_id,area_id,appVersion")or die(mysqli_error($mysqli));
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
                       
                          </table>
                      
                         
                  </div><!-- /col-lg-129 END SECTION MIDDLE -->
                  
                  

              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
     <script type="text/javascript" src="assets/js/pdf/jspdf.debug.js"></script>
	<script type="text/javascript" src="assets/js/pdf/pdf_functions.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
 
	
	
  </body>
</html>

