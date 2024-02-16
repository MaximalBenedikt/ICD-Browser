<?php

require "Database.php";

class Entity 
{
    public $data = [
        "Basic" => [
            "UEID" => null,
            "ICDID" => null,
            "Linearisation" => "",
            "Release" => "",
            "Language" => "",
            "Title" => null,
            "LastRefresh" => "0001-01-01 00:00:01",
            "BrowserUrl" => null,
            "ClassKind" => null,
        ],
        "Simple" => [
            "Definition" => null,
            "LongDefinition" => null,
            "FullySpecifiedName" => null,
            "DiagnosticCriteria" => null,
            "Code" => null,
            "CodeRange" => null,
            "CodingNote" => null,
            "BlockId" => null,
            "RelatedEntitiesInMaternalChapter" => null,
            "RelatedEntitiesInPerinatalChapter" => null
        ],
        "Advanced" => [
            "Children" => [],
            "Parents" => [],
            "Ancestors" => [],
            "Descendant" => [],
            "Inclusions" => [],
            "Exclusions" => [],
            "Synonyms" => [],
            "NarrowerTerms" => [],
            "FoundationChildElsewhere" => [],
            "indexTerm" => [],
            "PostcoordinationScale" => []
        ]
    ];

    private $status = [
        "isLoaded" => [
            "basic" => false,
            "simple" => false,
            "extendet" => false
        ]
    ];

    public function __construct() {
        
    }

    public function LoadByICDID(
        $ICDID, 
        $Options = [
            "Linearisation" => "Foundation", //If Not Provided, Foundation
            "Language" => "en",              //If not Provided, English
            "Release" => "",                 //If not Provided, Latest
            "Scope" => 1                     //If not Provided, 3 | Scope: 1 = Only Basic Data, 2 = Basic + Simple, 3 = Basic + Simple + Advanced 
        ]) {

        
        
        return $this->data;
    }
}

$testEntity = new Entity();
echo $testEntity->data;
var_export($testEntity->data);

/**
 * DB Entries for Entity:
 * Entities:
 *  UEID
 *  ICD-ID
 *  Linerization (Foundation or MMS)
 *  Release (i.E. 2024-01)
 *  Language ("en","de", etc)
 *  Title
 *  Definition
 *  LongDefinition
 *  FullySpecifiedName
 *  diagnosticCriteria
 *  Code
 *  CodingNote
 *  codeRange
 *  blockId
 *  classKind
 *  LastRefresh
 *  browserUrl
 *  relatedEntitiesInMaternalChapter
 *  relatedEntitiesInPerinatalChapter
 * 
 * Relations:
 *  ICD-ID - Root Entity
 *  Relation
 *  ICD-ID - Related Entity
 *  
 * Connections:
 *  ICD-ID - Root Entity
 *  Type (Synonyms, NarrowerTerms, Inclusions, Exclusions, foundationChildElsewhere, indexTerm)
 *  Language (en, ar, ...)
 *  Title
 *  ICD-ID - Foundation
 *  Linerization - 
 *  Linerization - ICD-ID
 * 
 * postcoordinationScale:
 *  UPCSID
 *  UEID - Entity
 *  requiredPostcoordination
 *  allowMultipleValues
 * 
 * Scale Entities
 *  UPCSID
 *  UEID - Entity
 * 
 * Variable Names
 *  $ueid = UEID (Unique Entity ID, This refers to ICD-ID, Release, Language and (if there are multiple Versions in one Release) which Version)
 *  $icdid = ICD ID (The ID under which the Specific Disease or Disorder is handled in the ICD Foundation/Linearization)
 *  $release = Releases of the ICD (2024-01, 2023-01, ...)
 * 
 */