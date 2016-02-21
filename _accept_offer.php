<?php

include_once 'include/dbconnection.php';

$offerId = $_POST["offerId"];

$conn = createConnection();

$result = mysqli_query($conn, "SELECT orderId FROM foodie.offer WHERE offerId='$offerId'");

$row = mysqli_fetch_array($result);
$orderId = $row["orderId"];

if(!mysqli_query($conn, "UPDATE foodie.offer SET status='accepted' WHERE offerId='$offerId'")) {
  echo json_encode(false);
}
else if(!mysqli_query($conn, "UPDATE foodie.offer SET status='rejected' WHERE orderId='$orderId' AND offerId<>'$offerId'")) {
  echo json_encode(false);
}
else if(!mysqli_query($conn, "UPDATE foodie.order SET status='accepted' WHERE orderId='$orderId'")) {
  echo json_encode(false);
}
else {
  echo json_encode(true);
}

closeConnection($conn);

?>
