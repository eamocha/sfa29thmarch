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
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $did=$_REQUEST['dealer_id'];  ?>
 
      
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Survey report for <?php echo business_name($did)?> <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>From </td><td> <input type="text" class="form-control dpd1" name="date"></td><td>&nbsp;</td><td>&nbsp;</td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div>
                     <!--start -->      <div>Survey report of  <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                            <table  width="100%" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr  align="center">
                                  <th width="3%" rowspan="2" style="text-align:center">No.</th>
                                  <th width="10%" rowspan="2" style="text-align:center">Date</th>
                                  <th width="15%" rowspan="2" style="text-align:center">Surveyed by</th>
                                <th width="10%" rowspan="2" style="text-align:center">O. Ads</th>
                                  <th width="10%" rowspan="2" style="text-align:center">I. Ads</th>
                                  <th width="10%" rowspan="2" style="text-align:center">Mer.</th>
                                  <th colspan="3" style="text-align:center">Fridge</th>
                                  <th width="6%" rowspan="2" style="text-align:center">Description</th>
                                  <th width="6%" rowspan="2" style="text-align:center">Comments</th>
                              </tr>
                              <tr>
                                <th width="10%" style="text-align:center">Avail.</th>
                                <th width="10%" style="text-align:center">Dealer</th>
                                <th width="10%" style="text-align:center">Pure</th>
                                </tr>
                              </thead>
                              <tbody>
                             <?php $i=1; 
			$q=mysql_query("SELECT * FROM `tbl_check_in` WHERE `dealer_id`=$did order by checkin_id desc")or die(mysql_error()); if (mysql_num_rows($q)==0) { echo ' <tr>
                                   <td colspan="11"> No survey has been carried!!</td>
                                   
                                 </tr>';}
							while($r=mysql_fetch_array($q)){
								$did=$r['dealer_id'];
								
								
                               ?>
                                
                                
                                 <tr>
                                   <td><?php echo $i;?></td>
                                   <td style="text-transform:capitalize"><?php echo date('d.m.Y',strtotime($r['date_timein']));?></td>
                                   <td style="text-transform:capitalize"><?php echo get_name($r['user_id']);?></td>
                                   <td style="text-transform:capitalize"><?php echo survey_history('outside_advert')?></td>
                                   <td style="text-transform:capitalize"><?php echo survey_history('inside_advert')?></td>
                                   <td style="text-transform:capitalize"><?php echo survey_history('mechandize')?></td>
                                   <td><?php echo survey_history('fridge')?></td>
                                   <td><?php echo survey_history('ownership')?></td>
                                   <td><?php echo survey_history('condition')?></td>
                                   <td ><?php echo $r['description']?></td>
                                   <td >&nbsp;</td>
                                 </tr>
                                 <tr>
                                   <td>&nbsp;</td>
                                   <td style="text-transform:capitalize">&nbsp;</td>
                                   <td style="text-transform:capitalize">&nbsp;</td>
                                   <td style="text-transform:capitalize">&nbsp;</td>
                                   <td style="text-transform:capitalize">&nbsp;</td>
                                   <td style="text-transform:capitalize">&nbsp;</td>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                   <td >&nbsp;</td>
                                   <td >&nbsp;</td>
                                 </tr>
                           
                             <?php $i++; }?></tbody>
                               
                          </table>
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

  
	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
  </body>
</html>
