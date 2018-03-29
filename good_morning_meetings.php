<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];  $area_id=$_SESSION['area_id']; $user_role=$_SESSION['user_role']; $region_id=$_SESSION['region_id'];$cluster_id=$_SESSION['cluster_id'];
	$boundary="";
	switch($user_role){
		case 5: $boundary=" and area=$area_id"; break;
		case 3: $boundary=" and area=$area_id";break;
		case 2: $boundary=" and region=$region_id"; break;
		case 1: $boundary=" and cluster=$cluster_id"; break;
		}
	   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>

     
  <script type="text/javascript" >
      $(window).load(function(e) {
         
 //load select boxes
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
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                      <span id="dontpdf">
                      <div class="border-head" >
                        <?php  include('submenu.php'); date_default_timezone_set('Africa/Nairobi'); $date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)); //yesterday
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">Good Morning Meetings Report </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
if(isset($_REQUEST['submit']))
{
    $date = date("Y-m-d",strtotime($_REQUEST['date'])); 
	$boundary=$boundary." and date_added LIKE '$date%'";
	//$date2=$_REQUEST['date2'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>Date </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date;?>" name="date"></td><td> </td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>Report of<b> <?php echo date("D d, M Y",strtotime($date)).' ( '.$date.' ) ';?></b></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th rowspan="2" >No</th>
                                  <th rowspan="2" >Where held</th>
                                  <th rowspan="2">Route</th>
                                  <th rowspan="2">Distributor</th>
                                  <th rowspan="2">Sub ARea</th>
                                  <th rowspan="2">Area</th>
                                 <th colspan="3">Previus Day Sales</th>
                                  <th colspan="2" >Corrective Actions Tracker</th>
                                  <th colspan="2" >Today Plan</th>
                                  <th rowspan="2" >Date Added</th>
                                  <th rowspan="2" >Added By</th>
                                  <th rowspan="2" >Sup. Remarks</th>
                                   <th rowspan="2" >Supervisor</th>
                                   <th rowspan="2">DSR</th>
                                  <th rowspan="2" >Actions</th>
                              </tr>
                              <tr>
                                <th>TGT</th>
                                <th>ACT</th>
                                <th>VAR</th>
                                <th >Prior Day Plan</th>
                                <th >C. Status</th>
                                <th >Target</th>
                                <th >Activities</th>
                                </tr>
                             
                              </thead>
                              <tbody>
                             <?php  $i=1;
			$q=mysqli_query( $mysqli,"SELECT location,distributor, `good_morning_meeting_id`, `taken_by`, `date_added`, `region`, `area`, `cluster`, `route`, `lon`, `lat`, `today_plan_activity`, `corrective_action_status`, `today_plan_target`, `pd_target`, `actual_sales`, `comments_by_supervisor`, `pd_corrective_action_plan`, `challanges_experienced`, `supervisor_id`, `dsm_incharge`, `attendance_details`, `status` FROM `tbl_good_morning_meeting` WHERE status=0 $boundary order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){ $id=$r['good_morning_meeting_id'];
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                  <td><?php echo $r['location']; ?></td>
                                  
                                   <td ><?php echo get_route($r['route']);?></td>
                                    <td ><?php echo distributor_name($r['distributor']);?></td>
                                    <td ><?php echo sub_area_name($r['cluster']);?></td>
                                     <td ><?php echo area_name($r['area']);?></td>
                                      <td ><?php echo $r['pd_target'];?></td>
                                     <td ><?php echo $r['actual_sales'];?></td>
                                     <td ><?php echo $r['pd_target']-$r['actual_sales'];?></td>
                                      <td ><?php echo $r['pd_corrective_action_plan'];?></td>
                                      <td ><?php echo $r['corrective_action_status'];?></td>
                                     <td ><?php echo $r['today_plan_target'];?></td>           
                                     <td ><?php echo $r['today_plan_activity'];?></td>
                                       <td ><?php echo $r['date_added'];?></td>
                                      <td ><?php echo get_name($r['taken_by']);?></td>
                                      <td ><?php echo $r['comments_by_supervisor'];?></td>
                                      <td ><?php echo get_name($r['supervisor_id']);?></td>
                                       <td ><?php echo $r['dsm_incharge'];?></td>
                                      <td ><a href="goodmm_remarks.php?id=<?php echo $id?>"><?php ?> Add remarks</a></td>
                                       </tr>  
                                <?php $i++; }?>
                                
                          
                              </tbody>
                               
                          </table>
                    </section>
 
                  </div><!-- /col-lg-12 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->    
              </div><! --/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

 <script src="assets/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

	<script src="assets/js/advanced-form-components.js"></script>  
  </body>
</html>
