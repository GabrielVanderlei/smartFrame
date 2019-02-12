<?php
class Component{
    static public function Get($file, $options = [], $to=0){
        if($to == 0){
            $file = (realpath(__DIR__ . '/..')."/components/".$file.".php");
            include $file;
        } else {
            $file = (realpath(__DIR__ . '/..')."/components/".$file.".php");
            ob_start();
            include $file;
            return ob_get_clean();
        }
    }
}
?>