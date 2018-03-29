
<?php include_once("assets/lib/config.php");include_once("assets/lib/functions.php"); $dealer_id=$_REQUEST['dealer_id'];

$outlet=$_REQUEST['dealer_id'];
$mode=$_REQUEST['mode'];
if($mode=="outlet_dashboard"){///summary

 $outlet_profile=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE dealer_id=$dealer_id LIMIT 1")or die(mysqli_error($mysqli));
 $row=mysqli_fetch_array($outlet_profile); ?>
 <div id="overview1" ><h3 style="background-color:#FFF">Overview</h3>
<table cellpadding='0' width="100%" cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' id='tblAppend'>
<tr>
  <td>Date Reg.</td>
  <td><strong><?php echo $row['reg_date'];?></strong></td>
  <td>Reg By</td>
  <td><?php echo get_name($row['added_by']);?></td>
  <td>Region </td>
  <td><?php echo region_name($row['region_id']);?> </td>
  <td>Area</td>
  <td><?php echo area_name($row['area_id'])?></td>
  </tr>
<tr>
  
  <td>Sub Area</td>
  <td><?php echo sub_area_name($row['cluster_id'])?></td>
  <td>Route</td>
  <td><?php echo get_route($row['route_id'])?></td>
  <td>Distributor</td>
  <td><?php echo distributor_name($row['distributor_id'])?></td>
  <td>Location</td>
  <td><?php echo $row['town'];?></td>
  </tr>
<tr>
  <td>Verification status</td>
  <td><?php if($row['verified']==1) echo 'Verified'; else echo  "Not Verified" ?></td>
  <td>Opening time</td>
  <td><?php echo $row['opening_time']?></td>
  <td>Closing Time</td>
  <td><?php echo $row['closing_time']?></td>
  <td>neibourhood income?</td>
  <td><?php echo $row['neibourhood_income']?></td>
  </tr>
<tr>
  <td>Channel</td>
  <td><strong><?php echo channel_type($row['channel']);?></strong></td>
  <td> Contact person</td>
  <td><?php echo $row['owner_name'].' ('.$row['designation'];?>)</td>
  <td>Contact No.</td>
  <td><?php echo $row['phone'];?></td>
  <td>Map Location</td>
  <td ><?php echo d( Get_Address_From_Google_Maps($row["latitute"], $row["longtitute"]))?></td>
</tr>
<tr>
  
  <td>Location Occassions</td>
  <td><?php echo $row['location_occassions'];?></td>
  <td>Has Elecctricity</td>
<td><?php echo $row['has_electricity'];?></td>
  <td>Sales FMCG</td>
<td><?php echo $row['sales_fmcg'];?></td>
 <td>Sales Beverages</td>
  <td><?php echo $row['do_you_sell_any_bevs'];?></td>
</tr>
<tr>
  <td>Sales Coke</td>
  <td><?php echo $row['do_you_sell_any_bevs'];?></td>
    <td>Stocked Coke in the past</td>
  <td><?php echo $row['stocked_coke_inthePast'];?></td>
  <td>Reason For not stocking coke</td>
  <td><?php echo $row['why_dd_yu_stop_stocking_coke'];?></td>
  <td>Willing to stoke coke</td>
<td><?php echo $row['willing_to_stock_coke'];?></td>

</tr>
<tr>
<td>Remarks on willingness to sell coke</td>
  <td><?php echo $row['willingness_remarks'];?></td>
  <td>Last Visit</td>
  <td><?php echo outlet_last_visit($dealer_id)?></td>
  <td>#visits</td>
  <td><?php echo  times_visited($dealer_id)?></td>
  <td>Next Visit</td>
  <td><?php echo getColumnName(" tbl_route_plan "," startdate "," startdate>= CURRENT_DATE()  and dealer_id=$dealer_id and status=0")?></td>
  
</tr>

<tr>
 <td>Sellout Rate</td>
  <td><?php echo outlet_sell_out_rate($dealer_id) ?> Cases/day</td>
   <td>Ex Reorder date</td>
  <td>N/A</td>
<td>Date Modified</td>
  <td><?php echo $row['dateTimeModified'];?></td>
 
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
 </table> 
