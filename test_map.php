<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user=clean($_REQUEST['uid']);?>
       <style> #mapsidebar { float: right; width: 30%; }
            #mapmain { float:left; padding-right: 15px; }
            .infoWindow { width: 220px; }
			</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
      
        <script type="text/javascript">
        //<![CDATA[
       var user_id=<?php echo $user ?>;
	 //  alert (user_id);
       var map;
// Ban Jelačić Square - City Center
var center = new google.maps.LatLng(-1.283333300000000000, 36.816666700000040000);
 
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer();
 
function init() {
     
    var mapOptions = {
      zoom: 11,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
     
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
     
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById('directions_panel'));
     
    // Detect user location
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
             
            var userLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
             
            geocoder.geocode( { 'latLng': userLocation }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    document.getElementById('start').value = results[0].formatted_address;
                }
            });
             
        }, function() {
            alert('Geolocation is supported, but it failed');
        });
    }
	//alert(user);
     
    makeRequest('get_locations.php?uid='+user_id, function(data) {
         
        var data = JSON.parse(data.responseText);
        var selectBox = document.getElementById('destination');
         
        for (var i = 0; i < data.length; i++) {
            displayLocation(data[i]);
            addOption(selectBox, data[i]['business_name'], data[i]['town']);
        }
    });
}
 
function displayLocation(location) {
 
    var content =   '<div class="infoWindow"><strong>'  + location.business_name + '</strong>'
                    + '<br/>'     + location.town
                    + '<br/>'     + location.phone + '</div>';
     
    if (parseInt(location.latitute) == 0) {
        geocoder.geocode( { 'address': location.town }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                 
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: location.business_name
                });
                 
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                });
                 
                /* Save geocoding result to the Database*/
                var url =   'set_coords.php?dealer_id=' + location.dealer_id
                            + '&latitute=' + results[0].geometry.location.latitute()
                            + '&longtitute=' + results[0].geometry.location.longtitute();
                 
                makeRequest(url, function(data) {
                    if (data.responseText == 'OK') {
                        // Success
                    }
                });
            }
        });
    } else {
         
        var position = new google.maps.LatLng(parseFloat(location.latitute), parseFloat(location.longtitute));
        var marker = new google.maps.Marker({
            map: map,
            position: position,
            title: location.business_name
        });
         
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(content);
            infowindow.open(map,marker);
        });
    }
}
 
function addOption(selectBox, text, value) {
    var option = document.createElement("OPTION");
    option.text = text;
    option.value = value;
    selectBox.options.add(option);
}
 
function calculateRoute() {
     
    var start = document.getElementById('start').value;
    var destination = document.getElementById('destination').value;
     
    if (start == '') {
        start = center;
    }
     
    var request = {
        origin: start,
        destination: destination,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}
 
function makeRequest(url, callback) {
    var request;
    if (window.XMLHttpRequest) {
        request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
    } else {
        request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
    }
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            callback(request);
        }
    }
    request.open("GET", url, true);
    request.send();
	
}
        </script>
  </head>

<body onload="init();">

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
          <section class="wrapper site-min-height">
	         <table width="100%" ><tr><td > <?php include('submenu.php');?><td></td></td>
             </tr><tr><td colspan="2">
             <h3><?php echo get_name($user);?>: the <?php $date=date("Y-m-d"); echo all_dealers_in_route($user,$date);?> outlets to check  in today</h3>
     
    <form id="services">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user ?>"/>
        Location: <input type="text" id="start" />
        Destination: <select id="destination" onchange="calculateRoute();"></select>
        <input type="button" value="Display Directions" onclick="calculateRoute();" />
    </form></td>
     </tr>
<tr>
     
   <td width="70%" valign="top"> <section id="map_main">
        <div id="map_canvas" style="width: 100%; height: 500px;"></div>
    </section></td><td width="30%" valign="top"><section id="map_sidebar">
        <div id="directions_panel"> <?php ?></div>
    </section></td></tr>
    </table>
     
        <!-- page end-->
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
   
    <script src="assets/js/bootstrap.min.js"></script>



    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
	
	
	
  </body>
</html>
