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
		 // fetch_clients();
	//assign_salesperson();
  
        
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
                        <?php include('submenu.php'); $date=date('Y'); ?>
                         <h3 class="float_left">Added Outlets</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr>
                       <td width="150"> Select Year</td>
                       <td width="188"> <select  class="form-control" id="date" name="date"><?php echo years_in_orders()?></select></td>
                       <td width="177"><button class="btn btn-small btn-success" type="submit" name="submit" >Fetch Info</button></td>
                       <td width="114">&nbsp;</td></tr></table></form> </div>
                     <!--start -->      <div>Outlets added in the year <b>  <?php echo date('Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                   
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Region</th>
                                  <th>TT</th>
                                  <th>Mapped</th>
                                  <th>Jan</th>
                                  <th >Feb</th>
                                  <th>Mar</th>
                                  <th>Apr</th>
                                  <th>May</th>
                                  <th>Jun</th>
                                   <th>Jul</th>
                                   <th>Aug </th>
                                  <th>Sep</th>
                                  <th>Oct</th>
                                  <th>Nov</th>
                                  <th>Dec</th>
                              </tr>
                              
                           
                              <tbody>
                            
                            <?php 
							update_dealers();
							$i=1;
							 $query=mysqli_query($mysqli,"SELECT region_name name,region_id FROM `tbl_regions` WHERE `status`=0")or die(mysqli_error($mysqli));
							while($row=mysqli_fetch_array($query)){
								$name=$row['name'];
								$region_id=$row['region_id'];
							
							 
							 ?>								<tr>
                                <td><?php echo $i?></td>
                                <td><?php echo region_name($region_id) ?></td>
                                <td><?php echo num_outlets($region_id) ?></td>
                                  <td><?php echo num_outlets_gps($region_id) ?></td>
                               <?php for($m=0;$m<12;$m++){?>  <td><?php $when=0; if($m<10)$when=$date.'0'.$m+1; else $when=$date.$m+1; echo num_registered_monthly($when,$region_id)?></td><?php }?>
                               
                               
                              </tr><?php $i++;	}?>
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
    <script src="assets/js/bootstrap.min.js"></script>
	
	
	
	
 
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
