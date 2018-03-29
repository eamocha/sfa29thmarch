<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $area_id=$_SESSION['area_id'];
	$today=date("Y-m-d");
  $jana=date("Y-m-d",strtotime("-1 days")); $juzi=date('Y-m-d',strtotime("-2 days")); 
  $daysInMonth=daysInMonth(date('Y'),date('m'));$tarehe=date('d'); ?>
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
                        <?php  include('submenu.php'); $area_id=$_SESSION['area_id']; date_default_timezone_set('Africa/Nairobi'); $date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)); $region_id=0;
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">Sellout Summary per area<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
					 $where="a.status=0  AND a.area_id NOT IN(8,14,23)";
if(isset($_REQUEST['submit']))
{ //$area_id=$_REQUEST['area'];
    $region_id = $_REQUEST['region']; 
	$where="a.status=0 and a.region_id=$region_id ";
	
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <select  class="form-control" name="region"><?php echo region_selection();?></select></td><td><!-- <select class="form-control" name="area" id="area"> <?php echo area_selection();?> </select>--></td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->           </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">	
                      
                              <thead> 
  <tr>
   <th>#</th> <th>Area</th>
    <th >Manager</th>
    <th >PY</th>
    <th >Actual</th>
    <th >Target</th><?php 
								 for($m=1; $m<=12; $m++) {?> <th><?php echo date($m)?></th><?php }?>

  </tr>
                     </thead>         <tbody>
		
										 <?php 			
						 $d=1;
		$dq=mysqli_query($mysqli,"SELECT a.area_id,area_name,arm_incharge,full_name,this_month_target FROM tbl_areas a left join tbl_users b on b.user_id=a.arm_incharge WHERE $where order by a.region_id,a.area_id") or die(mysqli_error($mysqli));
							  while($dr=mysqli_fetch_array($dq)){  $area_id=$dr['area_id'];$area_name=$dr['area_name'];
							  $arm_incharge=$dr['full_name'];
								  ?>
        
          <tr>
                                 <td><?php echo $d?></td>  <td><?php echo $area_name?></td> <td><?php echo $arm_incharge?></td>  <td><?php echo $dr['this_month_target']?></td>  <td><?php echo $dailyTarget= number_format($dr['this_month_target']/$daysInMonth,1)?></td><td><?php echo $dailyTarget*$tarehe;?></td> <?php for($month=1; $month<=12; $month++) {?> <td><?php  echo sum_columns("tbl_route_sales","qty_sold"," `area_id`=$area_id and month(date_sold)='".date($m)."' and status=0")?></td><?php }?>
							     </tr>
         <?php $d++;}//end area?> </tbody>                                          
                          </table>
              
                          
                         
                          					  
                           <?php ////get all data for sending
						   $message=ob_get_clean(); echo $message;
                        ?>
                         
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
