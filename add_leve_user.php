<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $area_id=$_SESSION['area_id'];
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		 
	
		 
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
                  
					
						       
                  <form  action="" method="post" onsubmit="return false" id="add_level_userform"  name="add_level_userform" >
                <?php $role=$_SESSION['user_role'];?>
                               <table id="add_users"  style="margin:auto;"><tr><td>Name</td><td><input type="text" class=" form-control" id="full_name" name="full_name"></td><td>Email</td><td><input type="email" class=" form-control" id="email" name="email"></td><td> Phone No</td><td><input type="tel" class="form-control"  id="tel" name="tel"></td></tr>
                               <tr><td>Password</td><td><input  type="password" class=" form-control" id="password" name="password"></td>
                                 <td>Confirm Pass</td><td><input type="password"  class=" form-control" id="cpassword" name="cpassword"></td><td>Role</td><td><select class=" form-control"  id="role" name="role"><?php echo roles_selection_boundary($role)?></select></td></tr>
                               <?php if($role==2){?>
                               <tr>
                                 <td>Area</td>
                                 <td><select class=" form-control" id="area_id" name="area_id"><option value="0"> All Areas</option><?php echo area_selection()?></select></td>
                                 <td>Sub Area</td>
                                 <td><select class=" form-control"  id="cluster_id" name="cluster_id">
                                   <option value="0">All sub Area</option>
                                   <?php echo cluster_selection()?>
                                 </select></td>
                                 <td>Distributor</td>
                                 <td><select type="text"  class="form-control" name="distributor_id" id="distributor_id">
                                   <option value="0">Distributor</option>
                                   <?php echo distributor_selection()?>
                                 </select></td>
                               </tr>
                               
                               <tr>
                                 <td>AD Cluster</td>
                                 <td><select class="form-control" id="ad_cluster_id" name="ad_cluster_id">
								 <option value="0"> All </option><?php echo ad_cluster_selection()?></select></td>
                                 <td>Route</td>
                                 <td colspan="2"><select class="form-control" id="route_id" name="route_id">
                                   <option value="0"> All </option>
                                   <?php echo route_selection()?>
                                 </select></td>
                                 <td>&nbsp;</td>
                               </tr>
                                
                               <?php } else if($role==3){///narea retail manager?>
                               <tr>
                                 <td>Sub Area</td>
                                 <td><select class=" form-control"  id="cluster_id" name="cluster_id">
                                   <option value="0">All sub Area</option>
                                   <?php echo cluster_selection()?>
                                 </select></td>
                                 <td>Distributor</td>
                                 <td><select type="text"  class="form-control" name="distributor_id" id="distributor_id">
                                   <option value="0">Distributor</option>
                                   <?php echo distributor_selection()?>
                                 </select></td>
                                 <td>AD cluster</td>
                                 <td><select class="form-control" id="ad_cluster_id" name="ad_cluster_id">
                                   <option value="0"> All </option>
                                   <?php echo ad_cluster_selection()?>
                                 </select></td>
                               </tr>
                               <tr>
                                 <td>Route</td>
                                 <td><select class="form-control" id="route_id" name="route_id">
                                   <option value="0"> All </option>
                                   <?php echo route_selection()?>
                                 </select></td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                               </tr>
  <?php } else if($role==1){?>   
  <tr>
    <td>Distributor</td>
    <td><select type="text"  class="form-control" name="distributor_id" id="distributor_id">
      <option value="0">Distributor</option>
      <?php echo distributor_selection()?>
    </select></td>
    <td>Route</td>
    <td><select class="form-control" id="route_id" name="route_id">
      <option value="0"> All </option>
      <?php echo route_selection()?>
    </select></td>
    <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                               </tr>
                               <?php }?>                          
                               
                               </table>
                              <div class="modal-footer">
						       <a  href="level_users.php" class="btn btn-default" >Reset</a>
						        <button  data-dismiss="modal" type="submit" id="submit" class="btn btn-success" onClick="add_level_user();" >Save</button>
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
