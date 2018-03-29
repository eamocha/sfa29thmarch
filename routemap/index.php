
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Route on map</title>
<?php $route_id=$_REQUEST['route_id'];?>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key= AIzaSyA7RJ9f7VE7qbFspvE8_c67EHoN5sG6kS4" type="text/javascript"></script><script>
var route_id=<?php echo $route_id ?>;</script>
<script src="map02.js" type="text/javascript"></script>

<script src="/mint/?js" type="text/javascript"></script>
</head>

<body onload="load()" onunload="GUnload()">

<div id="map" style="margin: 10px; border: 1px solid #000; width: 900px; height: 600px"></div>

<p>Route Map</p>



<script type="text/javascript">
<!--
document.write('<img src="/cgi-bin/axs/ax.pl?mode=img&ref=');
document.write( escape( document.referrer ) );
document.write('" height="1" width="1" style="display:none" alt="" />');
// -->
</script><noscript>
<img src="/cgi-bin/axs/ax.pl?mode=img" height="1" width="1" style="display:none" alt="" />
</noscript>

<!-- Not tracked as bot //-->
<!-- Has user agent //-->
<!-- TrackBots V 2.0 Patrick Taylor //-->

</body>
</html>