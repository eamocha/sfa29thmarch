<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $pid=clean($_REQUEST['pid']);
	if(isset($_REQUEST['save'])){
		edit_product($pid);} ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
		 
	load_users();//the select box to check for day
		 
		 });
  		  
		  //,get regions
		
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
                         <h3 class="float_left">Sku Details</h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                                  
						 </div>
                     <!--start -->           
                   <section id="unseen">
                  <?php $res = mysqli_query($mysqli,"SELECT * FROM `tbl_products` WHERE product_id=$pid")or die(mysqli_error($mysqli));
  $row = mysqli_fetch_array($res);
  $pid = $row['product_id'];
  $p_name =$row['product'];
  $variant=$row['variant'];
  $qty= $row['q_available'];
  $flavour = $row['flavour'];
  $sku_type = $row['sku_type'];
 $s_price = $row['s_price'];
  $pack_size=$row['pack_size'];
   $pack_type=$row['pack_type'];
    $product_desc=$row['product_desc'];
	$units_in_case=$row['units_in_a_case'];
  ?>
				     <form class="cmxform form-horizontal style-form" action="" id="commentForm"  method="post" >
                                 <table width="100%" id="add_products"><tr>
                                  <td>Product/Brand
                                  <input class=" form-control" id="product" name="product" value="<?php echo $p_name?>"  required ></td>
                                  <td>Variant <select  id="variant" class="form-control" name="variant"><option ><?php echo $variant?></option><?php echo product_variant_selection()?></select>
                                 </td>
                                <td>Flavour
                                        <select  class=" form-control" id="flavour" name="flavour"><option ><?php echo $flavour?></option><?php echo flavours_selection() ?>
                                      </select></td> 
                                                               
                                   <tr>
                                     <td>Pack size
                                   <select class="form-control " id="pack_size"  name="pack_size" ><option><?php echo $pack_size?></option><?php echo pack_size_selection()?></select></td>
                                   
                                      
                                      <td >Package Container
                                   <select class ="form-control " id="pack_type" name="pack_type" required>
                                 <option>  <?php echo $pack_type?></option>
                                          <option value="RGB">RGB</option>
                                          <option value="PET">PET</option>
                                           <option value="Can">Can</option>
                                          <option value="Tetra">Tetra</option>
                                      </select></td>
                                       <td>  SKU Type
                                       <select  class=" form-control" id="sku_type" name="sku_type"><option><?php echo $sku_type?></option><option value="Juice">Juice</option><option value="Soda">Soda</option> <option value="Malt">malt</option><option value="Water">water</option></select>  </td>
                                  </tr>
                                  <tr>
                                    <td> Number per case <input type="number" value="<?php echo $units_in_case?>" name="units_in_a_case" required id="units_in_a_case" class="form-control"  />
                                      </td>
                                    
                                     <td> Price
                                      <input  type="text" class=" form-control"  value="<?php echo $s_price?>" id="s_price" name="s_price" /> 
                                      </td>
                                      
                                      <td >Descrp
                                      <input  type="text" value="<?php echo $product_desc?>" class=" form-control" id="description" name="description" /></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td >  <input  type="reset" class="btn" value="Cancel">
			                          <button  type="submit" name="save" class="btn btn-success">Save</button>
                   </td>
                                  </tr>
                                   
                                </table> 
                                </form>
					
				
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    
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
