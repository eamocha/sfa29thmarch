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
	
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      <script type="text/javascript">
      function selected_day(){
		   $("#clients_list").empty();
			 var sel_day=document.getElementById('day').value;
			 var sel_user=document.getElementById('user').value;
		 n= outlets_in_day(sel_day,sel_user); //alert(n);
		 
		  }
		  $(document).ready(function(e) {
            load_users();
			//quick plan
			 $(".pg").click(function() {
            var status = $(this).attr('id');
          alert(status);
    });
			
			//quick_plan();
			
			
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
                         <h3 class="float_left">Verified Outlets List</h3>
                      </div>
                      
                   <div  style="padding-bottom:20px" class="float_left">
                     <?php
					 function day($day){
						 switch($day){
							 case 1: return "Monday"; break; case 2: return "Tuesday"; break; case 3: return "Wednesday"; break; case 4: return "Thursday"; break; case 5: return "Friday"; break; case 6: return "Satuday"; break; case 7: return "Sunday"; break;}
						 } $date=date("Y-m-d");
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['day'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>From </td><td>
 <select class="form-control" onchange="selected_day();" name="day" id="day"><option value="All">All days</option><option value="mon">Monday</option><option value="tue">Tuesday</option><option value="wed">wednesday</option><option value="thur">Thursday</option><option value="fri">Friday</option><option value="sat">Satarday</option><option value="sun">Sunday</option></select></td><td><select onchange="selected_day();" class="form-control sales_person_selection" id="user"></select></td><td>&nbsp;</td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div></span>
                     <!--start -->      <div >Outlets for <strong id="list_title"></strong></div>  
                   <!--start -->           
                <table class="table table-bordered table-striped table-condensed" ><thead><tr><th>#</th> <th >Outlet Name</th> <th >Longtitute</th><th>Latitute</th>
                              <th>DM</th>
                              <th  >Location</th><th >Phone</th> <th  >status</th><th class="pg" >Actions</th></tr></thead>
            <tbody id="clients_list">
                                </tbody>
                            </table>
  
  <?php include 'qplan.php';?>
 
                         
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

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>

  
	
	<script type="application/javascript">
        $(document).ready(function () {
			var day="<?php echo $date; ?>";
			fetch_clients_inday(day);
            
           
        });
        
        
       
    </script>
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	





 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
