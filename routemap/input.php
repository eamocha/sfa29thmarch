<?php

  $showbutton = TRUE;

  if (isset($_REQUEST['submit'])) { // If form submitted

    // Get vars
    $lat = $_REQUEST['lat'];
    $lng = $_REQUEST['lng'];

    // Check string lengths
    if (strlen($lat) < 6) {
      $problem = TRUE;
      $response0 = "LATITUDE too short.<br />";
    }
    if (strlen($lng) < 6) {
      $problem = TRUE;
      $response1 = "LONGITUDE too short.<br />";
    }

    // Check if numeric
    if(!is_numeric($lat)) {
      $problem = TRUE;
      $response0a = "LATITUDE not numeric.<br />";
    }
    if(!is_numeric($lng)) {
      $problem = TRUE;
      $response1a = "LONGITUDE not numeric.<br />";
    }

    if (!$problem) { // If no problem, connect to database
      require("../assets/lib/config.php");
      // Build MySQL query
      $query = "INSERT INTO tbl_dealers (latitute, longtitute, reg_date) 
      VALUES ('$lat', '$lng', NOW())";
      // Run query
      $result = @mysqli_query ($mysqli,$query);
      // Check result
      if ($result) {
        mysqli_close();
        $response2 = "MySQL query OK.<br />";
      } else { // No result
        $response2 = "MySQL query didn't run.<br />";
      }
      $response3 = "Co-ordinates entered."; // End
      $showbutton = FALSE;
    } else { // Problem
      $response3 = "Try again."; // End
    }

  }

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="text" name="lat" size="12" maxlength="12" value="
<?php if (isset($_REQUEST['submit'])) echo $_REQUEST['lat']; ?>" 
tabindex="1"><br />
<input type="text" name="lng" size="12" maxlength="12" value="
<?php if (isset($_REQUEST['submit'])) echo $_REQUEST['lng']; ?>" 
tabindex="2"><br />
<?php
  if ($showbutton == TRUE) {
 // Only show the Insert button if form not yet submitted
?>
<input type="submit" name="submit" value="Insert" tabindex="3">
<?php } ?>
</form>
<?php

  // Response section
  if (isset($_REQUEST['submit'])) {
    echo "\n";
    echo $response0;
    echo $response0a;
    echo $response1;
    echo $response1a;
    echo $response2;
    echo $response3;
  }

?>