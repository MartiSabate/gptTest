<?php

//declare parameters
$localId = $_GET['local'];
$accessToken = $_GET['accessToken'];

//declare variables
$host = 'localhost';
$username = 'root';
$password = 'password';
$database = 'focusTest';

// SQL statement
//$sql = "INSERT INTO access_tokens (localId, token) VALUES ($localId, $accessToken);";

// Create connection
$conn = new mysqli($host, $username, $password, $database);



// SQL statement with placeholders
$sql = "INSERT INTO access_tokens (localId, token) VALUES (?, ?)";

// Prepare the SQL statement with placeholders
$stmt = $conn->prepare($sql);

// Bind the parameters to the placeholders
$stmt->bind_param("is", $localId, $accessToken);






// Execute the SQL statement
//if ($conn->query($sql) === TRUE) {
if ($stmt->execute()) {
  echo "Record executed successfully";
} else {
  echo "Error executed record: " . $conn->error;
}

// Close connection
$stmt->close();

$conn->close();
?>