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
		//delete outlets
		 
		  $('#delete').click(function(){
		  delete_outlets_in_array();
		   });//end dellete outlets
		
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
                      <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                        <h3 class="float_left">Prospecting outlets </h3><a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal">Add Outlet</a> <?php include 'prospecting_form.php';?>
                      </div>
                          
                   <section id="unseen">
                   <?php $results=$mysqli->query("SELECT count(*) as t_records FROM `tbl_dealers` where status=1 and prospecting=1")or die('error');
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); ?><script type="text/javascript">
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var total=<?php echo $total_records->t_records?>;
	var pergroup=<?php echo $items_per_group=100?>;
	var dt=<?php echo strtotime($date)?>;
	loading_data('#results',"data.php?dt="+dt+'&mode=prospectus',track_load,loading,total_groups,total,pergroup);
		});
</script>
                           
                             <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Prospecting</th>
                                  <th>Region</th>
                                  <th>Channel</th>
                                  <th>Coords</th>
                                  <th>Contacts</th>
                                  <th>Reg Date</th>
                                   <th>Visits</th>
                                   <th>Tusker Malt</th>
                                  <th>Tusker Lite</th>
                                  <th>Heineken</th>
                                  <th><input type="button" id="delete" value="Del"></th>
                              </tr>
                              </thead>
                              <tbody id="results">
                              
                            </tbody>
                               
                          </table>
                    <div class="animation_image" style="display:none" align="center"><img src="images/37.gif">loading...</div>


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
