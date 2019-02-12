<?php
   class View
   {
      #Header & Estructure
      private $config;
      private $data;
      
      public function __construct(){
          //$this -> controller = new Controller();
      }
      
      public function render($config, $str)
      {
          
         foreach($config as $key){
            if(is_array($key)){
                $contador = 0;
                foreach($key as $conf){
                    $conf[$contador] = $conf;
                    $contador++;
                }
            }    
         }
         
         $this -> data = $str;
         $this -> config = $config;
         
         if(empty($config['auto'])) $this -> base($config);
         $this -> corpo($str);
         if(empty($config['auto'])) $this -> rodape();
      }
      
      public function base($data){
          include (realpath(__DIR__.'/..'))."/template/basic/header.php";
      }
      
      public function rodape(){
          include (realpath(__DIR__.'/..'))."/template/basic/footer.php";
      }
      
      
      public function corpo($data){
          
          /*Scope::::
            $this 
            -> dados
            [$this -> atualTabela]
            [$this -> atualId]
            ['bus_data']
            [$this -> atualBusiness]
          */
          
          if(!empty($this -> config)) $config = $this -> config;
          if(!empty($this -> data)) $data = $this -> data;
          
          include (realpath(__DIR__.'/..'))."/template/".$this -> config['template'];
      }
   }