<?php session_start();
?><!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' /><title>My planning</title>
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/js/moment.min.js'></script>
<script src='assets/js/jquery.min.js'></script>
<script src='assets/js/jquery-ui.min.js'></script>
<script src='assets/js/fullcalendar.min.js'></script>
<script type="text/javascript" src="calender.js"></script>
<?php if(!isset($_SESSION['u_id'] )&& $_SESSION['u_id']=='' && !isset($_SESSION['f_name'] )&& $_SESSION['f_name']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['email'] )&& $_SESSION['email']==''&& !isset($_SESSION['user_role'] )&& $_SESSION['user_role']==''&& !isset($_SESSION['region_id'] )&& $_SESSION['region_id']=='')
	{$cluster=$_SESSION['cluster_id'];
header("location:login.php");
}?>
<script type="text/javascript">
$(document).ready(function(e) {
     writeMonthOptions("#from");
	  writeMonthOptions("#to");
	$("#copy").click(function()
	  { 
	  var d = new Date();
      var thismonth = d.getMonth();
	var from=document.getElementById("from").value;
		  var to=document.getElementById("to").value;
		  if(to==0||from==0)  alert("invalid months. Select a valid month please"); 
		  else if(to<from) alert("Copy from a upper month to lower not allowed"); 
		   else if(to <thismonth) alert("Copying to a past month not allowed");
		   else{//send to the db
			   $.ajax({
				   type:"POST", data:"from="+from+"&to="+to+"&type=copy",url:"process.php",success: function(){
					   alert("Copied : "+getMonthName(from-1)+" plans to : "+getMonthName(to-1))
					   },
				   
				   });//end ajax
			   }//end else
			  
			  
		  });	  //end click function
});
//generate months

function writeMonthOptions(div)
{
var Months = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")

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
</script>

<?php include('../assets/lib/config.php'); include('../assets/lib/functions.php');

 ?>
<style>

	
	#trash{
		width:32px;
		height:32px;
		float:left;
		padding-bottom: 15px;
		position: relative;
	}
		
	#wrap {
		width: auto;
		margin: 0 auto;
	}
		
	#external-events {
		float: left ;
		width: 200px;

		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
			
	}
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}
		
	#external-events .fc-event {
		margin: 3px 0;
		cursor: pointer;
	}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		text-transform:capitalize;
		
	}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		float: right;
		min-width:500px;
		max-width:1100px;	
		left:250px;
		
	}
	#table {
		
		position:fixed;
		left:250px;
		margin-bottom:10px
	}
	.fc-time{
   display : none;
}

</style>
</head>
<body>
	<div id='wrap'>
    <?php  if($_SESSION['user_role']==1){?><table  style="margin:auto; width:50%" cellpadding="0" cellspacing="0" >
    <tr><th>Copy plan</th><th><select name="from" id="from"><option value="0">All months</option></select></th><th>To</th><th><select name="to" id="to"><option value="0">All months</option></select></th><th><button  id="copy" value="copy">Copy</button></th></tr><tbody></tbody></table>
<?php }  else{?>
<table  style="margin:auto; width:50%" cellpadding="0" cellspacing="0" >
    <tr><th>Select TSR</th><th><select name="tsr" id="tsr"><option>One staff</option></select></th><th>Region</th><th><select name="reg" id="reg"><option>All region</option></select></th><th>Month</th><th><select name="to" id="to"><option>All months</option></select></th><th><button value="View">View</button></th></tr><tbody></tbody></table>
	<?php
	}?>
		<div id='external-events'>
			<h4>DRAG TO CALENDER</h4>
		<p style="padding-bottom:15px">
				<img src="assets/img/trashcan.png" id="trash" alt="">
			</p>
            <table  width="100%" cellpadding="0" cellspacing="0" class=""><tr><th>Outlet</th><th>Pre. visit</th></tr><tbody>
            
           
            <?php
			// check last date of visit
			$area_id=$_SESSION['area_id'];
			
			 $q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status=0 and area_id=$area_id order by business_name")or die (mysqli_error($mysqli));
	while($r=mysqli_fetch_array($q))
	{		
		$id=$r['dealer_id'];
		$name=$r['business_name'];
		echo "<tr><td><div id=".$id." class='fc-event' style='text-transform:capitalize'>".$name."</div></td><td style='font-size:70%'>".outlet_last_visit($id)."</td></tr>";
		} ?> </tbody></table>
        </div>

		<div id='calendar'></div>

		<div style='clear:both'></div>

	</div>
</body>
</html>
