<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id'];  include 'export.html';
	$cluster_id=0;	$area_id=0;  $region_id=0; $mode=$_REQUEST['mode']; $id=0;
	
	if($mode=='region'){ $id=$region_id=$_REQUEST['region_id']; $where= " region_id=$region_id ";$title=region_name($region_id)." Region";}//region
		else if($mode=='area'){ $id=$area_id=$_REQUEST['area_id']; 
		$where= " area_id=$area_id ";$title=area_name($area_id)." Area";}//area
		else if($mode=='cluster'){ $id=$cluster_id=clean($_REQUEST['cluster_id']); $where= " cluster_id=$cluster_id ";$title=sub_area_name($cluster_id)." Sub Area";}///cluster
else if($mode=='route'){ $id=$route_id=clean($_REQUEST['route_id']); $where= " route_id=$route_id ";$title=get_route($route_id)." Route";}///routes
		
	else if(isset($_REQUEST['distributor_id'])) {$id=$distributor_id= $_REQUEST['distributor_id']; $where= " distributor_id=$distributor_id "; $title=distributor_name($distributor_id)." Distributor";}  else goback(); ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
     
     
  <script type="text/javascript" >
      $(window).load(function(e) {
		  
		   $('#route_selection').change(function(){
			   migrate_outlets_from_route_to_route();
		    });
		
		 var demarcation="<?php echo $mode?>";
		  var id="<?php echo $id?>";
      fetch_region_clients(demarcation,id) 
	  
	   $('#filtersForm').change(function(){
		//var filters= $('.filtersForm').serialize();
		get_filteredAjax4outlets(getfilterOptions()+"&id="+id,"","#region_outlet_list",demarcation,"filter_clients");
		//fetch_region_clients(getfilterOptions()+"&id="+id+"&mode="+mode,id);
		});

 		
		///////////
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
		 
		 
		 
  function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		  }
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
                  <div class="col-lg-12 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left"><?php echo $title?> Outlets <?php include 'common_export_icons.php'?></h3>
                       <?php include "filter_form.php";?>
                      </div>
                     
                     <!--start -->           
                   <section id="unseen">
                   
                           <table width="100%" class='"table table-bordered table-striped table-condensed ' id="tblExport"><thead><tr><td></td> <th>Outlet Name</th><th>Route</th><th>Distributor</th> <th>S.Area</th><th>Area</th><th >Channel</th>
                              <th >DM</th>
                              <th >Town/Place</th><th>Land Mark</th><th>Phone</th> <th><select id="route_selection"><option>Move to</option><?php route_selection()?></select></th><th >Actions</th></tr></thead>
            <tbody id="region_outlet_list">
            <tr> <td colspan="16"><img src="images/37.gif"/></td></tr>
                                </tbody>
                            </table>
                    </section>
 
                         
                  </div><!-- /col-lg-12 END SECTION  -->
                  
		     
                  
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
