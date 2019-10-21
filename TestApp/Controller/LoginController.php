<?php
session_start();
require_once '../Common/JsonView.php';
require_once '../Model/UserMapper.php';
require_once '../Controller/BaseController.php';

class LoginController extends BaseController{
    private $usermapper;
    protected $methodsMap = array (
        'add' => 'AddUser',
        'authenticate' => 'FindUserByEmailAndPassword',
        'getByID' => 'GetUserByID',
        'deleteByID' => 'DeleteUserByID',
        'updateByID' => 'UpdateUserByID' 
    );
    
    public function __construct(){
        $this->usermapper = new UserMapper();
    }
    
    public function FindUserByEmailAndPassword(){        
        //$requestData = json_decode($_POST["data"]);
        $email = $this->request_data["email"];
        $password = sha1($this->request_data["password"]);
        //$user = new UserMapper();

        if(($email!="") && ($password!="")){    
            $temp = $this->usermapper->findUserByEmailAndPassword($email, $password);           
            if($temp != null){        
                $message = "Welcome, ".$temp[0]["name"];
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
        //header('content-type:application/json'); 
        return JsonView::jsonModel($message, $data);
        
    }
    
}
    

?>