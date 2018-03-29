<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $cid=clean($_REQUEST['cid']);
	
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
                         <h3 class="float_left">Collect cash from: <?php echo get_client($cid) ?></h3>
                      </div>
                      
                  <div  style="padding-bottom:20px" class="float_left"></div>
                   <!--start -->           
                  <table style="background-color:#FFF" >
                             <tr><td>
                                <form class="cmxform form-horizontal" id="commentForm" method="post" action="collect_cash_exec.php?did=<?php echo $cid; ?>">
                                <table id="add_users"><tr>
                                  <td>Currency</td>
                                 <td><select class="form-control" name="currency" id="currency">
                                   <option value="1">Ksh</option>
                                   <option value="2">USD</option>
                                
                                 </select></td>
                                 <td>Amount</td>
                                 <td><input class="form-control " id="amount" type="text" name="amount" required /></td>
                                 <td>Mode of Payment</td>
                                 <td><select class="form-control" name="modeofpayment" id="modeofpayment">
                                   <option value="1">cash</option>
                                   <option value="2">Cheque</option>
                                   <option value="3">Mpesa</option>
                                   <option value="4">Credit Card</option>
                                 </select></td>
                                 <td>Refernce Number</td>
                                 <td><input type="text" class=" form-control" name="ref_no" id="ref_no"></td>
                                 </tr><tr>
                                   <td>  
                                      Description</td><td colspan="7">
                                          <textarea class ="form-control " id="description" name="description" required></textarea>
                                 </td></tr></table>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button class="btn btn-theme" type="submit">Save</button>
                                          <button class="btn btn-theme04" type="button">Cancel</button>
                                    </div>
                                </div>
                            </form>
                                 </td></tr>
                        </table>
                        <h3> Payment history</h3>
<table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead><tr>
                              <th width="17"></th>
                              <th width="104">Date of Payment</th> <th width="53">Amount</th><th width="33" class='hidden-phone'>Ref. No</th><th width="58" class='hidden-phone'>Mode of Payment</th> <th width="88" class='hidden-phone'>Details</th><th width="64">status</th><th width="64" class='hidden-phone'>Options</th></tr></thead>
                             <tbody> <?php $i=1; $pay_query=mysql_query("SELECT * FROM `tbl_payments` WHERE `dealer_id`=$cid")or die(mysql_error()); if(mysql_num_rows($pay_query)==0){ echo "<tr><td colspan='7'>No payment transactions with this Outlet</td></tr>";}
							 else{ while($row=mysql_fetch_array($pay_query)){ $confirmed_by=$row['confirmed_by'];
								 ?><tr><td><?php echo $i?></td><td><?php echo $row['date_time_made'];?></td><td><?php $cur=$row['currency']; if($cur==1) echo 'Kes. '; else echo ' USD'; echo $row['amount'];?></td><td><?php echo $row['Refernce_no'];?></td><td><?php $pay_mode= $row['mode_of_payment']; mode_of_payment($pay_mode)?></td><td><?php echo $row['details'];?></td><td><?php $status=$row['status']; if($status==0) echo 'unconfirmed'; else echo "confirmed by ".get_name($confirmed_by)?></td><td>
 <a href="edit_payments.php?pay_id=<?php echo $row['payment_id'];?>&cid=<?php echo $cid?>">Edit</a></td></tr>
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
