
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
                         <h3 class="float_left">Survey report  <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php 
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php  $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>From </td><td> <input type="text" class="form-control dpd1" name="date"></td><td>&nbsp;</td><td>&nbsp;</td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div></span>
                     <!--start -->      <div>Survey report of  <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen"><?php ?>
                           <?php $message=' <table  width="100%" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr  align="center">
                                  <th width="6%" rowspan="2" style="text-align:center">No.</th>
                                  <th width="9%" rowspan="2" style="text-align:center">Outlet</th>
                                  <th width="9%" rowspan="2" style="text-align:center">Outside Advertising</th>
                                  <th width="9%" rowspan="2" style="text-align:center">Inside Advertising</th>
                                  <th width="9%" rowspan="2" style="text-align:center">Merchandising</th>
                                  <th style="text-align:center" colspan="4">Fridge</th>
                                  <th width="11%" rowspan="2" style="text-align:center">Actions</th>
                              </tr>
                              <tr>
                                <th width="9%" style="text-align:center">Avail.</th>
                                <th width="9%" style="text-align:center">Dealer</th>
                                <th width="9%" style="text-align:center">Pure</th>
                                <th width="17%" style="text-align:center">Description</th>
                                </tr>
                              </thead>
                              <tbody>' ;
							   $i=1; $count1=0 ;$count2=0 ;$count3=0 ;$count4=0 ;$count5=0 ;$count6=0 ;
			$q=mysql_query("SELECT * FROM `tbl_dealers` where status=0")or die(mysql_error());
			$number=mysql_num_rows($q);
							while($r=mysql_fetch_array($q)){
								$did=$r['dealer_id'];
	$d_q=mysql_query("SELECT * FROM `tbl_check_in` WHERE date(`date_timein`)='$date' AND `dealer_id`=$did ");
$tt=mysql_fetch_array($d_q);
							if($tt['outside_advert']==1)$count1++;if($tt['inside_advert']==1)$count2++ ;if($tt['mechandize']==1)$count3++ ;if($tt['fridge']==1)$count4++ ;if($tt['ownership']==1)$count5++ ;if($tt['condition']==1)$count6++ ;
								
                              $message.='<tr><td>'.$i.'</td>
                                  <td style="text-transform:capitalize"> '.$r["business_name"].'</td>
                                  <td style="text-transform:capitalize">'.survey($did,"outside_advert",$date).'</td>
                                  <td style="text-transform:capitalize">'.survey($did,"inside_advert",$date).'</td>
                                  <td style="text-transform:capitalize">'. survey($did,"mechandize",$date).'</td>
                                  <td>'.survey($did,"fridge",$date).'</td>
                                  <td>'.survey($did,"ownership",$date).'</td>
                                   <td>'.survey($did,"condition",$date).'</td>
                                   <td>'. survey($did,"description",$date).'</td>
                                  <td ><a href="survey_history.php?dealer_id='. $did.'">View More</a></td>
                              </tr>
                           
                              '.$i++;} '  
							  <tr>
                                   <td>&nbsp;</td>
                                   <td >% summary</td>
                                   <td >'. number_format($count1*100/$number,2).'%</td>
                                   <td>'.number_format($count2*100/$number,2).'%</td>
                                   <td >'.number_format($count3*100/$number,2).'%</td>
                                    <td >'.number_format($count4*100/$number,2).'%</td>
                                     <td >'. number_format($count5*100/$number,2).'%</td>
                                      <td >'.number_format($count6*100/$number,2).'%</td>
                                       <td>&nbsp;</td>
                                   <td >&nbsp;</td>
                                 </tr></tbody>
                               
                          </table>';
						  send_email($message);
	?>
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
