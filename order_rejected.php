<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		  fetch_clients();
	assign_salesperson();
  
        
 //load select boxes
 		load_users();
		
		 });
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
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
                         <h3 class="float_left">Upcoming Orders Report</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td width="54">Select Date </td>
                       <td width="188"> <input type="text" class="form-control dpd1" name="date" value="<?php echo $date?>"></td>
                       <td width="177"><input type="text" class="form-control dpd2" name="date2" value="<?php echo $date?>"></td>
                       <td width="114"><button class="btn btn-small btn-success" type="submit" name="submit" >Fetch Info</button></td></tr></table></form> </div>
                     <!--start -->      <div>Orders Between  <b>  <?php echo date('D dS, M Y', strtotime($date));?></b> and <b> <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                   <?php $results=$mysqli->query("SELECT count(*) as t_records FROM `tbl_dealers` where status=0")or die('error');
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); ?><script type="text/javascript">
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var total=<?php echo $total_records->t_records?>;
	var pergroup=<?php echo $items_per_group=100?>;
	var dt=<?php echo strtotime($date)?>;
	loading_data('#results',"data.php?dt="+dt+'&mode=stock_levels',track_load,loading,total_groups,total,pergroup);
		
});
</script>
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th rowspan="2">No</th>
                                  <th rowspan="2">Outlet</th>
                                  <th colspan="3"> Soda</th>
                                  <th colspan="3">MM</th>
                                   <th colspan="3">Dasani</th>
                                  <th rowspan="2">Remarks</th>
                              </tr>
                              <tr>
                                <th>330ml</th>
                                <th>330ml Can</th>
                                <th>500ml Can</th>
                                <th>330ml</th>
                                <th>330ml Can</th>
                                <th>500ml Can</th>
                                <th>330ml</th>
                                <th>330ml Can</th>
                                <th>500ml Can</th>
                                </tr>
                              </thead>
                              <tbody id="results">
                            </tbody>
                               
                          </table>
                    </section>
 
                         
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
	
	
	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
		});
        
       
    </script>
 
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
