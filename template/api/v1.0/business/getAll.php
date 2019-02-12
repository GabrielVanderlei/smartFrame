<?php
    
    if(REST::VerifyEmpty($_GET['limit'])) 
    REST::Message(0, "Está faltando o parâmetro limit");
    
    $model = new Model;
    if(REST::VerifyEmpty($_GET['atual'])) 
    $model->consultarBanco("business", " ORDER BY bus_id LIMIT ".$_GET['limit']." ");
    else 
    $model->consultarBanco("business", " ORDER BY bus_id LIMIT ".$_GET['atual'].",".($_GET['atual']+$_GET['limit'])." ");
    $dados = $model->verDados();

    $retorno = [];
    
    foreach($dados['business'] as $dt){
        
        $template = [
            "id" => $dt['bus_id'],
            "nome" => $dt['bus_title'],
            "descricao" => $dt['bus_description'],
            "logo1" => $dt['bus_logo'],
            "logo2" => $dt['bus_logo2'],
            "logo3" => $dt['bus_logo3'],
            "logo4" => $dt['bus_logo4'],
            "logo5" => $dt['bus_logo5'],
            "endereco" => $dt['bus_address'],
            "email" => $dt['bus_email'],
            "telefone" => $dt['bus_contact'],
            "facebook" => $dt['bus_face'],
            "whatsapp" => $dt['bus_whats'],
            "latitutde" => $dt['bus_latitude'],
            "longitude" => $dt['bus_longitude'],
        ];
        
        array_push($retorno,$template);
    }
    
    if(empty($_GET['atual']))
    $total = $_GET['limit'];
    else
    $total = $_GET['atual'] + $_GET['limit'];
    
    $message = [
        "dataset" => $retorno,
        "last" => $total
    ];
    
    REST::Message(1, $message);
?>