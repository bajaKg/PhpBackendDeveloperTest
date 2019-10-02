<?php
session_start();
require_once 'JsonView.php';
require_once 'User.php';

$requestData = json_decode($_POST["data"]);
$email = $requestData->email;
$password = sha1($requestData->password);
$userDb = new User();

if(($email!=null || $email!="") && ($password!=null || $password!="")){
    
    $temp = $userDb->findUserByEmailAndPassword($email, $password);        
    if($temp != null){        
        $message = "Welcome, ".$temp["name"];
        $data = 1;        
        $_SESSION['logged'] = 1;        
    }
    else{
        $data = 0;
        $message = "Email or password incorrect!";
    }
    
}else{
    $data = 0;
    $message = "Fill in email and password text boxes.";
}
header('content-type:application/json'); 
echo JsonView::jsonModel($message, $data);
?>