</div>
<div><h3>Outlet Assets</h3>
 <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr>
                                  
                                  <th>No</th>
                                  <th>Asset</th>
                                  <th>Model</th>
                                  <th>Serial No</th>
                                  <th>Bar Code</th>
                                  <th>Date Issued</th>
                                                        
                                   <th>Held By</th>
                                   <th>Reg By</th>
                                    <th>Remarks</th>
                                   <th>&nbsp;</th>
                              </tr>
                              </thead><tbody>
                             <?php  $i=1; $u=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` where dealer_id=$outlet") or die(mysqli_error($mysqli));
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								 
								  $held_by=business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $date_isued=$asset_row['date_isued'];
								   $by=get_name($asset_row['reg_by']);
								  
									$remarks=$asset_row['remarks'];
										$name=$asset_row['name'];
								   
								 ?>
								 <tr>
                                 <th><?php echo $i?></th>
                                  <th><?php echo $name?></th>
                                  <th><?php echo $model?></th>
                                  <th><?php echo $serial?></th>
                                  <th><?php echo $bar_code?></th>
                                  <th><?php echo $date_isued?></th>
                                                        
                                   <th><?php echo $held_by?></th>
                                   <th><?php echo $by?></th>
                                    <th><?php echo $remarks?></th>
                                   <th><a href="asset_profile.php?id=<?php echo $id?>">Profile</a></th>
							     </tr>
								 <?php $i++;}?>
                                 </tbody>
</table></div>
<div>
  <h3>Previus Visit Details</h3>
                        
				  <?php
						 $checkin_query=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` WHERE  dealer_id=$dealer_id ORDER BY checkin_id desc LIMIT 1") or die(mysqli_error($mysqli));  
 $date_due=date("Y-m-d");  
						   $checkin_id=0; $stock_level_id=0;
	  
	if(mysqli_num_rows($checkin_query)==0){ echo "<div><table><tr><td> RED audit not carried out. <a href='mechandize.php?dealer_id=$dealer_id>Click Here</a></td></tr></table></div>";} else{ $checkin_row=mysqli_fetch_array($checkin_query);
	  $checkin_date=$checkin_row['date_timein'];
						  $checkout_date=$checkin_row['date_timeout'];
						  $inside_advert="Unailavable";  $inside_advert="Available";
						  $outside_advert="Unailavable";  $outside_advert="Available";
						  $mechandize="No";$mechandize='Yes';
						  $has_light_pannels="No";  $has_light_pannels="yes";
						  $promotion="No";  $promotion="Yes";
						  $has_glasses="No";  $has_glasses="Yes";
						  $fridge="No";  $fridge="Yes";
						 $has_coasters="No";  $has_coasters="yes";
						  $bar_r="No";  $bar_r="yes";
						  $has_neon_signs="No";  $has_neon_signs="yes";
						  $remarks_checkin='';
						  $img1='';
							$img2='';
							$img3='';
							$lat=$checkin_row['latitute'];
							$long=$checkin_row['longtitute'];
							$by=$checkin_row['user_id'];
							  ?>                      </div>
                      <div  style="padding-bottom:20px" class="float_left">
                   <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed"><thead>
                               <tr class=" "  >
                        <th colspan="4"  >Survey status report</th>
                      </tr>
                             </thead>
                     <tr>
                       <td width="37%" nowrap>Checkin Date/time </td>
                       <td width="31%" nowrap ><?php echo $checkin_date?></td>
                       <td width="32%" nowrap >Survey Done by</td>
                       <td width="63%" nowrap ><?php echo get_name($by)?></td>
                     
                    <tr>
                      <td>Running Promotoin</td>
                      <td nowrap ><?php echo $promotion?></td>
                      <td nowrap >Loaction</td>
                      <td nowrap ><?php echo d( Get_Address_From_Google_Maps($row["latitute"], $row["longtitute"]))?></td></tr>
                      
                    <?php $surveyQ=mysqli_query($mysqli,"SELECT `survey_id`, question,q_type, `survey_date`, `q_id`, `answer`, `plan_id`, `dealer_id` FROM `tbl_survey` s LEFT JOIN tbl_survey_questions sq on sq.survey_qID=s.q_id WHERE `dealer_id`=$dealer_id order by survey_id desc ")or die(mysqli_error($mysqli));
				   while($s_row=mysqli_fetch_array($surveyQ)){?> 
                   
                   <tr>
                      <td colspan="4" nowrap><p style="text-align:center; font-weight:bold; color:#000"><?php echo $s_row["question"]?></p></td>
                     <tr>
                      <td colspan="4" nowrap><?php echo  $s_row["answer"]?></td>
                      <?php } ?>
                       
                                            
                       <tr>
                        <td nowrap="nowrap">Perfomance rating?</td>
                        <td nowrap="nowrap">&nbsp;</td>
                        <td nowrap="nowrap">&nbsp;</td>
                        <td nowrap="nowrap">&nbsp;</td>
                      </tr>
                     <tr>
                      <td nowrap>Your Remarks</td>
                      <td nowrap ><?php echo $remarks_checkin?></td>
                      <td nowrap >Place done</td>
                      <td nowrap ><?php d( Get_Address_From_Google_Maps($lat, $long))?> </td>
                      <tr>
                      <td nowrap><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo image_properties($img1)?>" href="<?php echo $img1?>"><img class="img-responsive" src="<?php echo $img1?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div></td>
                      <td nowrap ><div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo image_properties($img2)?>" href="<?php echo $img2?>"><img class="img-responsive" src="<?php echo $img2?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div>
                      
                     </td>
                      <td nowrap > <div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" title="Date taken: <?php echo image_properties($img3)?>" href="<?php echo $img3?>"><img class="img-responsive" src="<?php echo $img3?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div></td>
                      <td nowrap >&nbsp;</td>
                    </table> <?php }?>
                
                  <div class="room-box">
