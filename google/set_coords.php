 <?php include('../assets/lib/config.php'); include('../assets/lib/functions.php');
    try {
     
     $db = new PDO($pdo, $db_username, $db_password);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         
        $sth = $db->prepare("UPDATE tbl_dealers SET latitute = ?, longtitute = ? WHERE dealer_id = ?");
        if ($sth->execute(array($_GET['latitute'], $_GET['longtitute'], $_GET['dealer_id'])))
            echo "OK";
         
    } catch (Exception $e) {
        echo $e->getMessage();
    }?>