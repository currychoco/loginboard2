<?php
require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";

    class Utility {
        function __construct() {
        }

        public function filter_SQL($content){
            $content = str_replace("&", "&amp", $content); 
            $content = str_replace("<", "&lt", $content);  
            $content = str_replace(">", "&gt", $content);  
            $content = str_replace("'", "&apos", $content);   
            $content = str_replace("\"", "&quot", $content);  
            $content = str_replace("\r", "", $content);
            $content = str_replace("'", "", $content);   
            $content = str_replace('"', "", $content);  
            $content = str_replace("--", "", $content);
            $content = str_replace(";", "", $content);
            $content = str_replace("%", "", $content);
            $content = str_replace("+", "", $content);
            $content = str_replace("script", "", $content);
            $content = str_replace("alert", "", $content);
            $content = str_replace("cookie", "", $content);
            $content = $this->SQL_Injection($content);
            return $content;
        }
        private function SQL_Injection($get_Str) { 
            return preg_replace("/( select| union| insert| update| delete| drop| and| or|\"|\'|#|\/\*|\*\/|\\\|\;)/i","", $get_Str); 
        }

        public function checkLogin($reqId, $reqNo){
            $userId = $this->filter_SQL($reqId);
            $no = $this->filter_SQL($reqNo);

            $user = array(
                'userId' => $userId,
                'no' => $no
            );

            return $user;
        }
        
        public function getUUID(){

            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
                );

        }
    }