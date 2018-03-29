function distance(lat1, lon1, lat2, lon2, unit) {
	var radlat1 = Math.PI * lat1/180
	var radlat2 = Math.PI * lat2/180
	var radlon1 = Math.PI * lon1/180
	var radlon2 = Math.PI * lon2/180
	var theta = lon1-lon2
	var radtheta = Math.PI * theta/180
	var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	dist = Math.acos(dist)
	dist = dist * 180/Math.PI
	dist = dist * 60 * 1.1515
	if (unit=="K") { dist = dist * 1.609344 }
	if (unit=="N") { dist = dist * 0.8684 }
	return dist
}
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } 
	else if(!navigator.geolocation) { 
	 window.location.href="geolocation.php";
       alert( "Geolocation is not supported by this browser.") 	   
	    }
}

function showPosition(position) {
	//check wehtehr position is o and o and redirect
	if(position.coords.latitude==0 && position.coords.longitude==0){ 
	window.location.href="geolocation.php";
	alert( "You ignored GPS Dialoag. Latitude: " + position.coords.latitude +"<br>Longitude: " + position.coords.longitude);	
}
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
		 window.location.href="geolocation.php";
           alert("You denied the request for Geolocation. you Must enable it")
            break;
        case error.POSITION_UNAVAILABLE:
		window.location.href="geolocation.php";
           alert( "Location information is unavailable.")
            break;
        case error.TIMEOUT:
           alert( "The request to get user location timed out.")
            break;
        case error.UNKNOWN_ERROR:
          alert("GPS An unknown error occurred.")
            break;
    }
}
  //end fnxn  here 
  function select_box_fill(){for(i=0;i<200;i++){
	 document.write("<option val='"+i+"'>"+i+"</option>")
						}}
			//fetch users for the tables
	function assign_salesperson(){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_users','isAjax':true},
    dataType:'json',
    success: function(data) {
    var select = $(".assign_salesperson"), options = '';
     select.empty();  
	options += "<option value='0'>Select Salesperson</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].user_id+"'>"+ data[i].name +"</option>";              
       }
       select.append(options);
    }
});
  }
  		///////////////////////////////////////////////////////////////
			//
	function fill_area_select_list(boundary,id){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fill_area_select_list','boundary':boundary,'id':id,'isAjax':true},
    dataType:'json',
    success: function(data) {
    var area = $("#area_id"), options = '';
     area.empty(); 
	  // var sub_area_id = $("#sub_area_id"), options = '';
     //sub_area_id.empty();  
	options += "<option value='0'>Select area </option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
       }
       area.append(options);
    }
});
  }
	///////////////////////////////////////////////////////////
	function fill_sub_area_select_list(boundary,id){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fill_sub_area_select_list','boundary':boundary,'id':id,'isAjax':true},
    dataType:'json',
    success: function(data) {
 var sub_area_id = $("#sub_area_id"), options = '';
sub_area_id.empty();  
	options += "<option value='0'>Select Sub area</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
       }
       sub_area_id.append(options);
    }
});
  }////////////////////////
  function fill_route_select_list(boundary,id){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fill_route_select_list','boundary':boundary,'id':id,'isAjax':true},
    dataType:'json',
    success: function(data) {
 var route_id = $("#route_id"), options = '';
route_id.empty();  
	options += "<option value='0'>Select route</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";              
       }
       route_id.append(options);
    }
});
  }
		//fetch routes to use when creating dealers 
	function select_routes(){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'select_routes','isAjax':true},
    dataType:'json',
    success: function(data) {
    var select = $("#route"), options = '';
     select.empty();  
	options += "<option value='0'>Select route</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].route_id+"'>"+ data[i].route_name +"</option>";              
       }
       select.append(options);
    }
});
  }
  
  //assign route
  	function assign_route(dealer_id){
		var uid=$("#uid").val();var rid=$("#rid").val();var oid=oid;
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'assign_route','uid':uid,'rid':rid,'dealer_id':dealer_id,'isAjax':true},
    dataType:'json',
    success: function(data) { 
	//
	}
});
  }
   //unassign route
  	function unassign_route(dealer_id){
		var uid=$("#uid").val();
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'unassign_route','uid':uid,'dealer_id':dealer_id,'isAjax':true},
    dataType:'json',
    success: function(data) { 
	//
	}
});
  }//function to load viewers
	function load_users(){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_users','isAjax':true},
    dataType:'json',
    success: function(data) {
    var select = $(".sales_person_selection"), options = '';
     select.empty();  
	options += "<option value='0'>Select AD/User</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].user_id+"'>"+ data[i].name +"</option>";              
       }
       select.append(options);
    }
});
  }
  function load_outlets(){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'load_outlets','isAjax':true},
    dataType:'json',
    success: function(data) {
    var select = $(".load_outlets"), options = '';
     select.empty();  
	//options += "<option value='0'>Select TSR</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].dealer_id +"'>"+i+'. '+ data[i].name +"</option>";              
       }
       select.append(options);
    }
});
  }//end load users function into select box
  function user_name(u_id){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'user_name','u_id':u_id,'isAjax':true},
   // dataType:'json',
    success: function(data) {
		$("#selected_trips").empty();
		$("#sales_person_name").html("<tr class='border thin'><td>"+data+"</td></tr>");
		if(u_id==0){$("#selected_trips").append("<div class='white_bg'>Select valid user first</div>")}else
		fetch_assignments(u_id);
      
    }
});
  }
  /////////////////////////////////////
  function load_all_regions_to_select_box(){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'load_all_regions_to_select_box','isAjax':true},
    dataType:'json',
    success: function(data) {
    var select = $("#region"), options = '';
     select.empty();  
	options += "<option value='-1'>Select Region</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].region_id+"'>"+ data[i].region_name +"</option>";              
       }
       select.append(options);
    }
});}
/////////////////////areas in a region
function load_area_dropDown(region){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'load_area_dropDown','region':region,'isAjax':true},
    dataType:'json',
    success: function(data) {
		
    var select = $("#area"), options = '';
	     select.empty();  
		 if(data.length==1){} else	options += "<option value='-1'>All Areas in Region</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].area_id+"'>"+ data[i].area_name +"</option>";              
       }
       select.append(options);
    }

});
}
////////////////////
function load_clusters_dropDown(area){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'load_clusters_dropDown','area':area,'isAjax':true},
    dataType:'json',
    success: function(data) {
		
    var select = $("#cluster"), options = '';
	     select.empty();  
		 if(data.length==1){} else	options += "<option value='-1'>All clusters in Area</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].cluster_id+"'>"+ data[i].cluster_name +"</option>";              
       }
       select.append(options);
    }

});
}
/******************************/
////////////////////
function load_distributors_dropDown(cluster){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'load_distributors_dropDown','cluster':cluster,'isAjax':true},
    dataType:'json',
    success: function(data) {
		
    var select = $("#distributor"), options = '';
	     select.empty();  
		 if(data.length==1){} else	options += "<option value='-1'>All Distributors in Cluster</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].distributor_id+"'>"+ data[i].distributor_name +"</option>";              
       }
       select.append(options);
    }

});
}/******************************/
////////////////////
function load_routes_dropDown(distributor){
	 $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'load_routes_dropDown','distributor':distributor,'isAjax':true},
    dataType:'json',
    success: function(data) {
		
    var select = $("#route"), options = '';
	     select.empty();  
		 if(data.length==1){} else	options += "<option value='-1'>All Routes in distributor</option>";    
     for(var i=0;i<data.length; i++)
       {
        options += "<option value='"+data[i].route_id+"'>"+ data[i].route_name +"</option>";              
       }
       select.append(options);
    }

});
}
//////////////////////////////////editing on live table
function liveTableEdit(editbox,edit_td,idLabel,mode){
			$(editbox).hide();///hide the edit box
			
			$(edit_td).click(function(){
	var ID=$(this).attr('id');
	$(idLabel+"_"+ID).hide();
	$(idLabel+"_input_"+ID).show();
				}).change(function()
				{
					var ID=$(this).attr('id');
					var value=$(idLabel+"_input_"+ID).val();

var dataString = 'id='+ ID +'&value='+value+'&mode='+mode;
$(idLabel+"_"+ID).html('<img src="ajax-loader.gif" />');
if(value.length>0 && value<100)
{
$.ajax({
type: "POST",
url: "read.php",
data: dataString,
cache: false,
success: function(html)
{
$(idLabel+"_"+ID).html(value);

}
});
}
else
{
alert('Enter valid number.');
}

});
//.....
$(document).mouseup(function()
{
$(editbox).hide();
$(".text").show();
});
////////////////////
		}
  //fetch clients on selecting a user
  function fetch_assignments(uid){
	  $.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'fetch_assignments','uid':uid},
	success: function(data){ 
	if(data==''){
		
		$("#selected_trips").append("<div class='white_bg'>Has not been assigned any route</div>")
		} else{
			//$("#selected_trips").append("<table class='table'><tr><td>No</td><td>Outlet</td><td>status</td></tr></table>")
		 for(var i=0;i<data.length; i++){
			 
			 var visited='';  if(data[i].visit_id==0) {} else visited='report';
			 //append 
$("#selected_trips").append("<li>"+data[i].business_name+"<a href=visit_report.php?dealer_id="+ data[i].dealer_id+"&visit_id="+data[i].visit_id+"&plan_id="+ data[i].plan_id+" style='float:right'>"+visited+"</a></li>"); 
		 }//end for	
		 
		}//end else
	 } //end success
	 
	  });//end ajax
  }
   //day of week
   
  //list outlets in a certain day
  function outlets_in_day(day,user){
	  if(day=='All') fetch_clients();
	   $("#list_title").empty();
	   $("#list_title").append(day);
	   $("#clients_list").empty();
	    $("#clients_list").append("<tr><td colspan='8' align='center'> <img src='assets/img/loading.gif'></td></tr>");
	   $.ajax(	{
		   type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'outlets_in_day','user':user, 'day':day},
	success: function(data){
		  $("#clients_list").empty();
   for(var i=0;i<data.length; i++){
		//return data;
		var n=i+1;
		var desg=data[i].designation; 
	
		
		
		var del='';
		var uid=data[i].user_id; if(uid<2) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#clients_list").append("<tr><td>"+ n +"</td> <td ><a href=client_details.php?dealer_id="+data[i].d_id+">"+data[i].bname+"</a></td><td>"+data[i].lon+"</td><td >"+data[i].lat+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td >"+data[i].phone+"</td> <td >"+data[i].verified+"</td> <td ><a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Update</a>"+del+"</td> </tr>");
		  }   
			 }//end succss
	});// end ajax
	  }
  //fetch the orders for assignment
   function fetch_outlets_for_routing(region_id){
	     $(".list").append("<tr><td colspan='8' align='center'> Loading <img src='images/37.gif'></td></tr>");
	  $.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'fetch_outlets_for_routing','region_id':region_id},
	success: function(data){ 
	  $(".list").empty();
	if(data==''){
		$(".list").append("<div class='white_bg'>No outlets in this region</div>")}
	 for(var i=0;i<data.length; i++){
		 if(data.length<1) {$(".list").append("<tr><td colspan='8'> No outlet Unassigned</td></tr>"); }
		 var n=1+i;
$(".list").append("<tr><td>"+n+"</td><td >"+data[i].bname+"</td><td >"+data[i].town+" "+data[i].place_name+"</td><td >"+data[i].reg_date+"</td><td >"+data[i].owner_name+" "+data[i].phone+"</td><td ><input type='hidden' name='dealer_id' id='dealer_id' value='"+data[i].dealer_id+"'> <button data-dismiss='alert' onclick='assign_route("+data[i].dealer_id+")' id='"+data[i].dealer_id+"' class='btn btn-success btn-xs'><i class='fa fa-check'></i></button></td></tr>"); 
		 }//end for	
	 } //end success
	  });//end ajax
  }
  //fetch assigned Route details
   function fetch_assigned_rote_outlets(route_id){
	    $(".list").append("<tr><td colspan='8' align='center'> Loading <img src='images/37.gif'></td></tr>");
	  $.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'fetch_assigned_rote_outlets','route_id':route_id},
	success: function(data){ 
	  $(".list").empty();
	if(data==''){
		$(".list").append("<div class='white_bg'>No outlets in this region</div>")}
	 for(var i=0;i<data.length; i++){
		 if(data.length<1) {$(".list").append("<tr><td colspan='8'> No outlet Unassigned</td></tr>"); }
		 var n=1+i;
$(".list").append("<tr><td>"+n+"</td><td >"+data[i].bname+"</td><td>"+data[i].channel+"</td><td >"+data[i].town+"</td><td >"+data[i].reg_date+"</td><td >"+data[i].owner_name+" "+data[i].phone+"</td><td ><a class='button-default' href=update_cluster_route.php?dealer_id="+data[i].dealer_id+"> Update</a><input type='hidden' name='dealer_id' id='dealer_id' value='"+data[i].dealer_id+"'> <button data-dismiss='alert' onclick='unassign_route("+data[i].dealer_id+")' id='"+data[i].dealer_id+"' class='btn btn-danger btn-xs'><i class='fa fa-times'></i></button></td></tr>"); 
		 }//end for	
	 } //end success
	  });//end ajax
  }
  
  
 
	  //fetchin lit for payments
	   function clients_collect_cash(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_clients','isAjax':true},
   dataType:'json',
    success: function(data) {
   for(var i=0;i<data.length; i++){
		//return data;
		var n=i+1;
		  $("#clients_collect_cash").append("<tr><td>"+ n +"</td> <td >"+data[i].bname+"</td><td>"+data[i].phone+"</td><td >"+data[i].town+"</td><td >"+data[i].phone+"</td> <td >"+data[i].email+"</td> <td ><a href=collect_cash.php?cid="+data[i].d_id+"> Receive Payment</a></td> </tr>");}    
    }
});
	  }
  
  //fetching clients
  function add_client(user_id){
	  var bname=$('#cname').val();  var phone= $('#phone').val(); var long=$('#long').val(); var lat=$('#lat').val();  var town=$('#town').val(); var pname=$('#place_name').val();  var owner=$('#decision_maker').val();  var designation=$('#designation').val(); var region=$('#region_id').val();var channel=$("#channel option:selected").val()
	  var type_of_outlet=$("#type_of_outlet option:selected").val()
	  	 
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'add_client','designation':designation,'bname':bname,'long':long,'phone':phone,'user_id':user_id,'lat':lat,'town':town,'pname':pname,'region':region,'type_of_outlet':type_of_outlet,'owner':owner,'channel':channel},
	success: function(data){ success_message('Successifully added outlet '+ bname); $("#clients_list").empty();fetch_clients() }  });
  }
   //prospect
  function add_prospecting(){
	  var bname=$('#cname').val();  var phone= $('#phone').val(); var long=$('#long').val(); var lat=$('#lat').val();  var town=$('#town').val(); var pname=$('#place_name').val();  var owner=$('#decision_maker').val();  var designation=$('#designation').val(); var region=$('#region_id').val();var channel=$("#channel option:selected").val()
	   var mult=$('#mult').val();  var lite= $('#lite').val(); var heineken=$('#heineken').val();
	  //days$("#ans option:selected").val()
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'add_prospecting','lite':lite,'heineken':heineken,'mult':mult,'designation':designation,'bname':bname,'long':long,'phone':phone,'lat':lat,'town':town,'pname':pname,'region':region,'owner':owner,'channel':channel},
	success: function(data){ success_message('Successifully added prosecting outlet '+ bname); $("#clients_list").empty();fetch_prospecting() }  });
  }
  
  
  //fetch prospecting
   function fetch_prospecting(){
	   $("#clients_list").append("<tr><td colspan='8' align='center'> <img src='images/37.gif'></td></tr>");

	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_clients','isAjax':true},
   dataType:'json',
    success: function(data) {
		 $("#clients_list").empty();
   for(var i=0;i<data.length; i++){
		
		var n=i+1;
		var desg=data[i].designation; 
		
		
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#clients_list").append("<tr><td>"+ n +"</td> <td ><a href=client_details.php?dealer_id="+data[i].d_id+">"+data[i].bname+"</a></td><td>"+data[i].channel+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td>"+data[i].phone+"</td> <td >"+data[i].visits+"</td> <td><a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Update</a>"+del+"</td> </tr>");}    
    }
});
	  }
     //fecth clients
  function fetch_clients(){
	   $("#clients_list").append("<tr><td colspan='8' align='center'> <img src='images/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_clients','isAjax':true},
   dataType:'json',
    success: function(data) {
		 $("#clients_list").empty();
   for(var i=0;i<data.length; i++){
		//return data;
		var n=i+1;
		var desg=data[i].designation; 
		var channel=''; if(data[i].channel==1){channel='Bar'} else if(data[i].channel==2){channel='Wines &spirits'}else if(data[i].channel==3){channel='Convinience'}else if(data[i].channel==4){channel='Golf clubs'}else if(data[i].channel==5){channel='Hotel'}else if(data[i].channel==6){channel='Supermarket'} else {channel='Other';}
		
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#clients_list").append("<tr><td>"+ n +"</td> <td ><a href=client_details.php?dealer_id="+data[i].d_id+">"+data[i].bname+"</a></td><td>"+data[i].long+"</td><td >"+data[i].lat+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td>"+data[i].phone+"</td> <td >"+data[i].visits+"</td> <td><a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Update</a>"+del+"</td> </tr>");}    
    }
});
	  }//end
