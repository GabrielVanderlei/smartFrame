<div class='form-group'>
	<?php if(empty($options[2])) $options[2] = "d/m/Y"; ?>
	<?php if(empty($options[3])) $options[3] = "00/00/0000"; ?>
	<label for='<?=$options[1]?>'><?=$options[0]?></label><br />
	<input type='text' class='form-control' id='<?=$options[1]?>' 
	placeholder='Modelo de preenchimento: <?=date($options[2])?>' <?php if($options[5]){ ?>value="<?=$options[5];?>"<?php } ?> name='<?=$options[1]?>' <?php if($options[4] == 1): ?> value='<?=date($options[2])?>' <?php endif; ?>/>
	<script>$("#<?=$options[1]?>").mask("<?=$options[3]?>")</script>
</div>