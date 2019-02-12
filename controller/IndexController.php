<?php
   include 'Controller.php';
   
   class BusController extends Controller
   {
      public $controller;
      
      public function __construct(){
          $this -> controller = new Controller();
      }
      
      public function Login()
      {
          
         $model = new Model;
         
         $this -> controller -> setConfig(array(
             'title' => 'Administrativo | AeTijucas',
             'template' => 'inicio/login.php',
             'version' => time() #Para testes o 'time' pode ser usado.
         ));
         
         $view = new View;
         $view->render(
             $this -> controller -> getConfig(),
             $model -> verDados());
             
      }
   }