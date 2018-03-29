<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $id=0;  $title=""; $cluster=0; $area_id=0;  $region_id=0; $mode=$_REQUEST['mode']; $where=" 1 ";
	if($mode=='region'){ $id=$region_id=$_REQUEST['region_id']; $where= " region_id=$region_id "; $title=region_name($region_id);}
		else if($mode=='area'){$id=$area_id=$_REQUEST['area_id']; $where= " area_id=$area_id "; $title=area_name($area_id);}
		else if($mode=='cluster'){ $id=$cluster=$_REQUEST['cluster_id']; $where= " sub_area_id=$cluster"; $title=sub_area_name($cluster);}
		
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
     var mode="<?php echo $mode?>";
		  var id="<?php echo $id?>";
      $(document).ready(function(e) {

	var url="analyze_outlets.php?demarcation_mode=ad_clusters_stats&id="+id+"&mode="+mode;
	$("#ad_clusters_list").load(url);
	
	 $('select').change(function(){
		//var filters= $('.filtersForm').serialize();
		get_filteredAjaxData(getfilterOptions()+"&id="+id+"&mode="+mode,getfilterOptions(),"#ad_clusters_list","ad_clusters_stats");
		});
          
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
                        <?php  include('submenu.php'); $date=date('Y-m-d'); ?>
                        <h3 class="float_left"><?php echo $title?> AD clusters</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left"><a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add AD Cluster</a> <?php include "filter_form.php";?>
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Sub Area</th>
                                  <th>Area</th>
                                  <th>Region</th>
                                  <th>Routes</th>
                                  <th>Outlets</th>
                                  <th>Assigned To</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody id="ad_clusters_list">
                            
                           <tr><td colspan="9">   <img src="images/37.gif"></td></tr>
                              </tbody>
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include 'add_ADcluster.php';?>
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

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
