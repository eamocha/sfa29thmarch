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
		  fetch_availabilitycheck();
		$("#submit").click(function(e) {
              save_stock_availability_check();
        });

        
 	
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
                  <div class="col-lg-12">
                  
                      <!--CUSTOM CHART START -->
                    <div class="border-head">
                      <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Outlet Stocking</h3>
                    </div>
                     <div  id="form_content" style="padding-bottom:20px" class="float_left">
                     <form id="stock_settingForm" method="post" name="stock_settingForm" action="">
                   <table>
                      <tr>
                              
                                <td><label>SKU Pack</label><select id="sku" name="sku"><?php echo availability_check_skus()?></select></td>
                           <td><label>Dealer Type</label><select id="dealer_type" name="dealer_type"><option value="Outlet">Outlet</option><option value="Distributor">Distributor</option></select></td>
                        <td ><label>Dealer Channel</label><select id="channel" name="channel"><?php echo category_select_list()?></select></td>                                <td ><label>Gold Minimum</label> <input  size="5"  type="text" required id="gqty" name="gqty"/></td>
                        <td ><label>Gold Score</label>
                        <input size="5" type="text" required id="gscore" name="gscore" value="0"/></td>
                        <td><label>Silver Minimum</label> <input value="0" size="5"  type="text" required id="sqty" name="sqty"/></td>
                        <td><label>Silver Score</label>
                        <input  size="5" value="0"  type="text" required id="sscore" name="sscore"/></td>
                        <td><label>Bronze Minimum</label> <input value="0" size="5"  type="text" required id="bqty" name="qtyb"/></td>
                        <td><label>Bronze Score</label>
                        <input  size="5"  type="text" required value="0" id="bscore" name="bscore"/></td>
                        <td><label>Others Minimum </label><input  value="0" size="5"  type="text" required id="oqty" name="oqty"/></td>
                        <td><label>Other Score</label>
                        <input  size="5" value="0" type="text" required id="oscore" name="oscore"/></td>
                       <td valign="bottom"><input type="button" id="submit" name="submit" value="Save"/></td>
  </tr></table></form>
                     
                    </div>
                     <!--start -->      <div></div>     
                   <section id="unseen">

                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                <th rowspan="2">#</th>
                                 <th rowspan="2">SKU</th>
                                 <th rowspan="2" >Dealer</th>
                                <th rowspan="2" >Channel</th>
                                  <th colspan="4" >Min. Number</th><th colspan="4" >Score</th>
                                <th rowspan="2" >Actions</th>
                                </tr>
                              <tr>
                                <th >Gold</th>
                                <th >Silver</th>
                                <th >Bronze</th>
                                <th >Other</th>
                                <th >Gold</th>
                                <th >Silver</th>
                                <th >Bronze</th>
                                <th >Other</th>
                                </tr>
                             
                              </thead>
                              <tbody id="availability_check_list">
                               <tr>
                              
                                <td colspan="13">Loading <img src="images/37.gif"></td>
                               
                              </tr>
                            </tbody>
                               
                          </table>
                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
               
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php'); //include('add_competitor.php');?>
      <!--footer end-->
  </section>
<script src="assets/js/bootstrap.min.js"></script>
 
 <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
  
</body>
</html>
