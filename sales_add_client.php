<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php'; ?>
    <!-- autocomplet in google -->
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
	 <script type="text/javascript" src="assets/js/scripts.js" >
      </script>
      <script type="text/javascript" >
	   
	   var autocomplete;
        function initialize() {
        autocomplete = new google.maps.places.Autocomplete(
           /** @type {HTMLInputElement} */(document.getElementById('town')), { types: ['geocode'] });
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
              });
		}
	
	  function display_nosupport_message()
{
	if(!navigator.geolocation)
	{
		$('#show').text('Your browser does not support HTML 5 geolocation. ');
		window.location("w.php");
	}
}
	 $(document).ready(function(){
		    display_nosupport_message();
	if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
    var x=position.coords.latitude;
     var y= position.coords.longitude;
		 $("#lat").val(x);$("#long").val(y);
    }); }//end if
		  });
      </script>
      
  </head>

  <body onLoad="initialize();">

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
                         <h3 class="float_left">Add outlet </h3>
                      </div>
               
                  
         <section id="unseen">
                  <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal">Add Outlet</a> <?php include 'add_client_form.php';?>
                    
                            <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='example2'><thead><tr> <th width="2%" >No.</th><th width="17%">Outlet Name</th> <th width="11%">Channel</th>
                              <th width="21%">Decision maker &amp; Designation</th>
                              <th width="17%" >Town/Place</th><th width="10%" >Phone</th> <th width="11%" >Visits</th><th width="11%" >Actions</th></tr></thead>
            <tbody id="clients_list">
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
     <?php include('footer.php');?>
      <!--footer end-->
  </section>
    <script src="assets/js/bootstrap.min.js"></script>

	

    <!--script for this page-->
    

  
    <script type="text/javascript">
    

      $(document).ready(function() {
          fetch_clients();
		  select_routes(); 
        
      } );
  </script>
  </body>
</html>
