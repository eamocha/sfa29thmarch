<?php  session_start();
include "../assets/lib/functions.php";
include "../assets/lib/config.php";
 if(!empty($_FILES["employee_file"]["name"]))  
 {  
   
      $output = '';  
      $allowed_ext = array("csv");  
	  $tmp = explode('.', $_FILES["employee_file"]["name"]);
$extension = end($tmp);
$USER_ID=$_SESSION['u_id'];
$sku=$_REQUEST['sku'];

      if(in_array($extension, $allowed_ext))  
      {  
           $file_data = fopen($_FILES["employee_file"]["tmp_name"], 'r');  
           fgetcsv($file_data); $row=array();
		   $row= fgetcsv($file_data); $sku_cell=0; 
		  
           while($row= fgetcsv($file_data))  
           {  if(strcmp($row[0],"No")==0){ $sku_cell=$row[$sku];}else{
		  
                
				$route_id = mysqli_real_escape_string($mysqli, $row[0]);  
                $contribution = mysqli_real_escape_string($mysqli, $row[$sku]);  
                       
                $query = "  
                INSERT INTO `tbl_sku_contributions`(`contribution`, `sku_id`, `added_by`, `boundary`, `boundary_id`) VALUES ($contribution,$sku_cell,$USER_ID,'route',$route_id) ON DUPLICATE KEY UPDATE contribution=$contribution
                ";  
                mysqli_query($mysqli, $query);//or die(mysqli_error($mysqli));  
		   }
           }  
           $select = "SELECT * FROM tbl_sku_contributions where added_by=$USER_ID ORDER BY sku_contribution_id DESC limit 1000";  
           $result = mysqli_query($mysqli, $select);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="5%">contributionId</th>  
                          <th width="25%">contribution</th>  
                          <th width="35%">Sku</th>  
                          <th width="10%">added by</th>  
                          <th width="20%">boundary</th>  
                          <th width="5%">route_id</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'.$row["sku_contribution_id"].'</td>  
                          <td>'.$row["contribution"].'</td>  
                          <td>'. product_name($row['sku_id']).'</td>  
                          <td>'.$row["added_by"].'</td>  
                          <td>'.$row["boundary"].'</td>  
                          <td>'.$row["boundary_id"].'</td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
           echo $output;  
      }  
      else  
      {  
           echo 'Error1';  
      }  
 }  
 else  
 {  
      echo "Error2";  
 }  
 ?>  