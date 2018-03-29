<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $title="";  $distributor_id=0;
	$cluster_id=0;	$area_id=0;  $region_id=0; $mode=$_REQUEST['mode'];
	if($mode=='region'){ $region_id=$_REQUEST['region_id']; $where= " region_id=$region_id ";$title=region_name($region_id);}//region
		else if($mode=='area'){ $area_id=$_REQUEST['area_id']; $where= " area_id=$area_id ";$title=area_name($area_id);}//area
		else if($mode=='cluster'){ $cluster_id=$_REQUEST['cluster_id']; $where= " cluster_id=$cluster_id ";$title=sub_area_name($cluster_id);}///cluster
		
	else if(isset($_REQUEST['distributor_id'])) {$distributor_id= $_REQUEST['distributor_id']; $where= " distributor_id=$distributor_id "; $title=distributor_name($distributor_id);} else goback();  ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     
       <!-- end pdf export-->  <?php include "export.html";?>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {     
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
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                         <?php 
					 include('submenu.php');?>
                         <h3 class="float_left"><?php echo $title?> Routes
                         <?php include 'common_export_icons.php'?></h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left"><table ><tr><td></td><td>&nbsp;</td><td>&nbsp;</td><td><?php include('add_route.php');?> <a data-toggle="modal" class="btn btn-success btn-sm" href="#routeModal">Add Route</a></td></tr></table> </div>
                     <!--start -->           
                   <section id="unseen">
                            <table id="content_table" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th width="">No</th>
                                  <th width=""> Route Name</th>
                                    <th width=""> Contributions</th>
                                   <th width=""> Area Name</th>
                                    <th width=""> Sub Area Name</th>
                                  <th width=""> Distributor</th>
                                    <th width="" >Day of week</th>
                                    <th width="" title="number of dealers in this route">Outlets</th>
                                  <th width="" >Target (Cases)</th>
                                <th width="">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                             <?php $i=1; 
							 
							 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE ".$where." and status=0 ORDER BY distributor_id")or die(mysqli_error($mysqli));
							 if(mysqli_num_rows($q)==0){echo  "<tr><td colspan='6'>Empty list</td></tr>";}
							 else{
							while($r=mysqli_fetch_array($q)){?> <tr>
                                  <td><?php echo $i?></td>
                                  <td><?php echo $r['route_name'];?></td>
                                  <td><?php echo $r['route_contribution']*100;?></td>
                                   <td><?php echo area_name($r['area_id']);?></td>
                                  <td><?php echo sub_area_name($r['cluster_id']);?></td>
                                  <td><?php echo distributor_name($r['distributor_id']);?></td>
                                  <td><?php echo $r['day'];?></td>
                                  <td><a href="region_outlets.php?mode=route&route_id=<?php echo $r['route_id'];?>"><?php echo total_outlets_in_route($r['route_id']);?></a></td>
                                  
                                  <td></td>
                                   <td > <a href="edit_route.php?mode=route&id=<?php echo $r['route_id'];?>"> Edit</a> | <a href="route_map.php?route_id=<?php echo $r['route_id']?>">Map</a> | <a href="setRoute_targets.php?route_id=<?php echo $r['route_id']?>">Set targets</a> | <a href="assign_outlets_to_routes.php?region=<?php echo $r['region_id']?>&rid=<?php echo $r['route_id'];?>">Assign</a> | <a href="migrate.php?mode=route&id=<?php echo $r['route_id'];?>">Delete</a> </td>
                              </tr><?php  $i++;}
							 }?>
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

    <script src="assets/js/bootstrap.min.js"></script>
    


	 <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  
	
	
	


    
  </body>
</html>
