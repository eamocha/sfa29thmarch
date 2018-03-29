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
 ?>
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
                         <h3 class="float_left">DOSA Per Distributor<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
					 $where="dealer_type='D' and a.status=0";
if(isset($_REQUEST['submit']))
{ $area_id=$_REQUEST['area'];
    $region_id = $_REQUEST['region']; 
	if($area_id<=0) $where=" dealer_type='D' and a.status=0 and region_id=$region_id "; else	$where=" dealer_type='D' and a.status=0 and region_id=$region_id and area_id=$area_id";
	
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <select  class="form-control" name="region"><?php echo region_selection();?></select></td><td><select class="form-control" name="area" id="area"><option value="-1">All</option> <?php echo area_selection();?> </select></td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div><p>Region <?php echo region_name($region_id)?>. Area: <?php echo area_name($area_id)?>. Please click<a href="http://almasisfa.com/excel_dosa_raw_data_per_distributor.php"> here </a>to download an excel sheet </p></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">
                        
                              <thead> 
  <tr>
   <th>#</th> <th>Distributor</th>
   <th>Area</th>
    <th >Entered by</th>
    <th >Date entered</th>
    <th >Qns </th>
     <th >Score</th>
     <th >Total score</th>
     <th >%</th>
     
      <th >Actions</th>
  
  </tr>            </thead>         <tbody>
		
										 <?php $d=1; 			
						  $total_score=sum_columns("tbl_survey_questions","score_gold","red_eds_dosa='dosa' and status=0 ");
						  
		$arq=mysqli_query($mysqli,"SELECT COALESCE(sum(score),0) AS score,survey_date,`by` as uid,dealer_id,b.distributor_name,b.area_id,b.region_id FROM `tbl_survey` a LEFT JOIN tbl_distributors b ON a.dealer_id=b.distributor_id  WHERE $where GROUP by dealer_id, date(survey_date), `by` ORDER by survey_date DESC") or die(mysqli_error($mysqli));
							  while($ar=mysqli_fetch_array($arq)){ 
							  $distributor_id=$ar['dealer_id'];
							  $date_done=date("Y-m-d",strtotime($ar['survey_date']));
							  $by=$ar['uid'];
							  $qns=num_rows("tbl_survey","dealer_id=$distributor_id AND DATE(survey_date)='$date_done' AND status=0 and `by`=$by");
							 
							  
								?>
                              <tr>  <td><?php echo $d?></td> <td><?php echo $ar['distributor_name']?></td>
   <td><?php echo area_name($ar['area_id'])?></td>
    <td><?php echo get_name($by)?></td>
    <td><?php echo date("d.m.Y",strtotime($ar['survey_date']))?></td>
    <td><?php echo $qns?></td>
    <td><?php echo $ar['score']?></td>
     <td><?php echo $total_score?></td>
     <td><?php echo  percentage_conversion($ar['score'],$total_score)?></td>
 
     <td><a href="distributor_dosa_questions_answers.php?distributor_id=<?php echo $distributor_id?>&date=<?php echo $date_done?>">Details</a></td></tr>
        
         <?php $d++; }//end area?> </tbody>                                          
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
