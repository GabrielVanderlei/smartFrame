<?php
    If(!($_GET['p'] > 0)) define('PAGE', 1);
    else define('PAGE', $_GET['p']);
    define('PAGINATOR', 5);
    if(empty($_GET['p'])){
        define('ATUAL', 0);
    }
    else{
        $_GET['p'] = $_GET['p'] - 1;
        define('ATUAL', $_GET['p'] * PAGINATOR);
    }
    
?>