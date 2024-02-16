<?php

class Entity {
    public $data = {
        "UEID" = null,
        "ICDID" = null,
        "Linearisation" = "",
        "Release" = "",
        "Language" = "",
        "Title" = null,
        "Definition" = null,
        "LongDefinition" = null,
        "FullySpecifiedName" = null,
        "DiagnosticCriteria" = null,
        "Code" = null,
        "CodeRange" = null,
        "CodingNote" = null,
        "BlockId" = null,
        "ClassKind" = null,
        "LastRefresh" = "0001-01-01 00:00:01",
        "BrowserUrl" = null,
        "RelatedEntitiesInMaternalChapter" = null,
        "RelatedEntitiesInPerinatalChapter" = null,
        "Children" = [],
        "Parents" = [],
        "Ancestors" = [],
        "Descendant" = [],
        "Relations" = [],
        "Synonyms" = [],
        "NarrowerTerms" = [],
        "Inclusions" = [],
        "Exclusions" = [],
        "FoundationChildElsewhere" = [],
        "indexTerm" = [],
        "PostcoordinationScale" = []
    }

    public function __construct() {
        
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


// Alter Teil