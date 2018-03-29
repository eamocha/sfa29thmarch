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
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
        <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
		<script src="assets/js/excel/jquery.base64.js"></script>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		  fetch_clients();
	assign_salesperson();
    
      
 //load select boxes
 		load_users();
		convert_to_excel("#tblExport","#btnExport","Daily sell out");
			
		 });
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date("Y-m-d"); $tsr=0; if(isset($_REQUEST['day']))$date=$_REQUEST['date']; if(isset($_REQUEST['user']))$tsr=$_REQUEST['user'] ?>
                        <h3 class="float_left">Daily Sales Report (Detailed)
 <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{ 
    $date = $_REQUEST['date'];
	$tsr=$_REQUEST['tsr'];
	if($tsr=='') $tsr=$_REQUEST['user'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>Date </td><td> <input class="form-control dpd1 " id="date" value="<?php echo $date?>" name="date"></select> </td><td>TSR</td><td><select  class="form-control sales_person_selection" name="tsr" id="sales_person_selection"></select></td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div>
      <div>Sell out on <?php echo $date;  ?> for <?php if ($tsr!=0) echo get_name($tsr) ; else echo "all Sales Reps"; ?> </div>     
                     <!--start -->          
                   <section id="unseen">
                            <table id="tblExport"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th rowspan="2">No</th>
                                  <th rowspan="2">Sell Date</th>
                                  <th rowspan="2">Time</th>
                                  <th rowspan="2">Outlet</th>
                                  <th rowspan="2">Region</th>
                                  <th rowspan="2">Sales Rep</th>
                                  <th colspan="3">Sell-Out by (User)</th>
                                  <th rowspan="2">Total Sales</th>
                                </tr>
                              <tr>
                                <th>330ml Bottle</th>
                                <th>500ml Can</th>
                                <th>330ml Can</th>
                              </tr>
                              </thead>
                              <tbody id="content_div">
                             <tr> <td colspan="10">Loading <img src='images/37.gif'></td> </tr>                            </tbody>
                               
                          </table>
                          </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/bootstrap.min.js"></script>

    <!--script for this page-->
	
	
	
	 	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
 




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
    
    <script>
	
    $(document).ready(function(e) {
        //load the the data
		var dat=<?php echo strtotime($date)?>; var tsr= <?php echo $tsr?>;
var url="report_sections/daily_sales_report_detailed.php?date="+dat+"&tsr="+tsr;
	$("#content_div").load(url);
    });
    </script>
	


    
  </body>
</html>
