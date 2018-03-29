<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';   ?><script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    <script type="text/javascript">
    $(document).ready(function(e) {
       fetch_users();//fetch users for the select box
	    writeMonthOptions("#month",'t');//populate the months select box
	//convert to excel
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
          <?php include('submenu.php')?>
          	<h3> Sales Productivity Report: <?php  $date=date("Y-m-d"); $month=date("m");  $year=date("Y");
			if((isset($_REQUEST['month'])  || isset($_REQUEST['year'])) and $_REQUEST['month'] !='0' ){
				$month=$_REQUEST['month']; $year=$_REQUEST['year'];
				}
				$days_in_month= cal_days_in_month(CAL_GREGORIAN, $month, $year);
				$date=$year.'-'.$month.'-1';
				?>
            
          	 <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> </h3>
             <form name="filter" id="filter" method="post" action="<?php echo $_SERVER['PHP_SELF']?>"> <table width="627" class=><tr>
                  <td width="193"><?php echo date('F, Y',strtotime($date));?></td><td width="108">Select Month</td><td width="126"><select class="form-control" name="month" id="month"><option value="0" > Select Month</option></select></td><td width="73">Select year</td><td width="48"><select  class="form-control" id="year" name="year"><?php echo years_in_orders()?></select></td>
                  <td width="51"><button class="btn btn-small btn-success" type="submit" name="submit" >Filter</button></td>
              </tr>
            </table></form>
            
            <!--add users moda-->
            
      				<!-- MODALS -->
      				<div class="showback">
      				
            <!--add users end modal-->
				<div class="row mb">
				
				   <!-- page start-->
                  <div class="content-panel">
                 
                    <section id="unseen">
                            <table  class="table table-bordered table-striped table-condensed" id="tblExport">
                              <thead>
                              <tr>
                                  <th rowspan="2">Region</th>
                                  <th rowspan="2">Person</th>
                                  <th rowspan="2">Role</th>
                                  <th colspan="7">Week1</th>
                                  <th colspan="7">Week2 </th>
                                  <th colspan="7" >Week3</th>
                                  <th colspan="7" >Week4</th>
                                  <?php $rem_days= $days_in_month-28; if($rem_days>0) echo "<th colspan='$rem_days' >Week5 </th>";?>
                                  <th colspan="1" >Totals </th>
                                </tr>
                              <tr>
                                <?php for($i=0;$i<$days_in_month;$i++){ ?><th ><?php echo $i+1;?></th><?php }?>
                               
                                </tr>
                             
                              </thead>
                              <tbody>
                              
                              <?php 
							 //initialize weeks 
							 $totalw1=0;$totalw1p=0; $totalw2=0; $week3=0; $week4=0; $week5=0;
							  $q=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` WHERE  status=0") or die(mysqli_error($mysqli));
							  while($region_row=mysqli_fetch_array($q)){ $r_id=$region_row['region_id']; $pple= check_number_of_pple_in_region($r_id)
								  ?>    <tr>
                                <td rowspan="<?php echo $pple+1?>"><?php echo region_name($r_id)?></td>
                                 <?php if($pple+1>1){ //if the region has users then proceed
								$user_query=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE region_id=$r_id order by role")or die (mysqli_error($mysqli));
								while($user=mysqli_fetch_array($user_query)){ $user_id=$user['user_id'];$role=$user['role']; 
								
								
								//geting my total
								 $my_total=0;
								 $region_total=0;
								 $grand_total=0;
								
								?>
                                <td><?php echo get_name($user_id)?></td>
                                <td><?php echo get_role($role)?></td>
                             <?php for($i=0;$i<$days_in_month;$i++){ ?><td ><?php $date=$year.'-'.$month.'-'.($i+1);
							  $my_total+= days_orders_deliveries($user_id,$date,'pieces'); //tsr's sales total in  amonth
							  $region_total+=days_orders_deliveries($user_id,$date,'pieces');
							  echo  days_orders_deliveries($user_id,$date,'pieces');?></td><?php }?><td><strong><?php echo $my_total?></strong></td>
                              </tr><?php }// end the while
							   }//end the # pple?>
                              <tr style="color:blue">
                                <td colspan="2">Region Sub Total</td>  <?php for($i=0;$i<$days_in_month;$i++){ ?><td ><?php //echo $region_total;?></td><?php }?><td><?php // echo $region_total;?></td>
                               
                              </tr>
                              
                             <?php
								  }?>
                                  <tr><td></td></tr>
                              </tbody>
                          </table>
                          </section>
                  </div>
              <!-- page end-->

				
            </div><!-- /row -->

		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
       <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
    <script src="assets/js/bootstrap.min.js"></script>
   <!--script for this page-->
    <script src="../form-validation-script.js"></script>
     <!--script for this page-->
    

  
    

  </body>
</html>
