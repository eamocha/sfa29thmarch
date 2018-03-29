<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respona.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respona.js/1.4.2/respona.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $area_id=$_SESSION['area_id'];
	$today=date("Y-m-d");
  $jana=date("Y-m-d",strtotime("-1 days")); $juzi=date('Y-m-d',strtotime("-2 days"));   $exc_empties =" sku_id NOT IN $EMPTIES";
  $daysInMonth=daysInMonth(date('Y'),date('m'));$tarehe=date('d'); ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
     
  <script type="text/javascript" >
      $(window).load(function(e) {
		  writeMonthOptions('#month',"l");
		  boundary_filters_dist_route();
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
                        <?php  include('submenu.php');
							
	 $date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)); 
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">Raw Data as entered <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php 
					
					 ///end roles
					 $reg_name=region_name($_SESSION['region_id']); $ar_name="All areas"; $route_id=0;  $day='2017-10-24';//date('Y-m-d');//2017-10-30 13:46:28
					 if(isset($_REQUEST['route_id'])){
						$route_id=$_REQUEST['route_id'];
						
						 }

?><form  method="post"><table ><tr><td>Region </td><td> <select  class="boundary_filters form-control" name="region" id="region"><option value="-1">Select Region</option><?php echo region_selection();?></select></td><td>Area </td><td><select class="boundary_filters form-control" name="area" id="area"> <option value="-1">Select area</option> <?php echo area_selection();?> </select></td>
<td>Sub Area</td><td><select class="boundary_filters form-control" name="cluster" id="cluster"> <option value="-1">Select subarea</option> <?php echo cluster_selection();?> </select></td>
<td>Distributor</td><td><select class="boundary_filters form-control" id="distributor" name="distributor"><option value="-1">Select distributor</option> </select></td><td>Route</td><td><select class="boundary_filters form-control" id="route" name="route"><option value="-1">Select route</option> </select></td><td> Day</td><td> <input class="form-control  dpd1" value="<?php echo $date?>" type="text"   id="day" name="name"/></td><td><span class="btn btn-small btn-success"  id="submit" name="submit" >Search</span></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div> Region <?php echo $reg_name ?>   Area <?php echo $ar_name ?><!--<p> Please click<a href="http://almasisfa.com/excel_distributor_stock.php"> here </a>to download an excel sheet showing for this month- MTD </p>--></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">	
                      
                              <thead> 
  <tr>
   <th>#</th> <th>SKu</th>
     <th >Qty</th>
      
    <th >Date/time</th><td><?php echo "Route"?></td>
    <th >Inputed by</th><td>Actions</td>

  </tr>
                     </thead>         <tbody id="resultsBody">
                     
                  <tr><td colspan="6">Loading Please wait..... This may take upto 5 minutes<img src="images/37.gif"></td></tr>
               
		
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
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	<script type="text/javascript">
	$(document).ready(function(e) {
	
		$("#submit").click(function(e) {
			$("#resultsBody").empty();
			$("#resultsBody").append('<tr><td id="loading" colspan="<?php echo 6?>">Loading Please wait..... This may take upto 5 minutes<img src="images/37.gif"></td></tr>');
            var region=$("#region").val();
			var area=$("#area").val();
			var cluster=$("#cluster").val();
			var distributor=$("#distributor").val();
			var route=$("#route").val();
			  var date=$("#day").val();
			
			
			
			var url="report_sections/sales.php?mode=raw_data&region="+region+"&area="+area+"&cluster="+cluster+"&distributor="+distributor+"&route="+route+"&month=-1&year=-1&date="+date;
	$("#resultsBody").load(url);
        });///default load
		
	var url="report_sections/sales.php?mode=raw_data&month=-1&year=-1";
	$("#resultsBody").load(url);    
    });
  
    </script>
  </body>
</html>
