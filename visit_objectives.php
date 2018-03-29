<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $user_role=$_SESSION['user_role'];   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script src="assets/js/excel/jquery.btechco.excelexport.js"></script>
<script src="assets/js/excel/jquery.base64.js"></script>
<link href="assets/js/advanced-datatable/media/css/demo_table.css">
     
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
                         <h3 class="float_left">Visit Objectives<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date']; 
	//$date2=$_REQUEST['date2'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>Date </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date;?>" name="date"></td><td> </td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>Report of<b> <?php echo date("D d, M Y",strtotime($date)).' ( '.$date.' ) ';?></b></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th >No</th>
                                  <th >Objetive detail</th>
                                  <th  >Reviewed </th>
                                   <th >Remarks</th>
                                  <th >Outlets</th>
                                   <th >Added By</th>
                                   <th>Date Time</th>
                                  <th >Actions</th>
                              </tr>
                             
                              </thead>
                              <tbody>
                             <?php  $i=1;
			$q=mysqli_query( $mysqli,"SELECT `objective_id`, `details`, `reviewed_objective`, `dealer_id`, `added_by`, `date_added`, `remarks`, `status` FROM `tbl_objectives` WHERE 1 order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td ><?php echo $r['details'];?></td>
                                   <td ><?php echo $r['reviewed_objective'];?></td>
                               
                                    <td ><?php echo $r['remarks'];?></td>
                                        <td ><?php echo business_name($r['dealer_id']);?></td>
                                         <td ><?php echo get_name($r['added_by']);?></td>
                                     <td ><?php echo $r['date_added'];?></td>
                                     <td ><a href=""><?php ?> View</a></td>
                                       </tr>  
                                <?php $i++; }?>
                                
                          
                              </tbody>
                               
                          </table>
                    </section>
 
                  </div><!-- /col-lg-12 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->    
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
