<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $user_status=0;
	if(isset($_REQUEST['user_status']) && $_REQUEST['user_status']==1){$user_status=1;}
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		  $("#user_rolesbtn").click(function(){
			  $("#users_table").toggle();
			  });
		
   fetch_users(<?php echo $user_status?>,-1,-1,-1,-1,-1)
        fetch_user_roles();
 //load select boxes
 	//	load_users();//the select box to check for day
		///on changing region or any area group
		  $(".filters").change(function(){
			var what=$(this).attr("id");// get the filter selected
			var region=$("#region").val();
			var area=$("#area").val();
			var todayLoin=$("#todayLoin").val();
			var role_filter=$("#role_filter").val();
			var order_by=$("#order_by").val();
			  
			  //var cluster=$("#cluster").val();		
			//   var distr=$("#distributor").val();
			  switch(what){
				  case "region":    	load_area_dropDown(region);  
				  case "area":  		//load_clusters_dropDown(area);
				//  case "cluster":  	  	load_distributors_dropDown(cluster);
				  //case "distributor": 	load_routes_dropDown(distr);  fetch_users("route");
				  default: -1;
				  }
				  	 
		   fetch_users(<?php echo $user_status?>,region,area,todayLoin,role_filter,order_by);
			  });
		 });
  		  
		  //,get regions
		  load_all_regions_to_select_box();
		  
		
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
                         <h3 class="float_left">Users list</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                 <?php if($_SESSION['user_role']==4){?>  <button class="btn btn-success btn-sm"  data-toggle="collapse" data-target="#roles" id="user_rolesbtn" name="user_rolesbtn" >User Roles</button><?php }?>  <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add users</a>
                    <select name="region" class="filters" id="region"><option value="-1">Select Region</option></select> | <select class="filters" name="area" id="area" ><option value="-1">Select Area</option></select> | <select class="filters" id="role_filter" name="role_filter"><option value="-1">Select Role</option><?php echo roles_selection()?></select> | <select class="filters" name="todayLoin" id="todayLoin"> <option value="-1"> Any LogIn </option><option value="notlogged">Not LoggedIn Today</option><option value="logged">LoggedIn Today</option></select> | <select class="filters" name="order_by" id="order_by"><option value="-1">Order by</option> <option value="region_id">Region</option><option value="area_id">Area</option><option value="logins">last login</option><option value="role">role</option><option value="full_name">Name</option><option value="appVersion">AppVersion</option></select>
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <!--- hid this part----->
                            <div id="roles" class="collapse">
                             <a data-toggle="modal" class="btn btn-success btn-sm" href="#add_user_role">  Add Role</a>
<table id="user_roles_table" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th> <th>Role Name</th>  <th >assignees</th><?php $q=mysqli_query($mysqli,"SELECT region_name FROM tbl_regions WHERE status=0") or die(mysqli_error($mysqli)); while($row=mysqli_fetch_array($q)){  ?><th ><?php echo $row['region_name']?></th><?php }?>
                                 <th >Actions</th></tr>
                              </thead>
                              <tbody id="user_roles">
                              </tbody>
                          </table>
</div><!----eb=nd roles --->
                           <table id="users_table" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th> <th>Full Name</th>  <th >Email</th><th >Tel</th><th >Role</th>
                                  <th >Region</th><th >Area</th><th >Last Log</th> <th >AppVer</th><th >Actions</th></tr>
                              </thead>
                              <tbody id="users_list">
                              
                              </tbody>
                          </table>
                          
                           
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include "add_user.php"; include "add_role.php";?>
		          <!-- modal -->
              
               
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include("footer.php");?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->

  
    <script src="assets/js/bootstrap.min.js"></script>
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   
	

	


    
  </body>
</html>
