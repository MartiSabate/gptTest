<?php


/*
Test this function in > > > https://elmejordominiodepruebasdelahistoriadelahumanidad.shop/focusWebTest/retrieveFromDatabase.php?local=9898011&accessToken=token
Where:
  - local > localId
  - accessToken > Access Token

*/


//declare parameters
/*
$localId = $_GET['local'];
$accessToken = $_GET['accessToken'];
*/
//FAKE parameters for testing
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

// SQL statement to request the token
$sql = "SELECT token FROM access_tokens WHERE localId = ?;";


// Prepare the SQL statement with placeholders
$stmt = $conn->prepare($sql);

// Bind the parameters to the placeholders
//$stmt->bind_param("is", $localId, $accessToken);
$stmt->bind_param("i", $localId);



//Execute the query
$stmt->execute();

// Execute the SQL statement
//if ($conn->query($sql) === TRUE) {
/*
//Degug code
if ($stmt->execute()) {
  echo "Record executed successfully";
} else {
  echo "Error executing record: " . $conn->error;
}
*/

// Get the result
$result = $stmt->get_result();

// Fetch the data from the result
$row = $result->fetch_assoc();

/*
//This is the nice return message
if ($row) {
    echo "Token is: " . $row['token'] . "\n";
} else {
    echo "No token found for localId: " . $localId;
}
*/

//This is the production return message
if ($row) {
  echo $row['token'];
} else {
  echo "NA";
}

// Close connection
$stmt->close();

$conn->close();
?>