//fetch_clients in a day

function fetch_clients_inday(day){
	   $("#clients_list").append("<tr><td colspan='8' align='center'> <img src='images/37.gif'></td></tr>");

	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_clients','isAjax':true},
   dataType:'json',
    success: function(data) {
		 $("#clients_list").empty();
		 
   for(var i=0;i<data.length; i++){
		//return data;
		var n=i+1;
		var desg=data[i].designation; 
		
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#clients_list").append("<tr><td>"+ n +"</td> <td ><a href=client_details.php?dealer_id="+data[i].d_id+">"+data[i].bname+"</a></td><td>"+data[i].lon+"</td><td >"+data[i].lat+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td >"+data[i].phone+"</td> <td >"+data[i].visits+"</td> <td ><span onClick='quick_plan("+data[i].d_id+")' class='qp' id="+data[i].d_id+">Quick plan</span> |<a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Edit</a>"+del+"</td> </tr>");}    
    }
});
	  }//end of day based clients
	  function fetch_unverified_clients_in_area(){
		  	  var from=document.getElementById('from').value;
			  var to=document.getElementById('to').value;
			 var user=document.getElementById('user').value;
	   $("#unverified_clients_in_area_list").append("<tr><td colspan='8' align='center'> <img src='images/37.gif'></td></tr>");

	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_unverified_clients_in_area','to': to,'from': from,'user': user,'isAjax':true},
   dataType:'json',
    success: function(data) {
		if(data==null){}else{
		 $("#unverified_clients_in_area_list").empty();
   for(var i=0;i<data.length; i++){
		//return data;


		var n=i+1;
		var desg=data[i].designation; 
		
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#unverified_clients_in_area_list").append("<tr><td>"+ n +"</td> <td ><a href=client_details.php?dealer_id="+data[i].d_id+">"+data[i].bname+"</a></td><td>"+data[i].opening_time+"</td><td >"+data[i].closing_time+"</td><td >"+data[i].channel+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td >"+data[i].phone+"</td> <td >"+data[i].qns+"</td> <td ><span onClick='verify_outlet("+data[i].d_id+")' class='qp' id="+data[i].d_id+">Verify</span> |<a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Edit</a>"+del+"</td> </tr>");}    
    }
	}//end else
});
	  }
	  
	  function verify_outlet(id){
			          var conf = confirm('Verify outlet',{ buttons: { Ok: true, Cancel: false} });
if(conf){
	$.ajax({
		type: "POST",
    url: 'read.php',
  data:{'mode':'verify_outlet','id':id},
   dataType:'json',
    success: function(data)
		{
			alert(data);
			success_message("Successiful");
			
						}
		}

	);
}
else{}	}

	  ////////////////////////////////adcluster_asignments
	  
	  	    function adcluster_asignments(clid,user){
			$.ajax(
			{type:'POST',url:"read.php",dataType:"json",
			data:"clid="+clid+"&user="+user+"&mode=adcluster_asignment2AD",
			success: function(data){success_message('Successifully updated');
				}
				});
			
			}
	  
	  
	  //////////////////////////////////////////
	  	    function save_route2adcluster(clid,route){
			$.ajax(
			{type:'POST',url:"read.php",dataType:"json",
			data:"clid="+clid+"&route="+route+"&mode=save_route2adCluster",
			success: function(data){success_message('Successifully assigned');
				}
				});
			
			}
	  ///////////////////////
  function add_product(){
	 
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data: $('#add_products').serialize()+"&mode=add_product",
	success: function(data){ 
	success_message('Successifully added product ');
	fetch_product() }  });
  }/////////////////
    function save_stock_availability_check(){
	 
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data: $('#stock_settingForm').serialize()+"&mode=save_stock_availability_check",
	success: function(data){
	success_message('Successifully added'); 
	fetch_availabilitycheck();
	 }
	  });
  }///////////
   function fetch_availabilitycheck(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_availabilitycheck','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#availability_check_list").empty();
   for(var i=0;i<data.length; i++){
		   		var n=i+1;
				
 $("#availability_check_list").append("<tr><td >"+ n +"</td><td>"+data[i].product+"</td> <td>"+data[i].market_segment+"</td><td >"+data[i].channel_name+"</td><td >"+data[i].gold_qty+"</td><td >"+data[i].silver_qty+"</td><td >"+data[i].bronze_qty+"</td><td >"+data[i].other_qty+"</td><td >"+data[i].gold_score+"</td><td >"+data[i].silver_score+"</td><td >"+data[i].bronze_score+"</td><td >"+data[i].other_score+"</td> <td ><a href=?id="+data[i].avail_check_id+">Edit</a>|<a href=read.php?mode=delete_stocking_standard&id="+data[i].avail_check_id+"> Delete</a></td> </tr>");
	 	
	 }}
});
	  }
  //////////////////////////
   function add_distributor(){
	 
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data: $('#distributorform').serialize()+"&mode=distributorform",
	success: function(data){ 
	success_message('Successifully added product ');
	fetch_product() }  });
  }
   function save_competitor(){
	 
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	data: $('#competitor_form').serialize()+"&mode=add_competitor",
	success: function(data){ 
	success_message('Successifully added Competitor ');
	fetch_competitors() }  });
  }
  
  //fetching products
  function fetch_competitors(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_competitors','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#competitor_list").empty();
   for(var i=0;i<data.length; i++){
	
		var n=i+1;
		  $("#competitor_list").append("<tr><td >"+ n +"</td><td >"+data[i].name+"</td> <td>"+data[i].company+"</td> <td >"+data[i].description+"</td><td >"+data[i].reg_by+"</td> <td ></td> </tr>");}    
    }
});
	  }//end////////////////////////////////////////////////
	  function fetch_couching_plans(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_couching_plans','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#couching_plansList").empty();
   for(var i=0;i<data.length; i++){
	
		var n=i+1;
		  $("#couching_plansList").append("<tr><td >"+ n +"</td><td >"+data[i].plan_date+"</td> <td>"+data[i].place+"</td> <td >"+data[i].justification+"</td><td >"+data[i].participants+"</td> <td >"+data[i].scheduled_by+"</td> </tr>");}    
    }
});
	  }//end////////////////////////////////////////////////
	 function add_question(){
	  
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	//data:{'mode':'add_question','q':q,'onOf':onOf,'q_type':q_type,'abr':abr},
	data: $('#add_query_form').serialize()+"&mode=add_question",
	success: function(data){ 
	
	success_message('Successifully added query');
	fetch_query() }  });
  } //////////////////////////////////////// 
   function add_question_option(){
	  	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	//data:{'mode':'add_question','q':q,'onOf':onOf,'q_type':q_type,'abr':abr},
	data: $('#add_question_optionform').serialize()+"&mode=add_question_option",
	success: function(data){ 
	
	success_message('Successifully added query');
	//fetch_options() 
	}  });
  } //////////////////////////////////////// 
  function fetch_options(question){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_options','question':question,'isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#options_list").empty();
   for(var i=0;i<data.length; i++){
	
		var n=i+1;
		  $("#options_list").append("<tr><td>"+n+"</td><td >"+data[i].name+"</td> <td>"+data[i].counter+"</td></tr>");}    
    }
});
	  }//////////////////////
	   function fetch_number_options(question){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_number_options','question':question,'isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#options_list").empty();
   for(var i=0;i<data.length; i++){
	
		var n=i+1;
		  $("#options_list").append("<tr><td>"+n+"</td><td >"+data[i].answer+"</td> <td>"+data[i].counter+"</td></tr>");}    
    }
});
	  }
  	  function on_off(clicked_id){
		$.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'on_of','on_off_id':clicked_id,'isAjax':true},
   dataType:'json',
     success: function(data) {
	if(data=="done") ;//////// 
	alert("Successiful");
  
    }
});
	}
	  ////////////////////////////////////////////////////////
  function fetch_query(){
	   $("#question_list").append('<tr><td colspan="14">Loading <img src="images/37.gif"></td></tr>');
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_question','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#question_list").empty();
		   if(data==null){$("#question_list").append('<tr><td colspan="7">Nothing in Database</td></tr>');} else{
   for(var i=0;i<data.length; i++){
			var n=i+1;                               	  
		  $("#question_list").append("<tr><td >"+ n +"</td><td><a href='answers.php?id="+data[i].id+"'>"+data[i].question+"</td> <td>"+data[i].q_type+"</a></td><td >"+data[i].category+"</td> <td>"+data[i].red_eds_dosa+"</td> <td>"+data[i].region+"</td> <td>"+data[i].required+"</td> <td>"+data[i].channel+"</td> <td>"+data[i].score_gold+"</td> <td>"+data[i].score_silver+"</td> <td>"+data[i].score_bronze+"</td> <td><a  href='javascript:void(0)' id='"+data[i].id+"'>Edit</a>|<a href=read.php?mode=delete_question&qid="+data[i].id+"> Delete</a></td> </tr>");}    
    }
	}//end if
});

	  }//end////////////////////////////////////////////////
	   function add_setting(){
	  
	$.ajax(
	{type:'POST',url:"read.php",dataType:'json',
	//data:{'mode':'add_question','q':q,'onOf':onOf,'q_type':q_type,'abr':abr},
	data: $('#settingsForm').serialize()+"&mode=add_setting",
	success: function(data){ 
	
	success_message('Successifully added query');
	fetch_settings() }  });
  }
	  ////////////////////////////////////////////////////////
	  
	   function fetch_settings(){
	   $("#settings_list").append('<tr><td colspan="7">Loading <img src="images/37.gif"></td></tr>');
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_settings','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#settings_list").empty();
   for(var i=0;i<data.length; i++){
	
		var n=i+1; 
		//"id":"2","setting":"Holiday days","setting_value":"2016-12-12","setting_date_added ":"2016-09-04 02
//:45:37","added_by":"123","description":"0"
		  $("#settings_list").append("<tr><td >"+ n +"</td><td><a href='answers.php?id="+data[i].id+"'>"+data[i].setting+"</a></td><td >"+data[i].setting_value+"</td> <td>"+data[i].description+"</td> <td>"+data[i].setting_date_added+"</td> <td></td> </tr>");}    
    }
});

	  }//end////////////////////////////////////////////////

  function checkin_time(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'checkin_time','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#checkin_time").empty();
   for(var i=0;i<data.length; i++){
	
	  // status=data[i].status;
	 //  if(status==1) status='deleted'; else status='active';
		//return data;
		var n=i+1;
		  $("#checkin_time").append("<tr><td >"+ n +"</td><td>"+data[i].name+"</td><td >"+data[i].checkin_time+"</td> <td>"+data[i].outlet_name+"</td> <td >"+data[i].from+"</td><td >"+data[i].distance+"</td><td >''</td></tr>");}    
    }
});
	  }//end/////////////////////////////////////////////////////
	   function fetch_product(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_product','isAjax':true},
   dataType:'json',
    success: function(data) {
		   $("#product_list").empty();
   for(var i=0;i<data.length; i++){
		
	
		var n=i+1;
		  $("#product_list").append("<tr><td >"+n+"</td><td>"+data[i].p_name+"</td><td >"+data[i].variant+"</td> <td>"+data[i].flavour+"</td> <td >"+data[i].pack_size+"</td><td >"+data[i].pack_type+"</td><td >"+data[i].sku_type+"</td><td >"+data[i].s_price+"</td><td >"+data[i].units_in_case+"</td> <td ><a href=edit_product.php?pid="+data[i].pid+">Edit</a>|<a href=delete_product.php?pid="+data[i].pid+"> Delete</a></td> </tr>");}    
    }
});
	  }
	   //fetching products
  function fetch_inventory(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_product','isAjax':true},
   dataType:'json',
    success: function(data) {
   for(var i=0;i<data.length; i++){
	  // status=data[i].status;
	 //  if(status==1) status='deleted'; else status='active';
		//return data;
		var n=i+1;
		  $("#product_list").append("<tr><td>"+ n +"</td><td><span >"+data[i].p_name+"</span></td><td >"+data[i].s_price+"</td> <td >"+data[i].p_discount+"</td><td >"+data[i].t_rate+"</td><td >"+data[i].qty+"</td> <td ><a href=edit_product.php?pid="+data[i].pid+">Edit</a>|<a href=delete_product.php?pid="+data[i].pid+"> Delete</a></td> </tr>");}    
    }
});
	  }//end
	  /////////////////////////////////
	   function add_asset_type(){
	var name=$('#name').val();
	  

		var description=$('#description').val();
		
		
		$.ajax(
	{type:"POST",url:"read.php",dataType:'json',
	data:{'mode':'add_asset_type','description':description,'name':name},
	success: function(data){ 
	//var message=full_name+" "+tel+" "+email+"added"
	//success_message()
	
	 }
	 });
  }
	  //..............................................
	//start users
	 function add_user(){
		
		
		$.ajax(
	{type:"POST",url:"read.php",dataType:'json',
	data: $('#signupForm').serialize()+"&mode=add_user",
	//data:{$("#").serialize()},
	success: function(data){ 
	var message=full_name+" "+tel+" "+email+"added"
	success_message()
	
	 }
	 });
  }/////////////
   function add_level_user(){
		
		
		$.ajax(
	{type:"POST",url:"read.php",dataType:'json',
	data: $('#add_level_userform').serialize()+"&mode=add_level_user",
	//data:{$("#").serialize()},
	success: function(data){ 
	var message=full_name+" "+tel+" "+email+"added"
	success_message()
	
	 }
	 });
  }
  ////////////////////////////////////////////////////////////////
   function add_user_role(){
						$.ajax(
	{type:"POST",url:"read.php",dataType:'json',
	data: $('#add_userroleForm').serialize()+"&mode=add_userroleForm",
	
	success: function(data){ 
	//var message=full_name+" "+tel+" "+email+"added"
	success_message("Added a role")
	
	 }
	 });
  }
  /////////////////////////////////////////////////////////////////////////
  function  fetch_users(status,region,area,todayLoin,role_filter,order_by){
	   $("#users_list").append('<tr><td colspan="11">Loading <img src="images/37.gif"></td></tr>');
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_userslist',"status":status,"region":region,"area":area,"todayLoin":todayLoin,"role_filter":role_filter,"order_by":order_by,'isAjax':true},
   dataType:'json',
    success: function(data) {
		 $("#users_list").empty()
   for(var i=0;i<data.length; i++){
		//return data;
		n=i+1;
	
	var s=data[i].status; var action='restore'; var file='delete_user.php';if(s==0){s='active'; file='delete_user.php'; action='delete';} else  if(s==1){s='deleted';  file='restore.php'; action='restore';} else s='suspended'; 
	
		actions="<a href=edit_users.php?uid="+data[i].user_id+">Edit</a>|<a href=read.php?mode=reset_pass&uid="+data[i].user_id+" onclick=alert('Ressetto123456')>Reset</a>|<a href=push_to_mobile.php?uid="+data[i].user_id+">Give Mobile Data</a>|<a href="+file+"?uid="+data[i].user_id+">"+ action ;
		
		if(status==1)actions="<a href=read.php?mode=restore_user&uid="+data[i].user_id+">Restore</a>";
		var uid=data[i].user_id;
		
		
		  $("#users_list").append("<tr><td>"+n+"</td><td >"+ data[i].name+"</td><td >"+ data[i].email+"</td><td >"+ data[i].mobile+"</td> <td >"+ data[i].role+"</td> <td >"+ data[i].district+"</td> <td>"+  data[i].area+"</td><td >"+data[i].logins+"</td> <td >"+  data[i].appVersion+"</td> <td >"+actions+"</a></td> </tr>");}    
    }
});
	  }
	  function fetch_targets(level){
	   $("#targets_list").append('<tr><td colspan="10">Loading <img src="images/37.gif"></td></tr>');
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'route_targets',"level":level,'isAjax':true},
   dataType:'json',
    success: function(data) {
		 $("#targets_list").empty()
   for(var i=0;i<data.length; i++){
		//return data;
		n=i+1;
		
		  $("#targets_list").append("<tr><td>"+n+"</td><td >"+ data[i].route+"</td><td >"+ data[i].number+"</td><td >"+ data[i].number+"</td><td >"+ data[i].number+"</td><td >"+ data[i].number+"</td><td ></td> <td >"+ data[i].date_added+"</td> <td >"+ data[i].target_added_by+"</td> <td><a href=''>Set Target</a></td> </tr>");}    
    }
});
	  }
	  ///////////////////////////////roles
	   function fetch_user_roles(){
	   $("#user_roles").append('<tr><td colspan="10">Loading <img src="images/37.gif"></td></tr>');
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_user_roles','isAjax':true},
   dataType:'json',
    success: function(data) {
		 $("#user_roles").empty()
   for(var i=0;i<data.length; i++){
		//return data;
		n=i+1;
	
		//var m=data[i].gender; if(m==1)m='male'; else m='female';
		var uid=data[i].user_id;
		
		
		  $("#user_roles").append("<tr><td>"+n+"</td><td >"+ data[i].role+"</td><td >"+ data[i].assignees+"</td><td >"+ data[i].kisii+"</td> <td >"+ data[i].mtkenya+"</td> <td >"+ data[i].rv+"</td> <td></td> </tr>");}    
    }
});
	  }
	  //fetch truck
	   function fetch_trucks(){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_trucks','isAjax':true},
   dataType:'json',
    success: function(data) {
   for(var i=0;i<data.length; i++){
		//return data;
		var n=i+1; var s=data[i].status; if(s==0) s='Working'; else if(s==1) s='Not working';
		
		  $("#trucks_list").append("<tr><td>"+n+"</td><td >"+ data[i].reg_no+"</td><td>"+ data[i].added_by+"</td><td >"+ data[i].capacity+"</td><td >"+ data[i].description+"</td> <td >"+ data[i].date_added+"</td><td >"+s +"</td><td ><a href=edit_trucks.php?tid="+data[i].vid+">Edit</a></td> </tr>");}    
    }
});
	  }
	  //end fetch trucks
