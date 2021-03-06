<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/include/dbconnection.php';

$conn = createConnection();

$result = mysqli_query($conn, "SELECT orderId, location, time, createdTime, status FROM foodie.order WHERE status='waiting' ORDER BY orderId ASC");

$orders = [];

while($row = mysqli_fetch_array($result)) {
	$order = ["orderId" => $row["orderId"],
           "location" => $row["location"],
           "time" => $row["time"],
           "createdTime" => $row["createdTime"],
           "status" => $row["status"],
           "items" => []];
        $orderId = $order["orderId"];

   $result1 = mysqli_query($conn, "SELECT itemId, category, description, price FROM foodie.item WHERE orderId='$orderId'");
   
  while($row1 = mysqli_fetch_array($result1)) {
    $order['items'][] = [ "itemId" => $row1["itemId"],
       "category" => $row1["category"],
       "description" => $row1["description"],
       "price" => $row1["price"]];
  }

  $orders[] = $order;
}

echo json_encode($orders);

closeConnection($conn);

?>
