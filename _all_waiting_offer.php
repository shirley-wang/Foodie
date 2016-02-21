<?php

include_once 'include/dbconnection.php';

$orderId = $_GET["orderId"];

$conn = createConnection();

$result = mysqli_query($conn, "SELECT offerId, vendor FROM foodie.offer WHERE orderId = '$orderId' AND status='waiting' ORDER BY offerId ASC");

$offers = [];
while($row = mysqli_fetch_array($result)) {
	$offers[] = ["offerId" => $row["offerId"],
           "vendor" => $row["vendor"]];
}

echo json_encode($offers);

closeConnection($conn);

?>
