<?php
/**
 * Creates Unsynced MySQL DB rows count as JSON
 */
    include_once 'db_functions.php';
    $db = new DB_Functions();
	$user_id=$_REQUEST['user_id'];
    $routes = $db->getUnSyncPlans($user_id);
    $a = array();
    $b = array();
    if ($routes != false){
        $no_of_routes = mysqli_num_rows($routes);        
        $b["count"] = $no_of_routes;
        echo json_encode($b);
    }
    else{
        $no_of_routes = 0;
        $b["count"] = $no_of_routes;
        echo json_encode($b);
    }
?>
 

