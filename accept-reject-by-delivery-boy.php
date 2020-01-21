<?php
require_once 'config.php';
error_reporting(0);

$status = $_POST['status'];
$orderid = $_POST['orderid'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$bal = $_POST['bal'];





if($status == 'A'){

	
$sql = "UPDATE temporder SET order_status = 'Your Order has been assign to delivery boy', delivery_person = '$email', otp = '123456' WHERE uniqueId = '$orderid';";

}


$query = mysqli_query($connection,$sql);


$return = array();

if($query == true) {
	

	$connection->query("update user_wallet set balance = balance - '$bal' where phone = '$phone'");
	$connection->query("update delivery_persons set commision = '$bal' where phone = '$phone'");
	
	$return['status'] = 1;
	$return['message'] = "Successfully Update";
	$return['uniquid'] = $orderid;
	$return['vendor_id'] = $vendor_id;
	
	$sql2 = $connection->query("SELECT * from temporder WHERE uniqueId = '$orderid'")->fetch_assoc();	
	echo json_encode($return);
} else {
	$return['status'] = 0;
	$return['message'] = "Update Failed";
	echo json_encode($return);
}
