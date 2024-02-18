<?php
//Copy this to the Parentfolder of your Installation
$config = {
    "WHO": {
        "tokenEndpoint" = "https://icdaccessmanagement.who.int/connect/token",
        "clientId" = "[insert clientId here]", //If you enter your Clientid
        "clientSecret" = "[insert clientSecret here]", //and Secret, in your sourcecode: Well Played :P
        "scope" = "icdapi_access", // No Change required
        "grant_type" = "client_credentials" // No Change required
    },

    "Database": { // Database for Caching (Please use this if you want faster responsetimes and don't spam the WHO-Servers with useless requests)
        "enabled": true, // As mentioned above...
        "host": "127.0.0.1", // Database Host
        "user": "root", // Database User
        "pass": "root" // Database Password
        "dbname": "ICD" // Database Name
    }

    "ExpireTime": 336,// Value in Hours; Default 14 Days; The software automatically Checks if the Current Release is the most recent if not otherwise specified. If this is -1 the Entities will never expire and only Update if "Force Update" in the UI is pressed.
    "FullSweepPassword": "thisisapassword" // You know what to do...
};
$
?>