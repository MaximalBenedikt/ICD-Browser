<?php

class Entity {
    public $UEID = null; 
    public $ICDID = null;
    public $Linearisation = "";
    public $Release = "";
    public $Language = "";
    public $Title = null;
    public $Definition = null;
    public $LongDefinition = null;
    public $FullySpecifiedName = null;
    public $DiagnosticCriteria = null;
    public $Code = null;
    public $CodeRange = null;
    public $CodingNote = null;
    public $BlockId = null;
    public $ClassKind = null;
    public $LastRefresh = "0001-01-01 00:00:01";
    public $BrowserUrl = null;
    public $RelatedEntitiesInMaternalChapter = null;
    public $RelatedEntitiesInPerinatalChapter = null;
    public $Children = [];
    public $Parent = [];
    public $Ancestors = [];
    public $Descendant = [];
    public $Relations = [];
    public $Synonyms = [];
    public $NarrowerTerms = [];
    public $Inclusions = [];
    public $Exclusions = [];
    public $FoundationChildElsewhere = [];
    public $indexTerm = [];
    public $PostcoordinationScale = [];

    public function __construct() {
        
    }
}

$testEntity = new Entity();
echo $testEntity;
var_export($testEntity);

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
 *  $ueid = UEID (Unique Entity ID; This refers to ICD-ID, Release, Language and (if there are multiple Versions in one Release) which Version)
 *  $icdid = ICD ID (The ID under which the Specific Disease or Disorder is handled in the ICD Foundation/Linearization)
 *  $release = Releases of the ICD (2024-01, 2023-01, ...)
 * 
 */


// Alter Teil