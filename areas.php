<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $region_id=$_REQUEST['region_id'];
	
	  include "export.html"; ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
 $(document).ready(function(e) {
	 var region=<?php echo $region_id?>;
		//  var url="analyze_outlets.php?demarcation_mode=areas_stats&region_id="+region;
	//$("#areas_list").load(url);
	update_Area();
	 $('#filtersForm').change(function(){
		//var filters= $('.filtersForm').serialize();
		get_filteredAjaxData(getfilterOptions()+"&region_id="+region,getfilterOptions(),"#areas_list","areas_stats");
		});
	//////////////////////
	
 		load_users();
		
		///editing the live table
		//by default 
				
		
		$(".editbox").hide();
$(".edit_td").click(function(){
var ID=$(this).attr('id');
$("#contr_"+ID).hide();

$("#contr_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var contr=$("#contr_input_"+ID).val();

var dataString = 'id='+ ID +'&contr='+contr+'&mode=area_contribution';
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
//.....
$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});
////////////////////

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
                         <h3 class="float_left"> <?php echo region_name($_REQUEST['region_id']) ?> Areas  <?php include 'common_export_icons.php'?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left"><a data-toggle="modal" class="btn btn-success btn-sm" href="#areaModal"> Add Area</a>  
                 <?php include "filter_form.php";?>
                      
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <table id="content_table" width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead> <tr><th></th> <th>Area Name</th><th>Incharge</th> <th >Sub areas</th> <th>Distributors</th>    <th>Routes</th>  <th>All Outlets</th><th>Verified Outlets</th><th>% Contribution in the region </th> <th>Actions</th> </tr> </thead>
                              <tbody id="areas_list">
                        <?php $i=0;
                         $res=mysqli_query($mysqli,"SELECT * FROM `tbl_areas` WHERE region_id=$region_id and  status=0 order by area_name") or die(mysqli_error());
	while ($row = mysqli_fetch_array($res)) { $area_id=$row['area_id'];
	?><tr><td><?php echo $i?></td><td><?php echo get_area($area_id) ?></td><td><?php echo get_name($row['arm_incharge'])?></td><td><a href="clusters.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_clusters","status=0 and area_id=".$area_id)?></a></td><td><a  href="distributors.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_distributors","status=0 and area_id=".$area_id) ?></a></td>
    <td><a href="view_routes.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_routes"," status=0 and area_id=".$area_id)  ?></a></td><td><a href="region_outlets.php?mode=area&area_id=<?php echo $area_id?>"><?php echo num_rows("tbl_dealers","status=0 and cluster_id>0 and area_id=$area_id ".regions_filters_condition())?></a></td><td><?php echo num_rows("tbl_dealers","status=0 and cluster_id>0 and  verified=1 and type_of_class IN  ('Bronze','Silver','Gold','Other') and area_id=$area_id ".regions_filters_condition())?></td>
    <td class="edit_td" id="<?php echo $area_id; ?>"><span id="contr_<?php echo $area_id; ?>" class="text"><?php echo $row['area_contribution']*100; ?></span>
<input type="number" value="<?php echo  $row['area_contribution']*100; ?>" class="editbox" id="contr_input_<?php echo $area_id; ?>" /></td>
        <td><a data-id="<?php echo $area_id?>" class='editAreaButton' href="javascript:void(0)" >Edit</a>|<a href="migrate.php?mode=area&id=<?php echo $area_id?>">Delete</a></td></tr>
	<?php $i++; }?>
                              </tbody>
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include 'area_form.php';?>
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
	

	
   <script src="assets/js/bootbox.min.js"></script>
   <script src="assets/js/bootbox_functions.js"></script>

    
  </body>
</html>
