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
		$dealer_id=clean($_REQUEST['dealer_id']);
		

	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		  $("#sub_area").change(function(e) {
		var sub_area=$(this).val();
		
			 fill_route_select_list("sub_area",sub_area);
           
        });
		
        
 //load select boxes
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
                  <div class="col-lg-12">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                        <h3 class="float_left">Edit <?php echo business_name($dealer_id)?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left"> </br></br>
                      
						 </div>
                     <!--start -->           
                   <section id="unseen">
                    <form name="f" action="read.php?mode=update_subArea_route" method="post">
                   <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              </thead>
                              <tbody class="">
                             
                              <?php $region_id=0;  $i=1; 
$res=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE dealer_id=$dealer_id ") or die(mysqli_error($mysqli));
	$row = mysqli_fetch_array($res);
	$cluster=$row['cluster_id']; $region=$row['region_id'];$area_id=$row['area_id']; $dealer_id=$row['dealer_id']; 
		?><tr>
                                <td>Area</td><td><?php echo get_area($area_id)?></td><td>Sub Area</td><td>
                                
                               
                                  <select id="sub_area" name="sub_area"><?php echo cluster_selection_boundary(3,"region")?></select>
                               </td><td>Route</td><td> <select id="route_id" name="route_id"> <?php echo route_selection_region($region)?></select></td><td><input  type="hidden" id="dealer_id" name="dealer_id" value="<?php echo $dealer_id?>"/>
						        <button  type="submit" name="submit" class="btn btn-primary">Save</button></td>
                                </tr>
             
                              </tbody>
                          </table>	</form>
                 
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal --><!-- modal -->
                  
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
