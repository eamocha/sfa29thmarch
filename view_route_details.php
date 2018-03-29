<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php'; 
	if(!isset($_SESSION['u_id'])){
header("location:login.php");
}
	else if($_SESSION['ppt']=='') header("location:uploadppt/index.php");
	$rid=$_REQUEST['rid'];
	$region=$_REQUEST['region'];
	
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >
      </script>
      <script type="text/javascript" >
	  var route=<?php echo $rid ?>;
      $(document).ready(function(e) {
	//assign_salesperson();
	

        fetch_assigned_rote_outlets(route);
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
                         <?php include('submenu.php');?>
                        <h3> Assigned outlets to: <?php get_route($rid);?></h3>
                      
                     
                      </div>
                    <div class="row mb">
				
				   <!-- the hidden input field here helps to fetch the route_id-->
                   <input type="hidden" name="rid" id="rid" value="<?php echo $rid; ?>" />				 
                   <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['u_id']?>"	 />	
                       <!-- page start-->
                  <div class="content-panel">
                  
                        <div class="adv-table">
                            <table  class="table table-bordered table_stripped " >
                                <thead>
                                <tr><th>No</th>
                                    <th>Dealer</th>
                                      <th>Channel</th>
                                    <th >Town</th>
                                    <th >Reg Date</th>
                                    <th >Contact</th>
                                    <th >Assign</th>
                                    
                                </tr>
                                </thead>
                                <tbody  class="list" >
                            
                              </tbody>
                            </table>
                        </div>
                  </div>
              <!-- page end-->

              </div><!-- /row -->
                  
                  

                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
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

    
    <script src="assets/js/bootstrap.min.js"></script>
	
	
	
               
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	
	


  </body>
</html>
