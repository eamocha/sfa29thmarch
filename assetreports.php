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
	//assign_salesperson();
  
        
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
                         <h3 class="float_left">Assets</h3>
                    </div>
                     <div  style="padding-bottom:20px" class="float_left">
                    <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add Asset Type</a>
                     <a data-toggle="modal" class="btn btn-success btn-sm" href="#model"> Add Asset Model</a>
                    </div>
                     <!--start -->      <div>As at <b>  <?php echo date('D dS, M Y', strtotime($date));?></b></div>     
                   <section id="unseen">
                
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th rowspan="2">Region</th>
                                 <?php 
								 $number_of_types=0; $ids=array(); 
								 
								 $q=mysqli_query($mysqli,"SELECT DISTINCT(name) as name FROM `tbl_assets`
ORDER BY `tbl_assets`.`name` ASC")or die(mysqli_error($mysqli));
								$number_of_types= mysqli_num_rows($q) ; while($r=mysqli_fetch_array($q)){
									$ids[]=$r['name']?>
                                  <th colspan="2" ><?php  echo $r['name'];?></th>
                                 <?php }?>
                              </tr>
                              <tr>
                               <?php for($i=0; $i<count($ids);$i++){?>
                                <th >Working</th>
                                <th >Not Working</th><?php }?>
                                </tr>
                             
                              </thead>
                              <tbody id="">
                              <?php $q=mysqli_query($mysqli,"select region_id from tbl_regions where status=0")or die( mysqli_error($mysqli)); while($reg_row=mysqli_fetch_array($q)){
								 $region_id=$reg_row['region_id'];  ?>
                               <tr>
                              
                                <td><?php echo region_name($region_id)?></td>
                                <?php for($i=0; $i<count($ids); $i++){?>
                                <td ><?php echo num_rows2(" tbl_assets a ","  name='".$ids[$i]."'  and a.status=0 and dealer_id in (select dealer_id FROM tbl_dealers where region_id=$region_id and status=0)") ?></td>
                                 <td ><?php echo num_rows2("tbl_assets a right join tbl_asset_status s on s.asset_id=a.asset_id","  name='".$ids[$i]."' and a.status=0 and dealer_id in (select dealer_id FROM tbl_dealers where region_id=$region_id)") ?></td>
                                <?php }?>
                                
                              </tr><?php }// end regions  ?>
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
     <?php include('footer.php'); include('add_asset.php');include('add_asset_model.php');?>
      <!--footer end-->
  </section>
<script src="assets/js/bootstrap.min.js"></script>
	

<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/js/advanced-form-components.js"></script>      
</body>
</html>
