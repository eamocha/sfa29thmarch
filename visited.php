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
                        <?php include('submenu.php'); $date=$_REQUEST['day']; $tsr=$_REQUEST['user'] ?>
                         <h3 class="float_left">Stock Levels</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                     <?php
if(isset($_REQUEST['submit']))
{ 
    $date = $_REQUEST['date'];
	$tsr=$_REQUEST['tsr'];
	if($tsr=='') $tsr=$_REQUEST['user'];
   }
?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr><td>From </td><td> <input type="text" class="form-control dpd1" value="<?php echo $date?>" name="date"></td><td>TSR</td><td><select  class="form-control sales_person_selection" name="tsr" id="sales_person_selection"></select></td><td><button class="btn btn-small btn-success" type="submit" name="submit" >Search</button></td></tr></table></form> </div>
                     <!--start -->      <div>Stock status as at <b>  <?php echo date('D dS, M Y', strtotime($date));?> as taken by <?php echo get_name($tsr)?></b></div>     
                   <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th rowspan="2">No</th>
                                  <th rowspan="2">Outlet</th>
                                  <th colspan="3"> Calsberg</th>
                                  <th colspan="3" title="number of dealers for this route">Somersby</th>
                                   <th colspan="3">Tuborg</th>
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
			$q=mysql_query("SELECT * FROM `tbl_route_plan` WHERE DATE(`date_visted`)='$date' and visted=1 and `assigned_to`=$tsr group by dealer_id ")or die(mysql_error());if(mysql_num_rows($q)==0){?> <tr><td colspan="12">No details for <?php echo get_name($tsr);?> on <?php echo  $date?></td></tr><?php } else
							while($r=mysql_fetch_array($q)){
								$did=$r['dealer_id'];
								
								$totalcal1 +=stock_individual($did,'singles',27,$date,$tsr);
								$totalcal1 +=stock_individual($did,'cases',27,$date,$tsr)*24;
                                   $totalcal2+= stock_individual($did,'singles',28,$date,$tsr);
								    $totalcal2+= stock_individual($did,'cases',28,$date,$tsr)*24;
                              $totalcal3+=  stock_individual($did,'singles',29,$date,$tsr);
							    $totalcal3+=  stock_individual($did,'cases',29,$date,$tsr)*24;
                                 $totaltur1+= stock_individual($did,'singles',30,$date,$tsr);
								   $totaltur1+= stock_individual($did,'cases',30,$date,$tsr)*24;
                                  $totaltur2+= stock_individual($did,'singles',31,$date,$tsr);
								  $totaltur2+= stock_individual($did,'cases',31,$date,$tsr)*24;
                                  $totaltur3+= stock_individual($did,'cases',32,$date,$tsr)*24;
								   $totaltur3+= stock_individual($did,'singles',32,$date,$tsr);
                                   $totalsomer1+=stock_individual($did,'cases',33,$date,$tsr)*24;
								   $totalsomer1+=stock_individual($did,'singles',33,$date,$tsr);
                                $totalsomer2+=stock_individual($did,'singles',34,$date,$tsr);
								   $totalsomer2+=stock_individual($did,'cases',34,$date,$tsr)*24;
                                 $totalsomer3+=stock_individual($did,'cases',35,$date,$tsr)*24;
								       $totalsomer3+=stock_individual($did,'singles',35,$date,$tsr);
                               ?>
                                
                                 <tr>
                                  <td><?php echo $i;
								   ?></td>
                                  <td style="text-transform:capitalize"><?php echo business_name($did);?></td>
                                  <td><?php echo number_format((stock($did,'singles',27,$date)+stock($did,'cases',27,$date)*24)/24,1)?></td>
                                  <td><?php echo number_format((stock($did,'singles',28,$date)+stock($did,'cases',28,$date)*24)/24,1)?></td>
                                  <td><?php echo number_format((stock($did,'singles',34,$date)+stock($did,'cases',34,$date)*24)/24,1)?></td>
                                   <td><?php echo number_format((stock($did,'singles',29,$date)+stock($did,'cases',29,$date)*24)/24,1)?></td>
                                  <td><?php echo number_format((stock($did,'singles',30,$date)+stock($did,'cases',30,$date)*24)/24,1)?></td>
                                   <td><?php echo  number_format((stock($did,'singles',31,$date)+ stock($did,'cases',31,$date)*24)/24,1)?></td>
                                   <td><?php echo number_format( (stock($did,'singles',32,$date)+stock($did,'cases',32,$date)*24)/24,1)?></td>
                                   <td><?php echo number_format((stock($did,'singles',33,$date)+stock($did,'cases',33,$date)*24)/24,1)?></td>
                                  
                                   <td><?php echo number_format(stock($did,'cases',35,$date)+stock($did,'cases',35,$date),1)?></td>
                                  <td ><a href="stock_by_outlet.php?dealer_id=<?php echo $did?>">View more</a></td>
                              </tr>
                           
                             <?php $i++; }?>
                                 <tr style="font-size:110%; background:#666 !important;  font-weight:500;" >
                               <td>&nbsp;</td>
                               <td style="text-transform:uppercase">Total</td>
                               <td style="font-weight:bold"><?php echo $totalcal1/24?></td>
                               <td style="font-weight:bold"><?php echo $totalcal2/24?></td>
                               <td style="font-weight:bold"><?php echo $totalsomer2/24?></td>
                               <td style="font-weight:bold"><?php echo $totalcal3/24?></td>
                               <td style="font-weight:bold"><?php echo $totaltur1/24?></td>
                               <td style="font-weight:bold"><?php echo $totaltur2?></td>
                               <td style="font-weight:bold"><?php echo $totaltur3?></td>
                               <td style="font-weight:bold"><?php echo $totalsomer1?></td>
                               
                               <td style="font-weight:bold"><?php echo $totalsomer3?></td>
                               <td style="font-weight:bold" >&nbsp;</td>
                             </tr></tbody>
                               
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

    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/bootstrap.min.js"></script>

    <!--script for this page-->
	
	
	
	 	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	
	
 




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>
