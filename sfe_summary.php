<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $area_id=$_SESSION['area_id']  ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
     
  <script type="text/javascript" >
      $(window).load(function(e) {

 		
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
     
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row" id="pdfthis">
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                      <span id="dontpdf">
                      <div class="border-head" >
                        <?php  include('submenu.php'); $area_id=$_SESSION['area_id']; date_default_timezone_set('Africa/Nairobi'); $date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)); //yesterday
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">AD plans, Visits and sales<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
if(isset($_REQUEST['submit']))
{ $area_id=$_REQUEST['area'];
    $date = $_REQUEST['date']; 
	//$date2=$_REQUEST['date2'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date;?>" name="date"></td><td><select class="form-control" name="area" id="area"> <?php echo area_selection();?> </select></td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>Day Peromance report for Area: <?php echo get_area($area_id)?> of <b> <?php echo  date("D d, M Y",strtotime($date)).' ( '.$date.' ) ';?></b>. Note that the time per outlet is supposed to be 30 minutes</div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">	
                         <thead>
 <tr>
    <th rowspan="2" >#</th>
      <th rowspan="2" >AD</th>
    <th Colspan="3" >Time In Outlet</th>
    <th Colspan="3" >Scheduled Calls</th>
    <th Colspan="2" >Unscheduled Calls</th>
    <th Colspan="2" >Strike    Rate</th>
  </tr>
  <tr>
    <th>Plan</th>
    <th>Actual</th>
    <th>%</th>
    <th>Plan</th>
    <th>Actual</th>
    <th>Route Completion %</th>
    <th>Actual</th>
    <th>%</th>
    <th>Actual</th>
    <th>%</th>
  </tr>

</thead>
  <tbody>
  <?php $i=1;
   $q=$mysqli->query("SELECT * FROM  tbl_users  WHERE role=1 and area_id=$area_id ORDER BY full_name") or die($mysqli->error);
while($row=mysqli_fetch_array($q)){ $user_id=$row['user_id'];
	$planned=num_rows('tbl_route_plan',"status=0 and assigned_to=$user_id and date(startdate)='$date'");
	$visited=num_rows('tbl_route_plan',"status=0 and assigned_to=$user_id and date(startdate)='$date'  and visted=1");
	$total_time_spent=timeSpentinAnOutletsByAD($user_id,$date);
	$scheduled=num_rows('tbl_route_plan',"status=0 and assigned_to=$user_id and date(startdate)='$date' and when_scheduled='Scheduled'");
	$scheduled_visited=num_rows('tbl_route_plan',"status=0 and assigned_to=$user_id and date(startdate)='$date' and when_scheduled='Scheduled' and visted=1");
		$unscheduled=num_rows('tbl_route_plan',"status=0 and assigned_to=$user_id and date(startdate)='$date' and when_scheduled='Unscheduled'");
		$soldTo=num_rows('tbl_orders_details',"status=0 and made_by=$user_id and date(date_added)='$date' group by dealer_id");
	
	?> <tr>
    <td><?php echo $i?></td>
    <td><?php echo $row['full_name']?></td>
    <td><?php echo $planned*30 //planned?></td>
    <td><?php echo $total_time_spent?></td>
    <td><?php echo percentage_conversion($total_time_spent,$planned*30)?></td>
     <td><?php echo $scheduled?></td>
    <td><?php echo $scheduled_visited?></td>
    <td><?php echo percentage_conversion($scheduled_visited,$scheduled)?></td>
    <td><?php echo $unscheduled?></td>
    <td><?php echo percentage_conversion($unscheduled,$scheduled)?></td>
    <td><?php echo $soldTo?></td>
  <td><?php echo percentage_conversion($soldTo,$visited)?></td>
  </tr><?php $i++;} 
  
 ?></tbody>
                               
                          </table>
                    </section>
  <?php $message=ob_get_clean(); echo $message;
 // $send_to_q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `role`>1")or die(mysqli_error()); while($result=mysqli_fetch_array($send_to_q)){
						 // $to=$result['email']; $title='Day performance report of: '.$date;
					//send_email($message ,$title,$to); 
						//  }?>
                         
                  </div><!-- /col-lg-129 END SECTION MIDDLE -->
                  
                  

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
