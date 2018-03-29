<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';   $uid=$_SESSION['u_id'];  include "export.html";
		 $id=1;
	$mode="region";
	$link="analyze_outlets.php?demarcation_mode=verified_assets&id=$id&mode=$mode";
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
        
    <link rel="stylesheet" href="assets/css/layout.css">

 
    <script charset="utf-8" src="assets/myscipt/http _cdn.datatables.net_1.10.0_js_jquery.dataTables.js"></script>
     <script charset="utf-8" src="assets/myscipt/http _cdn.jsdelivr.net_jquery.validation_1.13.1_jquery.validate.min.js"></script>
     <script type="text/javascript">

      $(document).ready(function(e) {

		  var url="<?php echo $link?>";
	$("#verified_assets").load(url);
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
                <div class="col-lg-12 ">
                  
                      <!--CUSTOM CHART START -->
                  <div class="border-head">
                        <?php include('submenu.php');?>
                         <h3 class="float_left">Verified assets  List   <span  id="img_icons"><a href="assets_excel.php"><img src="assets/img/excel_icon.gif"></a> | <a href="<?php echo $link?>&send_email"> <img src="assets/img/email_icon.gif" width="19" height="20" alt="Email"></a></span></h3>
                         <?php include "assets_filterForm.php";?>
                      </div>
                                         <span id="verified_assets" ><img src="images/37.gif"/> Loading ...
                            
                            </span>
                           
                              
 

                         
                </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
              
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
   
	


	


    
  </body>
</html>
