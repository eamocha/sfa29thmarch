<!DOCTYPE html>
 
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> Map of outlets I should visit today</title>
        <style type="text/css">
            h1 { font-size: 24px; }
            h2 { font-size: 18px; }
            #sidebar { float: right; width: 30%; }
            #main { padding-right: 15px; }
            .infoWindow { width: 220px; }
        </style>
       <link href="../assets/css/style.css" rel="stylesheet">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
      
        <script type="text/javascript">
        //<![CDATA[
         
       var map;
 
// Ban Jelačić Square - City Center
var center = new google.maps.LatLng(-1.283333300000000000, 36.816666700000040000);
 
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
 
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer();
 
function init() {
     
    var mapOptions = {
      zoom: 13,
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
     
    makeRequest('get_locations.php', function(data) {
         
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
         
    <h1>Outlets to check  in today</h1>
     
    <form id="services">
        Location: <input type="text" id="start" />
        Destination: <select id="destination" onchange="calculateRoute();"></select>
        <input type="button" value="Display Directions" onclick="calculateRoute();" />
    </form>
     
    <section id="sidebar">
        <div id="directions_panel"></div>
    </section>
     
    <section id="main">
        <div id="map_canvas" style="width: 70%; height: 500px;"></div>
    </section>
     
</body>
</html>