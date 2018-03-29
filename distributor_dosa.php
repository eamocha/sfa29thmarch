<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];  $distributor_id=$_REQUEST['distributor_id'];
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		  $("#user_rolesbtn").click(function(){
			  $("#users_table").toggle();
			  });
		 // fetch_clients();
   fetch_users("");///all users in the system
        fetch_user_roles();
 //load select boxes
 		load_users();//the select box to check for day
		///on changing region or any area group
		 
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
                         <h3 class="float_left">Dosa</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                    <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Availability</a> <button class="btn btn-success btn-sm"  data-toggle="collapse" data-target="#roles" id="user_rolesbtn" name="user_rolesbtn" >Others</button>
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   <!--- hid this part----->
                            <div id="roles" class="collapse">
                            <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed '>
                              <thead>
                              <tr>
                                  <th>#</th> <th>Item</th>  
                              </thead>
                              <tbody id="">
                              <?php $q=mysqli_query($mysqli,"SELECT * FROM `tbl_survey_questions` WHERE status=0") or die(mysqli_error($mysqli)); while($row=mysqli_fetch_array($q)){  ?><tr><td><input type="checkbox"></td><td><?php echo $row['question']?></th><?php }?></td>                    </tbody>
                          </table>
                            <a  class="btn btn-success btn-sm" href=""> Save</a>
</div><!----eb=nd roles --->
                          

   <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='tblAppend'>
  <tr class="modal-header "  >
                        <th  >&nbsp;</th>
                        <th  >SKU</th>
                        <th >Pack </th>
                        <th>Type</th>
                        <th >Cases</th>
                        <th >Pieces</th>
                        <th>Action</th>
                      </tr>
                     
                    <?php $i=1; 
					$q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products`  where status=0 order by pack_size desc  ")or die(mysqli_error($mysqli));
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product'];$available=$row['q_available']; $type=$row['pack_type']; $pack=$row['pack_size']; $pid=$row['product_id'];?>
                                     <form id="stock_form<?php echo $pid ?>" class="stock_form" action="save_stock.php?dis_id=<?php  echo $distributor_id?>" method="post">   <tr  >
                        <td ><?php echo $i.$pid?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                       <?php $qu=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `product_id`=$pid and Date(`date_added`)=Date(NOW()) ") or die(mysqli_error($mysqli));
					   $result=mysqli_fetch_array($qu); $stock_id=$result['stock_level_id']; $cases=$result['cases']; $singles=$result['singles']; if(mysqli_num_rows($qu)==1){?><td><?php echo $cases?></td><td><?php echo $singles?></td><td><a href="edit_stock.php?pid=<?php echo $stock_id?>">Edit</a></td><?php } else {?>
                       <td> <input class="validate[required]" type='text' name='crates' size="3" id='crates<?php echo $pid?>' value="0"></td><td><select  name='singles' id='singles<?php echo $pid?>'><script type="text/javascript">for(i=0;i<24; i++){
						   document.write("<option value='"+i+"'>"+ i+"</option>")}</script></select></td><input type="hidden" name="pid" value="<?php echo $pid?>" id="<?php echo $pid?>" /><input type="hidden" name="dealer_id" value="<?php //echo $dealer_id?>" id="<?php ?>" />
                        <td> <input name='save'  id="<?php echo $pid?>" type='submit' value='save'></td><?php }?>
                      </tr>
                 </form>
                     
                                        <?php
										$i++;	}?> 
                      
                      
                          </table>
                          
                           
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php //include 'add_user.php'; include 'add_role.php';?>
		          <!-- modal -->
                  
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
	

	


    
  </body>
</html>
