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
		//  fetch_clients();
	///assign_salesperson();
  
        
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
                         <h3 class="float_left">Photos list</h3>
                    </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr>
                       <td width="54"> Select Year</td>
                       <td width="93"> <input type="text" class="form-control dpd1" name="date" value="<?php echo $date?>"></td>
                       <td width="93"><input type="text" class="form-control dpd2" name="date2" value="<?php echo $date?>"></td>
                       <td width="177"><button class="btn btn-small btn-success" type="submit" name="submit" >Fetch Info</button></td>
                       <td width="114">&nbsp;</td></tr></table></form> 
                     </div>
                     <!--start -->      <div>As at <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
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
                            <table style="margin:auto; padding:10px" width="">
 <?php $unaivailale='';
 
 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_photos` where 1")or die(mysqli_error($mysqli)); 
 
	while($r=mysqli_fetch_array($q)){
		?><tbody id="results">
                            
		<tr><td style="margin:auto; padding:10px"><img src="<?php echo $r['image']?>" width="250px" height="250px"  alt="No image"/></td><td style="margin:auto; padding:10px"><img width="250px" src="<?php echo $r['image']?>" height="250px"  alt="No image"/></td><td style="margin:auto; padding:10px"><img width="250px" height="250px"  src="<?php echo $r['image']?>"  alt="No image"/><br/>
        <div class="description">Taken on: <br/>
         uploaded by:<br/>
         Outlet:</div></td></tr>
		<?php
		
		 }
	?></tbody></table> 
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
