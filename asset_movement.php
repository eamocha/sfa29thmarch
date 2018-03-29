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
                <div class="col-lg-12 main-chart">
                  
                      <!--CUSTOM CHART START -->
                  <div class="border-head">
                        <?php include('submenu.php');?>
                         <h3 class="float_left">Assets that require attention </h3>
                      </div>
                      
                   <table id="content_table" class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr>
                                  
                                  <th>#</th>
                                       <th>Assect Code</th> 
                                       <th>Move from</th>
                                  <th>Move to</th>
                                  <th>Recommended by</th>
             
                                  <th>Aproved by</th>
                             
                                   <th>Moved by</th>     
                                   <th>date recommended</th>
                                   <th>Reason</th>
                                    <th>Remarks</th>
                                     <th>Action</th>
                                    
                                
                                  
                              </tr>
                              </thead>
                              <tbody id="assets_list">
                              <?php $i=1; $role=$_SESSION['user_role']; $myregion=$_SESSION['region_id']; $myArea=$_SESSION['area_id'];$cluster_id=$_SESSION['cluster_id'];$distributor_id=$_SESSION['distributor_id'];
	$where=" status=0 ";
	switch($role){
		case 4: $where=" status=0 "; break;//cm
		case 2: $where=" region_id=$myregion and status=0 "; break;//rm
		case 3: $where=" recommended_by IN (select user_id from tbl_users where area_id=$myArea) and status=0 "; break;//arm
		case 1: $where=" cluster_id=$cluster_id and status=0 "; break;//AD
		
		case 7: $where=" distributor_id=$distributor_id and status=0 ";//AD
	}
	$q=$mysqli->query("SELECT `move_id`, `date_moved`, `asset_id`, `from_outlet`, `to_outlet`, `recommended_by`, `approved_by`, `authorized_by`, `moved_by`, `date_recommended`, `reason`, `remarks`, `status` FROM `tbl_asset_movement` WHERE $where")or die($mysqli->error);
	while($r=mysqli_fetch_array($q))
	{?>
	<tr><td><?php echo $i?></td><td><?php echo get_asset_name ($r['asset_id'])?></td><td><?php echo business_name($r['from_outlet'])?></td><td><?php echo business_name ($r['to_outlet'])?></td><td><?php echo get_name($r['recommended_by'])?></td><td><?php echo get_name($r['approved_by'])?></td><td><?php echo get_name($r['moved_by'])?></td><td><?php echo ($r['date_recommended'])?></td><td><?php echo $r['reason']?></td><td><?php echo $r['remarks']?></td><td><select id="approve_reject" name="approve_reject"><option>Approve</option> <option value="Reject">Reject</option></td></tr><?php $i++;} ?>
                           
                              </tbody>
                            
                             
                             
                          </table>
 

                         
                </div><!-- /col-lg12END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                
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
    <script src="assets/js/jquery.sparkline.js"></script>

   
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
			  fetch_inventory();
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
