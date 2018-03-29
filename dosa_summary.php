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
                         <h3 class="float_left">Sellout Summary <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
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
   <th>#</th> <th>Parameter</th>
   <?php $ids=array(); $total_score=sum_columns("tbl_survey_questions","score_gold","red_eds_dosa='dosa' and status=0 ");
    $areasq=mysqli_query($mysqli,"SELECT area_name,area_id FROM tbl_areas a WHERE $where ") or die($mysqli->error);
    while($rws=mysqli_fetch_array($areasq)){ $ids[]=array("area_id"=>$rws['area_id']); ?> <th ><?php echo $rws['area_name']?></th><?php }?>

  </tr>
                     </thead>         <tbody>
		
										 <?php //convert the ids into an array
for ($i = 0; $i < count($ids); $i++) {
  $all_ids[] = implode(',', $ids[$i]);
}
						 $d=1;
		$dosaQ=mysqli_query($mysqli,"SELECT category,sum(score_gold) as param_score FROM `tbl_survey_questions` WHERE red_eds_dosa='dosa' group by category") or die(mysqli_error($mysqli));
							  while($r=mysqli_fetch_array($dosaQ)){  
							  
						$category=$r['category'];
						$parameter_score=$r['param_score']
							 
								  ?>
        
          <tr>
                                 <td><?php echo $d?></td>  <td><a href="dosa_raw_data_per_parameter.php?parameter=<?php echo $category?>&month=<?php echo date('m')?>"><?php echo $category?></a></td> <?php  foreach($all_ids as $aa){?><td><?php echo area_dosa_per_parameter($aa,$category,$parameter_score)?></td><?php } ?>  
							     </tr>
         <?php $d++;}//end area?> 
   </tbody>            <tfoot>  <tr class="totalfooter">   <td colspan="2">Total</td> <?php  foreach($all_ids as $aa){?><td><?php echo dosa_per_area($aa,$total_score)?></td><?php } ?>  
							     </tr>                               
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
