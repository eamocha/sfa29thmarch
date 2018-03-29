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
          //  $("#contents_area").html(response); 
            //alert(response);
        }
    });
		 
        
 //load select boxes
 		load_users();
		 writeMonthOptions("#month",'t');//populate the months select box
		 
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
                         <h3 class="float_left">Sales by Outlet per specific Date and user<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                     
                      <div  style="padding-bottom:20px" class="float_left">
                     <?php 
   $date=date("Y-m-d"); $month=date("m");  $year=date("Y"); $sold_by=0;
			if((isset($_REQUEST['month'])  || isset($_REQUEST['year'])) and $_REQUEST['month'] !='0' ){
				$month=$_REQUEST['month']; $year=$_REQUEST['year']; $sold_by=$_REQUEST['assign_to'];
				}
				$days_in_month= cal_days_in_month(CAL_GREGORIAN, $month, $year);
				$date=$year.'-'.$month.'-1';
				if($month<10)$month='0'.$month;

?>
                       
                        <form name="filter" id="filter" method="post" action="<?php echo $_SERVER['PHP_SELF']?>"> <table width="100%" class=><tr>
             
                  <td >BY</td>
                  <td ><?php echo user_select_list($user_id)?></td><td >Region</td>
                       <td ><select class="form-control" name="region"><option value="0">All</option><?php region_selection()?></select></td><td >From</td>
                       <td ><input type="text" class="form-control dpd1" value="<?php echo date('Y-m-d');?>" name="date"></td>
                                              <td >To </td>
                      <td ><input type="text" class="form-control dpd2" value="<?php echo date('Y-m-d');?>" name="date2"></td>
                  <td ><button class="btn btn-small btn-success" type="submit" name="submit" > Filter </button></td>
              </tr>
            </table></form>
</div>
                       
                       


                     <!--start -->      <div> Report of  <b>  <?php if($sold_by>0)echo get_name($sold_by); echo " ". date(' M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                            <table id="tblExport"  width="100%" class="table table-bordered table-striped table-condensed">
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Outlet</th>
                                  <th>Region</th>
                                  <th >Total Visits</th>
                                  <th >Month Visits</th>
                                  <th >Total Cases</th>
                                  <th>Month Cases </th>
                                  <th >Last Sale date</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i=1; $user_condition=" AND made_by=".$user_id; if($sold_by==0)$user_condition="";
			 $q=mysqli_query($mysqli,"SELECT distinct(dealer_id) FROM `tbl_orders_details` WHERE MONTH(`date_added`)='$month' and YEAR(`date_added`)='$year'  $user_condition and status=0 ") or die(mysqli_error($mysqli)); if(mysqli_num_rows($q)>0){
	while($r=mysqli_fetch_array($q)){?>
                              <tr>
                                  <td><?php echo $i;?></td>
                                  <td ><?php echo business_name($r["dealer_id"]);?></td>
                                  <td><?php echo get_region_from_dealerID($r["dealer_id"])?></td>
                                  <td ><?php if(times_visited($r["dealer_id"])==0) echo 1; else echo times_visited($r["dealer_id"])?></td> 
                                             <td><?php echo times_visted_in_month($r["dealer_id"],$month,$year)?></td>         
                                  <td><?php echo sales_by_outlet_total($r["dealer_id"]) ?></td>                      <td> <?php echo sales_by_outlet_month($date,$r["dealer_id"])?></td>                                  
                                  <td><?php echo sales_by_outlet_lastvisit($r["dealer_id"])?></td>
                                 
                                </tr><?php $i++; } } else{?>
                              <tr>
                                <td colspan="8">List is empty</td>
                                </tr>
                              
                              <?php } ?></tbody></table></section>
       
                         
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




	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
  </body>
</html>
