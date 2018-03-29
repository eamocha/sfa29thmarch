<?php include 'assets/lib/config.php'; include 'auth.php'; include 'assets/lib/functions.php'; 
$items_per_group=3000;
if($_REQUEST)
{	//sanitize post value
	$group_number = filter_var($_REQUEST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		//throw HTTP error if group number is not valid
	if(!is_numeric($group_number)){
		header('HTTP/1.1 500 Invalid number!');
		exit();
	}	
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	$date=date("Y-m-d",$_REQUEST['dt']);
	$total=$_REQUEST['total'];
	
	//mode
	if($_REQUEST['mode']=='survey'){
		
	$i=1; $oad=0 ;$iad=0 ;$merch=0 ;$fridge=0 ;$glasses=0 ;$coasters=0 ;$neon=0 ;$pannels=0 ;$barrunners=0 ;$promotion=0 ;
	$d_q=mysqli_query($mysqli,"SELECT * FROM `tbl_check_in` where  DATE(`date_timein`)='$date' and status=0 LIMIT $position, $items_per_group") or die(mysqli_error($mysqli)); $number=mysqli_num_rows($d_q);
	if($number==0){ echo"<tr><td colspan='3'>Empty results</td> <td ></td><td></td><td ></td><td ></td><td></td>                                  <td></td>  <td></td><td></td><td ></td>
                              </tr>";} else{
while($tt=mysqli_fetch_array($d_q))
{ $did=$tt['dealer_id'];
							$tt['outside_advert']==1? $oad++:$oad ;$tt['inside_advert']==1?$iad++ :$iad; $tt['mechandize']==1?$merch++:$merch ;$tt['fridge']==1?$fridge++:$fridge ;$tt['has_glasses']==1?$glasses++ :$glasses;$tt['has_coasters']==1?$coasters++:$coasters;$tt['has_bar_runners']==1?$barrunners++:$barrunners;$tt['has_neon_signs']==1?$neon++:$neon;	$tt['running_promotion']==1?$promotion++:$promotion; 
							
								
                               ?>
                                 <tr>
                                  <td><?php if($position==0) echo $i; else echo $i+$position;?></td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo survey($did,'outside_advert',$date)?></td>
                                  <td ><?php echo survey($did,'inside_advert',$date)?></td>
                                  <td ><?php echo survey($did,'mechandize',$date)?></td>
                                  <td><?php echo survey($did,'has_neon_signs',$date)?></td>
                                  <td><?php echo survey($did,'has_light_pannels',$date)?></td>
                                   <td><?php echo survey($did,'has_bar_runners',$date)?></td>
                                   <td><?php echo survey($did,'has_coasters',$date)?></td>
                                  <td ><?php echo survey($did,'has_glasses',$date)?></td>
                                  <td ><?php echo survey($did,'running_promotion',$date)?></td>
                                  <td ><?php echo survey($did,'fridge',$date)?></td>
                              </tr>
                           
                             <?php $i++; }
							 ?> 
                              <tr>
                                   <td>&nbsp;</td>
                                   <td >% summary</td>
                                   <td ><?php if($number>0) echo number_format($oad*100/$number,2).'%';?></td>
                                   <td><?php if($number>0) echo number_format($iad*100/$number,2).'%';?></td>
                                   <td ><?php if($number>0)echo number_format($merch*100/$number,2).'%';?></td>
                                    <td ><?php if($number>0) echo number_format($neon*100/$number,2).'%';?></td>
                                     <td ><?php if($number>0) echo number_format($pannels*100/$number,2).'%';?></td>
                                      <td ><?php if($number>0)echo number_format($barrunners*100/$number,2).'%';?></td>
                                       <td ><?php if($number>0)echo number_format($coasters*100/$number,2).'%';?></td>
                                  <td ><?php if($number>0)echo number_format($glasses*100/$number,2).'%';?></td>
                                  <td ><?php if($number>0)echo number_format($promotion*100/$number,2).'%';?></td>
                                  <td ><?php if($number>0)echo number_format($fridge*100/$number,2).'%';?></td>
                                 </tr>
                                 <?php // end if
	}}// end both the 'else' there are records ad the  mode..............................................................................................................................
	if($_REQUEST['mode']=='stock_levels'){
		
	 $totalcal1=0;$totalcal2=0;$totalcal3=0;$totaltur1=0;$totaltur2=0;$totaltur3=0;$totalsomer1=0;$totalsomer2=0;$totalsomer3=0; $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` where status=0 LIMIT $position, $items_per_group")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								
								$totalcal1 +=stock($did,'singles',27,$date);
                                $totalcal2+= stock($did,'cases',28,$date);
                              $totalcal3+=  stock($did,'singles',29,$date);
                                 $totaltur1+= stock($did,'cases',30,$date);
                                  $totaltur2+= stock($did,'singles',31,$date);
                                  $totaltur3+= stock($did,'cases',32,$date);
                                   $totalsomer1+=stock($did,'singles',33,$date);
                                $totalsomer2+=stock($did,'cases',34,$date);
                                 $totalsomer3+=stock($did,'cases',35,$date);
                               ?>
                                
                                 <tr>
                                  <td><?php $date_query=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did order by stock_level_id desc limit 1 ")or die(mysql_error($mysqli)); $result_dat=mysqli_fetch_array($date_query);  $last_d=$result_dat['date_added']; echo date("d.m.Y",strtotime($last_d));
								   ?></td>
                                  <td ><?php echo $r['business_name'];?></td>
                                  <td><?php echo stock($did,'singles',27,$date)?></td>
                                  <td><?php echo stock($did,'cases',28,$date)?></td>
                                   <td><?php echo stock($did,'singles',29,$date)?></td>
                                  <td><?php echo stock($did,'cases',30,$date)?></td>
                                   <td><?php echo  stock($did,'singles',31,$date)?></td>
                                   <td><?php echo  stock($did,'cases',32,$date)?></td>
                                   <td><?php echo stock($did,'singles',33,$date)?></td>
                                  <td><?php echo stock($did,'cases',34,$date)?></td>
                                   <td><?php echo stock($did,'cases',35,$date)?></td>
                                  <td ><a href="stock_by_outlet.php?dealer_id=<?php echo $did?>">View more</a></td>
                              </tr>
                           
                             <?php $i++; }
							 if($i==$total){?> 
                               <tr style="font-size:110%; background:#666 !important;  font-weight:500;" >
                               <td>&nbsp;</td>
                               <td >Total</td>
                               <td ><?php echo $totalcal1?></td>
                               <td ><?php echo $totalcal2?></td>
                               <td ><?php echo $totalcal3?></td>
                               <td ><?php echo $totaltur1?></td>
                               <td ><?php echo $totaltur2?></td>
                               <td ><?php echo $totaltur3?></td>
                               <td ><?php echo $totalsomer1?></td>
                               <td ><?php echo $totalsomer2?></td>
                               <td ><?php echo $totalsomer3?></td>
                               <td  >&nbsp;</td>
                             </tr>
                                 <?php }// end if
	}// end mode
	
	if($_REQUEST['mode']=='orders_summary'){
		
	 $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` where status=0 LIMIT $position, $items_per_group")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$region_id=$r['region_id'];
								
								
                               ?>
                                
                                 <tr>
                                  <td> <?php echo $i; ?>  </td>
                                  <td ><?php echo region_name($region_id)?></td>
                                  <td><?php echo all_orders_in_region($region_id)?></td>
                                  <td><?php echo serviced_orders_in_region($region_id) ?></td>
                                   <td><?php echo rejected_orders_in_region($region_id)?></td>
                                  <td><?php echo expired_orders($region_id)?></td>
                                   
                                   </tr>
                           
                             <?php $i++; }
							
	}// end mode
	if($_REQUEST['mode']=='all_outlets'){//start mode all outlets
		$i=1;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` where status=0 order by region_id LIMIT $position, $items_per_group ")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								$region_id=$r["region_id"];
								
								$type_of_outlet=$r["type_of_outlet"];
								$longtitute=$r["longtitute"];
								$latitute=$r["latitute"];
								$channel=channel_type($r["channel"]);
									$phone=$r["phone"];
										$reg_by=$r["added_by"];
											$reg_date=$r["reg_date"];
												$town=$r["town"];
                               ?>
                                
                                 <tr>
                                  <td><?php	 echo $i;   ?></td>
                                  <td ><?php echo business_name($did);?></td>
                                       <td><?php //echo get_region_from_district($id)?></td>
                                  <td><?php echo region_name($region_id);?></td>
                                <!--  <td><?php	// echo $channel   ?></td>-->
                                   <td><?php echo $longtitute //$coods	; if($latitute!=0 and $longtitute!=0)  $coods=0 ;else $coods=1; echo survey_history($coods); ?></td><td><?php echo $latitute?></td>
                                  <td><?php	 echo $town   ?></td>
                                   <td><?php	echo $r['owner_name'];   ?></td>
                                  
                                  <td><?php	 echo $phone ?></td>
                                 
                                  <td ><?php	 echo get_name($reg_by) ?></td>
                                    <td><?php	 echo record_date($reg_date) ?></td>
                                    
                                   <td><?php echo '<input type="checkbox" class="checkbox" value="'.$did.'" name="list[]">'?></td>
                                  
                              </tr>
                           
                             <?php $i++; }
							
                               
	}// end mode
	//******************************************************************************************************************
if($_REQUEST['mode']=='stock_levels'){
		
	 $totalcal1=0;$totalcal2=0;$totalcal3=0;$totaltur1=0;$totaltur2=0;$totaltur3=0;$totalsomer1=0;$totalsomer2=0;$totalsomer3=0; $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` where status=0 LIMIT $position, $items_per_group")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								
								$totalcal1 +=stock($did,'singles',27,$date);
                                $totalcal2+= stock($did,'cases',28,$date);
                              $totalcal3+=  stock($did,'singles',29,$date);
                                 $totaltur1+= stock($did,'cases',30,$date);
                                  $totaltur2+= stock($did,'singles',31,$date);
                                  $totaltur3+= stock($did,'cases',32,$date);
                                   $totalsomer1+=stock($did,'singles',33,$date);
                                $totalsomer2+=stock($did,'cases',34,$date);
                                 $totalsomer3+=stock($did,'cases',35,$date);
                               ?>
                                
                                 <tr>
                                  <td><?php $date_query=mysqli_query($mysqli,"SELECT * FROM `tbl_stock_levels` WHERE `dealer_id`=$did order by stock_level_id desc limit 1 ")or die(mysql_error($mysqli)); $result_dat=mysqli_fetch_array($date_query);  $last_d=$result_dat['date_added']; echo date("d.m.Y",strtotime($last_d));
								   ?></td>
                                  <td ><?php echo $r['business_name'];?></td>
                                  <td><?php echo stock($did,'singles',27,$date)?></td>
                                  <td><?php echo stock($did,'cases',28,$date)?></td>
                                   <td><?php echo stock($did,'singles',29,$date)?></td>
                                  <td><?php echo stock($did,'cases',30,$date)?></td>
                                   <td><?php echo  stock($did,'singles',31,$date)?></td>
                                   <td><?php echo  stock($did,'cases',32,$date)?></td>
                                   <td><?php echo stock($did,'singles',33,$date)?></td>
                                  <td><?php echo stock($did,'cases',34,$date)?></td>
                                   <td><?php echo stock($did,'cases',35,$date)?></td>
                                  <td ><a href="stock_by_outlet.php?dealer_id=<?php echo $did?>">View more</a></td>
                              </tr>
                           
                             <?php $i++; }
							 if($i==$total){?> 
                               <tr style="font-size:110%; background:#666 !important;  font-weight:500;" >
                               <td>&nbsp;</td>
                               <td >Total</td>
                               <td ><?php echo $totalcal1?></td>
                               <td ><?php echo $totalcal2?></td>
                               <td ><?php echo $totalcal3?></td>
                               <td ><?php echo $totaltur1?></td>
                               <td ><?php echo $totaltur2?></td>
                               <td ><?php echo $totaltur3?></td>
                               <td ><?php echo $totalsomer1?></td>
                               <td ><?php echo $totalsomer2?></td>
                               <td ><?php echo $totalsomer3?></td>
                               <td  >&nbsp;</td>
                             </tr>
                                 <?php }// end if
	}// end mode
	
	
	if($_REQUEST['mode']=='assets'){//start mode all outlets
		$i=1;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` where status=0 order by region_id LIMIT $position, $items_per_group ")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$region_id=$r["region_id"];
								
                               ?>
                                
                                 <tr>
                                    <td><?php echo region_name($region_id)?></td>
                               
                                <td > 0</td>
                                <td >0</td>
                                <td >2</td>
                                <td >2</td>
                                <td >0</td>
                                <td >9</td>
                              </tr>
                           
                             <?php $i++; }
							
                               
	}// end mode	//*******************************************************************************************************************************
if($_REQUEST['mode']=='prospectus'){//start mode all prospectus
		$i=1;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` where prospecting=1 order by business_name LIMIT $position, $items_per_group ")or die(mysqli_error($mysqli));
			if(mysqli_num_rows($q)==0){?> <tr>
                                  <td colspan="11"> Empty list  </td>
                                  
                                  
                              </tr><?php }
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								$region_id=$r["region_id"];
								$cooler=survey_history($r["has_cooler"]);
								$lp=survey_history($r["has_light_pannels"]);
								$neon_sign=survey_history($r["neon_sign"]);
								$type_of_outlet=$r["type_of_outlet"];
								$longtitute=$r["longtitute"];
								$latitute=$r["latitute"];
								$channel=channel_type($r["channel"]);
									$phone=$r["phone"];
										$reg_by=$r["added_by"];
											$reg_date=$r["reg_date"];
                               ?>
                                
                                 <tr>
                                  <td><?php	 echo $i;   ?></td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo region_name($region_id);?></td>
                                  <td><?php	 echo $channel   ?></td>
                                   <td><?php $coods	; if($latitute!=0 and $longtitute!=0)  $coods=0 ;else $coods=1; echo survey_history($coods); ?></td>
                                  <td><?php	 echo $phone   ?></td>
                                   <td><?php	 echo record_date( $reg_date)   ?></td>
                                   <td><?php	 echo times_visited($did)  ?></td>
                                  <td><?php	 echo prospect_prices($did,1)?></td>
                                   <td><?php	 echo prospect_prices($did,2) ?></td>
                                  <td ><?php	 echo prospect_prices($did,3) ?></td>
                                  <td><?php echo '<input type="checkbox" class="checkbox" value="'.$did.'" name="list[]">'?></td>
                                  
                              </tr>
                           
                             <?php $i++; }
							
                               
	}// end mode
