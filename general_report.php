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
                        <?php include('submenu.php'); $date=date('Y-m-d'); $date2=date('Y-m-d');?>
                         <h3 class="float_left">Report <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date']; 
	//$date2=$_REQUEST['date2'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <input type="text" class="form-control dpd1" value="<?php $date=date("Y-m-d",strtotime(date("Y-m-d"))-86400*7); echo $d=first_day_of_week($date);?>" name="date"></td><td> </td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div><?php $next_sund=date("Y-m-d",strtotime($d)+86400*7); echo $subject="WEEKLY: ". date('D dS, M Y', strtotime($d))." - ".date('D dS, M Y', strtotime($next_sund));?></b></div>     </span>
                   <section id="unseen">
                        <?php 
$message="<table border='1' class='table table-bordered table-striped table-condensed' id='tblExport'>	
                              <thead>  <tr>
                                  <th rowspan='2'>No</th>
                                  <th rowspan='2'>Name/Region</th>
                                   <th colspan='3' >Outlets</th>
                                  <th colspan='3'>Stock</th>
                                  <th colspan='5'>Merchandizing</th>
                              </tr>
                              <tr>
                                <th >Total</th>
                                <th >Visted</th>
                                <th >Added</th>
                                <th>Required</th>
                                <th>Delivered</th>
                                <th>Orders Made</th>
                                <th>O. adv</th>
                                <th>I. advert</th>
                                <th>Fridge A.</th>
                                <th>Fridge N/A.</th>
                              </tr>
                              </thead>
                              <tbody>";?>
                             <?php
							 $i=1; 
			$q=mysql_query("SELECT * FROM `tbl_users`  WHERE role=1 and status=0")or die(mysql_error());
							while($r=mysql_fetch_array($q)){
								$region_id=$r["region_id"];
								$user_id=$r["user_id"];
								
		
                              $message.= " <tr>
                                   <td> ". $i."</td><td>".$r["full_name"]."</td>
                                   <td>". total_outlets_in_region($region_id)."</td>
                                   <td >".outlets_visted_per_time($user_id,$d,$next_sund )."</td>
                                   <td >".outlets_added_per_time($user_id,$d,$next_sund)."</td>
                                   <td >".stock_required_per_period($user_id,$d,$next_sund)."</td>
                                   <td  >".stock_supplied_per_period($user_id,$d,$next_sund)."</td>
                                   <td  >".orders_in_period($user_id,$d,$next_sund)."</td>
                                   <td  >".o_advert($user_id,$d,$next_sund)."</td>
								   <td  >".in_advert($user_id,$d,$next_sund)."</td>
								   <td  >".fridge_av($user_id,$d,$next_sund)."</td>
								   <td  >".fridge_na($user_id,$d,$next_sund)."</td>
                                 </tr>"?>
                           
                             <?php $i++; }?>
                                 <?php  $message .= "<tr >
                               <td>&nbsp;</td>
                               <td ></td>
                               <td colspan='3' ></td>
                               <td colspan='7'  >&nbsp;</td>
                             </tr>
                              </tbody>
                               
                          </table>";
						  echo $message;
						  $send_to_q=mysql_query("SELECT * FROM `tbl_users` WHERE `role`>1")or die(mysql_error()); while($result=mysql_fetch_array($send_to_q)){
						  $to=$result['email'];
					send_weekly_summary($to,$subject,$message);
						  }?>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->     <span id="dontpdf">             
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
