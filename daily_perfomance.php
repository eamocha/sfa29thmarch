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
		//  fetch_clients();
	//assign_salesperson();
          
 //load select boxes
 	
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
                        <?php  include('submenu.php'); $area_id=$_SESSION['area_id']; $date=date('Y-m-d'); $date=date("Y-m-d"); $region_id=$_SESSION['region_id'];;?>
                         <h3 class="float_left">Outlets visited, #orders and #sales daily Report<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();

 $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" a.status=0 ";
	switch($role){
		case 4: $where=" a.status=0 "; break;//cm
		case 2: $where=" a.region_id=$myregion and a.status=0 "; break;//rm
		case 3: $where=" a.area_id=$myArea and a.status=0 "; break;//arm
		case 1: $where=" a.cluster_id=$cluster_id and a.status=0 "; break;//AD
		case 7: $where=" a.distributor_id=$distributor_id and a.status=0 ";//AD
	}
	
	$reg_name=region_name($region_id); $ar_name="All areas";
if(isset($_REQUEST['submit']))
{ $area_id=$_REQUEST['area'];
$date=$_REQUEST['date'];
    $region_id = $_REQUEST['region']; $ar_name=area_name($area_id);
	 $reg_name=region_name($region_id);
	 if($area_id==0){$where.=" and a.status=0 and a.region_id=$region_id ";} else{
	$where.=" and a.region_id=$region_id and a.area_id=$area_id";}
	   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>Date </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date;?>" name="date"></td><td><select  class="form-control" name="region"><?php echo region_selection();?></select></td><td><select class="form-control" name="area" id="area"><option value="0">Select area</option> <?php echo area_selection();?> </select></td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>Day Peromance report of<b> <?php echo  date("D d, M Y",strtotime($date)).' ( '.$date.' ) ';?></b>. Region: <?php echo $reg_name?>  and area: <?php echo $ar_name?></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">	
                              <thead>
                              <tr>
                                  <th rowspan="2">No</th>
                                  <th rowspan="2" >AD</th>
                                   <th colspan="4" >Outlets</th>
                                  <th colspan="2">Stock Status</th>
                                  <th>Sales</th>
                                  <th rowspan="2">Actions</th>
                              </tr>
                              <tr>
                              <th>Planned</th>
                                <th >Visited</th>
                                <th>New</th>
                                 <th title="The average distance calculated based on the point where the RED audit was carried out in comparision to where the outlet was registered">Avg. Mtrs from Visit</th>
                                 <th>Cases</th>
                                <th>Pieces</th>
                                <th>Orders Generated</th>
                                </tr>
                              </thead>
                              <tbody>
                             <?php
							 $i=1; 
			$q=mysqli_query( $mysqli,"SELECT  a.user_id,a.full_name as name, count(b.id) as planned, COALESCE(SUM(b.visted=1),0) AS visited, AVG(b.distance_from_visit_point) AS distance, COUNT(c.dealer_id) AS registered, COALESCE(sum(d.cases),0) as cases, COALESCE(sum(d.cases),0) as pcs
FROM tbl_users a LEFT JOIN tbl_route_plan b on ( a.user_id=b.made_by AND ( date(b.startdate)='$date' OR b.startdate=null) AND b.status=0) LEFT JOIN tbl_dealers c ON (a.user_id=c.added_by AND c.status=0 AND date(c.reg_date)='$date') LEFT JOIN tbl_orders_details d ON (d.made_by=a.user_id AND d.status=0 AND date(d.date_added)='$date')
WHERE a.status=0 and $where GROUP BY a.user_id  WITH ROLLUP
")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$uid=$r['user_id'];
								$name=$r['name'];
							if($r['user_id']===null){ $name='Total';$i=""; $uid=0;}
								//$reg_id=$r['region_id'];
								//$total_visted += visited_today($uid,$date);
								//$total_added +=outlets_added_in_day($uid,$date);
								//$strike_rate+=day_strike_rate($uid,$date);
								//$cases+=days_stock_levels($uid,$date,'cases');
								//$singles+=days_stock_levels($uid,$date,'singles');
							//	$orders+=days_orders_deliveries($uid,$date,'cases');
							//	$delivered+=days_orders_deliveries($uid,$date,'pieces')
								?>
                                
                                 <tr>
                                   <td><?php echo $i;
								   ?></td>
                                   <td ><?php echo $name;?></td>
                                   <td ><?php echo $r['planned'] ?></td>
                                   <td ><?php  echo $r['visited'] ?></td>
                                    <td ><?php echo $r['registered'] ?></td>
                                   <td ><?php echo $r['distance'];?></td>
                                   <td ><?php echo days_stock_levels($uid,$date,'cases');?></td>
                                   <td ><?php echo days_stock_levels($uid,$date,'singles');?></td>
                                   <td ><?php echo $r['cases']?></td>
                                   <td  style="text-align:center" ><a href="individual_route_completion.php?day=<?php echo $date ?>&user_id=<?php echo $uid?>">View more</a></td>
                                 </tr>  
                                <?php $i++; }?>
                                 </tbody>
                               
                          </table>
                    </section>
  <?php $message=ob_get_clean(); echo $message;
 // $send_to_q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `role`>1")or die(mysqli_error()); while($result=mysqli_fetch_array($send_to_q)){
						 // $to=$result['email']; $title='Day performance report of: '.$date;
					//send_email($message ,$title,$to); 
						//  }?>
                         
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
