                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                  	<div class="donut-main">
						<h4>Route Details</h4>
                  	</div>
                                      <span>Select Sales Person<select onchange="select_sales();" class="form-control sales_person_selection" id="sales_person_selection"></select></span>   
                                        <span id="sales_person" class="centered mt "><table id="sales_person_name"><thead><th>Route Outlets</th></thead><tr><td ><h5>None selected</h5></td></tr></table></span><div><ol id="selected_trips"></ol> 
                                                      <!--end the route details div-->
<div class="donut-main">
						<h4>Order Generation</h4>
</div>
                      <div class="desc" style="background-color:#FFF; padding:1px">
                      <?php if($_SESSION['user_role']==4){ ///if it is commercial manager?> <table class="table" >
                      <thead> <tr>
                        <th>Region</th>
                        <th>OG</th>
                        <th>Delivered</th>
                        </tr></thead>
                      <tbody>
                      <?php
					   $regions=mysqli_query($mysqli,"SELECT `region_id`,`region_name` FROM `tbl_regions` WHERE status=0")or die(mysqli_error($mysql)); while($ro=mysqli_fetch_array($regions)){ $region_id=$ro['region_id']?><tr><td><?php echo region_name($region_id)?></td><td><?php //echo expired_orders($region_id)?></td><td><?php //echo upcoming_orders($region_id)?></td></tr><?php }?>
                      </tbody></table><?php }
					  
					  
					   elseif($_SESSION['user_role']==2){// if it is rsm ?>
                     <table class="table" >
                      <thead> <tr>
                        <th>Area</th>
                        <th>OG</th>
                        <th>Delivered</th>
                        </tr></thead>
                      <tbody>
                      <?php $myRegion=$_SESSION['region_id']; $areas=mysqli_query($mysqli,"SELECT `area_id`,`area_name` FROM `tbl_areas` WHERE region_id=$myRegion and status=0")or die(mysqli_error($mysqli)); while($ro=mysqli_fetch_array($areas)){ $area_id=$ro['area_id']?><tr><td><?php echo area_name($area_id)?></td><td><?php //echo expired_orders($region_id)?></td><td><?php //echo upcoming_orders($region_id)?></td></tr><?php }?>
                      </tbody></table>
                      
                      <?php } elseif($_SESSION['user_role']==3){?>
                       <table class="table" >
                      <thead> <tr>
                        <th>Sub Area</th>
                        <th>OG</th>
                        <th>Delivered</th>
                        </tr></thead>
                      <tbody>
                      <?php $myarea=$_SESSION['area_id']; $sub_areas=mysqli_query($mysqli,"SELECT `cluster_id`,`cluster_name` FROM `tbl_clusters` WHERE area_id=$myarea and status=0")or die(mysqli_error($mysqli)); while($ro=mysqli_fetch_array($sub_areas)){ $sub_area_id=$ro['cluster_id']?><tr><td><?php echo sub_area_name($sub_area_id)?></td><td><?php //echo expired_orders($region_id)?></td><td><?php //echo upcoming_orders($region_id)?></td></tr><?php }?>
                      </tbody></table>
                      
                      <?php }?>
                       </div>
                    
                      
                       </div>
               
                        <div class="donut-main"><h4> Day's Best Three ADs-Based on sales</h4></div>
                        <div class="desc" style="background-color:#FFF; padding:1px">
                       <table class="table" >
                      <thead> <tr><th>Name</th><th>Visited</th><th>Sold</th></tr></thead>
                      <tbody>       <?php $best=mysqli_query($mysqli,"SELECT sum(pieces) qty ,supplied_by FROM `tbl_orders_details` WHERE date(`date_supplied`)=date(now()) and status=1 group by supplied_by order by qty desc Limit 3") or die(mysqli_error($mysqli)); 
					  if(mysqli_num_rows($best)==0){ echo "<tr><td colspan=3>None</td></tr>"; } while($best_r=mysqli_fetch_array($best)){ $user=$best_r['supplied_by']; $date=date("Y-m-d");
						  
						 
		?>
                      <tr><td><?php echo get_name($uid)?></td><td><?php echo already_visted($uid,$date) ?></td><td><?php echo $best_r['qty']?></td></tr><?php }?>
                      </tbody></table>
                       </div>
                       <!--end best 3-->
                        <div class="donut-main"><h4> Recent Activities</h4></div>
<?php include ('recent_activities.php');?>
                      <style> 
					  #loading{
						  background-image:url(assets/img/loading.gif);
						  }</style>
                      <script type="text/javascript">
$(document).ready(function() { 
       $.ajax({    //create an ajax request to load_page.php
        type: "GET",  url: "track_people.php",  dataType: "html",   //expect html to be returned                
        success: function(response){    
		$("#loading").fadeOut(5000);                 
            $("#responsecontainer").html(response); 
            //alert(response);
        }
    });
	});

</script>
                      <div> <h4 class="centered mt ">TRACK PEOPLE</h4>
                      <span id="responsecontainer"><img  width="250px" src="assets/img/loading.gif" /></span></span>
                          </div><!-- /col-lg-3 -->