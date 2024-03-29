<?php
session_start();
require_once '../Common/JsonView.php';
require_once '../Model/UserMapper.php';

$requestData = json_decode($_POST["data"]);
$text = $requestData->text;
$userMapper = new UserMapper();
$data = 23;
if(isset($_SESSION['logged'])){    
    if($text!=""){
        $temp = $userMapper->findUserByEmailorName($text);                
        if($temp != null){              
            foreach ( $temp as $key => $value ) {                
                $temp1 = array();
                $temp1 ['id'] = $value['id'];
                $temp1 ['name'] = $value['name'];
                $temp1 ['email'] = $value['email'];

                $tempB [] = $temp1;
            }
            $data = $tempB;        
            $message = "";
        }else{
            $data = 0;
            $message = "Data not found!";
        } 
    } else{
        $data = 0;
        $message = "";
    } 
    header('content-type:application/json'); 
    echo JsonView::jsonModel($message, $data);    
}
else{
    $data = -1;
    $message = "Please login";
    header('content-type:application/json'); 
    echo JsonView::jsonModel($message, $data);
}
?>