<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; 		
		$ad_cluster_id=clean($_REQUEST['ad_cluster_id']);
		

	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
     
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
                  <div class="col-lg-9 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                        <h3 class="float_left">Edit <?php echo ad_cluster_name($ad_cluster_id)?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left"> </br></br>
                      
						 </div>
                     <!--start -->           
                   <section id="unseen">
                    <form name="ad_cluster" action="add_region_process.php?mode=update_adCluster" method="post">
                   <table width="100%"  class="table table-bordered table-striped table-condensed">
                             
                            
                             
                              <?php $region_id=0;  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_ad_clusters` WHERE ad_cluster_id=$ad_cluster_id") or die(mysqli_error($mysqli));
	$row = mysqli_fetch_array($res);
	 $description=$row['description']; $ad_cluster_name=$row['ad_cluster_name'];
	$assigned_ad_id=$row['assigned_ad_id']; $area_id=$row['area_id'];  $sub_area_id=$row['sub_area_id'];$region_id=$row['region_id'];
	
	?>
    <tr>                                <td><p>Sub Area</p> <select class="" name="sub_area_id" id="sub_area_id"><option value="<?php echo $sub_area_id?>"><?php echo getColumnName('tbl_clusters','cluster_name', 'cluster_id='.$sub_area_id);?></option><?php echo cluster_selection()?></select></td><td><p>Area</p><select id="area" name="area"><option value="<?php echo $area_id?>"><?php echo getColumnName('tbl_areas','area_name', 'area_id='.$area_id)?></option><?php echo area_selection()?></td><td>
                                <input  type="hidden" name="ad_cluster_id" value="<?php echo $ad_cluster_id?>">
                                 <p>Ad Cluster</p>
                                  <input type="text" name="ad_cluster_name" value="<?php  echo $ad_cluster_name?>" id="ad_cluster_name">
                               </td><td></td>
                                </tr>
    <tr>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
      
      <td><a  href="" class="btn btn-default" >Close</a>
        <button  type="submit" name="submit" class="btn btn-primary">Save</button></td>
      </tr>
             
                          </table>	
                   </form>
                 
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal --><!-- modal -->
                  
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
