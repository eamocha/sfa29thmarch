<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $id=clean($_REQUEST['id']);
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
                  <div class="col-lg-9 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Route Update</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                                  
						 </div>
                     <!--start -->           
                   <section id="unseen">
                  
											       
                 <?php $q=mysqli_query($mysqli,"SELECT `route_id`, `route_name`, `details`, `distributor_id`, `cluster_id`, `area_id`, `region_id` FROM `tbl_routes` WHERE route_id=".$id) or die(mysqli_error($mysqli));
$row = mysqli_fetch_array($q);
$route_id =$row['route_id'];
$route_name = $row['route_name'];
$details = $row['details'];
$region_id = $row['region_id'];
$area_id =$row['area_id'];$sub_area_id =$row['cluster_id'];$distributor_id =$row['distributor_id'];

	?> <form name="edit_route" id="edit_user"  action="read.php?mode=edit_route&id=<?php echo $id?>" method="post">
                               <table ><tr><td>Name</td><td><input type="text" class=" form-control" id="route_name" value="<?php echo  $route_name?>"name="route_name"/></td><td>Details</td><td><input type="text" class=" form-control" id="details" name="details" value="<?php echo  $details?>"></td>
                                 <td>Region</td>
                                 <td><select class="form-control filters"  id="region" name="region_id">
                                   <option value="<?php echo $region_id?>"><?php echo get_region_no_link($region_id)?></option>
                                   <?php echo region_selection();?>
                                 </select></td></tr><tr>
                                 <td>Area</td>
                                 <td><select  class="form-control filters" id="area" name="area_id">
                                   <option value="<?php echo $area_id?>"><?php echo get_area($area_id)?></option>
                                 
                                 </select></td>
                              
                                 <td>Sub Area</td>
                                 <td><select class=" form-control filters"  id="cluster" name="cluster_id">
                                   <option value="<?php echo $sub_area_id?>">
                                     <?php echo sub_area_name($sub_area_id)?>
                                   </option>
                                  
                                 </select></td>
                                 <td>Distributor</td>
                                 <td><select type="text"  class="form-control filters" name="distributor_id" id="distributor">
                                   <option value="<?php echo $distributor_id?>">
                                     <?php echo distributor_name($distributor_id)?>
                                   </option>
                                 
                                 </select></td>
                                
                               </tr>
                              
                               </table>
                              <div class="modal-footer">
						      
						        <button  type="submit" class="btn btn-primary">Save</button>
						      </div></form>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    
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
