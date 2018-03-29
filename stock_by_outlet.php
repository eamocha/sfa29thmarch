<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $dealer_id=$_SESSION['distributor_id']; if(isset($_REQUEST['dealer_id']))$dealer_id =$_REQUEST['dealer_id']; ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		  fetch_clients();
	assign_salesperson();
  
        
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
                         <h3 class="float_left"><?php echo business_name($dealer_id);?> stock levels</h3>
                      </div>
                      
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{
    $date = $_REQUEST['date'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>From </td><td> <input type="text" class="form-control dpd1" name="date"></td><td>&nbsp;</td><td>&nbsp;</td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div>
                     <!--start -->      <div>Stock status as at <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                           <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' >
  <tr class="modal-header "  >
                        <th rowspan="2">Date</th>
                                  <th rowspan="2">Taken By</th>
                                  <th colspan="3"> Calsberg</th>
                                  <th colspan="3" title="number of dealers for this route">Somersby(ml)</th>
                                   <th colspan="3">Tuborg(ml)</th>
                                  <th rowspan="2">Actions</th>
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
                              <tbody>
                             <?php $totalcal1=0;$totalcal2=0;$totalcal3=0;$totaltur1=0;$totaltur2=0;$totaltur3=0;$totalsomer1=0;$totalsomer2=0;$totalsomer3=0; $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$dealer_id")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								
								
                               ?>
                                
                                 <tr>
                                  <td><?php $date_query=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did order by stock_level_id desc limit 1 ")or die(mysqli_error($mysqli)); $result_dat=mysqli_fetch_array($date_query);  $last_d=$result_dat['date_added']; echo date("d.m.Y",strtotime($last_d));
								   ?></td>
                                  <td style="text-transform:capitalize"><?php echo get_name($r['user_id']);?></td>
                                  <td><?php echo stock($did,'singles',27,$date)?></td>
                                  <td><?php echo stock($did,'cases',28,$date)?></td>
                                   <td><?php echo stock($did,'singles',29,$date)?></td>
                                  <td><?php echo stock($did,'cases',30,$date)?></td>
                                   <td><?php echo  stock($did,'singles',31,$date)?></td>
                                   <td><?php echo  stock($did,'cases',32,$date)?></td>
                                   <td><?php echo stock($did,'singles',33,$date)?></td>
                                  <td><?php echo stock($did,'cases',34,$date)?></td>
                                   <td><?php echo stock($did,'cases',35,$date)?></td>
                                  <td ><a href="stock_by_outlet.php?dealer_id=<?php echo $did?>">Comment</a></td>
                              </tr>
                           
                             <?php $i++; }?>
                                 <tr style="font-size:110%; background:#666 !important;  font-weight:500;" >
                               <td>&nbsp;</td>
                               <td style="text-transform:uppercase">Total</td>
                               <td style="font-weight:bold"><?php echo $totalcal1?></td>
                               <td style="font-weight:bold"><?php echo $totalcal2?></td>
                               <td style="font-weight:bold"><?php echo $totalcal3?></td>
                               <td style="font-weight:bold"><?php echo $totaltur1?></td>
                               <td style="font-weight:bold"><?php echo $totaltur2?></td>
                               <td style="font-weight:bold"><?php echo $totaltur3?></td>
                               <td style="font-weight:bold"><?php echo $totalsomer1?></td>
                               <td style="font-weight:bold"><?php echo $totalsomer2?></td>
                               <td style="font-weight:bold"><?php echo $totalsomer3?></td>
                               <td style="font-weight:bold" >&nbsp;</td>
                       </tr>
                
                                       
                      
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
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
	<script src="assets/js/google-maps/maplace.js"></script>
	<script src="assets/js/google-maps/data/points.js"></script>
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	<script>
	    //ul list example
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-list',
	        controls_type: 'list',
	        controls_title: 'Choose a location:'
	    }).Load();
	
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-tabs',
	        controls_div: '#controls-tabs',
	        controls_type: 'list',
	        controls_on_map: false,
	        show_infowindow: false,
	        start: 1,
	        afterShow: function(index, location, marker) {
	            $('#info').html(location.html);
	        }
	    }).Load();
	</script>
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
