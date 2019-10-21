<?php
require_once "../Common/MySQLDB.php";
require_once "User.php";

class UserMapper{
    private $mdb;
    
    
    public function __construct() {
        $this->mdb = MySQLDB::getInstance();
    }
    
    
    public function AddUser($user){
        try {
            $sql = "INSERT INTO user(email, name, password)";
            $sql.= "VALUES (:email, :name, :password)";
            
            $stmt = $this->mdb->prepare($sql);
            $username = $user->getName();
            $useremail = $user->getEmail();
            $userpassword = $user->getPassword();
            $stmt->bindParam('name', $username);
            $stmt->bindParam('email', $useremail);
            $stmt->bindParam('password', $userpassword);
            
            $stmt->execute();            
            return true;
        }catch(PDOException $e) {
            echo "Error: ";
            echo $e->getMessage();
            return false;
        }            
    }
    
    //check if an email already exists in the table user
    function findUserByEmail($email){
        $sql = "SELECT * from user WHERE email LIKE :email";
        $stmt = $this->mdb->prepare($sql);
        //$this->mdb->bindParam(':name', 'bajic_kg@live.com');
        //$res = $this->mdb->exec();
        //$res = $this->mdb->execute('bajic_kg@live.com');
        $stmt->execute([':email' => "$email"]);        
        $res = $stmt->fetchAll();        
        if(!$res){
            return 0;
        }else{
            return 1;
        }
    }

    //search for  users with either a name or an email 
    //address similar to the query text 
    function findUserByEmailOrName($text){
        try{
            $sql = "SELECT * FROM user WHERE email LIKE :text OR name LIKE :text";
            $stmt = $this->mdb->prepare($sql);
            //var_dump($stmt->execute([':text' => "%$text%"]));
            $stmt->execute([':text' => "%$text%"]);              
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $array;
        } catch (Exception $ex){
             echo "Error: ";
             echo $e->getMessage();
        }
    }
    
    //check if an user with the specified email and password exists in the table user
    function findUserByEmailAndPassword($email, $password){
        try{                
            $sql = "SELECT * from user WHERE email LIKE ? AND password LIKE ?";
            $stmt = $this->mdb->prepare($sql);     
            $stmt->execute(array($email, $password));
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            if(!$res)
            {
              return null;              
            }
            //success case
            else{                                   
                return $res;
            }                
        } catch (Exception $ex) {
            echo "Error: ";
            echo $e->getMessage();
        }
    }
}

