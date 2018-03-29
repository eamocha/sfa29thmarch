<?php session_start();
// Database details

include_once "assets/lib/functions.php";
include_once "assets/lib/config.php";
$result=''; $message='';
// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_clients' ||
      $job == 'get_client'   ||
      $job == 'add_client'   ||
      $job == 'edit_client'  ||
      $job == 'delete_client'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      if (!is_numeric($id)){
        $id = '';
      }
    }
  } else {
    $job = '';
  }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != ''){
    
  // Execute job
  if ($job == 'get_clients'){
    $i=1;
   //  Get   <th>Contact</th>
            
$role=$_SESSION['user_role'];$where=" status=0 "; $region_id=$_SESSION['region_id']; $area_id=$_SESSION['area_id'];
if($role==4){$where=" status=0 ";}else if($role==3){$where=" area_id=$area_id and status=0 ";} else if($role==2){$where=" region_id=$region_id and status=0 ";}

           
             
	  $query = "SELECT business_name,longtitute,latitute,dealer_id,region_id,area_id, distributor_id,cluster_id,route_id,town,owner_name,phone,added_by,last_visisted,channel,    sales_fmcg,do_you_sell_any_bevs,sales_coke_products,stocked_coke_inthePast,willing_to_stock_coke,willingness_remarks,why_dd_yu_stop_stocking_coke,type_of_class FROM tbl_dealers where $where  ";
  
    $query = mysqli_query($mysqli, $query) ;
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($row = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $row['dealer_id'] . '" data-name="' . $row['business_name'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $row['dealer_id'] . '" data-name="' . $row['business_name'] . '"><span>Delete</span></a></li>';
        $functions .= '</ul></div>';
        $mysql_data[] = array(
		
          "No"          => $i,
		   "business_name" => business_name($row['dealer_id']),
		   "region"  => region_name($row['region_id']),
			"area"    => get_area($row['area_id']),
			"cluster"     => sub_area_name($row['cluster_id']),
			"distributor"  => distributor_name($row['distributor_id']),
			"route"     => get_route( $row['route_id']),
			"town"   => $row['town'],
		  "contact_person"  => $row['owner_name']." ". $row['phone'],
          "Channel"    => channel_type($row['channel']),
		   "fmcg"    => $row['sales_fmcg'],
			"do_you_sell_any_bevs"    => $row['do_you_sell_any_bevs'],
		 "sales_coke_products"    => $row['sales_coke_products'],
		"stocked_coke_inthePast"    => $row['stocked_coke_inthePast'],
		 "why_dd_yu_stop_stocking_coke"       => $row['why_dd_yu_stop_stocking_coke'],
		  "willing_to_stock_coke"       => $row['willing_to_stock_coke'],
		    "willingness_remarks"       => $row['willingness_remarks'],
			  "latitute"       => $row['latitute'],
			   "longtitute"       => $row['longtitute'],
			    "type_of_class"       => $row['type_of_class'],
         "last_visisted"    => $row['last_visisted'], 
		 
          "functions"     => $functions
        );///end array
     $i++; }
    }
    
  } elseif ($job == 'get_client'){
    
    // Get row
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM tbl_dealers WHERE dealer_id = " . mysqli_real_escape_string($mysqli, $id) ;
      $query = mysqli_query($mysqli, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($query)){
          $mysql_data[] = array(
          
       
		   "business_name" => $row['business_name'],
		   "region"  => region_name($row['region_id']),
			"area"    => get_area($row['area_id']),
			"cluster"     => sub_area_name($row['cluster_id']),
			"route"     => get_route( $row['route_id']),
			//"distributor"  => getColumnName('tbl_distributors','distributor_name', "distributor_id=". $row['distributor_id']),
          "town"   => $row['town'],
		  "contact_person"  => $row['owner_name'],
          "phone"    => $row['phone'],
          "reg_by"       => get_name($row['added_by']),
         "reg_date"    => $row['reg_date'],
        
          
          );
        }
      }
    }
  
  } elseif ($job == 'add_client'){
    
    // Add row
    $query = "INSERT INTO tbl_dealers SET ";
    if (isset($_GET['rank']))         { $query .= "rank         = '" . mysqli_real_escape_string($mysqli, $_GET['rank'])         . "', "; }
    if (isset($_GET['row_name'])) { $query .= "row_name = '" . mysqli_real_escape_string($mysqli, $_GET['row_name']) . "', "; }
    if (isset($_GET['industries']))   { $query .= "industries   = '" . mysqli_real_escape_string($mysqli, $_GET['industries'])   . "', "; }
    if (isset($_GET['revenue']))      { $query .= "revenue      = '" . mysqli_real_escape_string($mysqli, $_GET['revenue'])      . "', "; }
    if (isset($_GET['fiscal_year']))  { $query .= "fiscal_year  = '" . mysqli_real_escape_string($mysqli, $_GET['fiscal_year'])  . "', "; }
    if (isset($_GET['employees']))    { $query .= "employees    = '" . mysqli_real_escape_string($mysqli, $_GET['employees'])    . "', "; }
    if (isset($_GET['market_cap']))   { $query .= "market_cap   = '" . mysqli_real_escape_string($mysqli, $_GET['market_cap'])   . "', "; }
    if (isset($_GET['headquarters'])) { $query .= "headquarters = '" . mysqli_real_escape_string($mysqli, $_GET['headquarters']) . "'";   }
    $query = mysqli_query($mysqli, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
    }
  
  } elseif ($job == 'edit_client'){
    
    // Edit row
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "UPDATE tbl_dealers SET ";
      if (isset($_GET['rank']))         { $query .= "rank         = '" . mysqli_real_escape_string($mysqli, $_GET['rank'])         . "', "; }
      if (isset($_GET['row_name'])) { $query .= "row_name = '" . mysqli_real_escape_string($mysqli, $_GET['row_name']) . "', "; }
      if (isset($_GET['industries']))   { $query .= "industries   = '" . mysqli_real_escape_string($mysqli, $_GET['industries'])   . "', "; }
      if (isset($_GET['revenue']))      { $query .= "revenue      = '" . mysqli_real_escape_string($mysqli, $_GET['revenue'])      . "', "; }
      if (isset($_GET['fiscal_year']))  { $query .= "fiscal_year  = '" . mysqli_real_escape_string($mysqli, $_GET['fiscal_year'])  . "', "; }
      if (isset($_GET['employees']))    { $query .= "employees    = '" . mysqli_real_escape_string($mysqli, $_GET['employees'])    . "', "; }
      if (isset($_GET['market_cap']))   { $query .= "market_cap   = '" . mysqli_real_escape_string($mysqli, $_GET['market_cap'])   . "', "; }
      if (isset($_GET['headquarters'])) { $query .= "headquarters = '" . mysqli_real_escape_string($mysqli, $_GET['headquarters']) . "'";   }
      $query .= "WHERE row_id = '" . mysqli_real_escape_string($mysqli, $id) . "'";
      $query  = mysqli_query($mysqli, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
    
  } elseif ($job == 'delete_client'){
  
    // Delete row
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "DELETE FROM tbl_dealers WHERE dealer_id = '" . mysqli_real_escape_string($mysqli, $id) . "'";
      $query = mysqli_query($mysqli, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  
  }
  
  // Close database connection
  mysqli_close($mysqli);

}

// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);

// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>