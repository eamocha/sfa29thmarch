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
	$distributor_id=clean($_REQUEST['distributor_id']); $date_done=clean($_REQUEST['date']);
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
                        <?php  include('submenu.php'); $area_id=$_SESSION['area_id'];$date=date('Y-m-d'); $date=date("Y-m-d",strtotime($date)); $region_id=0;
						$date2=date('Y-m-d');?>
                         <h3 class="float_left">DOSA Per Distributor<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php ob_start();
					 $where="dealer_type='D' and a.status=0 and dealer_id=$distributor_id and date(survey_date)='$date_done'";
if(isset($_REQUEST['submit']))
{ 
    $distributor_id = $_REQUEST['distributor']; 
	$parameter = $_REQUEST['parameter']; 
	if($parameter==='none'){ $where=" dealer_type='D' and a.status=0 and dealer_id=$distributor_id ";}
	else $where=" dealer_type='D' and a.status=0 and dealer_id=$distributor_id and category='$parameter' ";
	
	
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>Distributor </td><td><select name="distributor" id="distributor" class="form-control" > <?php echo distributor_selection();?> </select></td><td>Parameter </td><td><select name="parameter" id="parameter" class="form-control" ><option value="none"  >All</option> <?php echo question_category_selection('dosa');?> </select></td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div><p> Distributor: <?php echo distributor_name($distributor_id)?>. Please click<a href="http://almasisfa.com/excel_dosa_raw_data_per_distributor.php"> here </a>to download an excel sheet </p></div>     </span>
                   <section id="unseen">
                          <table border="1px" class="table table-bordered table-striped table-condensed" id="tblExport">
                        
                              <thead> 
  <tr>
   <th>#</th> <th>Question</th>
  
    <th>Max score</th>
         <th >Answer</th>
          <th >Score</th>
           <th >Category</th>

      <th >Date </th>
      <th >Done By </th>
    
  
  </tr>            </thead>         <tbody>
		
										 <?php $d=1; 			
						
		$arq=mysqli_query($mysqli,"SELECT `survey_qID`, `question`, `category_group`, `category`, `score_gold`,score,b.answer,b.survey_date,b.by as uid FROM`tbl_survey_questions` a RIGHT JOIN tbl_survey b ON a.`survey_qID`=b.q_id  WHERE $where 
ORDER BY `a`.`category`,survey_qID ASC") or die(mysqli_error($mysqli));
							  while($ar=mysqli_fetch_array($arq)){ 
							 
							  $date_done=$ar['survey_date'];
							  $by=$ar['uid'];
							 							 
							  
								?>
   <tr>  <td><?php echo $d?></td> <td><?php echo $ar['question']?></td>
    <td><?php echo $ar['score_gold']?></td>
     <td><?php echo $ar['answer'];?></td>
     <td><?php echo  $ar['score'];?></td>
    <td><?php echo $ar['category'];?></td>
    <td><?php echo $ar['survey_date']?></td>
     <td><?php echo get_name($by)?></td>
  
 
    </tr>
        
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
