<?php
include "config.php";

// Get OAUTH2 token
$AuthTokenRequest = curl_init();
curl_setopt($AuthTokenRequest, CURLOPT_URL, $tokenEndpoint);
curl_setopt($AuthTokenRequest, CURLOPT_POST, TRUE);
curl_setopt($AuthTokenRequest, CURLOPT_POSTFIELDS, array(
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
			'scope' => $scope,
			'grant_type' => $grant_type
));
curl_setopt($AuthTokenRequest, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec($AuthTokenRequest);
$json_array = (json_decode($result, true));
print_r($json_array);
$token = $json_array['access_token'];
curl_close($AuthTokenRequest);
