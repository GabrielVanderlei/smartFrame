<?php
class REST{
    static public function VerifyEmpty($str){
        return empty($str);
    }
    
    static public function Message($status, $str){
        
        $code = Array(
            0 => "404",
            1 => "202",
            2 => "500"
        );
        
        $message = Array(
            "status" => $status,
            "code" => $code[$status],
            "message" => ($str),
        );
        
        echo json_encode($message, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    static public function PrepareSQL($str){
        return addslashes($str);
    }
    
    static public function JSON($str, $end=0){
        if(!end)
        return json_encode($str, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        else
        exit(json_encode($str, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
    
    static public function CryptPassword($uservar, $pass){
        $token = '20';
        return sha1($uservar.$pass.$token);
    }
}
?>