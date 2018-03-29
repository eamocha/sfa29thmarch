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
 <script charset="utf-8" src="assets/myscipt/http _cdn.datatables.net_1.10.0_js_jquery.dataTables.js"></script>
    <script charset="utf-8" src="assets/myscipt/http _cdn.jsdelivr.net_jquery.validation_1.13.1_jquery.validate.min.js"></script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
     
  <script type="text/javascript" >
      $(window).load(function(e) {

 	//	load_users();
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
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                      <span id="dontpdf">
                      <div class="border-head" >
                        <?php  include('submenu.php'); $area_id=$_SESSION['area_id']; date_default_timezone_set('Africa/Nairobi'); $date=date('Y-m-d'); $date=date("Y-m-d"); //yesterday
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">The report shows Visited outlets only<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
					  $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	 $where="  date(`date_visted`)='$date' and a.status=0 ORDER BY assigned_to limit 70";
	switch($role){
		case 4: $where="  date(`date_visted`)='$date' and a.status=0 ORDER BY assigned_to limit 70 "; break;//cm
		case 2: $where=" region_id=$myregion and  date(`date_visted`)='$date' and a.status=0 ORDER BY assigned_to limit 70 "; break;//rm
		case 3: $where=" area_id=$myArea and  date(`date_visted`)='$date' and a.status=0 ORDER BY assigned_to limit 70 "; break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
	}
	
	 
					 $area_name="All areas";
if(isset($_REQUEST['submit']))
{ $area_id=$_REQUEST['area'];
    $date = $_REQUEST['date']; 
	$area_name=area_name($area_id);

	 $where=" date(`date_visted`)='$date' and area_id=$area_id ORDER BY assigned_to";
   } 
   
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date;?>" name="date"></td><td><select class="form-control" name="area" id="area"><option value="<?php echo $area_id?>"><?php echo $area_name?></option> <?php echo area_selection();?> </select></td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>Outlets Visisted on <b> <?php echo  date("D d, M Y",strtotime($date)).' ( '.$date.' ) ';?></b> Market: <?php echo $area_name?></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">	
                          <thead>   <tr>
<tr>
  <th >#</th>
   <th >Date</th>
  <th>AD</th>
  <th>Route</th>
  <th>Outlet</th>
  <th >Lon</th>
  <th >Lat</th>
  <th >Distance</th>
  <th >Time In</th>
  <th >Time Out</th>
  <th >Time In Outlet</th>
  <th >Scheduled/Unscheduled </th>
 
  <th >Total Sales</th>
  </tr>
</thead>
<tbody>
<?php $i=1; $q=$mysqli->query("SELECT `id`, `lon`, `lat`, `closed`,outlet_closed, `time_in`, `time_out`, `syncStatus`, `dTModified`, `dealer_id`, `made_by`, `assigned_to`, `visted`,date_visted, `startdate`, `enddate`, `allDay`, distance_from_visit_point, `merchandized`, `stock_taken`, `order_done`, `when_scheduled`, full_name,area_id FROM `tbl_route_plan` a LEFT JOIN tbl_users b on a.`assigned_to`=b.user_id WHERE $where") or die($mysqli->error);
while($row=mysqli_fetch_array($q)){
	 $dealer_id = $row['dealer_id']; 
	 $time_in = $row['time_in']; 
   	$time_out=$row['time_out']; 
   $date_visited=date("Y-m-d",strtotime($row['date_visted']));
   ?><tr>
    <td><?php echo $i?></td>
    <td><?php echo $row['date_visted']?></td>
     <td><?php echo $row['full_name']?></td>
    <td><?php echo dealer_route($dealer_id)?></td>
    <td><?php echo business_name($dealer_id)?></td>
    <td><?php echo $row['lon']?></td>
   <td><?php echo $row['lat']?></td>
     <td><?php echo $row['distance_from_visit_point']?></td>
    <td><?php echo $time_in?></td>
    <td><?php echo $time_out?></td>
  <td><?php   echo time_diff($time_in,$time_out);?></td>
   <td><?php echo $row['when_scheduled']?></td>
    <td><?php echo day_outlet_sales($dealer_id,$date_visited)?></td>
  </tr><?php $i++;} ?></tbody>
                               
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
