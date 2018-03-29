<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script type="text/javascript"  src="assets/js/scripts.js"></script> <?php require 'header.php';   $user='';
	if(isset($_REQUEST['user'])){
	$user=clean($_REQUEST['user']); 
	}
	else {
	header("location:".$_SERVER['HTTP_REFERER']."");}
	?>
    <script type="text/javascript">
/* $(document).ready(function(){
		load_products();
		 });
		//selecting salesman
	 function select_sales(){
			 var sel_val=document.getElementById('sales_person_selection').value;
		 n= user_name(sel_val); //alert(n);
		 
		  }*/
 
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
                 <div class="col-lg-9 main-chart">
                 <?php include('submenu.php');?>
                     <table  width="100%"><tr><th colspan="3"> <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <h3>Give stock to :  
                          <?php echo  get_name($user);
					?>
                      </h3>
                      </div></th></tr>
                       <!--Deliver products-->
                       <tr class="deliver">
                         <td>Take stock</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                       </tr>
                       
  </table>
<div style="background-color:#FFF">
   <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='tblAppend'>
  <tr class="modal-header "  >
                        <th  >&nbsp;</th>
                        <th  >SKU</th>
                        <th >Pack </th>
                        <th>Type</th>
                        <th >Cases</th>
                        <th >Pieces</th>
                        <th>Action</th>
                      </tr>
                     
                    <?php $i=1; $q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products` p where p.status=0 order by p.product desc  ")or die(mysqli_error($mysqli));
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product'];
										$available=$row['q_available']; 
										$type=$row['pack_size']; $pack=$row['flavour'];
										 $pid=$row['product_id'];?>
                              <form id="<?php echo $pid ?>" action="issue_exec.php" method="post">   <tr  >
                        <td ><?php echo $i?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                       <?php $qu=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `product_id`=$pid and Date(`date_added`)=Date(NOW()) ") or die(mysqli_error($mysqli));
					   $result=mysqli_fetch_array($qu); $stock_id=$result['stock_level_id']; $cases=$result['cases']; $singles=$result['singles']; if(mysqli_num_rows($qu)==1){?><td><?php echo $cases?></td><td><?php echo $singles?></td><td><a href="edit_stock.php?pid=<?php echo $stock_id?>">Edit</a></td><?php } else {?>
                       <td> <input  class='' type='text' name='crates' id='crates<?php echo $pid?>'/></td><td><input  class=''  type='text' name='singles' id='singles<?php echo $pid?>'></td><input type="hidden" name="pid" value="<?php echo $pid?>" id="<?php echo $pid?>" /><input type="hidden" name="dealer_id" value="<?php echo $user?>" id="<?php echo $user?>" />
                        <td> <input name='save'  id="<?php echo $pid?>" type='submit' value='save'></td><?php }?>
                      </tr>
                 </form>
                     
                                        <?php
										$i++;	}?> 
                      
  </table>         
                    
                 
</div></div>
               
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?php include('home_right.php');?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
  /*      $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to King Beverage DMS!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Developed by cloud connect',
            // (string | optional) the image to display on the left
            image: 'assets/img/eric.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	*/</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "fetch_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
	<script src="assets/js/google-maps/maplace.js"></script>
	<script src="assets/js/google-maps/data/points.js"></script>
	
	<script>
	    //ul list example
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-list',
	        controls_type: 'list',
	        controls_title: 'Choose a location:'
	    }).Load();
	
	    new Maplace({
	        locations: LocsB,
	        map_div: '#gmap-tabs',
	        controls_div: '#controls-tabs',
	        controls_type: 'list',
	        controls_on_map: false,
	        show_infowindow: false,
	        start: 1,
	        afterShow: function(index, location, marker) {
	            $('#info').html(location.html);
	        }
	    }).Load();
	</script>
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
