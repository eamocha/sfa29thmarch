<?php
session_start();
include_once("assets/lib/config.php"); include("assets/lib/functions.php");
// funstion to insert recod and or fetch order_id
//empty cart by distroying current session
//remove item 	mysqli_query($mysqli,"DELETE FROM `tbl_orders_details` WHERE order_id=$order_id") or die(mysql_error());
//user
	$uid=$_SESSION['u_id'];
	//set the date of delivery

	// approve order
	if(isset($_REQUEST["approve"]) && $_REQUEST["order_id"]!='')
	
{$oid=clean($_REQUEST['order_id']);
$update="UPDATE `tbl_orders` SET `status`=2 WHERE `order_id`=$oid";
			$res=mysqli_query($mysqli,$update) or die(mysql_error());
			if($res){
	goback();}
	}
		//delivery date
if(isset($_REQUEST["submit_delivery_date"]) && $_REQUEST["delivery_date"]!='')
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	$date_due=clean($_REQUEST['delivery_date']);
	$date_due= format_date($date_due);
	$oid=clean($_REQUEST['order_id']);
	$update="UPDATE `tbl_orders` SET `date_due`='$date_due' WHERE `order_id`=$oid";
			$res=mysqli_query($mysqli,$update) or die(mysql_error());
			if($res){
	header('Location:'.$return_url);}
	else echo "Error setting delivery date";
}
//set products session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	unset($_SESSION['products']); 
	$oid=$_GET['oid'];
	$update="UPDATE `tbl_orders` SET `status`=5 WHERE `order_id`=$oid";
	$res=mysqli_query($mysqli,$update) or die(mysql_error());
	$update="UPDATE `tbl_orders_details` SET `status`=3 WHERE `order_id`=$oid";
			$res=mysqli_query($mysqli,$update) or die(mysql_error());
			header('Location:'.$return_url);
}

//add item into shopping cart
if(isset($_REQUEST["type"]) && $_REQUEST["type"]=='add')
{
	$product_code 	= clean($_REQUEST["product_code"]); 
	$product_qty 	= clean($_REQUEST["product_qty"]); 
	$required 	= clean($_REQUEST["required"]); //product required
	$product_id =clean($_REQUEST["product_id"]); 
	$return_url = base64_decode($_REQUEST["return_url"]); //return url
	

	$dealer_id=filter_var($_REQUEST["dealer_id"], FILTER_SANITIZE_NUMBER_INT); //dealer id
	$order_id=clean($_REQUEST['order_id']);
	//check if in db
	$check_pr=mysqli_query($mysqli,"SELECT * FROM `tbl_orders_details` WHERE `product_id`=$product_id and order_id=$order_id and status !=3")or die(mysqli_error($mysqli));
	$rw=mysqli_fetch_array($check_pr);
	$odi=$rw['order_details_id'];
	if(mysqli_num_rows($check_pr)==0){
	//insert info to db
	$insert = $mysqli->query("INSERT INTO `tbl_orders_details`( `product_id`,date_added, `cases`,cases,pieces, `made_by`, `order_id`, `dealer_id`) VALUES ($product_id,'$today_constant',$required,$product_qty,$uid,$order_id,$dealer_id)") or die(mysql_error());
	}
	else{ 
		
			$update="UPDATE `tbl_orders_details` SET `cases`=$required,pieces=$product_qty,made_by=$uid WHERE `order_details_id`=$odi";
			mysqli_query($mysqli,$update) or die(mysql_error());}
			
	//end of my query
	//MySqli query - get details of item from db using product code
	$results = $mysqli->query("SELECT od.`order_details_id` as odi, p.`product_id` as product_id, pieces,cases,  `preordered_by`, `date_made`, od.`dealer_id`, s_price as price,product_name FROM  tbl_orders_details od   LEFT JOIN `tbl_products` p  on od.product_id=p.product_id LEFT JOIN tbl_orders o on o.order_id=od.order_id WHERE o.`order_id`=$order_id LIMIT 1");
	$obj = $results->fetch_object();
	if (!$mysqli->query($results)) {
  echo  trigger_error('Database error: '. $db->error);
}
	
	if ($results) { //we have the product info 
		
		//prepare array for the session variable
		$new_product = array(array('name'=>$obj->product_name,'cases'=>$obj->cases,'pieces'=>$obj->qty_suplied,'odi'=>$obj->odi,'product_id'=>$product_id, 'code'=>$product_code, 'qty'=>$product_qty, 'price'=>$obj->price));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["product_id"] == $product_id){ //the item exist in array
					$product[] = array('name'=>$cart_itm["name"],'odi'=>$cart_itm["odi"],'code'=>$cart_itm["code"], 'product_id'=>$cart_itm["product_id"],'cases'=>$required,'pieces'=>$product_qty, 'price'=>$cart_itm["price"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"],'odi'=>$cart_itm["odi"],'product_id'=>$cart_itm["product_id"], 'code'=>$cart_itm["code"], 'cases'=>$cart_itm["cases"],'pieces'=>$cart_itm["pieces"], 'price'=>$cart_itm["price"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//save the order
	//$insert = $mysqli->query("INSERT INTO `tbl_orders_details`( `product_id`, `quantity`, `made_by`, `order_id`, `dealer_id`) VALUES ($product_id,$product_qty,$uid,$order_id,$dealer_id)");
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
				//udate the records in the db
				$pieces=$new_product['pieces'];
				$oid=$new_product['odi'];
				$cases=$new_product['cases'];
				
		$update=mysqli_query("UPDATE `tbl_orders_details` SET `cases`=$cases,cases=$cases,made_by`=$uid WHERE `order_details_id`=$odi");

							}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["products"] = $new_product;
		}
		
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$product_id 	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url

	$remove="UPDATE `tbl_orders_details` SET `status`=3,made_by=$uid WHERE `order_details_id`=$product_id";
			mysqli_query($mysqli,$remove) or die(mysql_error());
			
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["code"]!=$product_code){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'order_id'=>$cart_itm["order_id"],'code'=>$cart_itm["code"],'product_id'=>$cart_itm["product_id"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

?>