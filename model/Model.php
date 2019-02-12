<?php
    #DatabaseHelper
    $root = 'C:\xampp\htdocs';
    require $root.'/class/databaseHelper.php';

   class Model
   {
      #SQL
      private $sqlInteraction;
      
      #Ordenamento
      private $ordemArray;
      private $identifier;
      
      #Modelagem
      public $dados;
      private $tabelaAtual;
      private $atualTabela;
      private $atualBusiness;
      private $atualId;
      
      #Banco de Dados
      private $dadosDoBanco;
      private $banco;
      
      function __construct(){
          
          $this -> atualTabela = 0;
          $this -> atualBusiness = 0;
          $this -> atualId = 0;
          
          #Configuração do banco de dados
          $this -> dadosDoBanco = array(
              "type" => "",
              "host" => "",
              "dbname" => "",
              "user" => "",
              "pass" => ""
              );
              
          $this -> banco = new DatabaseHelper($this -> dadosDoBanco);
          
      }
      
      public function mudarBanco($dadosBanco){
          $this -> banco = new DatabaseHelper($dadosBanco);
      }
      
      public function getText($str='oi'){
          echo $str;
      }

      public function verDados()
      {
          return $this -> dados;
      }
      
      private function unirArray($antigoArray, $novoArray=''){
          if(!empty($antigoArray)) return array_merge($antigoArray, $novoArray);
          else{ return $novoArray; }
      }
      
      public function setOrdem($index){
        $this -> ordemArray[count($this -> ordemArray)] = $index;
      }

      public function closeOrdem(){
          $this -> ordemArray = [];
      }
      
      public function setSQLIntegration($sqlFixo, $sqlBind, $param , $sqlOpt){
          $this -> sqlInteraction = '';
          $this -> sqlInteraction = $sqlFixo;
          $dados = $this -> dados[$this -> atualTabela];
          
          $contador = 0;
          foreach($dados as $key){
            $contador++;
            if((!empty($key[$param])) || ($key[$param] === '0')){
                $this -> sqlInteraction .= $sqlBind;
                $this -> sqlInteraction .= " '".$key[$param]."' ";
                
                if(
                    (!empty($sqlOpt)) &&
                    ($contador != count($dados))
                    ){
                    $this -> sqlInteraction .= $sqlOpt;
                }
            }
          }
          
      }
      


      public function consultarBanco($tabela = 'business', $sql='', $i = '', $identifier='')
      {
        $this -> atualTabela = $tabela;
              
        if(!empty($identifier)){
        $this -> identifier = $identifier;
        }
              
        else{
            $this -> identifier = $this -> atualTabela;
        }
          
        if(!empty($tabela)){
            if(!empty($this -> sqlInteraction)){
                $sql .= $this -> sqlInteraction;
            }
                  
            $this 
            -> banco 
            -> GET(
                "SELECT *
                FROM ".$tabela . $sql ,
                        
                function ($resposta, $i, $end){
                    $this 
                    -> dados[$this -> identifier][$i] = $resposta;
                            
                    if(is_array($this -> ordemArray)){
                        foreach($this -> ordemArray as $key => $val){
                            $this 
                            -> dados
                            [$this -> identifier]
                            [$val]
                            [$resposta[$val]] = $resposta;
                        }
                    }
                    
                    if(($i + 1) == $end){
                        //$this -> ordemArray = '';
                        $this -> identifier = '';
                    }
                    }
            );
                    
        }
              
        else{
            $this 
            -> banco 
            -> GET(
                $sql ,
                        
                function ($resposta, $i){
                    $this 
                    -> dados = $this -> unirArray($this-> dados, $resposta);
                }
            );
        }
      }
      
      public function alterarBanco($sql){
          $this -> banco -> GET($sql, '');
      }
      
      public function contar($tabela, $add=''){
          $this 
            -> banco 
            -> GET(
                'SELECT COUNT(*) AS '.$tabela.'_total FROM '.$tabela . $add,
                        
                function ($resposta, $i){
                    $this 
                    -> dados = $this -> unirArray($this-> dados, $resposta);
                }
            );
      }
      
      public function inserirTabela($tabela, $colunas, $valores){
      	$total_colunas='';
      	$total_valores='';
      	$c = '';
      	
      	if($valores == true){
      		$base = $colunas;
      		$colunas = array_keys($base);
      		$valores = array_values($base);
      	}
      	
      	$c = '';
      	foreach($colunas as $parte_colunas){ 
      		$total_colunas .= $c." ".$parte_colunas;
      		$c = ',';
      	}
      	
      	$c = '';
      	foreach($valores as $parte_valores){ 
      		$total_valores.= $c.' "'.$parte_valores.'"';
      		$c = ',';
      	}
     
      	$this -> banco -> GET(
      		" INSERT INTO ".
      		$tabela." (".
      		$total_colunas.") VALUES (".
      		$total_valores.") ", '');
      }

      public function alterarTabela($tabela, $mudancas, $id){ 
      	
      	$mudancas_sql = '';
      	$c = '';

      	foreach ($mudancas as $key => $value) {
      		$mudancas_sql .= $c.$key . ' = "' . $value . '" ';
      		$c = ', ';	
      	}
      	
      	$this -> banco -> GET(
      		' UPDATE '.
      		$tabela.' SET '.
      		$mudancas_sql.'  
      		WHERE id="'.$id.'" ', '');
      }
      
      private function verificaSeExiste($pattern, $input, $flags=0) {
            return array_intersect_key(
                $input, array_flip(
                    preg_grep(
                        $pattern, 
                        array_keys($input), 
                        $flags)));
        }
   }