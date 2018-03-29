<?php session_start(); $region_id=$_SESSION['region_id'];  $area_id=$_SESSION['area_id'];?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php require 'header.php';   $user_id=$_SESSION['u_id'];
	 ?>

  
 
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
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->

      
      <!--sidebar end-->
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
  <section id="main-content">
    <h1>    Outlets that have not complied </h1> 
    
     <h3 class="centered">  Incomplete outlets </h3>
     Please Update or delete the following outlets before you get access to the other system features. Work with the data collection team to update the routes and sub areas that are missing. Thanks
  </section>
  

    <table width="100%"  class='"table table-bordered table-striped table-condensed ' ><thead><tr> <th >No</th>
      <th >Outlet Name</th> 
    <th >Area</th>
            <th  >Sub Area</th> <th  >Distributor</th> <th >Route </th>
                             
                                  <th>Town/location</th>
                                   <th>Landmark</th>
                              <th  >Reg Date</th>
                               <th >channel</th>
                              <th  >Reg by</th>
                            
                              <th  >Actions</th></tr>
                              <?php $i=1;$query=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE (route_id=0 or cluster_id=0) and status=0 and area_id=$area_id order by added_by asc")or die (mysqli_error($mysqli));
							  while($row=mysqli_fetch_array($query)){
								  $dealer_id= $row['dealer_id'];
								 ?>
        <tr>
          <th ><div align="left"><?php echo $i;?>
          </div></th>
          <th ><div align="left"><?php echo business_name($dealer_id)?>
          </div></th>
         <th > <div align="left"><?php echo get_area($row['area_id'])?></div></th>
          <th ><div align="left">
            <?php echo  sub_area_name($row['cluster_id'])?> </div></th>
            <th ><div align="left">
            <?php echo  distributor_name($row['distributor_id'])?> </div></th>
           <th ><div align="left"><?php echo get_route($row['route_id'])?></div></th>
          <th><div align="left"><?php echo $row['town']?></div></th>
            <th><div align="left"><?php echo $row['landmark_building']?></div></th>
          <th  ><div align="left"><?php echo $row['reg_date']?></div></th>
          <th  ><div align="left"><?php echo channel_type($row['channel'])?></div></th>
          
          <th  ><div align="left"><?php echo get_name($row['added_by']); //num_rows("tbl_assets","dealer_id=$dealer_id"); echo num_rows("tbl_survey","dealer_id=$dealer_id")?></div></th>
          <th  ><div align="left"><a href="update_cluster_route.php?dealer_id=<?php echo $dealer_id
		  ?>">Update</a> | <a href="read.php?mode=delete_outlets&dealer_id=<?php echo $dealer_id?>">Delete</a></div></th>
            </tr><?php  $i++;}?>
    </thead>
            
                            </table>



 
 

    	


	


    
  </body>
</html>
