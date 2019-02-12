<br />
<div class="list-group list-group-flush">
	<?php foreach($options as $key): ?>
	<div class="list-group-item">
		<div class="row">
			<?php foreach($key as $k => $v): ?>
			<div class="col"><?=$v;?></div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>