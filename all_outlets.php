<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];   ?>
   <script type="text/javascript" src="assets/js/scripts.js" >     </script>
      
    <link rel="stylesheet" href="assets/css/layout.css">

 
    <script charset="utf-8" src="assets/myscipt/http _cdn.datatables.net_1.10.0_js_jquery.dataTables.js"></script>
    <script charset="utf-8" src="assets/myscipt/http _cdn.jsdelivr.net_jquery.validation_1.13.1_jquery.validate.min.js"></script>
       <script charset="utf-8" src="outlets_datajs.js"></script>
       
       
   <!-- end pdf export-->  <?php include "export.html";?>




  <script type="text/javascript" >
	  
      $(window).load(function(e) {
		   $('#delete').click(function(){
		  delete_outlets_in_array();
		   });//end dellete outlets
		//////////////////////////////////types of export
		
		
         });//close the window.load
		 

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
                      <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">List of all outlets 
                          <span  id="img_icons"><img src="assets/img/pdf_icon.gif" onClick ="$('#table_outlets').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});" /> <img onclick="javascript:printDiv('pdfthis')" src="assets/img/print_icon.gif" ><img id="btnExport" src="assets/img/excel_icon.gif" onClick ="$('#table_outlets').tableExport({type:'excel',escape:'false'});"> <img src="assets/img/word_icon.png" width="20px"  onClick ="$('#table_outlets').tableExport({type:'doc',escape:'false'});"/> <img onClick ="$('#table_outlets').tableExport({type:'powerpoint',escape:'false'});" src="assets/img/PowerPoint_icon.png" width="20px"> <img onClick="window.location='inbox.php'" src="assets/img/email_icon.gif"></span>
                         </h3>
                      </div>
                    <table align="left"  ><tr><td align="left"> </td><td></td><td></td></tr></table>      
                   <section id="unseen">
                  <div id="page_container">



      <table  width="100%"  class="table table-bordered table-striped table-condensed" id="table_outlets">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Region</th>
            <th>Area</th>
              <th>S. A</th>
                <th>Distributor</th>
             <th>Route</th>
            <th>Town</th>
             <th>Contact</th>
              <th>Channel</th>
                 <th>Sales FMCG</th>
                  <th>Sales Bevs</th>
             <th>Sales Coke</th>
              <th>Stocked Coke in Past</th>
               <th>Reason for stopping</th>
                 <th>Willingness to stock</th>
                     <th>Willingness Remarks</th>
           
            <th>Lat</th>
             <th>Lon</th>
              <th>Class</th>
            <th>Last Visit</th>
            <th>Actions</th>
                  </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    </div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
                <h2>Add Outlet</h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          <div class="input_container">
            <label for="rank">Rank: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" step="1" min="0" class="text" name="rank" id="rank" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="company_name">Outlet name: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="company_name" id="company_name" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="industries">Industries: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="industries" id="industries" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="revenue">Revenue: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" step="1" min="0" class="text" name="revenue" id="revenue" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="fiscal_year">Fiscal year: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" min="0" class="text" name="fiscal_year" id="fiscal_year" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="employees">Employees: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" min="0" class="text" name="employees" id="employees" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="market_cap">Market cap: <span class="required">*</span></label>
            <div class="field_container">
              <input type="number" step="1" min="0" class="text" name="market_cap" id="market_cap" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="headquarters">Headquarters: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="headquarters" id="headquarters" value="" required>
            </div>
          </div>
          <div class="button_container">
            <button type="submit">Add Outlet</button>
          </div>
        </form>
        
      </div>
    </div>
    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
            Loading, please wait...
          </div>
        </div>
      </div>
    </div>


                    </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  

              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>


 <script src="assets/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	    
            
     
    

  </body>
</html>
