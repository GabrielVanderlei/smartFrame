<?php
    /*
        @package Index Router
        @author Gabriel Vanderlei
        @description Sistema de redirecionamento de URL's
    */
    
    # Raiz
    $root = (realpath(__DIR__));
    
    #Controle de Roteamento
    require $root.'/router.php';
    require $root.'/config.php';
    
    #Classes
    require $root.'/class/REST.php';
    require $root.'/class/USER.php';
    require $root.'/class/Components.php';

   // USER::init();
    
    $router = new Router();
    
    $router -> GET('404', ['Erro 404', 'start/404.php']);
    $router -> GET('/welcome', ['Bem vindo!', 'start/welcome.php']);
