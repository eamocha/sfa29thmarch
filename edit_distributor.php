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
		$distributor_id=clean($_REQUEST['distributor_id']);
		

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
                        <h3 class="float_left">Edit <?php echo distributor_name($distributor_id)?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left"> </br></br>
                      
						 </div>
                     <!--start -->           
                   <section id="unseen">
                    <form name="f" action="read.php?mode=update_distributor" method="post">
                   <table width="100%"  class="table table-bordered table-striped table-condensed">
                             
                            
                             
                              <?php $region_id=0;  $i=1; 
							  $res=mysqli_query($mysqli,"SELECT * FROM `tbl_distributors` WHERE distributor_id=$distributor_id") or die(mysqli_error($mysqli));
	$row = mysqli_fetch_array($res); $owner=$row['owner']; $contact=$row['contact'];
	$distributor_name=$row['distributor_name']; $area_id=$row['area_id'];  $sub_area_id=$row['cluster_id'];$distributor_id=$row['distributor_id']; $class=$row["distributor_class"]; $channel_type=$row['distributor_channel'];
	
	?>
    <tr>                                <td><p>Sub Area</p> <select class="filter_boundary" name="sub_area_id" id="sub_area_id"><option value="<?php echo $sub_area_id?>"><?php echo getColumnName('tbl_clusters','cluster_name', 'cluster_id='.$sub_area_id);?></option><?php echo cluster_selection()?></select></td><td>
                                <input  type="hidden" name="distributor_id" value="<?php echo $distributor_id?>">
                                 <p>Distributor</p>
                                  <input type="text" name="distributor" value="<?php  echo $distributor_name?>" id="distributor">
                               </td><td><p>Channel</p><select id="distributor_channel" name="distributor_channel"><option value="<?php echo $channel_type?>"><?php echo $channel_type?></option><?php echo select_distributor_channel()?></td><td><p>Distributor Class</p><select id="distributor_class" name="distributor_class"><option value="<?php echo $class?>"><?php echo $class?></option><?php echo select_distributor_class()?></td>
                                </tr>
    <tr>
      <td><p>Contact Person</p><input type="text" value="<?php echo $owner?>" name="owner" id="owner"></td>
      <td><p>Contact Number</p><input type="text" name="contact" value="<?php echo $contact?>" id="contact"></td>
      <td>&nbsp;</td>
      
      <td><a  href="" class="btn btn-default"  >Close</a>
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
