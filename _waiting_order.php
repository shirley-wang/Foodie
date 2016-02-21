<?php

include_once 'include/dbconnection.php';

function sendMsg($id, $msg) {
  header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
	echo "id: $id" . PHP_EOL;
	echo "data: $msg" . PHP_EOL;
  echo PHP_EOL;
  ob_flush();
  flush();
}

$conn = createConnection();

$result = mysqli_query($conn, "SELECT orderId, location, time, createdTime, status FROM foodie.order WHERE status='waiting' ORDER BY orderId DESC LIMIT 1");

if($row = mysqli_fetch_array($result)) {
	$order = ["orderId" => $row["orderId"],
           "location" => $row["location"],
           "time" => $row["time"],
           "createdTime" => $row["status"],
           "items" => []];
        $orderId = $order["orderId"];

   $result1 = mysqli_query($conn, "SELECT itemId, category, description, price FROM foodie.item WHERE orderId='$orderId'");
   
  while($row1 = mysqli_fetch_array($result1)) {
    $order['items'][] = [ "itemId" => $row1["itemId"],
       "category" => $row1["category"],
       "description" => $row1["description"],
       "price" => $row1["price"]];
  }

   sendMsg($order['orderId'], json_encode($order));
}
else {
   //$_SESSION['orderId'] = $orderId;
}

closeConnection($conn);

?>
