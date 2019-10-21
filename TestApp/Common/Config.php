<?php

class Config {
    private $content;
    private static $instance = null;
    
    //Gets configuration data from Config.json
    private function __construct() {
        $temp = file_get_contents("../Config/Config.json");
        if(!$temp){
            echo "Error reading Config.json file";
            die;
        }else{
            $this->content = json_decode($temp, true);
        }
    }
    
    public function getConfigParam($arg) {
        
        if (array_key_exists($arg, $this->content)) {            
            return $this->content [$arg];
        } else {
            //throw new APIException("Invalid argument: " . $arg, APIException::ERROR_CONFIG, Logger::ERROR);
            echo "Error reading content of Config";
            die;
        }
    }
    
    private function __clone() {
    }

    private function __wakeup() {
    }
            
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new static();            
        }
        return self::$instance;
    }
}