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

$orderId = $_GET["orderId"];

$conn = createConnection();

$result = mysqli_query($conn, "SELECT offerId, vendor FROM foodie.offer WHERE orderId = '$orderId' AND status='waiting' ORDER BY offerId DESC LIMIT 1");

if($row = mysqli_fetch_array($result)) {
	$offer = ["offerId" => $row["offerId"],
           "vendor" => $row["vendor"]];

   sendMsg($offer['offerId'], json_encode($offer));
}
else {
   sendMsg(-1, "null");
}

closeConnection($conn);

?>
