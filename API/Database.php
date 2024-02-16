<?php
    require "../config.php";
    
    $pdo = new PDO('mysql:host='.$config["Database"]["host"].';dbname='.$config["Database"]["dbname"], $config["Database"]["user"], $config["Database"]["pass"]);

    // GET
    // Search
    function GetEntitySearch()

    // Entity Versions
    function GetEntityVersionsByUEID ($ueid) {}
    function GetEntityVersionsByICD  ($icd, $release, $language) {}
    
    // Entity Releases
    function GetEntityReleasesByUEID ($ueid) {}
    function GetEntityReleasesByICD  ($icd, $release, $language) {}

    // Entities
    function GetEntityByICD ($icdid, $release) {
        $getbyICD = $pdo->prepare("SELECT * FROM Entities WHERE ICD-ID = ?");
    }
    function GetEntityByUEID ($ueid) {}

    // INSERT/UPDATE
    // Save Entity
    function UpdateEntityByUEID ($ueid, )
?>