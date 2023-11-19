<?php
/*
Test this function in > > > https://elmejordominiodepruebasdelahistoriadelahumanidad.shop/focusWebTest/writeToDatabase.php?local=12555345&accessToken=token
Where:
  - local > localId
  - accessToken > Access Token

*/

/*
//declare parameters
$localId = $_GET['local'];
$accessToken = $_GET['accessToken'];
*/

//Testing variables value
$localId = 9898011;
$accessToken = "token";


//declare variables
$host = 'localhost';
$username = 'root';
$password = 'password';
$database = 'focusTest';

// SQL statement
//$sql = "INSERT INTO access_tokens (localId, token) VALUES ($localId, $accessToken);";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check for an existing row with the given localId
$checkSql = "SELECT COUNT(*) FROM access_tokens WHERE localId = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $localId);
$checkStmt->execute();
$checkStmt->bind_result($rowCount);
$checkStmt->fetch();
$checkStmt->close();
/*
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
*/

if ($rowCount > 0) { //verify the row cound is more than 0
  // If a row with the localId exists, update it
  $updateSql = "UPDATE access_tokens SET token = ? WHERE localId = ?;";
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("si", $accessToken, $localId);

  $resetTableSql = "DELETE FROM access_tokens WHERE localId = ?;";
  $resetTableSqlStmt = $conn->prepare($resetTableSql);
  $resetTableSqlStmt->bind_param("i", $localId);

  if ($resetTableSqlStmt->execute()) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $updateStmt->error;
}


  //print on serial monitor the query status

  /*
  if ($updateStmt->execute()) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $updateStmt->error;
  }

  */
  $updateStmt->close();
} else {  // If no row with the localId exists, insert a new row
  $insertSql = "INSERT INTO access_tokens (localId, token) VALUES (?, ?)";
  $insertStmt = $conn->prepare($insertSql);
  $insertStmt->bind_param("is", $localId, $accessToken);

  //print on serial monitor the query status
  if ($insertStmt->execute()) {
      echo "Record inserted successfully";
  } else {
      echo "Error inserting record: " . $insertStmt->error;
  }

  $insertStmt->close();
}


$conn->close();
?>