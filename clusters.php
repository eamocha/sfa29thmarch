<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';   $user_id=$_SESSION['u_id']; $title=""; $area_id=0;  $region_id=0; $mode=$_REQUEST['mode']; $id=0;
	
	if($mode=='region'){ $region_id=$_REQUEST['region_id']; $id=$region_id; $where= " region_id=$region_id "; $title=region_name($region_id);
	}
		else if($mode=='area'){ $area_id=$_REQUEST['area_id']; $id=$area_id; $where= "area_id=$area_id "; $title=area_name($area_id);}
  include "export.html";
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
  	
		  var mode="<?php echo $mode?>";
		  var id="<?php echo $id?>";
      $(document).ready(function(e) {

		  var url="analyze_outlets.php?demarcation_mode=sub_areas_stats&id="+id+"&mode="+mode;
	$("#sub_areas_list").load(url);
	
	 $('#filtersForm').change(function(){
		//var filters= $('.filtersForm').serialize();
		get_filteredAjaxData(getfilterOptions()+"&id="+id+"&mode="+mode,getfilterOptions(),"#sub_areas_list","sub_areas_stats");
		});
        
 //load select boxes
 		load_users();
		
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
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                        <h3 class="float_left"><?php echo $title?>  Sub Areas <?php include 'common_export_icons.php'?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left"><a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add Sub Area</a>     <?php include "filter_form.php";?>
                      
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <div id="title"></div>
                   <table id="content_table" width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Sub Area Name</th>
                                 <th>AD clusters</th>
                                  <th>Distributors</th>
                                  <th>Routes</th>
                                          <th>All Outlets</th> <th>Verified Outlets</th>
                                <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody id="sub_areas_list">
                             
                               <tr><td colspan="9">Loading <img src="images/37.gif"></td></tr>
                              </tbody>
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include 'add_cluster.php';?>
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
