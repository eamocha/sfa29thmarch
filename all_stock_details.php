<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; include 'export.html';
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
      $(window).load(function(e) {
	    fetch_product();
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
                         <h3 class="float_left">Products  <?php include 'common_export_icons.php'?></h3>
                      </div>
                     <div  style="padding-bottom:20px" class="float_left">
                   <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal"> Add products</a>
                  <select id="p_name" name="p_name" minlength="2"  required ><option>Dasani</option><option>Novida</option><option>Minute Maid</option><option>Soda</option></select> | <select   id="type2" name="type2"><option>CocaCola</option><option>Diet Coke</option><option>Coke Zero</option><option>Coca Cola Life</option><option>Cherry Coke</option><option>Caffeine-free Diet Coke</option><option>Vanilla Coke</option><option>Cherry Coke Zero</option>
                                      </select> | <select  id="p_code"  name="p_code" ><option value="">Select size</option><option>200ml</option><option>300ml</option><option>500ml</option><option> One Liter</option><option>1.2 litres</option><option>1.5 litres</option><option>2 litres</option><option> 3 Litres</option></select>
						 </div>
                     <!--start -->           
                   <section id="unseen">
                   
                             <table id="content_table" class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th >SKU</th>
                                  <th >Variant</th>
                                  <th >Flavour</th>
                                   <th >Pack size</th>
                                   <th >Type </th>
                                  <th >Category</th>
                                  <th >Price</th>
                                  <th >units/case</th>
                                  <th>Options</th>
                              </tr>
                              </thead>
                            <tbody id="product_list">
                          <tr><td colspan="10">Loading  <img src="images/37.gif"></td></tbody>
                             
                             
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
		          <!-- Modal -->
	
		                    <?php include 'add_product_form.php';?>
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

   
    <script src="assets/js/bootstrap.min.js"></script>
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

	
 <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
	


    
  </body>
</html>
