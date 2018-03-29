<?php session_start(); require '../assets/lib/functions.php';
 require '../assets/lib/config.php';
 $mode=clean($_REQUEST['mode']);
  $date=clean($_REQUEST['date']);
 //defaults 
 $role=$_SESSION['user_role']; 
$myregion=$_SESSION['region_id'];
 $myArea=$_SESSION['area_id'];
$cluster_id=$_SESSION['cluster_id'];
$distributor_id=$_SESSION['distributor_id'];
						  
						  ////////////////////////////////////////////////////////////////////////////////////////////////////////////
						  
						  $where="a.status=0 and a.region_id=$myregion AND a.area_id=$myArea";
		switch($role){
		case 4: $where="a.status=0"; break;//cm
		case 2: $where=" a.region_id=$myregion and a.status=0 and area_id=$myArea "; break;//rm
		case 3: $where=" a.area_id=$myArea and a.status=0 "; break;//arm
		case 1: $where=" a.cluster_id=$cluster_id and a.status=0 "; break;//AD
		case 7: $where=" a.distributor_id=$distributor_id and a.status=0 ";//AD
		 }
		 if(isset($_REQUEST['region']) and $_REQUEST['region']>0 )
{   $area_id=$_REQUEST['area'];
    $region_id =clean($_REQUEST['region']);  //$ar_name=area_name($area_id);
	// $reg_name=region_name($region_id);
	 if($area_id<1){$where="a.status=0 and a.region_id=$region_id ";} else{
	$where="a.status=0 and a.region_id=$region_id and a.area_id=$area_id";}
	   }///************
						
						 if($mode=="distributor_stock_persku") {
							
							 		
			 $product_id_arrays=array();
						   $skusq=$mysqli->query("SELECT product_id FROM `tbl_products` WHERE status=0 order by `pack_size`, `pack_type`, `sku_type` ")or die($mysqli->error()); 
						   while($sku_row=mysqli_fetch_array($skusq)) { $product_id_arrays[]=$sku_row["product_id"];  }			  
		 
		 $i=1; $q=mysqli_query($mysqli,"SELECT distributor_id FROM `tbl_distributors` a WHERE $where order by region_id,area_id, distributor_name ")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$id=$r['distributor_id'];
								?>
                              <tr>
                                  <td><?php  echo $i?></td>
                                  <td><?php echo distributor_name($id);?></td>
                                  <?php foreach($product_id_arrays as $pid) {
									  ?> <td><?php echo  getColumnNumber("tbl_distributor_stock_levels"," qty", " product_id=$pid and distributor_id=$id and DATE(date_taken)='$date' and status=0")?></td><?php }?>
                              </tr>
                              <?php $i++;}//end the stocks per day
		 
		 /********//***********///&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
		 
				  }///end distributor_stock_persku
				  else if($mode=="distributor_stock_perBrand"){
					   $exc_empties =" d.product_id NOT IN $EMPTIES";
					 
						   $variants_array=array(); $skusq=$mysqli->query("SELECT distinct(variant) FROM `tbl_products` WHERE status=0 order by variant Asc ")or die($mysqli->error()); 
						   while($sku_row=mysqli_fetch_array($skusq)) { $variants_array[]=$sku_row["variant"];}
						   
					 $i=1; $q=mysqli_query($mysqli,"SELECT distributor_id FROM `tbl_distributors` a WHERE $where order by region_id,area_id, distributor_name ")or die(mysqli_error($mysqli));
							while($r=mysqli_fetch_array($q)){
								$id=$r['distributor_id'];
								?>
                              <tr>
                                  <td><?php  echo $i?></td>
                                  <td><?php echo distributor_name($id);?></td>
                                  <?php foreach($variants_array as $variant) {
									  ?> <td><?php echo sum_columns("tbl_distributor_stock_levels d INNER JOIN tbl_products p ON d.product_id=p.product_id","qty","d.distributor_id=$id and  date(date_taken)='$date' and $exc_empties  and d.status=0 and variant='$variant'") ?></td><?php }?>
                              </tr>
                              <?php $i++;}//end the stocks per day
		 
					  
					  } 		 

?>