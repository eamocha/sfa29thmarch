<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';   $uid=$_SESSION['u_id'];
	
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
    <script type="text/javascript" >
	  
      $(window).load(function(e) {
		 // fetch_clients();
	//assign_salesperson();
  
        
 //load select boxes
 		load_users();
	
		 });
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
 </script>
 <style>
 .my-sticky-class{
	 color:green;
	 background:#CCC;}
 </style>
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
                         <h3 class="float_left">Add Product Item </h3>
                      </div>
                      <div class="row mb">
              <div class="form-panel">
                          <div class="form">
				     <form class="cmxform form-horizontal style-form"  onSubmit="return false" id="add_products"   >
                                <table id="add_products"><tr>
                                  <td>Produt Name</td>
                                 <td><input class=" form-control" id="p_name" name="p_name" minlength="2" type="text" required /></td>
                                 <td>Product Code</td><td><input class="form-control " id="p_code" type="text" name="p_code" /></td>
                                 <td> Brand</td><td><input class="form-control " id="p_brand" type="p_brand" name="text" /></td>
                              </tr>
                               <tr>
                                 <td>Suggested Price</td>
                                 <td><input  type="text" class=" form-control" id="s_price" name="s_price"></td>
                                 <td>Tax</td>
                                 <td><input type="text"  class=" form-control" id="p_tax" name="p_tax"></td>
                                 <td>Discount</td>
                                 <td><input class="form-control "  id="p_discount" type="text" name="p_discount" /></td>
                                 </tr><tr>
                                     <td>Product image</td><td><div style="position:relative;">
<div id="file" style="position:absolute; padding-left:5px">Select Image</div>
<input type="file" name="file" size="10" class="form-control"  style="opacity:0; width:15px; z-index:1;" onchange="document.getElementById('file').innerHTML = this.value;" />
</div></td><td>Q. Available</td><td><input type="text" class="form-control" name="q_available" id="q_available"></td> <td>  
                                      Description</td><td>
                                          <textarea class ="form-control " id="p_desc" name="p_desc" required></textarea>        </td>
                                 </tr>
                                </table>
                                 <div class="form-group"><input type="hidden" value="1" name="user_id" id="user_id"/>
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button class="btn btn-theme" onClick="add_product()" type="submit">Save</button>
                                          <button class="btn btn-theme04" type="button">Cancel</button>
                                    </div>
                                </div>
                            </form></div></div>
 </div>

                         
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
	
		
	<script type="application/javascript">
        $(document).ready(function () {
			  fetch_inventory();
           
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    	
	
	


    
  </body>
</html>
