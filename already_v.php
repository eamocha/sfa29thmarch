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
     ?><script type="text/javascript" src="assets/js/scripts.js" >     </script>
     <script type="text/javascript" src="assets/js/pdf/jspdf.debug.js"></script>
	<script type="text/javascript" src="assets/js/pdf/pdf_functions.js"></script>
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

              <div class="row" id="pdfthis">
                  <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head " id="dontpdf">
                         <?php include('submenu.php');?>
                         <h3 class="float_left">Already Visited outlets - <?php echo date_title($today_constant);?> 
                         <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img src="assets/img/excel_icon.gif"> </span></h3>
                         
                      </div>   
                      
                     <div  style="padding-bottom:20px" class="float_left room-box">
                     <table  width="100%" ><tr>
                     <td>select date</td><td> <input type="text" name="select date" value="<?php echo $today=date('Y-m-d',strtotime($today_constant));?>"> </td><td>Already Visited </td><td> <?php echo already_visted($user_id,$today) ?></td><td>Canceled</td>
                     <td><?php echo cancelled_route($user_id,$today)?></td>
                     <td>View on Map&gt;&gt;</td>
                     <td><a href="google_maps.php?uid=<?php echo $user_id?>"><img src="assets/img/google_maps.png" width="20" ></a></td>
                     </tr></table>
                      </div>
                     <!--start -->           
                   <section id="pdfthis">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th width="20">No</th>
                                  <th > Outlet Name</th>
                                  <th >Stock taken</th>
                                  <th >Merchandized</th>
                                  <th >Order made</th>
                                 <th  >Actions</th>
                                 
                              </tr>
                              </thead>
                              <tbody>
                              <?php $i=1; $q=mysql_query("SELECT * FROM `tbl_route_plan` rp LEFT JOIN tbl_dealers d on d.dealer_id=rp.dealer_id WHERE `assigned_to`=$user_id and DATE(`startdate`)='$today' and visted=1")or die(mysql_error());
                              if($num=mysql_num_rows($q)==0) {} else{
								  while($row=mysql_fetch_array($q)){
									  $taken=$row['stock_taken']; if($taken==0) $taken= 'No'; else  $taken= 'Yes';
									  $merchandized=$row['merchandized'];if($merchandized==0) $merchandized= 'No'; else  $merchandized= 'Yes';
									  $ordered=$row['order_done'];if($ordered==0) $ordered= 'No'; else  $ordered= 'Yes';
									  echo '<tr><td>'. $i.'</td><td> '.$row['business_name'].'</td><td>'. $taken.'</td><td>'.$merchandized.'</td><td>'.$ordered.'</td><td><a href="">Report</a></td></tr>';}}?>
                               </tbody>
                          </table>
                          </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->       <span id="dontpdf">           
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?></span>
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

