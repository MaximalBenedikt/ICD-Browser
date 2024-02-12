<?php
include "config.php"

// Get OAUTH2 token
$OAuthTokenRequest = curl_init();
curl_setopt($OAuthTokenRequest, CURLOPT_URL, $tokenEndpoint);
curl_setopt($OAuthTokenRequest, CURLOPT_POST, TRUE);
curl_setopt($OAuthTokenRequest, CURLOPT_POSTFIELDS, array(
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
			'scope' => $scope,
			'grant_type' => $grant_type
));
curl_setopt($OAuthTokenRequest, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec($OAuthTokenRequest);
$json_array = (json_decode($result, true));
$token = $json_array['access_token'];
curl_close($OAuthTokenRequest);
?>