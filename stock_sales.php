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
                         <h3 class="float_left"> Stock  Sales<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table width="765" ><tr>
                       <td width="54">Select Date </td>
                       <td width="188"> <input type="text" class="form-control dpd1" name="date" value="<?php echo $date?>"></td>
                       <td width="177"><input type="text" class="form-control dpd2" name="date2" value="<?php echo $date?>"></td>
                       <td width="114"><button class="btn btn-small btn-success" type="submit" name="submit" >Fetch Info</button></td></tr></table></form> 
                     </div></span>
                     <!--start -->      <div>Summary as at  <b> <?php $sttime=strtotime($date); echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen"><table width="100%" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th width="28" rowspan="3">No.</th>
                                  <th width="215" rowspan="3">Region </th>
                                  <th colspan="4" class="numeric">Soda </th>
                                  <th colspan="2" class="numeric">Dasani </th>
                                  <th colspan="3" class="numeric">Miniute Maid</th>
                                <th width="122" rowspan="3" class="numeric">Totals</th>
                              </tr>
                              <tr>
                                <th colspan="2" class="numeric">330ml</th>
                                <th colspan="2" class="numeric">500ml</th>
                                <th width="88" rowspan="2" class="numeric">Can</th>
                                <th width="80" rowspan="2" class="numeric">Bottle</th>
                                <th colspan="2" class="numeric">330 ml</th>
                                <th width="102" class="numeric">500ml</th>
                                </tr>
                              <tr>
                                <th class="numeric">Can</th>
                                <th class="numeric">Bottle</th>
                                <th class="numeric">Can </th>
                                <th class="numeric">Bottle</th>
                                <th width="101" class="numeric">Can</th>
                                <th width="132" class="numeric">Bottle</th>
                                <th width="102" class="numeric">&nbsp;</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $i=1;$tot=0; $q=mysqli_query($mysqli,"SELECT region_id FROM `tbl_regions` WHERE 1 order by region_name asc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$rid=$r['region_id'];
								//$tot+=$r['q_available']?>
                              <tr>
                                  <td><?php  echo $i?></td>
                                  <td><?php  echo region_name($rid) ;?></td>
                                  <td width="27" class="numeric"><?php //echo $r['brand'];?></td>
                                  <td width="41" class="numeric">&nbsp;</td>
                                  <td width="31" class="numeric">&nbsp;</td>
                                  <td width="84" class="numeric">&nbsp;</td>
                                  <td class="numeric"><?php // echo $r['reorder_level']?></td>
                                  <td class="numeric">&nbsp;</td>
                                  <td class="numeric"><?php // echo $r['s_price'];?></td>
                                  <td class="numeric">&nbsp;</td>
                                  <td class="numeric">&nbsp;</td>
                                  <td class="numeric">&nbsp;</td>
                              </tr>  <?php $i++;}
								?>
                              <tr>
                                <td colspan="2">Total</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                                <td class="numeric">&nbsp;</td>
                              </tr>
                            
                              </tbody>
                          </table>
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
	

	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            
        });
        
        
      
    </script>
  
	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
  </body>
</html>
