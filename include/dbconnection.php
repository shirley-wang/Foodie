<?php

function createConnection() {
	$conn = mysqli_connect("127.0.0.1", "root", "123456", "foodie");
	
	if(mysqli_connect_error()) {
		echo "Failed to connect to MySQL: ".mysqli_connect_error();
	}
	
	return $conn;
}

function closeConnection($conn) {
	mysqli_close($conn);
}

?>
