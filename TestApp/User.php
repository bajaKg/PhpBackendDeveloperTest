<?php

    class User{
        const hostName = 'localhost';
        const user = 'root';
        const password = '';
        const dbName = 'dbUser';
        
        private $dbh;
        
        function __construct() {
            try{
                $connectionString = "mysql:host=".self::hostName.";dbname=".self::dbName;
                $this->dbh = new PDO($connectionString, self::user, self::password);
            }  catch (PDOException $e){
                echo "Error: ";
                echo $e->getMessage();
            }
        }
        
        function __destruct() {
            $this->dbh = null;
        }
        
        function findUserByEmailAndPassword($email, $password){
            try{
                //var_dump($password);
                $sql = "SELECT * from user WHERE email LIKE '".$email."' AND password LIKE '".$password."'";
                $pdoExpresion = $this->dbh->query($sql);                             
                if(!$pdoExpresion)
                {
                  die("Execute query error");
                }
                //success case
                else{                   
                    $array = $pdoExpresion->fetch(PDO::FETCH_ASSOC);
                    return $array;
                }                
            } catch (Exception $ex) {
                echo "Error: ";
                echo $e->getMessage();
            }
        }
        
        function findUserByEmailAndName($text){
            try{
                $sql = "SELECT * from user WHERE email LIKE ".$text." OR name LIKE ".$text;
                $pdoExpresion = $this->dbh->query($sql);
                $array = $pdoExpresion->fetchAll(PDO::FETCH_ASSOC);
                return $array;
            } catch (Exception $ex) {
                 echo "Error: ";
                 echo $e->getMessage();
            }
        }
        
        public function AddNewUser($email, $name, $password) {
            try {
                $sql = "INSERT INTO user(email,name,password)";
                $sql.= "VALUES ('$email', '$name', '$password')";
                $pdo_izraz = $this->dbh->exec($sql);
                return true;
                
            }catch(PDOException $e) {
                echo "Error: ";
                echo $e->getMessage();
                return false;
                
            }
            
        }
    }
