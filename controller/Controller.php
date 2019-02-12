<?php

   # Controller.php
   # Essa é a classe que controla todas as requisições
   
    /* Ao realizar qualquer alteração basta alterar o parâmetro version que automaticamente os dados de script e folhas de estilo serão atualizados, essa medida é para que o navegador possa armazenar a maior quantidade de dados no dispositivo do usuário, agilizando assim o carregamento da página.
    */
    
    /* Cada função do aplicativo vai possuir sua própria classe específica, tornando assim o código muito menor e muito organizado. Essas funções terão ligação direta com a classe mestra para que alterações futuras sejam rápidamente repassadas para todas as áreas do app.*/

   class Controller
   {
      public $script;
      public $config;
      public $style;
      
      public function __construct(){
          date_default_timezone_set('America/Sao_Paulo');
          
          $model = new Model;
          $model -> alterarBanco(
          "SET time_zone='America/Sao_Paulo';
            SELECT @@time_zone;");
      }
      
      public function setConfig($arr){
        foreach($arr as $key => $val){
            if(isset($this -> config[$key])){
          $this -> config[$key] = array_merge($this -> config[$key], 
            $arr[$key]);
            }
            else{
                $this -> config[$key] =
            $arr[$key];
            }
        }
      }

      public function getConfig(){
          return $this -> config;
      }
      
      public function index()
      {
         $model = new Model;
         $view = new View;
         $view->render($model->getText());
      }
      
      public function Erro(){
          #Página de erro
          echo "Se você demorar muito a encontra-las, algumas páginas podem simplesmente ir embora.";
          header("HTTP/1.0 404 Not Found");
      }
      
      public function EnviarWhatsapp($para, $texto){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.waboxapp.com/api/send/chat");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "token=fcd32e4f51bcab5b932ccade243d61065a96ee46e6f4f&uid=554884679689&to=55".$para."&custom_uid=m-".time()."&text=".$texto);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
        
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close ($ch);
      }
      
      public function EnviarEmail($para, $assunto, $url, $dados){
              $model = new Model;
              $model -> setOrdem("user");
              $model -> consultarBanco("admin", " ORDER BY id ");
              
              $adm = $model -> verDados();
              $admin = $adm['admin']['user']['admin'];
              $email = $admin['email'];
              $destino = $email;
            
              $headers  = 'MIME-Version: 1.0' . "\r\n";
              $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
              $headers .= 'From: AeCidades Helper <'.$email.'>';
              
              include('/home/aetijucas/app/template/'.$url);
              $arquivo = $dr;
              
              #Para o sistema
              $enviaremail = mail($destino, '[E-mail de segurança] '.$assunto, $arquivo, $headers);
              #Para o destinatário
              $enviaremail = mail($para, $assunto, $arquivo, $headers); 
      }
      
      public function config($file, $opt=false){
          $file = file_get_contents("/home/aetijucas/api.aetijucas.com.br/configuration/".$file.".json");
          $json = json_decode($file, $opt);
          return $json;
      }
      
      public function Prepare($str, $type){
            // Retorna apenas letras e números
            if($type == 'email') $alt = '|@|.';
            if($type == 'telefone') $alt = '|(||)|.';
            else $alt = '';

            $secure = preg_replace('/[^[:alnum:]'.$alt.'_]/', '',$str);
            $secure = utf8_encode($secure);
            return $secure;
        }
      
      public function Show($str, $type){
          // Essa função serve para formatar valores do banco de dados.
          switch($type){
              
              case 'telefone':
                  $ddd = substr($str, 0, 2);
                  $numero = substr($str, 2);
                  return '('.$ddd.')'.$numero;
                  break;
              
              default:
                  return $str;
                  break;
          }
      }
      
   }