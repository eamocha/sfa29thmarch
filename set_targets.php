<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; 	$route_id=0; $distributor_id=0;$sub_area_id=0;$area_id=0;$region_id=0; 
	$mode=$_REQUEST['mode'];
	if($mode=='region'){ $id=$region_id=$_REQUEST['region_id']; $where= " region_id=$region_id ";$title=region_name($region_id);}//region
		else if($mode=='area'){ $id=$area_id=$_REQUEST['area_id']; $where= " area_id=$area_id ";$title=area_name($area_id);}//area
		else if($mode=='cluster'){ $id=$cluster_id=$_REQUEST['cluster_id']; $where= " cluster_id=$cluster_id ";$title=sub_area_name($cluster_id);}///cluster
		else if($mode=='distributor'){ $id=$distributor_id=$_REQUEST['distributor_id']; $where= " distributor_id=$distributor_id ";$title=distributor_name($distributor_id);}///distributor
				else if($mode=='route'){ $id=$route_id=$_REQUEST['route_id']; $where= " route_id=$route_id ";$title=get_route($route_id);}///distributor
				
				include 'export.html';
		 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		
 //load select boxes
 		load_users();
		
		
		//save the details from the text boxes
  var txt_input=$('input[type=number]').blur(function(e) {
        //`target_id`, `target_user`, `target_added_by`, `date_added`, `qty`, `remarks`, `market_boundary`, `market_boundary_id`, `product_id`, `month`,
       		var value=	$(this).val();
			var pid=$(this).attr('id');
			var field='qty';
			var boundary="<?php echo $mode?>";
			var boundary_id=<?php echo $id?>;
			
			if(value==null||value=='')
			{
				}
				else{
		save_target(field,value,boundary,boundary_id,pid);
			}
    });//number
	
		//save the details from the text boxes
  var txt_input=$('input[type=text]').blur(function(e) {
       
       		var value=$(this).val();
			var pid=$(this).attr('name');//item id
			var field='remarks';
			var boundary="<?php echo $mode?>";
			var boundary_id=<?php echo $id?>;
			
			if(value==null||value=='')
			{
				}
				else{
		  		save_target(field,value,boundary,boundary_id,pid);
			}
    });//number
	
	/////////////
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
                         <h3 class="float_left"><?php echo $title." ".$mode?> Targets    <?php include "common_export_icons.php"?></h3>
                    </div>
                     <div  style="padding-bottom:20px" class="float_left">
                    </div>
                     <!--start -->      <div></div>     
                   <section id="unseen">

                            <table id="content_table" class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr><th>#</th>   <th>SKU</th> <th >Package size</th>  <th >Pack Type</th>  <th ><?php echo date("M")?> Targets</th> <th >Remarks</th> <th >Actions</th> </tr>
                                 </thead>
                              <tbody id="">
                               <?php $i=1;  $mnth=date('m');
					$q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products`  where status=0 order by pack_size desc  ")or die(mysqli_error($mysqli));
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product'];$available=$row['q_available']; $type=$row['pack_type']; $pack=$row['pack_size']; $pid=$row['product_id'];?>
                                     <form id="stock_form<?php echo $pid ?>" class="stock_form" action="" method="post">   <tr  >
                        <td ><?php echo $i?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                      
                       <td> <input class="validate[required]" type='number' name='crates<?php echo $pid?>' size="3" id='<?php echo $pid?>' value="<?php echo getColumnName('tbl_targets','qty', "market_boundary='$mode' and market_boundary_id=$id  and  product_id=$pid and MONTH(target_month)='$mnth'");?>"></td><td><input type="text" id="remarks<?php echo $pid?>" value="<?php echo getColumnName('tbl_targets','remarks', "market_boundary='$mode' and market_boundary_id=$id  and  product_id=$pid");?>" name="<?php echo $pid?>"></td></td><input type="hidden" name="pid" value="<?php echo $pid?>" id="<?php echo $pid?>" /><input type="hidden" name="dealer_id" value="<?php //echo $dealer_id?>" id="<?php ?>" />
                        <td> <input name='save'  id="save_<?php echo $pid?>" type='submit' value='save'></td>
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

     
</body>
</html>
