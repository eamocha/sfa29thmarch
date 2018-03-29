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
      MAIN SIDEBAR MENU     *********************************************************************************************************************************************************** --> <!--sidebar start
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
                        <?php  include('submenu.php'); $date=date('Y-m-d'); $date2=date('Y-m-d');?>
                         <h3 class="float_left">Daily ADS Plan list<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date']; 
	//$date2=$_REQUEST['date2'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date;?>" name="date"></td><td> </td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>TSR plans for <b> <?php echo date("D d, M Y",strtotime($date)).' ( '.$date.' ) ';?></b></div>     </span>
                   <section id="unseen">
                         <table class="table table-bordered table-striped table-condensed" id="tblExport"><thead>
                           <tr><th>Name</th><th colspan="2">Outlet</th><th>Location</th><th>Visits</th><th>Sales(Cases)</th><th>Previus Visit</th></thead>
                         <tbody>
                         <?php 
						 			 $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" status=0 ";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
	}
						 
						 $users_q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE $where")or die(mysqli_error($mysqli)); while($result=mysqli_fetch_array($users_q)){
							 $u_id=$result['user_id'];
							 //initialize counter 
							 $i=1;
							 $query_plans=mysqli_query($mysqli,"SELECT * FROM `tbl_route_plan` WHERE date(`startdate`)='$date' and status=0 and `assigned_to`=$u_id")or die(mysqli_error($mysqli)); $n=mysqli_num_rows($query_plans); if($n==0){?>
							
                            <tr> <td rowspan="<?php echo $n?>"><?php echo $result['full_name']?></td><td> -</td>
                              <td>-</td>
                            <td> -</td><td> -</td><td> -</td><td> -</td></tr>
							 
							 <?php
								 } else{?><tr><td rowspan="<?php echo $n?>"><?php echo $result['full_name']?></td>
								 <?php
							  while($plan_rows=mysqli_fetch_array($query_plans)){ $dealer_id=$plan_rows['dealer_id']; ?>
                          
                         <td><?php echo $i?></td>
                         <td><?php echo business_name($dealer_id)?></td>
                         <td><?php echo outlet_position($dealer_id);?></td><td><?php echo times_visited($dealer_id)?></td><td><?php echo sales_by_outlet_total($dealer_id)?></td><td><?php echo last_visit_date($dealer_id)?></td></tr><?php $i++;} 
								 }//close else
						 
							 }?>
                         </tbody>
                         </table>
                    </section>
  <?php $message=ob_get_clean(); echo $message;
?>
                         
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


    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
  </body>
</html>