<h3>Stock Holding</h3></div>
                   <!--start -->           
                  <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                               <tr class=" "  >
                        <th  >&nbsp;</th>
                        <th  >SKU</th>
                        <th >Pack </th>
                        <th>Type</th>
                        <th >Cases</th>
                        <th >pieces</th>
                       
                      </tr>
                             </thead>
                             <tbody>  <?php echo $date=date("Y-m-d",strtotime(outlet_last_visit($dealer_id))); $i=1;
							  $q=mysqli_query($mysqli,"SELECT * FROM  `tbl_products` p where p.status=0 order by p.product desc  ")or die(mysqli_error($mysqli));
							 
										while($row = mysqli_fetch_array($q)){

										$sku=$row['product'];$available=$row['q_available']; $type=$row['sku_type']; $pack=$row['pack_size']; $pid=$row['product_id'];?>
                              <tr>
                                  
                        <td ><?php echo $i?></td>
                        <td ><?php echo $sku?> </td>
                        <td><?php echo $pack?></td>
                        <td><?php echo $type?></td>
                        <td class="numeric"><?php echo stock($dealer_id,'cases',$pid,$date)?></td>
                           <td class="numeric"><?php echo stock($dealer_id,'singles',$pid,$date)?></td>
                               </tr><?php $i++; }  ?>
                               <tr>
                                  <th width="34"></th>
                                  <th width="374"></th>
                                  <th width="150"></th>  <th width="150"></th>
                                  
                                  <th width="146" >&nbsp;</th> <th width="120" class="numeric">&nbsp;</th>
                                  
                    </tbody>
</table>
           <div class="room-box">
                    <h3>Orders and Deliveries History</h3></div>
