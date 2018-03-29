<?php
include_once "assets/lib/config.php";

$DB_TBLName = "tbl_assets"; 
$filename = "assets";  //your_file_name
$file_ending = "xls";   //file_extention

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
$sep = "\t";

$sql="SELECT `asset_id`,a.dealer_id,  distributor_name, business_name, `asset_size`, `asset_number`, `model`, `name`, `code`, `code_format`, `serial`, `date_isued`,  a.`remarks`, `asset_condition` FROM `tbl_assets` a inner join tbl_dealers b on a.dealer_id=b.dealer_id inner join tbl_distributors d on d.distributor_id=b.distributor_id WHERE a.status=0 order by b.distributor_id"; 
$resultt = $mysqli->query($sql) or die($mysqli->error);
while ($property = mysqli_fetch_field($resultt)) { //fetch table field name
    echo $property->name."\t";
}

print("\n");    

while($row = mysqli_fetch_row($resultt))  //fetch_table_data
{
    $schema_insert = "";
    for($j=0; $j< mysqli_num_fields($resultt);$j++)
    {
        if(!isset($row[$j]))
            $schema_insert .= "NULL".$sep;
        elseif ($row[$j] != "")
            $schema_insert .= "$row[$j]".$sep;
        else
            $schema_insert .= "".$sep;
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}?>