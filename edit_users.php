<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $uid=clean($_REQUEST['uid']);
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
                         <h3 class="float_left">Users Details</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                                  
						 </div>
                     <!--start -->           
                   <section id="unseen">
                  
					
						       
                 <?php $q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE user_id=".$uid) or die(mysqli_error($mysqli));
$row = mysqli_fetch_array($q);
$u_Id =$row['user_id'];
$name = $row['full_name'];
$email = $row['email'];
$emp_id = $row['emp_id'];
$mobile = $row['mobile'];
$gender = $row['gender'];
$region_id = $row['region_id'];

$status = $row['status'];$role =$row['role']; $area_id =$row['area_id'];$sub_area_id =$row['cluster_id'];$distributor_id =$row['distributor_id'];
$pass=md5($row['password']);
	?> <form name="edit_user" id="edit_user"  action="read.php?mode=edit_user&uid=<?php echo $uid?>" method="post">
                               <table id="add_users"  style="margin:auto;"><tr><td>Name</td><td><input type="text" class=" form-control" id="full_name" value="<?php echo  $name?>"name="full_name"/></td><td>Email</td><td><input type="email" class=" form-control" id="email" name="email" value="<?php echo  $email?>"></td><td> Phone No</td><td><input type="tel" value="<?php echo $mobile;?>"class="form-control"  id="tel" name="tel"></td></tr>
                               <tr>
                                 <td>Role</td>
                                 <td><select class=" form-control"  id="role" name="role"><option value="<?php echo $role?>"><?php echo get_role($role)?> </option>
                                   <?php echo roles_selection_boundary($_SESSION['user_role'])?>
                                 </select></td>
                                 <td>Region</td>
                                 <td><select class="form-control filters"  id="region" name="region_id">
                                   <option value="<?php echo $region_id?>"><?php echo get_region_no_link($region_id)?></option>
                                   <?php echo region_selection();?>
                                 </select></td>
                                 <td>Area</td>
                                 <td><select  class="form-control filters" id="area" name="area_id">
                                   <option value="<?php echo $area_id?>"><?php echo get_area($area_id)?></option>
                                 
                                 </select></td>
                                 </tr>
                               <tr>
                                 <td>Sub Area</td>
                                 <td><select class=" form-control filters"  id="cluster" name="cluster_id">
                                   <option value="<?php echo $sub_area_id?>">
                                     <?php echo sub_area_name($sub_area_id)?>
                                   </option>
                                  
                                 </select></td>
                                 <td>Distributor</td>
                                 <td><select type="text"  class="form-control filters" name="distributor" id="distributor">
                                   <option value="<?php echo $distributor_id?>">
                                     <?php echo distributor_name($distributor_id)?>
                                   </option>
                                 
                                 </select></td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                               </tr>
                               <tr>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                               </tr>
                               </table>
                              <div class="modal-footer">
						        <a  href="users.php" class="btn btn-default"  >Close</a>
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
