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

     fetch_query();
        
 //load select boxes
 		//load_users();
		$("#opts").hide();
		$("#query_type").change(function(e) {
            var qtype=$("#query_type").val();
			if(qtype=='Radio'||qtype=='CheckBox'){
		$("#opts").show();
			}
			else {$("#opts").hide();
				}
        });
		
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
                  <div class="col-lg-12 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); 
						 ?>
                         <h3 class="float_left">Survey Questions</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                  
                  <form action="<?php $_SERVER['PHP_SELF']?>" method="post"> <table><tr><td> <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add Question</a></td><td>Category</td><td><select name="cat_filter" id="cat_filter" class="form-control"><?php echo red_eds_dosa()?></select></td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Filter</button></td></tr></table></form>
				    </div>
                     <!--start -->           
                   <section id="unseen">
                   
                             <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th rowspan="2">#</th>
                                  <th rowspan="2">Question</th>
                                  <th rowspan="2" >Answer type</th>
                                  <th rowspan="2"  >Category</th>
                                  <th rowspan="2"  >Apply</th>
                                  <th rowspan="2"  >Region</th>
                                  <th rowspan="2"  >Required</th>
                                  <th rowspan="2"  >Channel</th>
                                  <th colspan="3"  >Score</th>
                                  <th rowspan="2"  >Options</th>
                                </tr>
                              <tr>
                                <th>G</th>
                                <th>S</th>
                                <th>B</th>
                                </tr>
                             
                              </thead>
                            <tbody id="question_list"></tbody>
                             
                             
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include 'add_question.php';?>
		          <!-- modal -->
        
               
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
    
    <script src="assets/js/bootbox.min.js"></script>
   <script src="assets/js/bootbox_functions.js"></script>

    
  </body>
</html>
