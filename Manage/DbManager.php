<?php
    class DbManager
    {
        private $connection;
        public function __construct($usr,$psw,$dbName) 
        {
            $this->connection =new PDO('mysql:host=localhost;dbname='.$dbName, $usr, $psw);
        }
        public function getConnectionPDO()
        {
            return $this->connection;
        }    
    }
?>