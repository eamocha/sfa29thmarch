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
	if(isset($_REQUEST['save'])){
		save_classification();
		}
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		//  fetch_clients();

       fetch_categories();
        

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
                         <h3 class="float_left">Outlet Categories</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                   <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add Category</a>
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <table width="100%"  class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Channel Name</th>
                                  <th>Applies On</th>
                                    <th>Member/group</th>
                                      <th>Description</th>
                                  <th>Outlets</th><th>Date added</th>
                                  <th>Added By</th>
                 
                                  
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody id="list_items">
                              
                              </tbody>
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
						        <h4 class="modal-title" id="myModalLabel">Channel Details</h4>
						      </div>
						      <div class="modal-body">
<form name="formName" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
                               <table id=""  ><tr>
                                   <td><label>Channel Name</label>                                     <input required type="text" class=" form-control" id="category_name" name="category_name"></td>
                                   <td><label for="description">
                                     <label>Description</label>
                                   </label>
                                     <textarea class=" form-control" id="description" name="description"></textarea>                                     </td>
                               </tr>
                               
                               <tr>
                                   <td><label>Applies for Distributor/Outlet</label>
                                     <select id="applies_for" name="applies_for"><option value="Outlets">Outlet</option><option value="Distributors">Distributors</option><option value="Both">Both</option></select></td>
                                   <td><label>The group where the channel belong</label>                                     <input type="text" class=" form-control" id="member_of" name="member_of">                                     </td>
                               </tr></table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  type="submit" id="submit" name="save" class="btn btn-primary">Save</button>
					        </div></form>
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


    <script src="assets/js/bootstrap.min.js"></script>   

    	
	

	


    
  </body>
</html>
