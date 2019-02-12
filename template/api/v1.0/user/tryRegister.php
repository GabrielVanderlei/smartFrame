<?php
    
    if(REST::VerifyEmpty($_POST['userName'])) REST::Message(0, "Nome de usuário em branco.");
    if(REST::VerifyEmpty($_POST['userRealName'])) REST::Message(0, "Nome em branco.");
    if(REST::VerifyEmpty($_POST['userEmail'])) REST::Message(0, "E-mail em branco.");
    if(REST::VerifyEmpty($_POST['token'])) REST::Message(0, "Token de segurança em branco.");
    if(REST::VerifyEmpty($_POST['userPass'])) REST::Message(0, "Senha em branco.");
    
    $registro = USER::register($_POST['userName'], $_POST['userRealName'], $_POST['userEmail'], $_POST['token'], $_POST['userPass']);
    if(!$registro) REST::Message(0, "Não foi possível fazer o regidtro");
    else REST::Message(1, "Usuário registrado com sucesso.");
    
?>