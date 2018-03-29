<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $title=""; $id=0;  $distributor_id=0;
	$cluster_id=0;	$area_id=0;  $region_id=0; $mode=$_REQUEST['mode'];
	if($mode=='region'){ $id=$region_id=$_REQUEST['region_id']; $where= " region_id=$region_id ";$title=region_name($region_id);}//region
		else if($mode=='area'){ $id=$area_id=$_REQUEST['area_id']; $where= " area_id=$area_id ";$title=area_name($area_id);}//area
		else if($mode=='cluster'){ $id=$area_id=$_REQUEST['cluster_id']; $where= " cluster_id=$cluster_id ";$title=sub_area_name($cluster_id);}///cluster
		
	else if(isset($_REQUEST['distributor_id'])) {$id=$distributor_id= $_REQUEST['distributor_id']; $where= " distributor_id=$distributor_id "; $title=distributor_name($distributor_id);}  else goback(); ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	  var mode="<?php echo $mode?>";
		  var id="<?php echo $id?>";
      $(document).ready(function(e) {

		  var url="analyze_outlets.php?demarcation_mode=routes_stats&id="+id+"&mode="+mode;
	$("#routes_list").load(url);
	
	$('#filtersForm').change(function(){
		//var filters= $('.filtersForm').serialize();
		get_filteredAjaxData(getfilterOptions()+"&id="+id+"&mode="+mode,getfilterOptions(),"#routes_list","routes_stats");
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
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                         <?php 
					 include('submenu.php');?>
                         <h3 class="float_left"><?php echo $title?> Routes</h3>
                      </div>
                      
                     <p  ><table ><tr><td></td><td>&nbsp;</td><td>&nbsp;</td><td><?php include('add_route.php');?> <a data-toggle="modal" class="btn btn-success btn-sm" href="#addRouteModal">Add Route</a></td></tr></table> <?php include "filter_form.php";?></p>
                     
                     <!--start -->           
                   <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th >No</th>
                                 <th > Route Name</th>
                                  <th >Contribution</th> <th > Distributor</th>
                                    <th >Sub Area</th>
                                            <th >Area</th>
                                            <th >Region</th>
                                    <th >Outlets</th>
                                  <th >Verfied Outlets</th>
                                <th >Action</th>
                              </tr>
                              </thead>
                              <tbody id="routes_list">
                             <tr><td colspan="9">Loading <img src="images/37.gif"></td></tr>
                               </tbody>
                          </table>
                          </section>
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                
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
  
	
	
	


    
  </body>
</html>
