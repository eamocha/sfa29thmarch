<?php

  // Connect to database
  require("../assets/lib/config.php");
  $route_id=$_REQUEST['route_id'];

  function parseToXML($htmlStr) { 
    $xmlStr=str_replace('<','&lt;',$htmlStr); 
    $xmlStr=str_replace('>','&gt;',$xmlStr); 
    $xmlStr=str_replace('"','&quot;',$xmlStr); 
    $xmlStr=str_replace("'",'&#39;',$xmlStr); 
    $xmlStr=str_replace("&",'&amp;',$xmlStr); 
    return $xmlStr; 
  } 

  // Select all the rows in the markers table
  $query = "SELECT latitute, longtitute, DATE_FORMAT(reg_date, 
  '%W %M %D, %Y %T') AS datetime FROM tbl_dealers WHERE route_id=".$route_id." and longtitute!=0 and status=0 limit 100 ";
  $result = mysqli_query($mysqli,$query);
  if (!$result) {
    die('Invalid query: ' . mysqli_error($mysqli));
  }

header("Content-type: text/xml");

  // Start XML file, echo parent node
  echo "<markers>\n";

  // Iterate through the rows, printing XML nodes for each
  while ($row = @mysqli_fetch_assoc($result)){
    // ADD TO XML DOCUMENT NODE
    echo '<marker ';
    echo 'lat="' . $row['latitute'] . '" ';
    echo 'lng="' . $row['longtitute'] . '" ';
    echo 'datetime="' . $row['datetime'] . '" ';
    echo "/>\n";
  }

  // End XML file
  echo '</markers>';

  // Free up the resources
  mysqli_free_result ($result);

  // Close the database connection
  mysqli_close($mysqli);

?>