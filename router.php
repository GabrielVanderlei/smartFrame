<?php
    
    #Script de Roteamento
    error_reporting(0);

    class Router {
        public $url;
        public $urlData;
        public $urlError;
        private $found;
        private $count;
        
        function __construct(){
            $this -> found = 0;
            $this -> url = $this -> URLPrep($_SERVER['REQUEST_URI']);
        }

        function URLPrep($uri = ''){
            $uri = explode('?', $uri);
            $routes = explode('/', $uri[0]);
            unset($routes[0]);
            $routes = array_values($routes);

            if($routes[(count($routes) - 1)] == ''){
                unset($routes[(count($routes) - 1)]);
            }

            $routes = array_values($routes);
            return $routes;
        }

        function DT($str, $fn){

            if($str == '404'){
                $this -> urlError['404']['fn'] = $fn;
            }

            $this -> urlData[count($this -> urlData)] = array(
                'str' => $str,
                'fn' => $fn
            ); 
        }

        function Process($str, $fn){
            $atualUrl = $this -> URLPrep($str);

            $u = array(
                0 => '',
                1 => ''
            );

            $pData = [];

            for($i = 0; $i <= (count($atualUrl) - 1); $i++){

                if(isset($atualUrl[$i]) && isset($this -> url[$i])){
                        
                        $params = preg_match("/{(.*)}/", $atualUrl[$i], $matches);
                        
                        if(!empty($matches)){
                            $atualUrl[$i] = $this -> url[$i];
                            $pData[$matches[1]] = $this -> url[$i];
                        }

                        $u[0] .= $atualUrl[$i].'/';
                        $u[1] .= $this -> url[$i].'/';

                        if(
                        ($u[0] == $u[1]) &&
                        (count($atualUrl) == ($i + 1)) && 
                        (count($atualUrl) == count($this -> url))
                        ){
                            $this -> found++;
                            $this-> f($fn, $pData);
                        }

                }
            }
        }
        
        function f($fn, $pData){
            if(is_callable($fn)){
                $fn($pData);
            } else{
                
                 $model = new Model;
                 $controller = new Controller;
                 
                 $controller -> setConfig(array(
                     'title' => $fn[0],
                     'template' => $fn[1],
                     'auto' => (($fn[2] == 1)?1:0),
                     'version' => time() #Para testes o 'time' pode ser usado.
                 ));
                 
                 $view = new View;
                 $view->render(
                     $controller -> getConfig(),
                     $model -> verDados());
            }
            
        }

        function GET($str, $fn){
            $this -> DT($str, $fn);
        }

        function LoadAllData(){
            foreach($this -> urlData as $key){
                $this
                -> Process($key['str'], $key['fn']);
            }
        }

        function ErrorHandler(){
            if($this -> found == 0){
                $this->f($this -> urlError['404']['fn'], '');
            }
        }

        function __destruct(){
            $this -> LoadAllData();
            $this -> ErrorHandler();
        }
    }
