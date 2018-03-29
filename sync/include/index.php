<?php
 /**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data
 */
include("../../assets/lib/functions.php");
if (isset($_REQUEST['tag']) && $_REQUEST['tag'] != '') {
    // get tag
    $tag = $_REQUEST['tag'];
 
    // include db handler
    require_once 'DB_Functions.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => FALSE);
 
    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST['password']);
		$version=$_REQUEST['appVersion'];
 
        // check for user
        $user = $db->getUserByEmailAndPassword($email, $password,$version);
        if ($user != false) {
            // user found
            $response["error"] = FALSE;
            $response["uid"] = $user["user_id"];
            $response["user"]["name"] = $user["full_name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["mobile"] = $user["mobile"];
            $response["user"]["role"] = $user["role"];
			$response["user"]["region_id"] = $user["region_id"];
            $response["user"]["reg_date"] = $user["date_registered"];
			$response["user"]["area_id"] = $user["area_id"];
            $response["user"]["cluster_id"] = $user["cluster_id"];
			$response["user"]["distributor_id"] = $user["distributor_id"];
			$response["user"]["request_pass_change"] = $user["request_pass_change"];
            
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = TRUE;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
 
        // check if user is already existed
        if ($db->isUserExisted($email)) {
            // user is already existed - error response
            $response["error"] = TRUE;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($name, $email, $password);
            if ($user) {
                // user stored successfully
                $response["error"] = FALSE;
                $response["uid"] = $user["unique_id"];
                $response["user"]["name"] = $user["name"];
                $response["user"]["email"] = $user["email"];
                $response["user"]["created_at"] = $user["created_at"];
                $response["user"]["updated_at"] = $user["updated_at"];
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = TRUE;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    }//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  else  if($tag == 'changePass'){
		$uid=(int)$_REQUEST['user_id'];
		$cpass=md5($_REQUEST['cpass']);
		$newPass=md5($_REQUEST['newPass']);
		 if ($db->passExists($uid,$cpass)) {//does the pass march this user
		 
		if($db->changePass($uid,$newPass)==1){
			
		   $response["error"] = FALSE;
                $response["uid"] = $uid;
                $response["error_msg"] = "Successfully Changed the password";
                echo json_encode($response);
		} else{ 
		$response["error"] = TRUE;
                $response["error_msg"] = "Error in updating the password";
                echo json_encode($response);}//pass changung error
				}///error in changing pass
				
			 else{
				   //
                $response["error"] = TRUE;
                $response["error_msg"] = "Wrong Current password!!!. Please try again";
                echo json_encode($response);}//pass not marching the userid
		
	}else {
        // user failed to store
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknown 'tag' value. It should be either 'login' or 'register'";
        echo json_encode($response);
    }
}//error on tag
	else{
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>