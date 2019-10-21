<?php

class JsonView {
        
    //create a json for a response data
    public static function jsonModel($message, $data) {
        $temp = array (
                'data' => $data,                
                'message' => $message             
        );        
        return json_encode($temp);
    }
}
?>