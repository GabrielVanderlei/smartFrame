<?php
    
    if(REST::VerifyEmpty($_POST['userName'])) REST::Message(0, "Nome de usuário em branco.");
    if(REST::VerifyEmpty($_POST['userPass'])) REST::Message(0, "Senha em branco.");
    
    $logado = USER::Login($_POST['userName'], $_POST['userPass']);
    if(!$logado) REST::Message(0, "Nome de usuário ou senha incorreto");
    else REST::Message(1, "Usuário logado com sucesso.");
    
?>