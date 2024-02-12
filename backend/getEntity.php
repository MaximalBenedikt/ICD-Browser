<?php
/*
Get Variables:
- Entity
- (Release: Optional, else newest)
- (Language: Optional, else "en")

Other used Variables: 
- (IP (check if User tried to access over 5 Times in the last 10 seconds; If True: Error))
- Comes Soon; DOS/Spam Protection
*/

//Check the provided Informations
//Check EntityId
if (isset($_GET["entityId"])) {
    if (!is_numeric($_GET["entityId"])) {
        http_response_code(400);
        exit("Entity ID is not a number.");
    }
    $entityId = $_GET["entityId"];
} 


//Check Release
if (isset($_GET["release"])) {
    $releaseId = $_GET["release"];
}

//Check Language
if (isset($_GET["language"])) {
    $language = $_GET["language"];
} else {
    $language = "en";
}


//Get Token for API-Access
include "getToken.php";

//Access API
$icd_request = curl_init();
curl_setopt($icd_request, CURLOPT_URL, 'https://id.who.int/icd/entity' . (isset($_GET["entityId"]))?'/' . $entityId:'');
curl_setopt($icd_request, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$token,
			'Accept: application/json',
            'API-Version: v2',
            (isset($releaseId)) ? 'releaseId: ' . $releaseId:"",
			'Accept-Language: ' . $language,
            'include:ancestor, decendant, diagnosticCriteria'
));
$icd_result=curl_exec($icd_request);
curl_close($icd_request);