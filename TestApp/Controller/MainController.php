<?php
require_once '../Controller/LoginController.php';
require_once '../Controller/RegisterController.php';
require_once '../Controller/SearchController.php';
require_once '../Controller/LogOut.php';

class MainController{
    private static $controller;
    
    public static function getInstance(){
        echo "getInstance()";
        self::$controller = $_GET['controller'];
        
        $temp = ucfirst(self::$controller);
        
        $className = $temp.'Controller';
        if(class_exists($className)){
            return new $className();
        }
        else{
            echo "Error";
            throw new Exception('Invalide model name: ' . $temp, null, null);            
        }
    }
}