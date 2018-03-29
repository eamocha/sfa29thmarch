<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $uid=$_SESSION['u_id']
	
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      <script>load_users()</script>
  
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
                         <h3 class="float_left">All payment details</h3>
                      </div>
                      
                  <div  style="padding-bottom:20px" class="float_left"></div>
                 
<table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead><tr>
                              <th width="17"></th>
                              <th width="98">Dealer/Outlet</th> <th width="65">Total Payments</th><th width="85" class='hidden-phone'>Total Unconfirmed</th>
                              <th width="74" class='hidden-phone'>T. Confirmed </th><th width="67">Received by</th> <th width="52" class='hidden-phone'>Options</th></tr></thead>
                             <tbody> <?php $i=1; $pay_query=mysqli_query($mysqli,"SELECT * FROM `tbl_payments` group by dealer_id")or die(mysqli_error($mysqli)); if(mysqli_num_rows($pay_query)==0){ echo "<tr><td colspan='7'>I have Never recieved any payment transactions </td></tr>";}
							 else{ while($row=mysqli_fetch_array($pay_query)){
								 ?>
                                 <tr>
                                 <td><?php echo $i?></td>
                                 <td style="text-transform:uppercase"><?php $deal= $row['dealer_id']; echo get_client($deal)?></td>
                                 <td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $tt=dealer_total_payments($deal)?></td>
                                 <td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $conf=dealer_total_confirmed($deal)?></td>
                                 <td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $tt-$conf?></td>
                                 <td><?php echo get_name($row['received_by']); ?></td>
                                 <td>
 <a href="collect_cash.php?cid=<?php echo $deal;?>">View</a></td></tr>
								 <?php $i++; }}?>
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
