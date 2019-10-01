<?php

class JsonView {

    public static function jsonModel($message, $data) {
        $temp = array (
                'data' => $data,                
                'message' => $message             
        );        
        return json_encode($temp);
    }
}
?>