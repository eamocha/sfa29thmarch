 <?php $q=mysqli_query($mysqli,"SELECT * FROM `tbl_dealers` WHERE `dealer_id`=$dealer_id")or die(mysql_error($mysqli));
					  $res=mysqli_fetch_array($q);
					 $name=$res['business_name']; $owne=$res['owner_name'];		$tn=$res['town'];   $res['place_name']; $long=$res['longtitute']; $lat=$res['latitute'];   $email=$res['email'];   $phon=$res['phone'] ; 
 $add_by=$res['added_by'];  //$descr=$res['description'];	  
  $dealer_route=$res['dealer_route_id'];
					    $state=$res['status']; $date_added=$res['reg_date'];?>
                     <div  style="padding-bottom:20px" class="float_left room-box"><table width="100%" class="table table-bordered table-striped table-condensed" align="left" ><tr><td>Located</td><td align="left"><?php echo $tn?> </td> <td>Registered  </td><td  align="left"><?php echo $date_added?></td> <td>email</td><td align="left"><?php echo $email ?> </td>  <td>registered by  </td><td  align="left"><?php echo $add_by?></td></tr>
                     <tr> <td>Phone contact</td><td align="left"><?php echo $phon?> </td>  <td>Route Assigned  </td><td  align="left">kibera</td> <td>Status</td><td align="left"><?php  if($state==0) echo 'active'; else echo 'Inactive';?> </td> <td>registered date </td><td  align="left"><?php echo $date_added?></td></tr></table> </div>