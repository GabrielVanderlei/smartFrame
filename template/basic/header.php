<!DOCTYPE html>
<html>
    <head> 
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
        <script type='text/javascript' src='/assets/js/jQuery.js'></script>
        <!--Configuração básica-->
        <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php if(!empty($data['title'])){ ?>
        <title><?=$data['title'];?></title>
        <?php } ?>
        
        <?php if(!empty($data['link'])){ ?>
        <!--Estilos-->
        <?php foreach($data['link'] as $key){ ?>
        <link rel='<?=$key[0];?>' 
              href='<?=$this->controller->Config("saoe")->{"public"};?><?=$key[1];?>?v2'/>
        <?php } ?>
        <?php } ?>
        
        <?php if(!empty($data['script'])){ ?>
        <!--Scripts-->
        <?php foreach($data['script'] as $key){ ?>
        <script type='<?=$key[0];?>' 
                src='<?=$this->controller->Config("saoe")->{"public"};?><?=$key[1];?>?v1'></script>
        <?php } ?>
        <?php } ?>
        
        <?php if(!empty($data['meta'])){ ?>
        <!--Metas-->
        <?php foreach($data['meta'] as $key){ ?>
        <meta name='<?=$key[0];?>' 
              content='<?=$key[1];?>'/>
        <?php } ?>
        <?php } ?>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>