function  fetch_user_for_editing(uid){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_user_for_editing','uid':uid,'isAjax':true},
   dataType:'json',
    success: function(data) {
   for(var i=0;i<data.length; i++){
	document.getElementById('#full_name').value=data[i].name;
	document.getElementById('#email').value=data[i].email;
	document.getElementById('#tel').value= data[i].mobile; 
	document.getElementById('#password').value= data[i].password; 
	document.getElementById('#gender').value= data[i].gender;  
	document.getElementById('#role').value= data[i].role; 
	document.getElementById('#empno').value=data[i].emp_id; 
	document.getElementById('#desc').value= data[i].desc;
		}    
    }
});
	  }
	  //fetch logs
	  
function  fetch_logs(){
	$("#logs").append("<tr><td colspan='5' align='center'> <img src='images/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_logs','isAjax':true},
   dataType:'json',
    success: function(data) {
		$("#logs").empty();
   for(var i=0;i<data.length; i++){
	   
	   n=1+i;
	   
	 $("#logs").append("<tr><td>"+n+"</td><td>"+ data[i].date_made+"</td><td>"+ data[i].added_by+"</td><td >"+ data[i].description+"</td><td ><a href=view_log.php?tid="+data[i].id+">view More</a></td> </tr>");
		}    
    }
});
	  }	  
	  function  fetch_my_logs(id){
	$("#my_logs").append("<tr><td colspan='5' align='center'> <img src='images/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_my_logs','id':id,'isAjax':true},
   dataType:'json',
    success: function(data) {
		$("#my_logs").empty();
   for(var i=0;i<data.length; i++){
	   
	   n=1+i;
	   
	 $("#my_logs").append("<tr><td>"+n+"</td><td>"+ data[i].date_made+"</td><td>"+ data[i].added_by+"</td><td >"+ data[i].description+"</td><td ><a href=view_log.php?tid="+data[i].id+">view More</a></td> </tr>");
		}    
    }
});
	  }	  
	  
	  //fetch regions
	  function  fetch_regions(){
	$("#regions_list").append("<tr><td colspan='8' align='center'> <img src='assets/img/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_regions','isAjax':true},
   dataType:'json',
    success: function(data) {
		$("#regions_list").empty();
   for(var i=0;i<data.length; i++){
	   
	   n=1+i;
	   
	 $("#regions_list").append("<tr><td>"+n+"</td><td>"+ data[i].name+"</td><td>"+ data[i].description+"</td><td>"+ data[i].date_added+"</td><td >"+ data[i].added_by +"</td><td>"+ data[i].outlets+"</td><td ><a href=region_outlets.php?region_id="+data[i].id+">View</a> | <a href=region_outlets.php?region_id="+data[i].id+">Edit</a> | <a href=delete_region.php?region_id="+data[i].id+">Delete</a></td> </tr>");
		}    
    }
});
	  }	 
	  
	  /////////////////////////////////////////
	  
	   function  fetch_categories(){
	$("#list_items").append("<tr><td colspan='5' align='center'> <img src='images/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_categories','isAjax':true},
   dataType:'json',
    success: function(data) {
		$("#list_items").empty();
   for(var i=0;i<data.length; i++){
	   	   n=1+i;
	   	 $("#list_items").append("<tr><td>"+n+"</td><td>"+ data[i].name+"</td><td>"+ data[i].applies_for+"</td><td>"+ data[i].member_of+"</td><td>"+ data[i].description+"</td><td>"+ data[i].outlets+"</td><td>"+ data[i].date_added+"</td><td >"+ data[i].added_by +"</td><td><a href=category_outlets.php?id="+data[i].id+">View</a> | <a href=delete_category.php?category="+data[i].id+">Delete</a></td> </tr>");
		}    
    }
});
	  }	 
	  //fetch cliens of a region
	      //fecth clients
  function fetch_region_clients(demarcation,id){
	   $(".region_outlet_list").append("<tr><td colspan='7' align='center'> Loading <img src='images/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_region_clients','id':id,'demarcation':demarcation,'isAjax':true},
   dataType:'json',
    success: function(data) {  $("#region_outlet_list").empty();
   for(var i=0;i<data.length; i++){
	   
		//return data;
		var n=i+1;
		var desg=data[i].designation; 
		
		
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#region_outlet_list").append("<tr><td>"+ n +"</td> <td>"+data[i].bname+"</td><td>"+data[i].route+"</td><td>"+data[i].distributor+"</td><td>"+data[i].sub_area+"</td><td>"+data[i].area+"</td><td>"+data[i].channel+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td >"+data[i].land_mark+"</td><td >"+data[i].phone+"</td> <td ><input name='list[]' class='migrate' type='checkbox' value='"+data[i].d_id+"'></td> <td ><a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Edit</a>"+del+"</td> </tr>");}    
    }
});
	  }///////////////////////outrlets registerd by user 
	  function user_registered_outlets(user_id){
		    $(".user_outlet_list").append("<tr><td colspan='6' align='center'> Loading <img src='images/37.gif'></td></tr>");
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'user_outlet_list','user_id':user_id,'isAjax':true},
   dataType:'json',
    success: function(data) {
   for(var i=0;i<data.length; i++){
	    $(".user_outlet_list").empty();
		//return data;
		var n=i+1;
		var desg=data[i].designation; 
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#user_outlet_list").append("<tr><td>"+ n +"</td> <td>"+data[i].bname+"</td> <td>"+data[i].route+"</td> <td>"+data[i].distributor+"</td> <td>"+data[i].sub_area+"</td> <td>"+data[i].area+"</td><td>"+data[i].channel+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td >"+data[i].phone+"</td> <td>"+data[i].reg_date+"</td>  <td ><a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Edit</a>"+del+"</td> </tr>");}    
    }
});
	  }//end
	  function get_filteredUserUutlets(data,title,listID,demarcation_mode,mode)
 { 
 $(listID).empty(); $("#title").empty();
	 $(listID).append('<img src="images/37.gif"/> Loading ...');
	 $("#title").text(title);

var url="read.php?demarcation="+demarcation_mode+"&"+data+"&mode="+mode;
		
		 $(listID).load(url);
	
		}
 //////////////////////
 function fetch_category_clients(id){
	   $.ajax({
    type: "POST",
    url: 'read.php',
   data: {'mode': 'fetch_category_clients','category':id,'isAjax':true},
   dataType:'json',
    success: function(data) {
   for(var i=0;i<data.length; i++){
		//return data;
		var n=i+1;
		var desg=data[i].designation; 
		
		
		var del='';
		var uid=data[i].user_id; if(uid<3) var del=''; else del="|<a href=delete_client.php?cid="+data[i].d_id+">Del</a>";
		
		  $("#region_outlet_list").append("<tr><td>"+ n +"</td> <td><a href=client_details.php?dealer_id="+data[i].d_id+">"+data[i].bname+"</a></td><td>"+data[i].channel+"</td><td >"+data[i].owner+" ( "+desg+")</td><td>"+data[i].town+"</td><td >"+data[i].phone+"</td> <td ></td> <td ><a href=create_order.php?dealer_id="+data[i].d_id+"> Order</a>|<a href=edit_clients.php?cid="+data[i].d_id+">Edit</a>"+del+"</td> </tr>");}    
    }
});
	  }//end
 
 ///////////////////////////
 ///checking whether a checkbox has been selected
 function validate(){
	var id= $(this).attr("id");
  var remember = document.getElementById(id);
  if (remember.checked){
    return $(this).val()=1;
  }else{
    return $(this).val()=1;
  }
}
	  //printing
	  
