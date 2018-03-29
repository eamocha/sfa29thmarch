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
                        <?php include('submenu.php'); $date=date('Y-m-d'); $date2=date('Y-m-d');?>
                         <h3 class="float_left">Route Completion Report <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span> </h3> <div>
       
    </div>
                      </div>
                    <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date']; 
	//$date2=$_REQUEST['date2'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table  ><tr><td>From </td><td> <input type="text" class="form-control dpd1" value="<?php echo $d=first_day_of_week($date);?>" name="date"></td><td> </td><td> </td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td><td> </td></tr></table></form> </div>
                     <!--start -->      <div>Route Completion for week starting<b> <?php echo date('D dS, M Y', strtotime($d));?></b> and ending <b><?php $next_sund=date("Y-m-d",strtotime($d)+86400*7); echo date('D dS, M Y', strtotime($next_sund));?></b></div>     </span>
                   <section id="unseen">
                          <table class="table table-bordered table-striped table-condensed" id="tblExport">	
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th >Sales Resource</th>
                                   <th >Item</th>
                                  <th> Mon</th>
                                  <th>Tue</th>
                                  <th>Wed</th>
                                  <th >Thur</th>
                                  <th >Fri</th>
                                  <th >Sat</th>
                                   <th>Sun</th>
                                   <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                             <?php  
							$t_vist_mon=0;$t_vist_tue=0;$t_vist_wed=0;$t_vist_thu=0;$t_vist_fri=0;$t_vist_sat=0;$t_vist_sun=0; $total_exp=0; $total_vsted=0; $mon_exp=0; $tue_exp=0; $wed_exp=0; $thur_exp=0; $fri_exp=0; $sat_exp=0;  $sun_exp=0; 
							 $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `role`=1 or `role`=2")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$uid=$r['user_id'];
								$reg_id=$r['region_id'];
								
						
						
							 $t_vist_mon+= $mon_visted=visted_outlets($uid,$date,'mon' );
                                    $t_vist_tue+=$tue_visted=visted_outlets($uid,$date,'tue' );
                                    $t_vist_wed+=$wed_visted=visted_outlets($uid,$date,'wed' );
                                    $t_vist_thu+=$thur_visted= visted_outlets($uid,$date,'thur' );
                                    $t_vist_fri+= $fri_visted=visted_outlets($uid,$date,'fri' );
                                    $t_vist_sat+=$sat_visted=visted_outlets($uid,$date,'sat' );
                                    $t_vist_sun+=$sun_visted=visted_outlets($uid,$date,'sun' );
									//total in week
							$total_exp+= $tt_w_exp=$mon_exp+$tue_exp+$wed_exp+$thur_exp+$fri_exp+$sat_exp+$sun_exp;
							 $total_vsted+=$tt_w_vstd=$mon_visted+$tue_visted+$wed_visted+$thur_visted+$fri_visted+$sat_visted+$sun_visted;
                               ?>
                                
                                 <tr>
                                   <td valign="top" rowspan="3"><?php echo $i;
								 
								   ?></td>
                                   <td valign="top" rowspan="3" ><?php echo $r['full_name'];?></td>
                                   <td>Exp.</td><?php for($c=1;$c<8; $c++){?><td><?php echo expected_outlets_to_visit($uid,date("Y-m-d",strtotime($d)+86400*$c) )?></td><?php }?>
                                   
                                   
                                   <td><?php echo $tt_w_exp?></td>
                                 </tr>  <tr>
                                   <td >Visited</td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400)?>&user=<?php echo $uid ?>"><?php echo $mon_visted?></a></td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400*2)?>&user=<?php echo $uid ?>"><?php echo  $tue_visted ?></a></td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400*3)?>&user=<?php echo $uid ?>"><?php echo  $wed_visted?></a></td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400*4)?>&user=<?php echo $uid ?>"><?php echo  $thur_visted?></a></td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400*5)?>&user=<?php echo $uid ?>"><?php echo  $fri_visted?></a></td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400*6)?>&user=<?php echo $uid ?>"><?php echo  $sat_visted?></a></td>
                                   <td><a href="visited.php?day=<?php echo date("Y-m-d",strtotime($d)+86400*7)?>&user=<?php echo $uid ?>"><?php echo  $sun_visted?></a></td>
                                   <td><?php echo $tt_w_vstd?></td>
                                   </tr> 
                                   <tr>
                                   <td >%</td>
                                   <td><?php if($mon_exp>0)echo number_format($mon_visted*100/12,1).'%'?></td>
                                   <td><?php if($tue_exp>0)echo number_format($tue_visted*100/12,1).'%'?></td>
                                   <td><?php if($wed_exp>0)echo number_format($wed_visted*100/12,1).'%'?></td>
                                   <td><?php if($thur_exp>0)echo number_format($thur_visted*100/12,1).'%'?></td>
                                   <td><?php if($fri_exp>0)echo number_format($fri_visted*100/12,1).'%'?></td>
                                   <td><?php if($sat_exp>0)echo number_format($sat_visted*100/12,1).'%'?></td>
                                   <td><?php if($sun_exp>0)echo number_format($sun_visted*100/12,1).'%'?></td>
                                   <td title="This is based on 12 by 7 days=84 outlets"><?php if($tt_w_exp>0)echo number_format($tt_w_vstd*100/84,1).'%'?></td>
                                   </tr>
                           
                             <?php $i++; }?>
                                 <tr >
                               <td rowspan="3">&nbsp;</td>
                               <td rowspan="3">Total</td>
                               <td >Exp.</td>
                               <td ><?php //echo $texp_mon?></td>
                               <td ><?php //echo $texp_tue?></td>
                               <td ><?php //echo $texp_wed?></td>
                               <td ><?php //echo $texp_thu?></td>
                               <td ><?php //echo $texp_fri?></td>
                               <td ><?php //echo $texp_sat?></td>
                               <td ><?php //echo $texp_sun?></td>
                               <td ><?php //echo $total_exp?></td>
                               </tr>
                                 <tr  >
                                   <td >Visited</td>
                                   <td ><?php //echo $t_vist_mon?></td>
                                   <td ><?php //echo $t_vist_tue?></td>
                                   <td ><?php //echo $t_vist_wed?></td>
                                   <td ><?php //echo $t_vist_thu?></td>
                                   <td ><?php //echo $t_vist_fri?></td>
                                   <td ><?php //echo $t_vist_sat?></td>
                                   <td ><?php //echo $t_vist_sun?></td>
                                   <td ><?php //echo $total_vsted?></td>
                                 </tr>
                                 <tr >
                                   									<td >%</td>
                                   <td><?php // if($texp_mon>0)echo number_format($t_vist_mon*100/$texp_mon,1).'%'?></td>
                                   <td><?php //if($texp_tue>0)echo number_format($t_vist_tue*100/$texp_tue,1).'%'?></td>
                                   <td><?php //if($texp_wed>0)echo number_format($t_vist_wed*100/$texp_wed,1).'%'?></td>
                                   <td><?php //if($texp_thu>0)echo number_format($t_vist_thu*100/$texp_thu,1).'%'?></td>
                                   <td><?php //if($texp_fri>0)echo number_format($t_vist_fri*100/$texp_fri,2).'%'?></td>
                                   <td><?php //if($texp_sat>0)echo number_format($t_vist_sat*100/$texp_sat,1).'%'?></td>
                                   <td><?php //if($texp_sun>0)echo number_format($t_vist_sun*100/$texp_sun,1).'%'?></td>
                                   <td><?php //if($total_exp>0)echo number_format($total_vsted*100/$total_exp,1).'%'?></td>
                                 </tr>
                              </tbody>
                               
                          </table>
                    </section>
 
                         
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
