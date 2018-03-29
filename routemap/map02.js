  function load() {
    if (GBrowserIsCompatible()) {

      // Get map (Version 2)
      var map = new GMap2(document.getElementById("map"));
      // map.setMapType(G_HYBRID_MAP);
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
      map.setUIToDefault(); // Default user interface

      // Get course
      GDownloadUrl("output_xml.php?route_id="+route_id, function(data) {
        var xml = GXml.parse(data);
        var markers = xml.documentElement.getElementsByTagName("marker");
        var points = new Array(0); // For polyline
        // Loop through the markers
        for (var i = 0; i < markers.length; i++) {
          var datetime = markers[i].getAttribute("datetime");
          var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                  parseFloat(markers[i].getAttribute("lng"))); // For markers
          points[i] = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                  parseFloat(markers[i].getAttribute("lng"))); // For polyline
          var marker = createMarker(point, datetime);
          map.addOverlay(marker);
        } // End loop
        // Polyline
        var polyline = new GPolyline(points, "#ff0000", 4);
        map.addOverlay(polyline);
        // Set map centre (to last point), zoom level
        map.setCenter(point, 9);
        // InfoWindow HTML (last marker)
        var html = "";
        html += "<div id=\"infobox\">";
        html += "Last Outlet in the route";
        html += "<br />" + datetime;
        html += "<br />Details of outlet here....";
        html += "</div>";
        map.openInfoWindowHtml(point, html);
      });
    }
  }

  // General markers
  function createMarker(point, datetime) {
    var marker = new GMarker(point, datetime);
    var html = "<div id=\"infobox\">Co-ords: " + point + "<br />" + datetime + "<br /><a href=\"/map/map02\">Re-load map&nbsp;&raquo;</a></div>";
    GEvent.addListener(marker, 'click', function() {
      marker.openInfoWindowHtml(html);
    });
    return marker;
  }