function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

                  }
				  
				  //message to display on new items
 function success_message(message){
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: message,
            // (string | mandatory) the text inside the notification
            text: 'Successiful',
            // (string | optional) the image to display on the left
            image:'images/success.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: 700,
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });}
		
		//function to track people 
function startTracking() {
var lt = 0;
var ls = false;
track = true;
	navigator.geolocation.watchPosition(
		function(position) {
			var now = new Date().getTime();
			if (ls != 1 || now - lt > 100000) {
				var lat= position.coords.latitude; var lon= position.coords.longitude;
	//start ajax
				$.ajax({
                type:"POST",
                url: "save_tracking.php",
				cache:false,
                data:'tm='+now+'&lon='+lon+'&lat='+lat,
                success: function(response){			   
				  //alert('added successifully');
                }
            });
				//end ajax
				lt = now; ls = 1;
			
			}
		},
		function() {
			var now = new Date().getTime();
			if (ls != 0 || now - lt > 10000) {
				//ta.value += now + ' // fail\n';
				//localStorage.setItem('trip', ta.value);
				lt = now;
				ls = 0;
			}
		},
		{
			enableHighAccuracy: true,
			maximumAge: 60000,
			timeout: 15000
		}
	);
}
// end the start tracking me function
/// data loading automatically
		function loading_data(divid,url,track_load,loading,total_groups,total,pergroup){
		
		$(divid).load(url, {'group_no':track_load,'total':total}, function() {track_load++;}); //load first group
		$(window).scroll(function() {  //detect page scroll
		if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
		{
		if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				//load data from the server using a HTTP POST request
				$.post(url,{'group_no': track_load,'total':total}, function(data){
				$(divid).append(data); //append received data into the element
				//var ap=total_groups*track_load;
				//var of=track_load+'of'+total;
				//$("#total_of").html(of);	
					//hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
					track_load++; //loaded group increment
					loading = false; 
				}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
					alert(thrownError); //alert with HTTP error
					$('.animation_image').hide(); //hide loading image
					loading = false;
				});
				
			}
		}
	});
		}
		/*888888888888 end the function loading data*/
		/*function to delete all arrayed records*/
		function delete_outlets_in_array(){
	   var eric = ($('.checkbox:checked').map(function() {
    return this.value;
}).get().join(', '));
$.ajax({
	url:'delete_client.php',type:'POST',data:'myArray='+eric+"&mode=delete",
	success: function(data){
		if(data=='done')
	{  $(".checkbox").prop("checked", false);
	 
	  location.reload();
	 
	}
	else alert(data)}
	});
 }
 
 ////////////////////moving outlets from one region to another
 function   migrate_outlets_in_array(){
	 var region_selected=document.getElementById('region_selection').value;
	//check whether a valid region is selected
	if(isNaN(region_selected)){ alert (region_selected+" is not a valid region. try again");
		} else{
	   var eric = ($('.migrate:checked').map(function() {
    return this.value;}).get().join(', '));
	//check if any value is carried here
$.ajax({
	url:'read.php',type:'POST',data:'myArray='+eric+"&mode=migrate_client&region_id="+region_selected,
	success: function(data){
		if(data=='done')
	{  $(".checkbox").prop("checked", false);
	 
	  location.reload();
	 
	}
	else alert(data)}
	});
	}//end else region is selected
 }
 //
  function   migrate_outlets_from_route_to_route(){
	 var route_selected=document.getElementById('route_selection').value;
	//check whether a valid region is selected
	if(isNaN(route_selected)){ alert (route_selected+" is not a valid route. try again");
		} else{
	   var eric = ($('.migrate:checked').map(function() {
    return this.value;}).get().join(', '));
	//check if any value is carried here
$.ajax({
	url:'read.php',type:'POST',data:'myArray='+eric+"&mode=migrate_outlets_from_route_to_route&route_id="+route_selected,
	success: function(data){
		if(data=='done')
	{  $(".checkbox").prop("checked", false);
	 
	  location.reload();
	 
	}
	else alert(data)}
	});
	}//end else region is selected
 }
 //resore outlets
 function restore_deleted_outlets(){
	   var eric = ($('.checkbox:checked').map(function() {
    return this.value;
}).get().join(', '));
$.ajax({
	url:'delete_client.php',type:'POST',data:'myArray='+eric+"&mode=restore",
	success: function(data){
		if(data=='done')
	{  $(".checkbox").prop("checked", false);
	 
	 alert('Refresh page to see changes');
	 
	}
	else alert(data)}
	});
 }
 //generate the twelve months in  a select box
 
