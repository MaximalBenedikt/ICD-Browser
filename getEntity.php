<?php

function LinkToId($link) {
  $parts = explode('/', $link);
  $rawId = array_pop($parts);
  return explode('?', $rawId)[0];
}

function GetEntity($rawid, $fullEntity, $debug) {
  if ($debug) {
      $exampleDataJSON = '{
          "@context": "string",
          "@id": "string",
          "title": {
            "@language": "string",
            "@value": "string"
          },
          "definition": {
            "@language": "string",
            "@value": "string"
          },
          "longDefinition": {
            "@language": "string",
            "@value": "string"
          },
          "fullySpecifiedName": {
            "@language": "string",
            "@value": "string"
          },
          "diagnosticCriteria": {
            "@language": "string",
            "@value": "string"
          },
          "source": "string",
          "code": "string",
          "codingNote": {
            "@language": "string",
            "@value": "string"
          },
          "blockId": "string",
          "codeRange": "string",
          "classKind": "string",
          "child": [
            "string"
          ],
          "parent": [
            "string"
          ],
          "ancestor": [
            "string"
          ],
          "descendant": [
            "string"
          ],
          "foundationChildElsewhere": [
            {
              "label": {
                "@language": "string",
                "@value": "string"
              },
              "foundationReference": "string",
              "linearizationReference": "string"
            }
          ],
          "indexTerm": [
            {
              "label": {
                "@language": "string",
                "@value": "string"
              },
              "foundationReference": "string",
              "linearizationReference": "string"
            }
          ],
          "inclusion": [
            {
              "label": {
                "@language": "string",
                "@value": "string"
              },
              "foundationReference": "string",
              "linearizationReference": "string"
            }
          ],
          "exclusion": [
            {
              "label": {
                "@language": "string",
                "@value": "string"
              },
              "foundationReference": "string",
              "linearizationReference": "string"
            }
          ],
          "relatedEntitiesInMaternalChapter": "string",
          "relatedEntitiesInPerinatalChapter": "string",
          "postcoordinationScale": [
            {
              "axisName": "string",
              "requiredPostcoordination": "string",
              "allowMultipleValues": "string",
              "scaleEntity": [
                "string"
              ]
            }
          ],
          "browserUrl": "string"
        }';
      return json_decode($exampleDataJSON, true);
  } 

  if (isset($rawid)) {
    if (!is_numeric($rawid)) {
      if (!filter_var($rawid, FILTER_VALIDATE_URL)) { 
        return null;
      }
      $rawid = LinkToId($rawid);
      if (!is_numeric($rawid)) {
        return null;
      }
    }
  } 

  if ($fullEntity) {
    $query = "?include=ancestor,descendant,diagnosticCriteria";
  } else {
    $query = "";
  }

  //Get Token for API-Access
  include "getToken.php";

  //Access API
  //Check for the newest Release
  $icd_request = curl_init();
  curl_setopt($icd_request, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$token,
    'Accept: application/json',
    'API-Version: v2',
    'Accept-Language: en',
  ));
  curl_setopt($icd_request, CURLOPT_URL, 'https://id.who.int/icd/release/11/mms/' . $rawid);
  curl_setopt($icd_request, CURLOPT_RETURNTRANSFER, true);

  $rawReleases=curl_exec($icd_request);
  if(curl_getinfo($icd_request, CURLINFO_HTTP_CODE)==404) {
    include "entity_not_found.php";
    exit (404);
  };
  $releases = json_decode($rawReleases, true);
  curl_close($icd_request);

  $icd_request = curl_init();
  curl_setopt($icd_request, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$token,
    'Accept: application/json',
    'API-Version: v2',
    'Accept-Language: en',
  ));
  curl_setopt($icd_request, CURLOPT_URL, str_replace("http://","https://",$releases["latestRelease"]) . $query);
  curl_setopt($icd_request, CURLOPT_RETURNTRANSFER, true);
  $rawOutput=curl_exec($icd_request);
  

  curl_close($icd_request);

  // print_r(json_decode($rawOutput, true));
  return json_decode($rawOutput, true);
}







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
// if (isset($_GET["entityId"])) {
//     if (!is_numeric($_GET["entityId"])) {
//         http_response_code(400);
//         exit("Entity ID is not a number.");
//     }
//     $query = "/" . $_GET["entityId"] . "?";
// } else {
//     $query = "?";
// }


// //Check Release
// if (isset($_GET["release"])) {
//     $query .= "&releaseId=" . $_GET["release"];
// }

// //Check Language
// if (isset($_GET["language"])) {
//     $language = $_GET["language"];
// } else {
//     $language = "en";
// }

// //Check Full Entity
// if (isset($_GET["fullEntity"])) {
//     $query .= "&include=ancestor,descendant,diagnosticCriteria";
// }


//Get Token for API-Access
// include "getToken.php";

// //Access API
// $icd_request = curl_init();
// curl_setopt($icd_request, CURLOPT_URL, 'https://id.who.int/icd/entity' . $query);
// curl_setopt($icd_request, CURLOPT_HTTPHEADER, array(
// 			'Authorization: Bearer '.$token,
// 			'Accept: application/json',
//             'API-Version: v2',
//             (isset($releaseId)) ? 'releaseId: ' . $releaseId:"",
// 			'Accept-Language: ' . $language,
            
// ));
// $icd_result=curl_exec($icd_request);
// curl_close($icd_request);