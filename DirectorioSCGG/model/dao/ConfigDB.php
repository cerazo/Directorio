<?php

    //namespace DirectorioSCGG\model;
    class ConfigDB{
        public $Db_Host;
        public $Db_User;
        public $Db_Pass;
        public $Db_Name;
        public $Db_Charset;
        
        function __construct(){
            
            $this->Db_Host = "localhost";
            $this->Db_User = "root";
            $this->Db_Pass = "";
            $this->Db_Name = "directorio";
            $this->Db_Charset = "utf-8";
        }
    }

    /*define('DB_HOST','192.168.0.48:3306'); 
    define('DB_USER','root'); 
    define('DB_PASS',''); 
    define('DB_NAME','Directorio'); 
    define('DB_CHARSET','utf-8');
    
    define('DB_HOST','localhost'); 
    define('DB_USER','root'); 
    define('DB_PASS',''); 
    define('DB_NAME','directorio'); 
    define('DB_CHARSET','utf-8');*/
    
    
?>