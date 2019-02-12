<?php
	$tipos = $options[2];
	$lista = '';
	$added = '';
	
	foreach($tipos as $tiposSuportados){
		switch($tiposSuportados){
			case 'Word': $lista.=$added."application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword";$added=','; break;
			case 'PDF': $lista.=$added."application/pdf";$added=','; break;
			case 'img': $lista.=$added."image/*";$added=','; break;
		}
	}
	
	if(empty($lista)) $lista = '*';
?>

<input type="hidden" name="MAX_FILE_SIZE" value="31457280" />
<div class="form-group">
	<label for="arquivo"><?=$options[0];?></label>
	<input class="form-control" id="<?=$options[1];?>" type="file" name="<?=$options[1];?>" accept="<?=$lista;?>"/>
</div>