<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';   $user_id=$_SESSION['u_id'];
	 ?>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script>
  $( function() { 	 
	  //////////////////////////
	  $( ".sortable" ).sortable({ 
   connectWith: '.sortable',cursor: 'move',
   placeholder: "widget-highlight",
   // Receive callback
   receive: function(event, ui) { 
     // The position where the new item was dropped
     var newIndex = ui.item.index();
	 var container_id=$(this).attr("id");//container id
	 var item_id=ui.item.attr("id");//the item id
     // Do some ajax action...
     $.post('read.php', {newPosition: newIndex,'item_id':item_id,"container_id":container_id,"mode":"assign_route2adCluster"}, function(returnVal) {
        // Stuff to do on AJAX post success
     });
   },
   // Likewise, use the .remove event to *delete* the item from its origin list
   remove: function(event, ui) {
     var oldIndex = ui.item.index();
	  var container_id=$(this).attr("id");//container id
	 var item_id=ui.item.attr("id");//the item id
     $.post('read.php', {deletedPosition: oldIndex,'item_id':item_id,"container_id":container_id,"mode":"unassign_routeFromAdCluster"}, function(returnVal) {
        // Stuff to do on AJAX post success
     });

   }
 });
   /////////////////////////
  } );
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
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
    
       <div id="sidebarforAssignments"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu   sortable" >
               <h3 class="centered">Routes</h3>
             <?php 
			 $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" status=0 ";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
		case 5:  $where=" area_id=$myArea and status=0 "; break;//AD
	}
		$q=mysqli_query($mysqli,"SELECT * FROM `tbl_routes` WHERE $where order by cluster_id, route_name") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($q))
{?>
              	     <li id="<?php echo $row['route_id']?>"><?php echo $row['route_name']?> </li>
                       <?php }?>          
              </ul>
              <!-- sidebar menu end-->
          </div>
      
      <!--sidebar end-->
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="AD_assignmentmain-content">
          <section class="wrapper">
              <div class="row">
                  <div  class="col-lg-12 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                        <h3 class="float_left">Assign routes to clusters</h3>
                      </div>
                    
                     <!--start -->           
                   <section id="unseen">
<?php   /////switch role to select from ad clusters
switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" area_id=$myArea and status=0 "; break;//arm
		case 1: $where=" sub_area_id=$cluster_id and status=0 "; break;//AD
	}
$select_users=mysqli_query($mysqli,"SELECT * FROM `tbl_ad_clusters` WHERE $where") or die(mysqli_error($mysqli));
while($row=mysqli_fetch_array($select_users))
{ $ad_cluster_id=$row['ad_cluster_id'];?>

<span class="ul_container">
<h3 style="text-align:center; padding:4px; font-weight:bold; color:white; background-color:#F00;"><?php echo $row['ad_cluster_name']?></h3>
<ul class="sortable"  id="<?php echo $ad_cluster_id?>">
  <li> </li>
  
  <?php $assignments=mysqli_query($mysqli,"SELECT route_name,a.route_id as rid FROM `tbl_assign_route2adcluster` a Left join tbl_routes c on a.route_id=c.route_id  WHERE a.status=0 and a.ad_cluster_id=$ad_cluster_id") or die(mysqli_error($mysqli));
while($r=mysqli_fetch_array($assignments))
{?>
   <li id="<?php echo $r['rid']?>"><?php echo $r['route_name']?> </li>
   <?php }  ?>
  
   </ul>
</span>

<?php } ?>
                  
                      
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
     <?php //include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->




 
 

    	
	

	


    
  </body>
</html>
