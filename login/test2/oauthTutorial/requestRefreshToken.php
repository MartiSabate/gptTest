<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Get the authorization code from the AJAX request
$authorizationCode = $_POST['code'];
//$authorizationCode = "4/0AfJohXmQg3CgQv7qoZ6m84_7onSusDOOxFBb799eHGosn0WG__NhKsAXYNnQ6BKx-89pzA";

// Perform the token exchange to obtain the refresh token from the authorization server
// Make a request to the authorization server's token endpoint and handle the response

// Example token exchange request
$tokenEndpoint = 'https://accounts.google.com/o/oauth2/token';
$clientId = '802530843235-7tu3o3ad0v1pkorb7ddhmq19sf7uphe4.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://elmejordominiodepruebasdelahistoriadelahumanidad.shop';



// Prepare the request parameters to request an access token
$params = [
    'grant_type' => 'authorization_code',
    'code' => $authorizationCode,
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectUri,
    'prompt' => 'consent', // Add this line to include the prompt parameter
];

function makeTokenExchangeRequest($tokenEndpoint, $params) {
    $ch = curl_init();
    $result = null;
    if ($result === false) {
    echo 'Curl error: ' . curl_error($ch);
}
    if ($ch === false) {
    echo 'Failed to initialize cURL';
    // Handle the error appropriately, e.g., exit the script or return an error response
}

    curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
    return json_decode($response, true);
}

// Make a POST request to the token endpoint to exchange the authorization code for tokens
$response = makeTokenExchangeRequest($tokenEndpoint, $params);


// Declare backend responses in variables
$accessToken = $response['access_token'];
//$refreshToken = $response['refresh_token'];

//declare the params to request a refresh token

 // Prepare the request parameters
$params = [
    'grant_type' => 'refresh_token',
    'refresh_token' => '1//06-9UGjUKFvh5CgYIARAAGAYSNwF-L9IrdJ5l1XMQ0S6rnaTrba_sLjC1HkQXh386SQrBCZDh9h1Ur6V-sx3nT7a0SnSe37eBOrc',
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectUri,
    'prompt' => 'consent', // Add this line to include the prompt parameter
];
//$response = makeTokenExchangeRequest($tokenEndpoint, $params);
//$refreshToken = $response['refresh_token'];


// Send the response back to the frontend (you can include access token, refresh token, etc. in the response)
$response = [
    'status' => 'success',
    'message' => 'Refresh token obtained successfully.',

    // Include other data in the response if needed
    'access_token' => $accessToken,
//    'refresh_token' => $refreshToken,
    'provided auth code' => $authorizationCode,


];



echo json_encode($response);
//ensure the response is ok
$jsonEncodedResponse = json_encode($response);
if ($jsonEncodedResponse === false) {
    echo 'JSON encoding error: ' . json_last_error_msg();
} else {
    echo $jsonEncodedResponse;
}

?>
