<?php
	if(!isset($mdleft)) $mdvarl = 6;
	else $mdvarl = $mdleft;
	
	if(!isset($mdright)) $mdvarr = 6;
	else $mdvarr = $mdright;
	
?>
<br />
<div class="list-group list-group-flush">
	<?php foreach($options as $key => $val): ?>
	<div class="list-group-item">
		<div class="row">
			<div class="col-md-<?=$mdvarl?>"><?=$key;?></div>
			<div class="col-md-<?=$mdvarr?>"><?=$val;?></div>
		</div>
	</div>
	<?php endforeach; ?>
</div>