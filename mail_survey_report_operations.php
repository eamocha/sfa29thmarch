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
		  fetch_clients();
	assign_salesperson();
  
        
 //load select boxes
 		load_users();
		//get excel
		function converting_to_excel(){
		var dt=new Date();
		
		var w_name=dt.getFullYear()+'.'+ dt.getMonth()+1+'.'+ dt.getDate()+' '+ dt.getHours()+'-'+ dt.getMinutes();
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
               , filename: w_name
            });
        });
		}
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
                        <?php include('submenu.php'); $date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)-86400); ?>
                         <h3 class="float_left">Survey report  <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table width="577" ><tr>
                      <td width="38"> <a href="graph_survey_report_operations.php" class="btn btn-default">Graph</a>  </td> <td width="46">As at </td><td width="175"> <input type="text" class="form-control  dpd1" name="date" value="<?php echo $date?>"></td><td width="20"> <input type="checkbox"> </td>
                      <td width="159"> Include previus</td><td width="111"><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div></span>
                     <!--start -->   <?php ob_start()?>   <div>Survey report of  <b> <?php $sttime=strtotime($date); echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
<?php $results=$mysqli->query("SELECT count(*) as t_records FROM `tbl_check_in` where  DATE(`date_timein`)='$date' and status=0")or die('error');
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); ?><script type="text/javascript">
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var total=<?php echo $total_records->t_records?>;
	var pergroup=<?php echo $items_per_group=100?>;
	var dt=<?php echo $sttime?>;
	loading_data('#results',"data.php?dt="+dt+'&mode=survey',track_load,loading,total_groups,total,pergroup);
		
});
</script>
                            <table  id="tblExport" width="100%" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr  align="center">
                                  <th width="3%" style="text-align:center">No.</th>
                                  <th width="15%" style="text-align:center">Outlet</th>
                                  <th width="6%" style="text-align:center">O. Ads</th>
                                  <th width="6%" style="text-align:center">I.Ads</th>
                                  <th width="10%" style="text-align:center">Merchandising</th>
                                  <th width="8%" style="text-align:center">N Signs</th>
                                  <th width="10%" style="text-align:center">L Pannels</th>
                                  <th width="9%" style="text-align:center">B runners</th>
                                  <th width="9%" style="text-align:center">Coasters</th>
                                  <th width="7%" style="text-align:center">Glasses</th>
                                  <th width="8%" style="text-align:center"> Promo</th>
                                  <th width="9%" style="text-align:center">Fridge Av</th>
                              </tr>
                              </thead>
                              <tbody id="results">
                             </tbody>
                               
                          </table>
                          <div class="animation_image" style="display:none" align="center"><img src="images/ajax-loader.gif">loading...</div>

                          </section>
   <?php $message=ob_get_clean(); echo $message;
  $send_to_q=mysql_query("SELECT * FROM `tbl_users` WHERE `role`>1")or die(mysql_error()); while($result=mysql_fetch_array($send_to_q)){
						  $to=$result['email']; $title='Survey/merchandize report of: '.$date;
					send_email($message ,$title,$to); 
						  }?>
                         
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
    <script src="assets/js/jquery.sparkline.js"></script>


  
	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
  </body>
</html>
