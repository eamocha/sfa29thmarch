<!DOCTYPE html>
<html lang="en"><head>
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
     
  <script type="text/javascript" >
  
	  
      $(window).load(function(e) {
		     $("#contents_area").append('Loading <img src="images/37.gif">'); 
		  //fetch data to put at the contents area
		   $.ajax({  
		     //create an ajax request to load_page.php
        type: "GET",  url: "report_sections/sales_by_outlet.php",  dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#contents_area").html(response); 
            //alert(response);
        }
    });
		
  
        
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
                        <?php include('submenu.php');  ?>
                         <h3 class="float_left">Sales by Outlet<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                     
                      <div  style="padding-bottom:20px" class="float_left">
                     <?php $date=date('Y-m-d'); 
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr>
                       <td width="74">  
                       <a href="survey_report_operations.php" class="btn btn-default">Graph</a> </td>
                       <td width="19">From</td>
                       <td width="19"><input type="text" class="form-control dpd1" name="date"></td>
                       <td width="40">To</td>
                      <td width="147"><input type="text" class="form-control dpd1" name="date2"></td><td width="64"><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div>
</span>
                     <!--start -->      <div>Sales report as at  <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                            <table id="tblExport"  width="100%" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr  align="center">
                                  <th width="5%" style="text-align:center">No.</th>
                                  <th width="17%" style="text-align:center">Outlet</th>
                                  <th width="12%" style="text-align:center">Region </th>
                                  <th width="17%" style="text-align:center">Contact</th>
                                   <th width="11%" style="text-align:center">Total Visits</th>
                                  <th width="8%" style="text-align:center">Total sales</th>
                                  <th width="6%" style="text-align:center"><?php echo date('M', strtotime(date('Y-m')." -2 month"));?></th>
                                   <th width="6%" style="text-align:center"><?php echo date('M', strtotime(date('Y-m')." -1 month"));?></th> <th width="6%" style="text-align:center"><?php echo date('M');?></th>
                                   <th width="12%" style="text-align:center">Last Sale date</th>
                                       </tr>
                              </thead>
                              <tbody  id="contents_area">
                              
                              
                              </tbody></table></section>
       
                         
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
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	

	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "fetch_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  
	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
  </body>
</html>
