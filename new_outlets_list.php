<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; 
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		//  fetch_clients();
	//assign_salesperson();
  
        
 //load select boxes
 		load_users();
		
		 });
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
 </script>

   <script type="text/javascript">  //delete data outlets
  $(document).ready(function(){
	  $('#delete').click(function(){
		  delete_outlets_in_array();
		  
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
                      <?php include('submenu.php'); $date=date('Y'); ?>
                         <h3 class="float_left">List of new outlets per Month </h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['year'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr>
                       <td width="123"> Select Year</td>
                       <td width="105"><select  class="form-control" id="year" name="year"><?php echo years_in_orders()?></select></td>
                       <td width="167"><button class="btn btn-small btn-success" type="submit" name="submit" >Fetch Info</button></td>
                       <td width="106">&nbsp;</td></tr></table></form> </div>
                     <!--start -->      <div> For month <b>  <?php echo date('Y M', strtotime($date));?></b></div>     
                   <section id="unseen">
            
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Outlet Name</th>
                                  
                                  <th >Channel</th>
                                  <th>Coords</th>
                                  <th>Contacts</th>
                                  <th>Reg By</th>
                                  <th>Reg Date</th>
                                   <th>Visits</th>
                                   <th>Neon</th>
                                  <th>Cooler</th>
                                  <th>L.Pannels</th>
                                  <th><input type="button" id="delete" value="delete"></th>
                                  
                              </tr></thead>   <tbody ><?php $i=1; $yearmonth=clean($_REQUEST['year_month']); $region_id=clean($_REQUEST['region_id']); 
							 $query=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE EXTRACT(YEAR_MONTH FROM `reg_date` )='$yearmonth' and status=0 and `region_id`=$region_id order by business_name")or die(mysqli_error($mysqli));
							while($row=mysqli_fetch_array($query)){
								$dealer_id=$row['dealer_id'];
								$region_id=$row['region_id']; $channel=$row['channel']; $coords='N/A'; if($row['latitute']!=0)$coords='Valid'; $phone=$row['phone']; $reg_by=$row['added_by']; $reg_date=$row['reg_date']; 
								$cooler=survey_history($row["has_cooler"]);
								$lp=survey_history($row["has_light_pannels"]);
								$neon_sign=survey_history($row["neon_sign"]);?>
							
                              <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo business_name($dealer_id)?></td>
                                <td><?php echo channel_type($channel)?></td>
                                <td><?php echo $coords?></td>
                                <td><?php echo $phone?></td>
                                 <td><?php echo get_name($reg_by)?></td>
                                 <td><?php echo record_date($reg_date)?></td>
                                 <td><?php echo times_visited($dealer_id)?></td>
                                <td><?php   echo $neon_sign;?></td>
                                <td><?php echo $cooler?></td>
                                <td><?php echo $lp?></td>
                                <td><?php echo '<input type="checkbox" class="checkbox" value="'.$dealer_id.'" name="list[]">';?></td>
                              </tr> <?php $i++; }?>
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
      </section>>
     <?php include('footer.php');?>
      <!--footer end-->
  </section>
    <script src="assets/js/bootstrap.min.js"></script>
 
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  

  </body>
</html>
