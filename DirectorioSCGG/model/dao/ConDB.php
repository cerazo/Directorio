<?php
    
    require_once "ConfigDB.php";
    
    class Conexion{
        
        public static $_db;
        private $_configDb;
        //public static $_con;
        //$configDB = new ConfigDB();

        //echo $configDB;
        
        public function __construct()
        {
            $this->_configDb = new ConfigDB();
        }

        public function Conectar()
        {
            try{
                $this->_db = new mysqli( $this->_configDb->Db_Host, $this->_configDb->Db_User,
                                    $this->_configDb->Db_Pass, $this->_configDb->Db_Name); 
            }catch(Exception $e){
                echo "Fallo al conectar a MySQL: " . $e ;
            }
            
        }

        public function Desconectar()
        {
            $this->_db->close();
        }
    }
    
?>




