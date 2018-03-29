<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $route_id=$_REQUEST['route_id'];  ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		
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
                         <h3 class="float_left">Route Targets</h3>
                    </div>
                     <div  style="padding-bottom:20px" class="float_left">
                    </div>
                     <!--start -->      <div></div>     
                   <section id="unseen">

                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr><th>No</th>
                                <th>SKU</th>
                                <th >size</th>
                                
                                <th >Pack Type</th>
                                <th >Target</th>
                                <th >Remarks</th>
                                <th >Actions</th>
                                </tr>
                             
                              </thead>
                              <tbody id="">
                               <?php $i=1; 
					$q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products`  where status=0 order by pack_size desc  ")or die(mysqli_error($mysqli));
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product'];$available=$row['q_available']; $type=$row['pack_type']; $pack=$row['pack_size']; $pid=$row['product_id'];?>
                                     <form id="stock_form<?php echo $pid ?>" class="stock_form" action="" method="post">   <tr  >
                        <td ><?php echo $i.$pid?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                      
                       <td> <input class="validate[required]" type='text' name='crates' size="3" id='crates<?php echo $pid?>' value="0"></td><td><input name="remarks"></td></td><input type="hidden" name="pid" value="<?php echo $pid?>" id="<?php echo $pid?>" /><input type="hidden" name="dealer_id" value="<?php //echo $dealer_id?>" id="<?php ?>" />
                        <td> <input name='save'  id="<?php echo $pid?>" type='submit' value='save'></td>
                      </tr>
                 </form>
                     
                                        <?php
										$i++;	}?> 
                          
                            </tbody>
                               
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
     <?php include('footer.php'); include('add_competitor.php');?>
      <!--footer end-->
  </section>
<script src="assets/js/bootstrap.min.js"></script>
	

<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/js/advanced-form-components.js"></script>      
</body>
</html>
