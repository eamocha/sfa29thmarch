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
	$rid=2//$_REQUEST['rid'];  ?>
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
                         <?php include('submenu.php');?>
                         <h3 class="float_left">Route Name: <?php get_route($rid)?></h3>
                      </div>   
                      
                     <div  style="padding-bottom:20px" class="float_left room-box"><table width="100%" align="left" ><tr>
                       <td>Date:  <?php //echo date("m/d/y")?></td><td align="left">No of outlets in route: <?php //$sel=mysql_query("SELECT count(*) as outlets FROM `tbl_orders` WHERE route_id=$rid   ")or die(mysql_error()); $result=mysql_fetch_array($sel) ; echo $result['outlets'] ?></td>
                     <td>Visited  outlets:  <?php //$sel=mysql_query("SELECT count(*) as outlets FROM `tbl_orders` WHERE route_id=$rid and status=1  ")or die(mysql_error());  $result=mysql_fetch_array($sel) ; echo $result['outlets'] ?></td><td  align="left"></td></tr></table> </div>
                     <!--start -->           
                    <?php $today=date('Y-m-d');
//; include the date bit  AND  DATE(`date_due`)=date(NOW())
 $sel=mysql_query("SELECT o.status as status,o.dealer_id as dealer_id, o.order_id as order_id,date_made,assigned_by,preordered_by FROM `tbl_orders` o LEFT JOIN tbl_dealers d on o.dealer_id=d.dealer_id WHERE  d.route_id=$rid and DATE(date_due)='$today' and o.status !=5") or die(mysql_error());
if(mysql_num_rows($sel)==0) echo '<div class="room-box">Today you dont have any Assigned routes!<br/> <strong>Good Day!!!</strong></div>'; 
else{
while($row=mysql_fetch_array($sel)){
	$visted=$row['status'];
if($visted==1){?><div class="room-box"><?php } else
{?> <div class="room-box notvisited"><?php } ?>
                              <h5 class="text-primary"><a href="client_details.php?oid=<?php echo $oid=$row['order_id']?>&dealer_id=<?php echo $dealer_id= $row['dealer_id']?>"><?php echo business_name($row['dealer_id'])?> </a> </h5><span style="float:right"> <?php if($visted==1){?>   <a href="survey_report.php?dealer_id=<?php echo $dealer_id?>&oid=<?php echo $oid?>"> <span class="btn btn-success "> Visited</span></a><?php } else{?>	<button type="button" onclick="window.location='checkin.php?dealer_id=<?php echo $row['dealer_id']?>&oid=<?php echo $row['order_id']?>'" class="btn btn-danger">CheckIn</button><?php }?></span>
                              <p> The client placed an order on <?php echo $row['date_made'];?> of <?php $order_id=$row['order_id'];  echo order_details($order_id); ?>   </p>
                              <p>  <span class="text-muted">Order by :</span><?php  $pre_by=$row['preordered_by']; $od=mysql_query("SELECT * FROM `tbl_users` WHERE `user_id`=$pre_by"); $rs=mysql_fetch_array($od); echo $rs['full_name']; ?> <span class="text-muted">Assigned by :</span> <?php echo get_name($row['assigned_by'])?> | <span class="text-muted">Order made :</span><?php echo nicetime($row['date_made'])?></p>
                              
                              </div>
	
 <?php }//end while
}//end else?>
 
                         
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

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

	

	
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
