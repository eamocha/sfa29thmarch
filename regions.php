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
  

 
   
     <?php include "export.html";?>
  <script type="text/javascript" >
      $(document).ready(function(e) {
		  
		var url="analyze_outlets.php?demarcation_mode=regions_stats";
	$("#regions_list").load(url);
	//////////////////////
	$('#filtersForm').change(function(){
		//var filters= $('.filtersForm').serialize();
		get_filteredAjaxData(getfilterOptions(),getfilterOptions(),"#regions_list","regions_stats");
		});
	////////////
         //load select boxes
 		load_users();
		
		
		
		 });
 
 
 
 ///////////////////

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
                         <h3 class="float_left">Regions  <?php include 'common_export_icons.php'?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                 <a href="graph_region_outlets.php" class="btn btn-default">Graph </a> |<a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add Region</a> 
                 <hr>
                 <?php include "filter_form.php";?>
				    </div>
                     <!--start -->           
                   <section id="unseen"><div id="title" ></div>
                   <table id="content_table" width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th rowspan="2">NO</th>
                                  <th rowspan="2">Region Name</th>
                                  <th colspan="2">Areas</th>
                                  <th colspan="2" >Sub Areas</th>
                                  <th colspan="2" >AD clusters</th>                                  
                                  <th colspan="2">Distributors</th>
                                  <td colspan="2"><strong>Routes</strong></td>
                                  <th colspan="2">Outlets</th>
                                   <th rowspan="2">Actions</th>
                              </tr>
                              <tr>
                                <th>All</th>
                                <th>Done</th>
                                <th >All</th>
                                <th >Done</th>
                                <th >All</th>
                                <th >Done</th>
                                <th>All</th>
                                <th>Done</th>
                                <td>All</td>
                                <td>Done</td>
                                <th>All</th>
                                <th>Conf.</th>
                              </tr>
                              </thead>
                              <tbody id="regions_list" class="regions_list">
                           <tr><td colspan="15">Loading <img src="images/37.gif"></td></tr>
                              </tbody>
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include_once 'add_region.php';///include_once 'area_form.php';include_once 'cluster_form.php';include_once 'distributor_form.php'; include_once 'route_form.php';?>
		          <!-- modal -->
                  
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
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
 

     
     
    

    
  </body>
</html>