<?php $order_id=0; $oq=mysqli_query($mysqli,"SELECT order_id FROM `tbl_orders` WHERE DATE(`date_supplied`)='$date' limit 1")or die(mysqli_error($mysqli));
if(mysqli_num_rows($oq)==0){ //echo 'No order/delivery made';
	} else{ $order_row=mysqli_fetch_array($oq);
		$order_id=$order_row['order_id'];
		 $od=mysqli_query($mysqli,"SELECT * FROM `tbl_orders_details` WHERE order_id='$order_id'")or die(mysqli_error($mysqli));
if(mysqli_num_rows($od)==0){ echo 'No details available';
	} else
	{
		while($details_row=mysqli_fetch_array($od)){
			
			}
			}//end else
		
	}?>


 <table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
                             <thead>
                               <tr>
                                  <th width="35">Code</th>
                                  <th width="32">SKU</th>
                                   <th width="33">Pack</th>
                                    <th width="34">Type</th>
                                    
                                    <th width="65">Qty required</th>
                                  <th width="57">Qty Supplied</th>
                                  <th width="56">Qty Ordered</th>
                                  
                                  
                                  <th width="54" >Date ordered</th> <th width="112" class="numeric">Price(Ksh)</th>
                                  
                              </tr>
                             </thead>
                             <tbody><?php $oid_of_order=0; $i=1; $status=0; $date_supplied=date("Y-m-d");$sub_t=0;
 $orders=mysqli_query($mysqli,"SELECT product,product_desc, od.date_supplied as date_supplied, od.status as status,sku_type,pieces,cases,s_price,od.order_id as oid,od.date_added as date_added FROM `tbl_orders` o join tbl_orders_details od on o.order_id=od.order_id left Join tbl_products p on p.product_id=od.product_id WHERE o.`order_id`=$order_id ")or die(mysqli_error($mysqli));
 if(mysqli_num_rows($orders)==0){echo '<tr><td colspan="7">Empty</td></tr>';} else{
  while($row=mysqli_fetch_array($orders)){ 
							 $oid_of_order= $row['oid'];
							 $req=$row['cases']; $sup=$row['pieces'];
							 $preorder=$req-$sup;
							 $date=$row['date_added'];
							 $status=$row['status'];  $date_supplied=$row['date_supplied'];
							 $sub_t=$preorder*$row['s_price'];
							 if($preorder!=0){
							  ?>
                              
                              <tr>
                                  <td><?php echo $i?></td>
                                  <td><?php echo $row['product']?></td>
                                  <td><?php echo $row['product_code']?></td><td><?php echo $row['sku_type']; ?></td><td><?php echo $req; ?></td><td><?php echo $sup ?></td>
                                  <td class="numeric"><?php echo $preorder?></td><td class="numeric"><?php echo record_date($date)?></td>
                                  <td class="numeric"><?php echo   $sub_t ?></td>
                                  
                               </tr><?php $i++;} 
							   }
							   } ?>
                               <tr>
                                  <th></th>
                                 <th></th>
                                  <th></th>
                                 <th></th>
                                   <th></th>
                                 <th></th>
                                   <th></th>
                                
                                  <th width="57" >Total</th> <th width="56" class="numeric"><?php //echo $currency.' '. price_calc($oid_of_order)?></th></tr>
                                 <tr><td align="right" colspan="9"><?php if(price_calc($oid_of_order)==0){} else if($status==0){?><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><input type="submit" name="deliver" value="Deliver"></form><?php } else echo ' Order Delivered on '.record_date($date_supplied);?></td></tr>
   </tbody>
</table>
 
