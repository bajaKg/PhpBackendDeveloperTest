<?php
require_once 'JsonView.php';
require_once 'User.php';

$requestData = json_decode($_POST["data"]);
$name = $requestData->name;
$email = $requestData->email;
$password = $requestData->password;
$confirm = $requestData->confirm;
$userDb = new User();

if($password=="" or $confirm=="" or $name=="" or $email==""){
    $message = "* You must fill all input fields.";
    $data = 0;
} else if(!ctype_alnum($password) or !ctype_alnum($confirm) or !ctype_alnum($name)) {
    $message = "*Special characters are not allowed for name and password.";
    $data = 0;
}else if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
    $message = "Invalid format of email address.";
    $data = 0;    
}else{
    $temp = $userDb->findUserByEmail($email);
    if($temp!=null) {
        $message = "User with specified email is already registered.";
        $data = 0;
    }else{
        if($password==$confirm){
            $password = sha1($password);
            $temp = $userDb->AddNewUser($email, $name, $password);
            if($temp){
                $message = "User succesfully registered";
                $data = 1;            
            }else{
               $message = "User not succeesfully registered.";
               $data = 0;
            }
        }
        else{
            $message = "Please confirm your password again.";
            $data = 0;
        }
    }
}
header('content-type:application/json'); 
echo JsonView::jsonModel($message, $data);
?>