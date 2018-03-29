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
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		//  fetch_clients();

    fetch_settings();
        
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
                  <div class="col-lg-9 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Settings</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                   <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add Setting</a>
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   
                             <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th>Setting</th>
                                  <th >Value</th>
                                  <th  >Description</th>
                                  <th  >Date Modified</th>
                                  <th  >Options</th>
                              </tr>
                              </thead>
                            <tbody id="settings_list"><tr><th>#</th>
                                  <th>Holiday Days</th>
                                  <th >Description</th>
                                  <th  >Value</th>
                                  <th  >Date </th>
                                  <th  >Options</th></tr></tbody>
                            
                             
                             
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
                  
	
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Setting</h4>
						      </div>
						      <div class="modal-body">
 <form class="cmxform form-horizontal"  onSubmit="return false" id="settingsForm"   >
                                <table><tr>
                                  <td rowspan="2"><label for="query">Setting</label>
                                  <textarea class="form-control" name="setting" id="setting" cols="35" rows="3"></textarea></td>
                                  <td>Value
                                    <input class="form-control" id="value" name="value" /></td>
                                 </tr>
                                  <tr>
                                    <td>ON/OFF<select class="form-control" name="onOf" id="onOf"><option value="0">On</option><option value="1">Off</option></select></td>
                                    <tr><td>Applies To
                                        <select class="form-control" id="appliesTo" name="appliesTo">
                                          <option value="phone">Phone</option>
                                          <option value="all">All Users</option>
                                           <option value="online">Online Use</option>
                                        </select>                                     ></td>
                                    <td>Description <input type="text" name="description" name="description" ></td></tr>
                                  </tr>
                                </table> <div class="modal-footer">
                               
                                        <input type="hidden" value="<?php $_SESSION['u_id']?>" name="user_id" id="user_id"/>
                                        
                                         
                                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button> <button class="btn btn-success" data-dismiss="modal" onClick="add_setting()" type="submit">Save</button>
                                       
                                      </div>
                            </form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->
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
