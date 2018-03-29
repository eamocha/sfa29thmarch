 <?php include('../assets/lib/config.php'); include('../assets/lib/functions.php');
$rows = '';
$query = "SELECT distinct(product_id),monthname(concat(`date_added`)) as month,sum(cases,pieces) as qty FROM `tbl_orders_details` WHERE `status` !=3  group by  MONTH(date_added) order by MONTH(date_added)";
$result = mysqli_query($mysqli,$query);
$total_rows =  $result->num_rows;
if($result) 
{
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
}
echo json_encode($rows);
?>