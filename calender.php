<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<?php include('header.php'); ?>
<link href='fullcalendar/assets/css/fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />


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
		height: 1000px;
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
		margin: 10px 0;
		cursor: pointer;
	}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		float: right;
		width: 1100px;
	}

</style>
</head>
<body style="background:#FFF">
	<div id='wrap'>

		<div id='external-events'>
			<h4>Drag outlets</h4>
		<p style="padding-bottom:15px">
				<img src="assets/img/trashcan.png" id="trash" alt="">
			</p>
            <?php $q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE status=0 and region_id=4 order by business_name")or die (mysql_error());
	while($r=mysqli_fetch_array($q))
	{
		
		$id=$r['dealer_id'];
		$name=$r['business_name'];
		echo "<div id=".$id." class='fc-event'>".$name."</div>";
		} ?>
            
			
		</div>

		<div id='calendar'></div>

		<div style='clear:both'></div>

	</div>
    <script src='fullcalendar/assets/js/moment.min.js'></script>
<script src='fullcalendar/assets/js/jquery.min.js'></script>
<script src='fullcalendar/assets/js/jquery-ui.min.js'></script>
<script src='fullcalendar/assets/js/fullcalendar.min.js'></script>
<script type="text/javascript" src="fullcalendar/calender.js"></script>
</body>
</html>
