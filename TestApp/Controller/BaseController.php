<?php
require_once '../Common/JsonView.php';

class BaseController{
    protected $methodsMap = array ();
    protected $request_data;
    private $json;
    
    public function __construct() {
        $this->json = new JsonView();
    }
    
    public function invoke($arg){
        if(array_key_exists($arg, $this->methodsMap)){
            $fun = $this->methodsMap[$arg];
            
            $this->request_data = isset($_POST["data"]) ? json_decode($_POST["data"], true) : array();
            
            try {
                $response = $this->{$fun}();
                
                //$output = $this->buildOutput($response);
                                                
                return $response;//JsonView::jsonModel("Success.", $output);
            } catch (Exception $e ) {
                return JsonView::jsonModel($e->getMessage(), - 1);
            }
        } else {
            throw new Exception('Invalide argument given: ' . $arg, -1, null);
        }
    }
        
    protected function buildOutput($arg) {
        return array ();    
    }
}