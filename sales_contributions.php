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
			  
			  
			  
			  /*************************save the %age boundary contributions**************************/
			  
			  $(".editbox").hide();
$(".edit_td").click(function(){
	
var ID=$(this).attr('id');
$("#contr_"+ID).hide();

$("#contr_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var contr=$("#contr_input_"+ID).val();
var mode=$("#mde").val();
var dataString = 'id='+ ID +'&contr='+contr+'&mode='+mode;
$("#contr_"+ID).html('<img src="ajax-loader.gif" />');

if(contr.length>0 && contr<100)
{
$.ajax({
type: "POST",
url: "read.php",
data: dataString,
cache: false,
success: function(html)
{
$("#contr_"+ID).html(contr);
//$("#last_"+ID).html(last);
}
});
}
else
{
alert('Enter valid number.');
}

});
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
                         <h3 class="float_left">Setting Sales contributions</h3>
                     <?php if($role==3){?>
                     <form action="<?php echo $_SERVER['PHP_SELF']?>"   > Select Routes to fill the %age contributions<select id="route" name="route"><?php distributor_selection();?></select> <input type="submit" name="submit" value="Display"></form><?php } ?>
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
<tr>  <th>#</th> <th>Route</th><th>Distributors</th>  <th>Sum of % SKU Contribution</th><th>%age Route contribution to the distributor</th><th> </th> <th>Actions</th></tr>
                              </thead>
                              <tbody id="">
                               <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE status=0 and area_id=$area order by distributor_id") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $route_id=$row['route_id']; $distr=$row['distributor_id'];
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo get_route($route_id) ?></td>
    <td><?php echo distributor_name($distr) ?></td>
   
    <td><?php  echo sum_columns("tbl_sku_contributions","contribution","boundary_id=$route_id and boundary='route'") ?></td><td class="edit_td" id="<?php echo $route_id; ?>"><span id="contr_<?php echo $route_id; ?>" class="text"><?php echo $row['route_contribution']; ?></span><input type="hidden" name="mde" id="mde" value="route_contribution">
<input type="text" value="<?php echo  $row['route_contribution']; ?>" class="editbox" id="contr_input_<?php echo $route_id; ?>" /></td>
   </td><td></td><td><a  href="set_contributionsperSku.php?mode=route&route_id=<?php echo $route_id?>">Update</a></td></tr>
       
						   <?php
                          $i++;}
						  echo "      </tbody></table>";///end role 3				  
						  
						   } else
						   if($role==3 and !isset($_REQUEST['route'])){//ARM
				   $area=$_SESSION['area_id']; $i=1;
					   ?>
					     <table  class="table table-bordered table-striped table-condensed">
                              <thead>
<tr>  <th>#</th> <th>Distributors</th> <th >Sum of % SKU Contribution</th><th>%age Distributor contribution to the Area</th><th>set by</th> <th>Actions</th></tr>
                              </thead>
                              <tbody id="">
                               <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE status=0 and area_id=$area ") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $distributor_id=$row['distributor_id']
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo distributor_name($distributor_id) ?></td>
    
    <td><?php  echo sum_columns("tbl_sku_contributions","contribution","boundary_id=$distributor_id and boundary='distributor'") ?></td><td class="edit_td" id="<?php echo $distributor_id; ?>"><span id="contr_<?php echo $distributor_id; ?>" class="text"><?php echo $row['distributor_contribution']; ?></span><input type="hidden" name="mde" id="mde" value="distributor_contribution">
<input type="text" value="<?php echo  $row['distributor_contribution']; ?>" class="editbox" id="contr_input_<?php echo $distributor_id; ?>" /></td><td></td><td><a  href="set_contributionsperSku.php?mode=distributor&distributor_id=<?php echo $distributor_id?>">Update</a></td></tr>

        
						   <?php
                          $i++;}
						  echo "      </tbody></table>";///end role 3				  
						  
						   } else if($role==2){ $i=1;
							   $region=$_SESSION['region_id'];?>
                            
                           <table  class="table table-bordered table-striped table-condensed">
                              <thead>
                              
<tr>  <th>#</th> <th>Area</th>  <th>Sum of % SKU Contribution</th><th>%age Area contribution to the Region</th><th>Actual</th><th>Date Added</th><th>Target by</th> <th>Actions</th></tr>
                              </thead>
                              <tbody id="">
                                                <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE status=0 and region_id=$region") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $area_id=$row['area_id']
	?><tr>
    
    <td><?php echo $i?></td><td><?php echo area_name($area_id) ?></td>
   
    <td><?php  echo sum_columns("tbl_sku_contributions","contribution","boundary_id=$area_id and boundary='area'") ?></td><td>&nbsp;</td><td><?php  echo sum_columns("tbl_deliveries dl inner join tbl_dealers d on d.dealer_id=dl.dealer_id","cases","MONTH(date_time)='$mnth'  and area_id =$area_id") ?></td><td class="edit_td" id="<?php echo $area_id; ?>"><span id="contr_<?php echo $area_id; ?>" class="text"><?php echo $row['area_contribution']; ?></span><input type="hidden" name="mde" id="mde" value="area_contribution">
<input type="text" value="<?php echo  $row['area_contribution']; ?>" class="editbox" id="contr_input_<?php echo $area_id; ?>" /></td></td><td></td><td><a  href="set_contributionsperSku.php?mode=area&area_id=<?php echo $area_id?>">Update</a></td></tr>

        
						   <?php
                          $i++;}
						  echo "      </tbody></table>";///end role 3				  
						  
						   } else
                              if($role==4){ $i=1;?>
						  <table  class="table table-bordered table-striped table-condensed">
                              <thead>
<tr>  <th>#</th> <th>Region</th> <th>Sum of % SKU Contribution</th><th>%age Region contribution </th><th>set by</th> <th>Actions</th></tr>
                              </thead>
                              <?php $res=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` WHERE status=0") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $region=$row['region_id'];
	?><tr>
       <td><?php echo $i?></td><td><?php echo region_name($region) ?></td>
    
    <td><?php  echo sum_columns("tbl_sku_contributions","contribution","boundary_id=$region and boundary='region'") ?></td><td class="edit_td" id="<?php echo $region; ?>"><span id="contr_<?php echo $region; ?>" class="text"><?php echo $row['region_contribution']; ?></span><input type="hidden" name="mde" id="mde" value="region_contribution">
<input type="text" value="<?php echo  $row['region_contribution']; ?>" class="editbox" id="contr_input_<?php echo $region; ?>" /></td></td><td></td><td><a  href="set_contributionsperSku.php?mode=region&region_id=<?php echo $region?>">Update SKU contributions</a></td></tr>
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
