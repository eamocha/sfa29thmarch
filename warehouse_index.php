<div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                         <?php include('submenu.php');?>
                      </div>
                     <!--start my trips . trip1-->           
                 
                       <!--end trip 1--> 
                    <?php 
//; include the date bit DATE(`date_due`)=date(NOW()) AND 
$sel=mysql_query("SELECT o.status as status,o.dealer_id as dealer_id, d.town as town,u.full_name as full_name,o.date_time_assigned as date_time_assigned,business_name,d.place_name as place_name,o.date_made as date_time, o.quantity as quantity,preordered_by,date_due FROM `tbl_orders` as o left join tbl_products as p on o.product_id=p.product_id left JOIN tbl_dealers as d on o.dealer_id=d.dealer_id left Join tbl_users as u on o.`preordered_by`=u.user_id left join tbl_routes as r on r.route_id=o.route_id WHERE u.user_id=$user_id")or die(mysql_error());
if(mysql_num_rows($sel)==0) echo '<div class="room-box">Today you dont have any scheduled trips!<br/> <strong>Good Day!!!</strong></div>'; 
else{
while($row=mysql_fetch_array($sel)){
	$visted=$row['status'];
if($visted==1){?><div class="room-box"><?php } else
{?> <div class="room-box notvisited"><?php } ?>
                              <h5 class="text-primary"><a href="client_details.php?dealer_id=<?php echo $row['dealer_id']?>"><?php echo $row['business_name']?> </a>- Assigned by <?php echo $row['full_name'] ?>  <?php echo nicetime($row['date_time_assigned'])?> </h5><span style="float:right"> <?php if($visted==1){?>   <button class="btn btn-success "> Visited</button><?php } else{?>	<button type="button" onclick="window.location='checkin.php?dealer_id=<?php echo $row['dealer_id']?>'" class="btn btn-danger">CheckIn</button><?php }?></span>
                              <p>Located at<?php echo $row['town']." ".$row['place_name']?>. The client placed an order on <?php $row['date_time'];?> of <?php echo $row['quantity'];?> Cases and <?php //echo $row['single_bottles'];?>  </p>
                              <p><span class="text-muted">Order by :</span><?php  $pre_by=$row['preordered_by']; $od=mysql_query("SELECT * FROM `tbl_users` WHERE `user_id`=$pre_by"); $rs=mysql_fetch_array($od); echo $rs['full_name']; ?> <span class="text-muted">Order was due on :</span> <?php echo $row['date_due']?> | <span class="text-muted">Last Activity :</span><?php echo nicetime($row['date_due'])?></p>
                              <p><button class="btn btn-success btn-xs fa fa-check"> Preorder</button> 
                                                <span class="btn btn-danger btn-xs fa fa-trash-o">Delete Preorder</span>    <span class="badge bg-warning">Notify</span></p>
                    </div>
	
 <?php }//end while
}//end else?>
 
 
                          <div class="room-box notvisited">
                              <h5 class="text-primary"><a href="client_history.php">Client D </a>- Assigned by Eric Atinga on 12th dec 2014</h5><span style="float:right">   	<button type="button" onclick="window.location='checkin.php? dealer_id=1'" class="btn btn-danger">CheckIn</button></span>
                              <p class="notvisited">Located at nairobi city center. 3 m from the city council buidling.placed an order on....... oof 3 botles and 2....</p>
                              <p><span class="text-muted">Sales Companion :</span>with Morris Muli | <span class="text-muted">Visted the client :</span> 98 Times| <span class="text-muted">Last Activity :</span> 2 min ago</p>
                              <p><span class="badge bg-important">Notify</span></p>
                          </div>   
				<!--end my trips list -->
					<div> <a href="">See More</a> </div>
                  
                  
                  

	        <div class="row mt">
	            <div class="col-sm-12">
	                <section class="panel">
	                    <header class="panel-heading">
	                        Google Map with Loaction List
	                    </header>
	                    <div class="panel-body">
	                        <div id="gmap-list"></div>
	                    </div>
	              
	            </div>
	        </div><!--end map-->
                  </div>