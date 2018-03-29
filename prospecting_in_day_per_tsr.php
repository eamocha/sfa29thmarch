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
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		
        
 //load select boxes
 		load_users();
		
		 });
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=$_REQUEST['day']; $tsr=$_REQUEST['user'] ?>
                         <h3 class="float_left">Newly added outlets</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{ 
    $date = $_REQUEST['date'];
	$tsr=$_REQUEST['tsr'];
	if($tsr=='') $tsr=$_REQUEST['user'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>From </td><td> <input type="text" value="<?php echo $date?>" class="form-control dpd1" name="date"></td><td>TSR</td><td><select  class="form-control sales_person_selection" name="tsr" id="sales_person_selection"><option value="<?php echo $tsr?>"><?php echo get_name($tsr)?></option></select></td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div>
                     <!--start -->      <div>Outlets added on <b>  <?php echo date('D dS, M Y', strtotime($date));?>  by <?php echo get_name($tsr)?></b></div>     
                   <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Outlet</th>
                                  <th> Channel</th>
                                  <th >Coords</th>
                                  <th>Contacts</th>
                                    <th>Tusker Malt</th>
                                      <th>Tusker Lite</th>
                                        <th>Heineken</th>
                                                     </tr>
                              </thead>
                              <tbody>
                             <?php $i=1;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE DATE(`reg_date`)='$date' and status=1 and prospecting=1 and `added_by`=$tsr")or die(mysqli_error($mysqli));if(mysqli_num_rows($q)==0){?> <tr><td colspan="6">No details for <?php echo get_name($tsr);?> on <?php echo  $date?></td>
                               </tr>
                             <?php } else
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								
								
								//$cooler=survey_history($r["has_cooler"]);
								//$lp=survey_history($r["has_light_pannels"]);
								//$neon_sign=survey_history($r["neon_sign"]);
								$type_of_outlet=$r["type_of_outlet"];
								$longtitute=$r["longtitute"];
								$latitute=$r["latitute"];
								$channel=channel_type($r["channel"]);
									$phone=$r["phone"];
										$reg_by=$r["added_by"];
											$reg_date=$r["reg_date"];
								
							
                               ?>
                                
                                 <tr> <td><?php echo $i;  ?></td>
                                  <td ><?php echo business_name($did);?></td><td><?php	 echo $channel   ?></td>
                                  <td><?php $coods	; if($latitute!=0 and $longtitute!=0)  $coods=0 ;else $coods=1; echo survey_history($coods);?></td> <td><?php echo $phone?></td><td><?php	 echo prospect_prices($did,1)?></td>
                                   <td><?php	 echo prospect_prices($did,2) ?></td>
                                  <td ><?php	 echo prospect_prices($did,3) ?></td></tr>
                           
                             <?php $i++; }?>
                                </tbody>
                               
                          </table>
                          </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/bootstrap.min.js"></script>

    <!--script for this page-->
	
	
	
	 	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
 




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
