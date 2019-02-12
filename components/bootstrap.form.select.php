<div class='form-group'>
	<label for='<?=$options[1]?>'><?=$options[0]?></label><br />
	<select class='form-control' name='<?=$options[1]?>' id='<?=$options[1]?>'>
	<option value=''>Escolha uma das opções...</option>
	<?php foreach($options[2] as $selk => $selv): ?>
	<option <?php if($options[3] == $selk){ ?>selected<?php } ?> value='<?=$selk?>'><?=$selv?></option>
	<?php endforeach; ?>
	</select>
</div>