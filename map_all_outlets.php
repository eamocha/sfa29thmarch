<!DOCTYPE html>
<html>
<head>
<?php include 'header.php'; if(!isset($_SESSION['u_id'])){ header("location:login.php");}  


?>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;key=AIzaSyA7RJ9f7VE7qbFspvE8_c67EHoN5sG6kS4"> </script>
<script type="text/javascript" src="assets/js/scripts.js"></script>
<?php 
$region_id=$_SESSION['region_id']; $latCenter=-1.283333300000000000; $longCenter=36.816666700000040000
?> 
<script type="text/javascript">
latCenter=-1.283333300000000000; longCenter=36.816666700000040000
$(document).ready(function() {
var user_id = <?php echo $_SESSION['u_id'] ?>;
//icon
var circle ={
    path: google.maps.SymbolPath.CIRCLE,
    fillColor: 'red',
    fillOpacity: .7,
    scale: 6.5,
    strokeColor: 'white',
    strokeWeight: 1
};

 var mapCenter = new google.maps.LatLng(latCenter,longCenter ); //Google map Coordinates
	var map;
	
	map_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
	function map_initialize()
	{
			var googleMapOptions = 
			{ 
				center: mapCenter, // map center
				zoom: 9, //zoom level, 0 = earth view to higher value
				//maxZoom: 18,
				//minZoom: 16,
				//zoomControlOptions: {
				//style: google.maps.ZoomControlStyle.SMALL //zoom control size
			//},
				scaleControl: true, // enable scale control
				mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
			};
		
		   	map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);			
			//Load Markers from the XML File
			$.get("map_process.php", function (data) {
				$(data).find("marker").each(function () {
					  var name 		= $(this).attr('name');
					  var address 	= $(this).attr('address');
					  var type 		= $(this).attr('type');
					   var town 		= $(this).attr('town');
					    var visits 		= $(this).attr('visits');
						 var Other_details= "<b>Phone </b> "+address+ "<br/><b>Channel</b> "+type+"<br><b>Town</b> "+town+"<br/><b>Visits<b> "+visits+"<br/>";
					  var point 	= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					  create_marker(point, name, Other_details, false, false, false, "images/icons/icon.png");
				});
			});	
			
			//Right Click to Drop a New Marker
			google.maps.event.addListener(map, 'rightclick', function(event) {
				load_outlets();
				var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<table id="add_users"><tr><td></td><td><input value="0"  class="save-name" id="cname"  name="cname" minlength="2" type="hidden" placeholder="Enter Outlet name" required /></td><td></td><td><input class="save-type"  type="hidden" id="channel" name="channel" required ></td></td></tr><tr><td></td><td><input placeholder="Name of person" class="decision_maker" id="decision_maker" type="hidden" name="decision_maker" /></td><td></td><td><input id="designation" class="designation" type="hidden" name="designation" required > </td></tr><tr><td></td><td><input type="hidden" name="tel" id="tel" class="tel"> </td><td></td><td><input class="town "  id="town" type="hidden" name="town" /></td> </tr><tr><td>Select name</td><td><select class="load_outlets" id="sales_person_selection"></select></span></td><td></td><td></td><td></td></tr></table>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Save outlet</button>';
				//Drop a new Marker with our Edit Form
				create_marker(event.latLng, 'Update Outlet GPS Details', EditForm, true, true, true, "images/icons/icon.png");
			});
										
	}
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Outlet!",
			icon: circle
		});
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		MapDesc+ 
		'</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Outlet</button>'+
		'</div></div>');	
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			remove_marker(marker);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('input.save-type')[0].value; //CHANNEL input field value
				var mType = contentString.find('input.save-type')[0].value; //type of marker
				var moreData=$("#SaveMarker").serialize();
				var channel=contentString.find('input.save-type')[0].value;
				var decision_maker=contentString.find('input.decision_maker')[0].value;
				var designation=contentString.find('input.designation')[0].value;
			var tel=contentString.find('input.tel')[0].value;
			 var town=contentString.find('input.town')[0].value;
			 var outlet_id=contentString.find('select.load_outlets')[0].value;
				//var user=user_id;
				
				if(outlet_id =='')
				{
					alert("Please Select outlet!");
				}else{
					save_marker(marker, mName, mDesc, channel,tel,outlet_id,decision_maker, mType, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Remove Marker Function ##############
	function remove_marker(Marker)
	{
		
		/* determine whether marker is draggable 
		new markers are draggable and saved markers are fixed */
		if(Marker.getDraggable()) 
		{
			Marker.setMap(null); //just remove new marker
		}
		else
		{
			//Remove saved marker from DB and map using jQuery Ajax
			var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
			var myData = {del : 'true', latlang : mLatLang}; //post variables
			$.ajax({
			  type: "POST",
			  url: "map_process.php",
			  data: myData,
			  success:function(data){
					Marker.setMap(null); 
					alert(data);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
		}

	}
	
	//############### Save Marker Function ##############
	function save_marker(Marker, mName, mAddress,channel,tel,designation,decision_maker, mType, replaceWin)
	{
		//Save new marker using jQuery Ajax
		var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
		var myData = {name : mName, address : mAddress,channel:channel,tel:tel,designation:designation,decision_maker:decision_maker, latlang : mLatLang, type : mType }; //post variables
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "map_process.php",
		  data: myData,
		  success:function(data){
				replaceWin.html(data); //replace info window with new html
				//Marker.draggable(false); //set marker to fixed
				Marker.setIcon('images/icons/pin_blue.png'); //replace icon
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
		});
	}

});
</script>

<style type="text/css">
h1.heading{padding:0px;margin: 0px 0px 10px 0px;text-align:center;font: 18px Georgia, "Times New Roman", Times, serif;}

/* width and height of google map */
#google_map {width: 90%; height: 1000px;margin-top:0px;margin-left:auto;margin-right:auto;}
#filtertable{width: 90%; ;margin-top:0px;margin-left:auto;margin-right:auto;}
/* Marker Edit form */
.marker-edit label{display:block;margin-bottom: 5px;}
.marker-edit label span {width: 100px;float: left;}
.marker-edit label input, .marker-edit label select{height: 24px;}
.marker-edit label textarea{height: 60px;}
.marker-edit label input, .marker-edit label select, .marker-edit label textarea {width: 60%;margin:0px;padding-left: 5px;border: 1px solid #DDD;border-radius: 3px;}

/* Marker Info Window */
h1.marker-heading{color: #585858;margin: 0px;padding: 0px;font: 18px "Trebuchet MS", Arial;border-bottom: 1px dotted #D8D8D8;}
div.marker-info-win {}
div.marker-info-win p{padding: 0px;margin: 10px 0px 10px 0;}
div.marker-inner-win{padding: 5px;}
button.save-marker, button.remove-marker{border: none;background: rgba(0, 0, 0, 0);color: #00F;padding: 0px;text-decoration: underline;margin-right: 10px;cursor: pointer;
}
</style>
</head>
<body>             
<h1 class="heading">Outlets on a Map</h1>
<table id="filtertable"  class="table table-bordered  " ><tr><td>Filter by</td><td>Region<select id="region"><option value="-1">All</option><?php echo region_selection()?></select></td><td>Area <select id="area"><option value="-1">All</option><?php echo area_selection()?></select></td><td>Sub Area<select id="subArea"><option value="-1">All</option><?php echo cluster_selection()?></select></td><td>Distributor <select id="distributor"><?php echo distributor_selection()?></select></td><td>Route <select id="route"><option value="-1">All</option><?php echo route_selection()?></select></td></tr>
  <tr>
    <td>Filter by Sales</td>
    <td>Lowest</td>
    <td>Highest</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Visted in the Between</td>
    <td>Without Coolers</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<div id="google_map"></div>
</body>
</html>


    