if($_REQUEST['mode']=='deleted_outlets'){//start mode all outlets
		$i=1;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` where status=1 order by business_name LIMIT $position, $items_per_group ")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								$region_id=$r["region_id"];
								$cooler=survey_history($r["distributor_id"]);
								$lp=survey_history($r["cluster_id"]);
								$neon_sign=survey_history($r["area_id"]);
								$type_of_outlet=$r["type_of_outlet"];
								$longtitute=$r["longtitute"];
								$latitute=$r["latitute"];
								$channel=channel_type($r["channel"]);
									$phone=$r["phone"];
										$reg_by=$r["added_by"];
											$reg_date=$r["reg_date"];
                               ?>
                                
                                 <tr>
                                  <td><?php	 echo $i;   ?></td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo region_name($region_id);?></td>
                                  <td><?php	 echo $channel   ?></td>
                                   <td><?php $coods	; if($latitute!=0 and $longtitute!=0)  $coods=0 ;else $coods=1; echo survey_history($coods); ?></td>
                                  <td><?php	 echo $phone   ?></td>
                                   <td><?php	 echo record_date( $reg_date)   ?></td>
                                   <td><?php	 echo times_visited($did)  ?></td>
                                  <td><?php	 echo $neon_sign ?></td>
                                   <td><?php	 echo $cooler ?></td>
                                  <td ><?php	 echo $lp ?></td>
                                   <td><?php	 echo $cooler ?></td>
                                   <td><?php echo '<input type="checkbox" class="checkbox" value="'.$did.'" name="list[]">'?></td>
                                  
                              </tr>
                           
                             <?php $i++; }
							
                               
	}// end mode........................................................................................................................
	//start onother
	
if($_REQUEST['mode']=='region_categories'){//start mode all outlets
		$i=1;
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_regions` where status=0 order by region_name LIMIT $position, $items_per_group ")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$region_id=$r['region_id'];
								
								
                               ?>
                                
                                 <tr>
                                  <td><?php	 echo $i;   ?></td>
                                  <td ><?php echo region_name($region_id);?></td>
                                  <?php $select=mysqli_query($mysqli,"SELECT channel_id as id FROM `tbl_outlet_channels` WHERE `status`=0 ") or die (mysqli_error($mysqli));
                                  while($row=mysqli_fetch_array($select)){?>                          
                                  
                                  <td><?php echo total_outlets_categories_in_region($region_id,$row["id"]);?></td> <?php }?>
                                
                                  
                              </tr>
                           
                             <?php $i++; }
							
                               
	}// end mode


	if($_REQUEST['mode']=='upcoming_orders'){
		
	 $totalcal1=0;$totalcal2=0;$totalcal3=0;$totaltur1=0;$totaltur2=0;$totaltur3=0;$totalsomer1=0;$totalsomer2=0;$totalsomer3=0; $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` where date(`date_due`)>date(now()) and status=0 LIMIT $position, $items_per_group")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								
								$totalcal1 +=stock($did,'singles',27,$date);
                                $totalcal2+= stock($did,'cases',28,$date);
                              $totalcal3+=  stock($did,'singles',29,$date);
                                 $totaltur1+= stock($did,'cases',30,$date);
                                  $totaltur2+= stock($did,'singles',31,$date);
                                  $totaltur3+= stock($did,'cases',32,$date);
                                   $totalsomer1+=stock($did,'singles',33,$date);
                                $totalsomer2+=stock($did,'cases',34,$date);
                                 $totalsomer3+=stock($did,'cases',35,$date);
                               ?>
                                
                                 <tr>
                                  <td><?php echo $i;?>
								   </td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo stock($did,'singles',27,$date)?></td>
                                  <td><?php echo stock($did,'cases',28,$date)?></td>
                                   <td><?php echo stock($did,'singles',29,$date)?></td>
                                  <td><?php echo stock($did,'cases',30,$date)?></td>
                                   <td><?php echo  stock($did,'singles',31,$date)?></td>
                                   <td><?php echo  stock($did,'cases',32,$date)?></td>
                                   <td><?php echo stock($did,'singles',33,$date)?></td>
                                  <td><?php echo stock($did,'cases',34,$date)?></td>
                                   <td><?php echo stock($did,'cases',35,$date)?></td>
                                  <td ><?php echo $r['date_due']?></td>
                              </tr>
                           
                             <?php $i++; }
							 if($i==$total){?> 
                               <tr style="font-size:110%; background:#666 !important;  font-weight:500;" >
                               <td>&nbsp;</td>
                               <td >Total</td>
                               <td ><?php echo $totalcal1?></td>
                               <td ><?php echo $totalcal2?></td>
                               <td ><?php echo $totalcal3?></td>
                               <td ><?php echo $totaltur1?></td>
                               <td ><?php echo $totaltur2?></td>
                               <td ><?php echo $totaltur3?></td>
                               <td ><?php echo $totalsomer1?></td>
                               <td ><?php echo $totalsomer2?></td>
                               <td ><?php echo $totalsomer3?></td>
                               <td  >&nbsp;</td>
                             </tr>
                                 <?php }// end if
	}// end mode
	if($_REQUEST['mode']=='expired'){
		
	 $totalcal1=0;$totalcal2=0;$totalcal3=0;$totaltur1=0;$totaltur2=0;$totaltur3=0;$totalsomer1=0;$totalsomer2=0;$totalsomer3=0; $i=1; 
			$q=mysqli_query($mysqli,"SELECT * FROM `tbl_orders` where date(`date_due`)<date(now()) and status=0 LIMIT $position, $items_per_group")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$did=$r['dealer_id'];
								
								$totalcal1 +=stock($did,'singles',27,$date);
                                $totalcal2+= stock($did,'cases',28,$date);
                              $totalcal3+=  stock($did,'singles',29,$date);
                                 $totaltur1+= stock($did,'cases',30,$date);
                                  $totaltur2+= stock($did,'singles',31,$date);
                                  $totaltur3+= stock($did,'cases',32,$date);
                                   $totalsomer1+=stock($did,'singles',33,$date);
                                $totalsomer2+=stock($did,'cases',34,$date);
                                 $totalsomer3+=stock($did,'cases',35,$date);
                               ?>
                                
                                 <tr>
                                  <td>
								   </td>
                                  <td ><?php echo business_name($did);?></td>
                                  <td><?php echo stock($did,'singles',27,$date)?></td>
                                  <td><?php echo stock($did,'cases',28,$date)?></td>
                                   <td><?php echo stock($did,'singles',29,$date)?></td>
                                  <td><?php echo stock($did,'cases',30,$date)?></td>
                                   <td><?php echo  stock($did,'singles',31,$date)?></td>
                                   <td><?php echo  stock($did,'cases',32,$date)?></td>
                                   <td><?php echo stock($did,'singles',33,$date)?></td>
                                  <td><?php echo stock($did,'cases',34,$date)?></td>
                                   <td><?php echo stock($did,'cases',35,$date)?></td>
                                  <td ></td>
                                   <td ><a href="stock_by_outlet.php?dealer_id=<?php echo $did?>">View more</a></td>
                              </tr>
                           
                             <?php $i++; }
							 if($i==$total){?> 
                               <tr style="font-size:110%; background:#666 !important;  font-weight:500;" >
                               <td>&nbsp;</td>
                               <td >Total</td>
                               <td ><?php echo $totalcal1?></td>
                               <td ><?php echo $totalcal2?></td>
                               <td ><?php echo $totalcal3?></td>
                               <td ><?php echo $totaltur1?></td>
                               <td ><?php echo $totaltur2?></td>
                               <td ><?php echo $totaltur3?></td>
                               <td ><?php echo $totalsomer1?></td>
                               <td ><?php echo $totalsomer2?></td>
                               <td ><?php echo $totalsomer3?></td>
                                <td ></td>
                               <td  >&nbsp;</td>
                             </tr>
                                 <?php }// end if
	}// end mode
								 }?>
								 
                                 
                                 
                                 
                                 
                                 
                                 