<?php
    class WHO{
        public function __construct(Type $var = null) {
            $this->var = $var;
        }

        // Request CURL Instance
        private function GetCurl( $language = "en" ) {
            require "../config.php";
    
            if (!isset($AuthToken)) {
                $AuthTokenRequest = curl_init();
                curl_setopt($AuthTokenRequest, CURLOPT_URL, $config["WHO"]["tokenEndpoint"]);
                curl_setopt($AuthTokenRequest, CURLOPT_POST, TRUE);
                curl_setopt($AuthTokenRequest, CURLOPT_POSTFIELDS, array(
                            'client_id' => $config["WHO"]["clientId"],
                            'client_secret' => $config["WHO"]["clientSecret"],
                            'scope' => $config["WHO"]["scope"],
                            'grant_type' => $config["WHO"]["grant_type"]
                ));
                curl_setopt($AuthTokenRequest, CURLOPT_RETURNTRANSFER, 1); 
                $result = curl_exec($AuthTokenRequest);
                if (curl_getinfo($AuthTokenRequest, CURLINFO_HTTP_CODE)!=200){
                    exit(curl_getinfo($AuthTokenRequest, CURLINFO_HTTP_CODE));
                }
                $json_array = (json_decode($result, true));
                global $AuthToken = $json_array['access_token'];
                curl_close($AuthTokenRequest);
            }
    
            $curl_who = curl_init();
            curl_setopt($curl_who, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer '.$token,
                'Accept: application/json',
                'API-Version: v2',
                'Accept-Language: ' . $language,
            ));
            curl_setopt($curl_who, CURLOPT_RETURNTRANSFER, true);
    
            return $curl_who;
        }
        
        /* 
            How to use the Returned Value
    
            $curl_instance = GetCurlWHO("en");
            curl_setopt($curl_instance, CURLOPT_URL, '(Insert Request URL)');
    
            $data=curl_exec($curl_instance);
    
            //Check for HTTP-Codes
            if(curl_getinfo($curl_instance, CURLINFO_HTTP_CODE)==404) { 
                include "entity_not_found.php";
                exit (404);
            };
    
            // Close the Connection
            curl_close($curl_instance);
        */

        // Foundation
        // Basic Informations
        public function GetFoundationRelease($language = "en", $release) {
            $query = "https://id.who.int/icd/entity";
            if (isset($release)) {
                $query .="?releaseId=".$release;
            }

            $curl_instance = $this->GetCurl($language);
            curl_setopt($curl_instance, CURLOPT_URL, $query);

            $rawData=curl_exec($curl_instance);
    
            $http_code = curl_getinfo($curl_instance, CURLINFO_HTTP_CODE)
            
            if ($http_code == 200) {
                $data = json_decode( $rawData, true );
                
                
            }

            // Close the Connection
            curl_close($curl_instance);
            $query = "https://id.who.int/icd/entity";
        }

        // Entity
        public function GetFoundationEntityByLink($link, $language = "en") {}
        public function GetFoundationEntityByICDID($icdid, $release, $language = "en") {}
        
        // Entity Releases
        public function GetFoundationEntityReleasesByICDID($icdid, $language = "en") {}
        

        // Linearization (MMS, ???)
        // Basic Informations
        public function GetLinearizationRelease($language, $linearization, $release) {}

        // Entity
        public function GetLinearizationEntityByLink($link, $language = "en") {}
        public function GetLinearizationEntityByICDID($icdid, $linearization, $language = "en") {}

        // Entity Releases
        public function GetLinearizationEntityReleasesByICDID($icdid, $linearization, $language = "en") {}


    }
?>