<table style="background-color:#FFF" class="table table-bordered table-striped table-condensed">
   
                    <?php $surveyQ=mysqli_query($mysqli,"SELECT `survey_id`, question,q_type, `survey_date`, `q_id`, `answer`,  `dealer_id` FROM `tbl_survey` s LEFT JOIN tbl_survey_questions sq on sq.survey_qID=s.q_id WHERE `dealer_id`=$dealer_id order by survey_id desc ")or die(mysqli_error($mysqli));
				   while($s_row=mysqli_fetch_array($surveyQ)){?> 
                   
                   <tr>
                      <td colspan="4" nowrap><p style="text-align:center; font-weight:bold; color:#000"><?php echo $s_row["question"]?></p></td>
                     <tr>
                      <td colspan="4" nowrap><?php echo  $s_row["answer"]?></td>
                      <?php } ?>
                       </table>
                       <?php }
					   else if($mode=="outlet_assets"){
						   ?>
						   <h3>Outlet Assets</h3>
 <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr>
                                  
                                  <th>No</th>
                                  <th>Asset</th>
                                  <th>Model</th>
                                  <th>Serial No</th>
                                  <th>Bar Code</th>
                                  <th>Date Issued</th>
                                                        
                                   <th>Held By</th>
                                   <th>Reg By</th>
                                    <th>Remarks</th>
                                   <th>&nbsp;</th>
                              </tr>
                              </thead><tbody>
                             <?php  $i=1; $u=mysqli_query($mysqli,"SELECT * FROM `tbl_assets` where dealer_id=$outlet") or die(mysqli_error($mysqli));
							  while($asset_row=mysqli_fetch_array($u)){
								  $id=$asset_row['asset_id'];
								 
								  $held_by=business_name($asset_row['dealer_id']);
								 $model=$asset_row['model'];
								 $serial=$asset_row['serial'];
								 $bar_code=$asset_row['code'];
								  $date_isued=$asset_row['date_isued'];
								   $by=get_name($asset_row['reg_by']);
								  
									$remarks=$asset_row['remarks'];
										$name=$asset_row['name'];
								   
								 ?>
								 <tr>
                                 <th><?php echo $i?></th>
                                  <th><?php echo $name?></th>
                                  <th><?php echo $model?></th>
                                  <th><?php echo $serial?></th>
                                  <th><?php echo $bar_code?></th>
                                  <th><?php echo $date_isued?></th>
                                                        
                                   <th><?php echo $held_by?></th>
                                   <th><?php echo $by?></th>
                                    <th><?php echo $remarks?></th>
                                   <th><a href="asset_profile.php?id=<?php echo $id?>">Profile</a></th>
							     </tr>
								 <?php $i++;}?>
                                 </tbody>
</table>
<?php }
					   
					   else if($mode=="outlet_stock"){ //stock
					   						   ?>
					   <table class="table table-bordered table-striped table-condensed" >
                              <thead>
                              <tr><th>#</th>
                                  <th>SKU</th>
                                 <?php $i=1; $days=daysInMonth(date('Y'),date('m')); $today=date("d");
								 for($day=1; $day<=$today; $day++) {?> <th><?php echo $day?></th><?php }?></tr> 
                                
                               <tr><th></th><th></th> <?php for($day=1; $day<=$today; $day++) {?>  <th >Actual</th>
                               <!-- <th >Dif</th>-->
                              <?php }?>
                                                           </tr>
                              </thead>
                            <tbody id="">
                            <?php $pq=mysqli_query($mysqli,"SELECT product,product_id from tbl_products where status=0")or die (mysqli_error($mysqli));
							
							while($prow=mysqli_fetch_array($pq)){
								?>
                               <tr><td ><?php echo $i?></td>
                                  <td ><?php echo $prow['product']?></td>
                                 <?php  
								 for($day=1; $day<=$today; $day++) {?> <td ><?php  echo $cur=stock($outlet,"cases",$prow['product_id'],date("Y-m-$day"))?></td><?php }?>
                                 
                              </tr>
								<?php $i++; }
							?></tbody>
                             
                             
                          </table>
					   <?php }
                        else if($mode=="outlet_objectives"){ //stock
					   						   ?>
					   <table border="1px" class="table table-bordered table-striped" id="tblExport">	
                              <thead>
                              <tr>
                                  <th >No</th>
                                  <th >Objetive detail</th>
                                  <th  >Reviewed </th>
                                   <th >Remarks</th>
                                  <th >Outlets</th>
                                   <th >Added By</th>
                                   <th>Date Time</th>
                                  <th >Actions</th>
                              </tr>
                             
                              </thead>
                              <tbody>
                             <?php  $i=1;
			$q=mysqli_query( $mysqli,"SELECT `objective_id`, `details`, `reviewed_objective`, `dealer_id`, `added_by`, `date_added`, `remarks`, `status` FROM `tbl_objectives` WHERE dealer_id=$outlet order by date_added desc")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
																?>
                                
                                 <tr>
                                   <td><?php echo $i; ?></td>
                                   <td ><?php echo $r['details'];?></td>
                                   <td ><?php echo $r['reviewed_objective'];?></td>
                               
                                    <td ><?php echo $r['remarks'];?></td>
                                        <td ><?php echo business_name($r['dealer_id']);?></td>
                                         <td ><?php echo get_name($r['added_by']);?></td>
                                     <td ><?php echo $r['date_added'];?></td>
                                     <td ><a href=""><?php ?> View</a></td>
                                       </tr>  
                                <?php $i++; }?>
                                
                          
                              </tbody>
                               
                          </table>
					   <?php }?>
 
 
