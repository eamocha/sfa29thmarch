<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';   $uid=$_SESSION['u_id']; 
	
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
                        <?php include('submenu.php');?>
                         <h3 class="float_left">My Presales  </h3>
                      </div>
                      
                  <div  style="padding-bottom:20px" class="float_left"></div>
                   <!--start -->           
                  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                              <tr>
                                  <th width="34">No.</th>
                                  <th width="150">Outlet</th>
                                  <th width="309">Description</th>
                                   <th width="82" class="numeric">Date Made</th>
                                  <th width="73" >Date Due</th>
                                   <th width="98" >Status</th>
                                  <th width="64" class="numeric">Options</th>
                              </tr>
                             </thead>
                             <tbody>
                            <?php
							$role=$_SESSION['user_role'];
			$region_id=$_SESSION['region_id'];
		$distributor_id=$_SESSION['distributor_id'];
		$area_id=$_SESSION['area_id'];
		$cluster_id=$_SESSION['cluster_id'];
			$where=" status=0 ";
		switch($role){
			case 1:$where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where region_id=$region_id)"; break;
			case 2:$where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where area_id=$area_id)"; break;
			case 3:$where.=" and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where area_id=$area_id)"; break;
			case 4:$where.=" "; break;
			
			case 5:$where.=" and role_id!=4 and role_id!=2 and role_id!=3"; break;
			case 8:$where.=" and role_id=6"; break;
			default: $where.=" and and  dealer_id IN (SELECT dealer_id FROM tbl_dealers where cluster_id=$cluster_id)"; break;
			}
			 $i=1; $q=mysqli_query($mysqli,"SELECT `order_details_id`, `product_id`, `cases`, `pieces`, `made_by`, `date_added`, `dealer_id`, `date_supplied`, `supplied_by`, `status` FROM `tbl_orders_details` WHERE $where") or die(mysqli_error()); if(mysqli_num_rows($q)==0){ echo "<tr><td colspan=7> No unprocessed Preorders.<a href='sales_clients_list.php'> Make preorder</a></td></tr>";} else{ while($r=mysqli_fetch_array($q)){
								?>  <tr>
                                  <td><?php echo $r['order_details_id'];?></td>
                                  <td><?php echo business_name($r['dealer_id'])?></td>
                                  <td class=""><?php echo $r['cases'];//order_details($r['order_id'])?></td>
                                  <td class=""><?php echo record_date($r['date_added'])?></td>
                                  <td class=""><?php echo record_date($r['date_supplied'])?></td>
                                  <td class=""><?php switch($r['status']){ 
								  case 0:
								  echo 'unconfirmed'; 
								  break;
								  case 1:
								  echo 'Delivered'; 
								  break;
								  case 2: 
								  echo 'Confirmed'; 
								  break;
								  case 3:
								  echo "Assigned to: ";
								  echo get_name($r['assigned_to']); 
								  break;
								  case 4: 
								  echo 'Rejected'; 
								  break;
								  case 5: 
								  echo 'Rejected'; 
								  break;
								  }?></td>
                                  <td class=""><?php if( $r['status']!=1 || $r['status']!=5)?><a href="preorder.php?dealer_id=<?php echo $r['dealer_id'] ?>&oid=<?php echo $r['order_details_id'];?>">View</a></td>
                               </tr><?php $i++; } }//end the else?>
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
	
	<script type="text/javascript">
  /*      $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to King Beverage DMS!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Developed by cloud connect',
            // (string | optional) the image to display on the left
            image: 'assets/img/eric.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	*/</script>
	
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
	





 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
