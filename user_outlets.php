<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];  $user_id=$_REQUEST['user_id'];
	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     
     
  <script type="text/javascript" >
      $(window).load(function(e) {
		

  id=<?php echo $user_id;?>;
      user_registered_outlets(id)
	  
	  $('#filtersForm').change(function(){
		var filters= $('.filtersForm').serialize();
		 
		get_filteredUserUutlets(getfilterOptions()+"&user_id="+id,"","#user_outlet_list","","user_filtered_outlet_list");
	
		});
	  
		var dt=new Date();
		var w_name=dt.getFullYear()+'.'+ dt.getMonth()+1+'.'+ dt.getDate()+' '+ dt.getHours()+'-'+ dt.getMinutes();
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
               , filename: w_name
            });
		
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
                         <h3 class="float_left">User: <?php echo get_name($user_id);?> (<?php echo num_rows("tbl_dealers"," added_by=".$user_id); ?>)<span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick="javascript:demoFromHTML()" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span></h3>
                            <?php include "filter_form.php";?>
                      </div>
                     
                     <!--start -->           
                   <section id="unseen">
                   
                           <table class="table table-bordered table-striped table-condensed" id="tblExport"><thead><tr><td></td> <th >Outlet Name</th><th>Route</th><th>Distributor</th> <th>S.Area</th><th>Area</th> <th >Channel</th>
                              <th >Decision maker </th>
                              <th >Town/Place</th><th >Phone</th> <th>Reg. Date</th><th >Actions</th></tr></thead>
            <tbody id="user_outlet_list">
                                </tbody>
                            </table>
                    </section>
 
                         
                  </div><!-- /col-lg-12 end -->
          
                  
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

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
