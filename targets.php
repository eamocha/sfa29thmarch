<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $role=$_SESSION['user_role'];
	 $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];
	$total=0;if($role==2){ $total=get_sum_of_region_targets($myregion,1);} else
	if($role==3){ $total=get_sum_of_area_targets($myArea,1);}
		  include "export.html";
		  //labels
		  $this_year=date('Y');
		   $two_ms_ago=date('M', strtotime(date('Y-m')." -2 month")); $last_m=date('M', strtotime(date('Y-m')." -1 month")); $this_m=date('M'); $mnth=date('m');$p1=date(date("m", strtotime("-1 months")));$p2=date("m", strtotime("-2 months"));
		   
		    ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		 // fetch_clients();
   fetch_targets("");///all users in the system
        
 //load select boxes
 		load_users();//the select box to check for day
		///on changing region or any area group
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
				  case "distributor": 	load_routes_dropDown(distr);  fetch_users("route");
				  default: return;
				  }
		  
			  });
			  
			  
			  
			  ////////
			  
			  
		//save the details from the text boxes
  var txt_input=$('.target').blur(function(e) {
       		var value=	$(this).val();
			var boundary="region";
			var boundary_id=$(this).attr('id');;
			
			if(value==null||value=='')
			{ alert("Invalid number entered");
				}
				else{
					if(value<0){alert("Input a figure between 0 and 100");}
					else{ save_region_target(value,boundary,boundary_id);}
			}
    });//number
	
		 });
  		  
		  //,get regions
		 // load_all_regions_to_select_box();
		  
		
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
                         <h3 class="float_left">Setting targets </h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                      <!-- <select name="region" class="filters" id="region">
                       <option>Select Region</option></select> | <select class="filters" name="area" id="area" ><option>Select Area</option></select> | <select class="filters" id="cluster" name="cluster"><option>Select Cluster</option></select> | <select class="filters" name="distributor" id="distributor"> <option>Select Distributor</option></select> | <select class="filters" name="route" id="route"> <option>Select Route</option></select>-->
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <?php if(isset($_REQUEST['route'])){//ARM
				   $area=$_SESSION['area_id']; $i=1;
					   ?>
					     <table  class="table table-bordered table-striped table-condensed">
                              <thead>
<tr>  <th>#</th> <th>Route</th><th>Distributors</th> <th><?php echo date('M', strtotime(date('Y-m')." -2 month"));?></th>                                 <th ><?php echo date('M', strtotime(date('Y-m')." -1 month"));?></th> <th><?php echo date('M');?></th><th >Target</th><th>Actual</th><th>Date Added</th><th>Target by</th> <th>Actions</th></tr>
                              </thead>
                              <tbody id="">
                               <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE status=0 and area_id=$area order by distributor_id") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $route_id=$row['route_id']; $distr=$row['distributor_id'];
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo get_route($route_id) ?></td>
    <td><?php echo distributor_name($distr) ?></td>
    <td><?php echo sum_columns("tbl_targets","qty","MONTH(target_month)='$p2' and market_boundary_id=$route_id and market_boundary='route'")?></td>
    <td><?php echo sum_columns("tbl_targets","qty"," MONTH(target_month)='$p1' and market_boundary_id=$route_id and market_boundary='route'")?></td>
    <td><?php  echo sum_columns("tbl_targets","qty","MONTH(target_month)='$mnth' and market_boundary_id=$route_id and market_boundary='route'") ?></td><td>&nbsp;</td>
    <td><?php  echo sum_columns("tbl_deliveries dl inner join tbl_dealers d on d.dealer_id=dl.dealer_id","cases","MONTH(date_time)='$mnth'  and route_id =$route_id") ?></td><td></td></td><td></td><td><a  href="set_targets.php?mode=route&route_id=<?php echo $route_id?>">Update</a></td></tr>

        
						   <?php
                          $i++;}
						  echo "      </tbody></table>";///end role 3				  
						  
						   } else
						   if($role==3 and !isset($_REQUEST['route'])){//ARM
				   $area=$_SESSION['area_id']; $i=1;
					   ?>
					     <table  class="table table-bordered table-striped table-condensed">
                              <thead>
<tr>  <th>#</th> <th>Distributors</th> <th><?php echo date('M', strtotime(date('Y-m')." -2 month"));?></th>                                 <th ><?php echo date('M', strtotime(date('Y-m')." -1 month"));?></th> <th><?php echo date('M');?></th><th >Target</th><th>Actual</th><th>Date Added</th><th>Target by</th> <th>Actions</th></tr>
                              </thead>
                              <tbody id="">
                               <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE status=0 and area_id=$area ") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $distributor_id=$row['distributor_id']
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo distributor_name($distributor_id) ?></td>
    <td><?php echo sum_columns("tbl_targets","qty","MONTH(target_month)='$p2' and market_boundary_id=$distributor_id and market_boundary='distributor'")?></td>
    <td><?php echo sum_columns("tbl_targets","qty"," MONTH(target_month)='$p1' and market_boundary_id=$distributor_id and market_boundary='distributor'")?></td>
    <td><?php  echo sum_columns("tbl_targets","qty","MONTH(target_month)='$mnth' and market_boundary_id=$distributor_id and market_boundary='distributor'") ?></td><td>&nbsp;</td><td><?php  echo sum_columns("tbl_deliveries dl inner join tbl_dealers d on d.dealer_id=dl.dealer_id","cases","MONTH(date_time)='$mnth'  and distributor_id =$distributor_id") ?></td><td></td></td><td></td><td><a  href="set_targets.php?mode=distributor&distributor_id=<?php echo $distributor_id?>">Update</a></td></tr>

        
						   <?php
                          $i++;}
						  echo "      </tbody></table>";///end role 3				  
						  
						   } else if($role==2){ $i=1;
							   $region=$_SESSION['region_id'];?>
                            
                           <table  class="table table-bordered table-striped table-condensed">
                              <thead>
                              
<tr>  <th>#</th> <th>Area</th> <th><?php echo date('M', strtotime(date('Y-m')." -2 month"));?></th>                                 <th ><?php echo date('M', strtotime(date('Y-m')." -1 month"));?></th> <th><?php echo date('M');?></th><th >Target</th><th>Actual</th><th>Date Added</th><th>Target by</th> <th>Actions</th></tr>
                              </thead>
                              <tbody id="">
                                                <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE status=0 and region_id=$region") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $area_id=$row['area_id']
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo area_name($area_id) ?></td>
    <td><?php echo sum_columns("tbl_targets","qty","MONTH(target_month)='$p2' and market_boundary_id=$area_id and market_boundary='area'")?></td>
    <td><?php echo sum_columns("tbl_targets","qty"," MONTH(target_month)='$p1' and market_boundary_id=$area_id and market_boundary='area'")?></td>
    <td><?php  echo sum_columns("tbl_targets","qty","MONTH(target_month)='$mnth' and market_boundary_id=$area_id and market_boundary='area'") ?></td><td>&nbsp;</td><td><?php  echo sum_columns("tbl_deliveries dl inner join tbl_dealers d on d.dealer_id=dl.dealer_id","cases","MONTH(date_time)='$mnth'  and area_id =$area_id") ?></td><td></td></td><td></td><td><a  href="set_targets.php?mode=area&area_id=<?php echo $area_id?>">Update</a></td></tr>

        
						   <?php
                          $i++;}
						  echo "      </tbody></table>";///end role 3				  
						  
						   } else
                              if($role==4){ $i=1;?>
						  <table  class="table table-bordered table-striped table-condensed">
                              <thead>
<tr>  <th>#</th> <th>Area</th> <th><?php echo $two_ms_ago ?></th> <th ><?php echo $last_m?></th> <th><?php echo $this_m?></th><th >Target</th><th>Actual</th><th>Date Added</th><th>Target by</th> <th>Actions</th></tr>
                              </thead>
                              <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` WHERE status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $region=$row['region_id'];
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo region_name($region) ?></td>
    <td><?php echo sum_columns("tbl_targets","qty","MONTH(target_month)='$p2' and market_boundary_id=$region and market_boundary='region'")?></td>
    <td><?php echo sum_columns("tbl_targets","qty"," MONTH(target_month)='$p1' and market_boundary_id=$region and market_boundary='region'")?></td>
    <td><?php  echo sum_columns("tbl_targets","qty","MONTH(target_month)='$mnth' and market_boundary_id=$region and market_boundary='region'") ?></td>
    
    <td><input class="target" type="number" value="<?php echo getColumnName("tbl_boundary_targets","qty", " boundary='region' AND boundary_id=$region AND target_month='$mnth' and target_year='$this_year' and status=0")?>" id="<?php echo $region?>" name="region_target"></td>
    
    <td><?php  echo sum_columns("tbl_deliveries dl inner join tbl_dealers d on d.dealer_id=dl.dealer_id","cases","MONTH(date_time)='$this_m'  and region_id =$region") ?></td><td></td></td><td></td><td><a  href="set_targets.php?mode=region&region_id=<?php echo $region?>">Update SKU Targets</a> </td></tr>
						  <?php
                          $i++;}
						  echo "</table>";}?>
                          
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -SELECT `delivery_id`, `date_time`, `order_id`, `product_id`, `user_id`, `quantity_supplied`, `plan_id`, `status` FROM `` WHERE 1-->
                 
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
