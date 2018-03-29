<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>

<script type="text/javascript" src="assets/js/graphs/highstock.js"></script>
     <script type="text/javascript" src="assets/js/graphs/js/modules/exporting.js"></script>
     
     
  <script type="text/javascript" >
      $(window).load(function(e) {
		  fetch_clients();
	assign_salesperson();
        
 //load select boxes
 		load_users();
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
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
		  //export
		
 </script>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Outlets'
        },
        subtitle: {
            text: 'Outlet numbers'
        },
        xAxis: {
            categories: [
                'Coast',
                'Eastlands',
                'CBD',
                'Mountain',
                'South',
                'Westlands',
                'Rift',
                'Metro',
                'Key Accounts',
                'North',
                'Lake',
                'Ungrouped'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Outlets'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>outlets</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Petrol Food Marts',
            data: [49, 71, 16, 19, 10, 1, 16, 15, 24, 11, 96, 54]

        }, {
            name: 'Members Club',
            data: [86, 78, 95, 94, 10, 85, 10, 13, 92, 85, 106, 93]

        }, {
            name: 'Institutions',
            data: [49, 38, 33, 44, 40, 43, 50, 56, 54, 62, 53, 52]

        }, {
            name: 'Wines & Spirits',
            data: [44, 32, 35, 37, 56, 75, 54, 64, 46, 31, 48, 51]

        }]
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
                <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <span id="dontpdf">
                      <div class="border-head" >
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Regional Outlets  <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                   <table ><tr><td width="57">
                      <td width="6"></td><td width="37">&nbsp;</td>
                       <td width="6"></td>
                       <td width="144"></td>
                      <td width="126">&nbsp;</td><td width="62"></td></tr></table> </div></span>
                  <!--start -->           
                   <section id="unseen">
                 
                                  
                        </section>
 
                         
                </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      ************************************************************************************************************************************************************* -->     <span id="dontpdf">             
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?></span>
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

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    


    	  
	
	
  </body>
</html>
