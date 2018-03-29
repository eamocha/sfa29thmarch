<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php require 'header.php';  $user_id=$_SESSION['u_id']; //  $exc_empties =" product_id NOT IN $EMPTIES"; ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
     
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
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
 
		  //export
		
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
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** --> <!--sidebar start
      <aside>
          <?php //include 'side_menu.php'?>
      </aside>
      sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row" id="pdfthis">
                  <div class="col-lg-12 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <span id="dontpdf">
                      <div class="border-head" >
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left"> Stock by SKU per KD<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                  <form  method="post"><table  ><tr><td>Region </td><td> <select  class="boundary_filters form-control" name="region" id="region"><option value="-1">Select Region</option><?php echo region_selection();?></select></td><td>Area </td><td><select class="boundary_filters  form-control" name="area" id="area"> <option value="-1">Select area</option> <?php echo area_selection();?> </select></td><td> Select Date </td><td><input type="text" class="form-control dpd1" name="date" id="date" value="<?php echo $date?>"></td><td><span class="btn btn-small btn-success"  id="submit" name="submit" >Search</span></td></tr></table></form> </div> </div></span>
                     <!--start -->      <div>Summary as at  <b> <?php $sttime=strtotime($date); echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen"><table width="100%" class="table table-bordered table-striped table-condensed" id="tblExport">
                              <thead>
                              <tr>
                                  <th >No.</th>
                                  <th >KD</th>
                                  <?php $product_id_arrays=array(); $skusq=$mysqli->query("SELECT product,product_id FROM `tbl_products` WHERE status=0 order by `pack_size`, `pack_type`, `sku_type` ")or die($mysqli->error()); while($sku_row=mysqli_fetch_array($skusq)) { $product_id_arrays[]=$sku_row["product_id"]?>
								  <th  class="rotate45"><div><span><?php echo $sku_row['product']?></span></div></th><?php }?>
                                 
                              </tr>
                              </thead>
                              <tbody id="resultsBody">
                                <tr><td colspan="<?php echo count($product_id_arrays)+2?>">Loading Please wait..... This may take upto 5 minutes<img src="images/37.gif"></td></tr>
                             
                              </tbody>
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
            
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
		var date=$("#date").val();
		$("#submit").click(function(e) {
			$("#resultsBody").empty();
			$("#resultsBody").append('<tr><td id="loading" colspan="<?php echo count($product_id_arrays)+2?>">Loading Please wait..... This may take upto 5 minutes<img src="images/37.gif"></td></tr>');
            var region=$("#region").val();
			var area=$("#area").val();
			var date=$("#date").val();
			  			
			var url="report_sections/stock.php?mode=distributor_stock_persku&region="+region+"&area="+area+"&date="+date;
	$("#resultsBody").load(url);
        });///default load
		
		
		  	var url="report_sections/stock.php?mode=distributor_stock_persku&date="+date;
	$("#resultsBody").load(url);    
    });
  
    </script>
  </body>
</html>
