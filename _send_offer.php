<?php

include_once 'include/dbconnection.php';

$orderId = $_POST["orderId"];
$vendor = "Best Food";

$conn = createConnection();

$result = mysqli_query($conn, "INSERT INTO foodie.offer(orderId, vendor, status) VALUES('$orderId', '$vendor', 'waiting')");

if($result) {
	echo json_encode(true);
}
else {
   echo json_encode(false);
}

closeConnection($conn);

?>
