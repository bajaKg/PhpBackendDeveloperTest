<?php
require_once '../Controller/MainController.php';

//echo "Why this doesn't work?!";
if(isset($_GET["action"])){
try{
    $controller = MainController::getInstance();
    header('content-type:application/json');
    
    //need to be implemented    
    echo $controller->invoke($_GET["action"]);    
} catch (Exception $ex) {
    var_dump($_GET["action"]);
    echo $ex->getMessage();
    return false;
}

}else{
    echo "ResultsScreen.php";
}