function writeMonthOptions(div,type)
{//check the month type s for short and l for long
	if(type=='s'){
var Months = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
	}
	else var Months = new Array("January","February","March","April","May","June","July","August","September","October","November","December")

for (monthCounter = 0; monthCounter < Months.length; monthCounter++)
{
$(div).append('<OPTION value=' + (monthCounter+1) + '>' + Months[monthCounter]);
}
}
//get name of month from a number
// getMonthName Function
getMonthName = function (v) {
    var n = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return n[v]
}
function quick_plan(id){
			          var conf = confirm('Add to todays route plan',{ buttons: { Ok: true, Cancel: false} });
if(conf){
	$.ajax({
		type: "POST",
    url: 'read.php',
  data:{'mode':'quick_plan','id':id},
   dataType:'json',
    success: function(data)
		{
			alert(done);
			success_message("Added to today's plan. Reflesh for changes");
			
						}
		}

	);
}
else{}	}

//check wehter a order sorce has been selected

function order_source_selected(id){          
	$.ajax({
		type: "POST",
    url: 'read.php',
  data:{'mode':'order_source_selected','id':id},
   dataType:'json',
    success: function(data)
		{
			//return data.source[0];
						
						}
		}

	);
	}////////////////////////////////////////////
	function getfilterOptions(){
	        var has_electricity = $('#has_electricity').val();//gender
			var sales_coke_products = $('#sales_coke_products').val();
			var location_occassions = $('#location_occassions').val();
			var has_asset=$('#has_asset').val();
			var channel_id = $('#channel_id').val();
			var sales_fmcg = $('#sales_fmcg').val();
			var willing_to_stock_coke = $('#willing_to_stock_coke').val();
			var open_time = encodeURI($('#opening_time').val().replace(/ /g,"+"));//;
			var close_time=encodeURI($('#closing_time').val().replace(/ /g,"+")) ;//;
			var stocked_coke_inthePast=$('#stocked_coke_inthePast').val();
			
			
	
		return	data="has_electricity="+has_electricity+"&sales_coke_products="+sales_coke_products+"&location_occassions="+location_occassions+"&has_asset="+has_asset+"&channel_id="+channel_id+"&willing_to_stock_coke="+willing_to_stock_coke+"&sales_fmcg="+sales_fmcg+"&opening_time="+open_time+"&closing_time="+close_time+"&stocked_coke_inthePast="+stocked_coke_inthePast;
	 }
	//////////////////
	
	
	 function get_filteredAjaxData(data,title,listID,demarcation_mode)
 { 
 $(listID).empty(); $("#title").empty();
	 $(listID).append('<img src="images/37.gif"/> Loading ...');
	 $("#title").text(title);
var url="analyze_outlets.php?demarcation_mode="+demarcation_mode+"&"+data;
	$(listID).load(url);
	
		}///////////////////////////////////////
			 function get_filteredAjax4outlets(data,title,listID,demarcation_mode,mode)
 { 
 $(listID).empty(); $("#title").empty();
	 $(listID).append('<img src="images/37.gif"/> Loading ...');
	 $("#title").text(title);

var url="read.php?demarcation="+demarcation_mode+"&"+data+"&mode="+mode;
		
		 $(listID).load(url);
	
		}
		
	////////////////////////////
	 function select_sales(){ //selecting a user to see his plan
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }
//convert to excel
function convert_to_excel(tableId,btn,file_name)
		{
			var dt=new Date();
		
		var w_name=dt.getFullYear()+'.'+ dt.getMonth()+1+'.'+ dt.getDate()+' '+ dt.getHours()+'-'+ dt.getMinutes();
        $(btn).click(function () {
            $(tableId).btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
               , filename: w_name
            });
        });
		}//end of the excel convert
		
		/////////////////////get this to filter the boundary based on wht is selected
		function filter_boundary(){
			 $(".filter_boundary").change(function(){
			  var what=$(this).attr("id");// get the filter selected
			  var region=$("#region").val();
			  var area=$("#area").val();
			  var cluster=$("#sub_area").val();		
			   var distr=$("#distributor").val();
			  switch(what){
				  case "region":    	load_area_dropDown(region); 
				  case "area":  		load_clusters_dropDown(area);
				  case "sub_area":  	  	load_distributors_dropDown(cluster);
				  case "distributor": 	load_routes_dropDown(distr); 
				  default: return;
				  }
		  
			  });
		}
		
		function save_target(field,value,boundary,boundary_id,pid){
			  	$.ajax({type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'save_targets','field':field,'value':value,'boundary':boundary,'pid':pid,'boundary_id':boundary_id},
	
	success: function(data){ 
	
	success_message('Successifully added');
	//fetch_options() 
	}  });
			
			}
			///////////////////////////////////////////////
		function save_region_target(value,boundary,boundary_id){
				$.ajax({type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'save_region_targets','value':value,'boundary':boundary,'boundary_id':boundary_id},
	success: function(data){ alert("Successively set for the whole region");
	success_message('Successifully added');
 
	}  });
			
			}////////////////////////////////////////////
			function boundary_filters(){
			 $(".boundary_filters").change(function(){
			var what=$(this).attr("id");// get the filter selected
			var region=$("#region").val();
			var area=$("#area").val();
		
			  switch(what){
				  case "region":    	load_area_dropDown(region);  
				  case "area":  		//load_clusters_dropDown(area);
				//  case "cluster":  	  	load_distributors_dropDown(cluster);
				  //case "distributor": 	load_routes_dropDown(distr);  fetch_users("route");
				  default: -1;
				  }
			 });
				  }
				  ////////////////////////////
				  function boundary_filters_dist_route(){
			 $(".boundary_filters").change(function(){
			var what=$(this).attr("id");// get the filter selected
			var region=$("#region").val();
			var area=$("#area").val();
			var distributor=$("#distributor").val();
			var route=$("#route").val();
			var cluster=$("#cluster").val();
		
			  switch(what){
				  case "region":    	load_area_dropDown(region);  
				  case "area":  		load_clusters_dropDown(area);
				 case "cluster":  	  	load_distributors_dropDown(cluster);
				  case "distributor": 	load_routes_dropDown(distributor);  //fetch_users("route");
				  default: -1;
				  }
			 });
				  }
			//////////////////////////////////////////////////////////////////
			
			function save_sku_contribution(field,value,boundary,boundary_id,pid){
			  	$.ajax({type:'POST',url:"read.php",dataType:'json',
	data:{'mode':'save_sku_contribution','field':field,'value':value,'boundary':boundary,'pid':pid,'boundary_id':boundary_id},
	
	success: function(data){ 
	
	success_message('Successifully added');
	//fetch_options() 
	}  });
			
			}