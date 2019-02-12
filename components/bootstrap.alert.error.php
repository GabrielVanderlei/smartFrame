<?php if(!empty($_SESSION['err'])): ?>
<div class="alert alert-primary">
    <?=($_SESSION['err']);?>
</div>
<?php $_SESSION['err'] = '';endif; ?>