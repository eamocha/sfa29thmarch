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
                         <?php include('submenu.php'); 
						 $from="2014-01-23"; $to= date('Y-m-d'); 
						$where="WHERE `made_by`=$user_id order by id desc";
						 if(isset($_REQUEST['submit']))
						 { $from=$_REQUEST['from'];
							 $to=$_REQUEST['to'];
							 $where="WHERE assigned_to=$user_id and DATE(date_visted) between '$from' and  '$to' order by id desc";								
						}?>
                         <h3 class="float_left">My Past routes </h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left"><form method="post" action="<?php  $_SERVER['PHP_SELF']?>"><table ><tr><td>From </td><td> <input type="text" value="<?php echo $from?>" class="form-control dpd1" name="from"></td><td>To</td><td> <input type="text" class="form-control dpd2" name="to" value="<?php echo $to;?>"></td><td><input  class="btn btn-small btn-success" type="submit" name="submit" value="Search" ></td></tr></table> </form> </div>
                     <!--start -->           
                   <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th width="34">No.</th>
                                  <th width="154">Client</th>
                                  <th width="152">Date</th>
                                  <th width="71" >Description</th>
                                  <th width="64" class="numeric">Options</th>
                              </tr>
                              </thead>
                              <tbody>
                            <?php $i=1; 
								
							$q=mysqli_query($mysqli,"SELECT * FROM tbl_route_plan rp Right join tbl_check_in c on c.route_plan_id=rp.id $where")or die(mysqli_error($mysqli));
							 if(mysqli_num_rows($q)==0){ 
							echo '<tr><td colspan=7>None.</td><tr>';} else {
							while($r=mysqli_fetch_array($q)){ //getting route name
							$plan_id=$r['id'];
							?> 
                            <tr>
                                  <td><?php echo $i;?></td>
                                  <td><?php echo business_name($r['dealer_id'])?></td>
                                  <td><?php echo $r['date_visted'];?></td>
                                  <td><?php echo $r['description'];?></td>
                               
                                 
                                
                                   <td ><a href="visit_report.php?dealer_id=<?php echo $r['dealer_id'] ?>&plan_id=<?php echo $plan_id ?>&stock_id=<?php echo 4?>">Details</a></td>
                              </tr><?php $i++; }} //end else and while?>
                               </tbody>
                          </table>
 
 
                         
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
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "fetch_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
	
	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	


    
  </body>
</html>
