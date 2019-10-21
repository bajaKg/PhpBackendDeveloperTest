<?php
require_once 'Config.php';

class MySQLDB{
    private $username, $password, $connectionString;  
    private static $instance = null;
    private $dbh;
    
    //Creates new instance of MySQL data base, opens connection
    private function __construct($username, $password, $connectionString) {
        $this->username = $username;
        $this->password = $password;
        $this->connectionString = $connectionString;
        
        try
        {           
            $this->dbh = new PDO($this->connectionString, $this->username, $this->password);
        }  catch (PDOException $e){
            echo "Error: ";
            echo $e->getMessage();
        }
                
    }
    
    private function __clone() {
    }

    private function __wakeup() {
    }
    
    //Returns new instance of MySQL data base (Singlton pattern
    //Data required for instanciating gets from config.json through Config::getInstance()
    public static function getInstance(){
        if(self::$instance == null){
            $config = Config::getInstance();
            self::$instance = new static($config->getConfigParam("username"), $config->getConfigParam("password"), $config->getConfigParam("connection_string"));            
        }
        return self::$instance;
    }
    
    public function select($query) {
        
    }
    
    public function prepare($query){
        $stmt = $this->dbh->prepare($query);
        return $stmt;
    }
    
    public function bindParam($name, $value){
        $this->dbh->bindParam($name, $value);
    }
    
    public function execute($array = NULL){
        //$this->dbh->prepare("SELECT * from user WHERE email LIKE ?");
        //var_dump($this->dbh->execute("bajic_kg@live.com"));
       // return is_null($array)? $this->dbh->exec() : $this->dbh->query("bajic_kg@live.com");             
    }
        
}

