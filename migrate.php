<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $mode=clean($_REQUEST['mode']); $where=""; $id=clean($_REQUEST['id']);
	if($mode=="distributor"){  $area_id=getColumnName('tbl_distributors','area_id', 'distributor_id='.$id); $where="area_id=$area_id"; 	}
		if($mode=="route"){  $area_id=getColumnName('tbl_routes','area_id', 'route_id='.$id); $where="area_id=$area_id"; 	}
	
	else if($mode=="area"){  $region_id=getColumnName('tbl_areas','region_id', 'area_id='.$id); $where="region_id=$region_id"; 
		}
		else if($mode=="subArea"){  $area_id=getColumnName('tbl_clusters','area_id', 'cluster_id='.$id); $where="area_id=$area_id"; 
		}
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		 
	load_users();//the select box to check for day
		 ///////////
		   $(".filters").change(function(){
			  var what=$(this).attr("id");// get the filter selected
			  var region=$("#region").val();
			  var area=$("#area").val();
			  var cluster=$("#cluster").val();		
			   var distr=$("#distributor").val();
			  switch(what){
				  case "region":    	load_area_dropDown(region); 
				  case "area":  		load_clusters_dropDown(area);
				  case "cluster":  	  	load_distributors_dropDown(cluster);
				  case "distributor": 	load_routes_dropDown(distr); 
				  default: return;
				  }
		  
			  });
		
		 });
  		  
		  //,get regions
		
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
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left"><?php echo $mode ?> Details</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                                  Kindly before <span style=" text-decoration:line-through"> deleting this <?php echo $mode?>,</span> choose where to migrate the data (Routes, outlets,assets,staff etc) in it to . This will ensure that we do not loose important corrected data. <span style="color:red; text-decoration:underline">Please note that this is a delicate activity that requires your full attenton sisnce it is not reversable</span></div>
                     <!--start -->           
                   <section id="unseen">
                  <?php if($mode=="distributor"){?>
					<table class="table table table-bordered table-striped table-condensed">
                     <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Distributor</th>
                                        <th>Sub Area</th>
                                              <th>Area</th>
                                                    <th>Region</th>
                                                    
                                  <th>Routes</th>
                                  <th >Outlets</th>
                                
                                  <th>Owner</th>
                                  <th>Contact</th>
                                    <th>Class</th>
                                  <th>Channel</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
						       
                 <?php  $i=1;$res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE $where and distributor_id!=$id and status=0 order by distributor_name ") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { 
	$d_id=$row['distributor_id'];
	?><tr><td><?php echo $i?></td><td><a href="distributor_profile.php?mode=distributor&distributor_id=<?php echo $d_id; ?>"><?php echo $row['distributor_name'] ?></a></td><td><?php echo sub_area_name($row['cluster_id'])?></td><td><?php echo area_name($row['area_id'])?></td><td><?php echo region_name($row['region_id'])?></td><td><a  href="view_route.php?mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_routes'," distributor_id=".$d_id) ?></a></td>
    <td><a href="region_outlets.php?mode=distributor&distributor_id=<?php echo $d_id?>"><?php echo num_rows('tbl_dealers'," status=0 and cluster_id>0 and route_id>0 and  distributor_id=$d_id ".regions_filters_condition()) ?></a></td><td><?php echo $row['owner'] ?></td><td><?php echo $row['contact'] ?></td><td><?php echo $row['distributor_class'];?></td><td><?php echo $row['distributor_channel'];?></td>
    <td><a href="read.php?mode=delete_distributor&dist_to_delete=<?php echo $id?>&move_to=<?php echo $d_id?>">Move its content here</a> </td></tr>
<?php }?>
                             </table>
                             <?php }///ended the distrubutor part
							 else if($mode=="subArea"){
								 ?> <table width="100%"  class="table table-bordered table-striped table-condensed"><thead><tr><th>#</th><th>Sub Area Name</th><th>AD clusters</th><th>Distributors</th><th>Routes</th><th>Outlets</th><th>Actions</th></tr></thead><?php
							$i=1;  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_clusters` WHERE $where and cluster_id!=$id and status=0 order by cluster_name") or die(mysqli_error($mysqli));
	while ($row = mysqli_fetch_array($res)) { 
	$region_id=$row['region_id']; $cluster=$row['cluster_id'];$area=$row['area_id'];
	
	?><tr><td><?php echo $i?></td><td><?php echo sub_area_name($row['cluster_id']) ?></td><td><a href="AD_clusters.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_ad_clusters","sub_area_id=".$cluster) ?></a></td> <td><a href="distributors.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_distributors","status=0 and cluster_id=".$cluster) ?></a></td>
                                <td><a href="view_routes.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_routes","status=0 and cluster_id=".$cluster) ?></a></td>
                               <td><a href="region_outlets.php?mode=cluster&cluster_id=<?php echo $cluster?>"><?php echo num_rows("tbl_dealers","status=0 and cluster_id=$cluster ".regions_filters_condition()) ?></a></td>
                                <td><a href="read.php?mode=delete_sub_area&subArea_to_delete=<?php echo $id?>&move_to=<?php echo $cluster?>">Move its content here</a>
                               </td>
                              </tr>                           
                             <?php $i++; }
							 }///ended the sub areas part
                              else if($mode=="area"){
								  ?><table class="table table table-bordered table-striped table-condensed">
                 
					   <thead> <tr><th>#</th> <th>Area Name</th> <th >Sub areas</th> <th>Distributors</th>    <th>Routes</th>  <th>Outlets</th> <th>Actions</th> </tr> </thead><?php
								    $i=1;
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE $where and area_id!=$id and status=0 order by area_name") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $area_id=$row['area_id'];
	?><tr><td><?php echo $i?></td><td><?php echo get_area($area_id) ?></td><td><a href="clusters.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_clusters","status=0 and area_id=".$area_id)?></a></td><td><a  href="distributors.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_distributors"," status=0 and area_id=".$area_id) ?></a></td>
    <td><a href="view_routes.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_routes"," status=0 and area_id=".$area_id)  ?></a></td><td><a href="region_outlets.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_dealers","status=0 and cluster_id>0 and area_id=$area_id ".regions_filters_condition())?></a></td><td><a href="read.php?mode=delete_area&area_to_delete=<?php echo $id?>&move_to=<?php echo $area_id?>">Move its content here</a> </td></tr>
	<?php $i++; }?></table><?php 
	 }///ended the sub areas part
							  else if($mode=="route"){?>
							   <table class="table table-bordered table-striped table-condensed"><thead><tr><th >No</th><th > Route Name</th><th > Distributor</th><th >Sub Area</th><th >Area</th><th >Region</th><th >Outlets</th><th >Target (Cases)</th><th >Action</th></tr></thead><?php
								  $i=1;
                               $q=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE route_id!=$id and ".$where)or die(mysqli_error($mysqli));
							 if(mysqli_num_rows($q)==0){echo  "<tr><td colspan='6'>Empty list</td></tr>";}
							 else{
							while($r=mysqli_fetch_array($q)){
								$route_id=$r['route_id'];?> <tr>
                                  <td><?php echo $i?></td>
                                  <td><?php echo $r['route_name'];?></td>
                                       
                                                  <td><?php echo distributor_name($r['distributor_id']);?></td>
                                                          <td><?php echo sub_area_name($r['cluster_id']);?></td>
                                  <td><?php echo area_name($r['area_id']);?></td>
                                  <td><?php echo region_name($r['region_id']);?></td>
                                  <td>
                                  <a href="view_route_details.php?region=<?php echo $r['region_id']?>&rid=<?php echo $route_id?>"><?php echo num_rows('tbl_dealers'," status=0 and cluster_id>0 and route_id=$route_id ".regions_filters_condition());?></a>
                                  </td>
                                  
                                  <td><a href="view_route_details.php?region=<?php echo $r['region_id']?>&rid=<?php echo $r['route_id'];?>"><?php echo total_outlets_in_route($r['route_id']);?></a></td>
                                   
                                   
                                   
                                   <td ><a href="read.php?mode=delete_route&route_to_delete=<?php echo $id?>&move_to=<?php echo $route_id?>">Move its content here</a> </td>
                              </tr><?php  $i++;}?></table><?php
							 }                        
                            }///ended the sub areas part?>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    
		          <!-- modal -->
                  
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
    	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
