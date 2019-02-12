    <br />
    <?php 
    	    $page = PAGE;
    	    $total = TOTAL;
    	    $atual = ATUAL;
    	    
    	    $excedido = 0;
	    $limite = 20;
	    if($page == 0) $page = 1;
	    if($page + $limite <= $total){
	    	$excedido = 1;
	    	$total = $limite;
	    } else {
	    	$excedido = 1;
	    	$total = ($total - $page);
	    }
	    
    ?>
<nav aria-label="...">
  <div class="pagination">
    <li class="page-item <?php if($_GET['p'] < 1){ ?>disabled<?php } ?>">
      <a class="page-link" href="?<?php if($_GET['p'] > 1){ ?>p=<?=($_GET['p']);?><?php } ?>" <?php if($_GET['p'] < 1){ ?>tabindex="-1"<?php } ?>>Anterior</a>
    </li>
    <?php for($i = $page; $i <= ($page + ($total+1)); $i++){ ?>
    <?php if(($excedido == 1)&&($i > ($page + $limite))){ ?>
    <li class="page-item <?php if(($_GET['p'] == ($i-1)) OR ((!isset($_GET['p']) AND ($i == 1)))){ ?>active<?php } ?>">
      <a class="page-link" href="?p=<?=$i;?>">...<?php if(($_GET['p'] == $i) OR (!isset($_GET['p']) AND ($i == 1))){ ?> <span class="sr-only">(current)</span><?php } ?></a>
    </li>
    <?php } else if(($excedido == 1)&&($i == ($page))&&($page > 1)){?>
    <li class="page-item <?php if(($_GET['p'] == ($i-1)) OR ((!isset($_GET['p']) AND ($i == 1)))){ ?>active<?php } ?>">
      <a class="page-link" href="?p=<?=((($page - $limite) > 0)?($page - $limite): 0 );?>">...<?php if(($_GET['p'] == $i) OR (!isset($_GET['p']) AND ($i == 1))){ ?> <span class="sr-only">(current)</span><?php } ?></a>
    </li>
    <?php } else { ?>
    <li class="page-item <?php if(($_GET['p'] == ($i-1)) OR ((!isset($_GET['p']) AND ($i == 1)))){ ?>active<?php } ?>">
      <a class="page-link" href="?p=<?=$i;?>"><?=$i;?><?php if(($_GET['p'] == $i) OR (!isset($_GET['p']) AND ($i == 1))){ ?> <span class="sr-only">(current)</span><?php } ?></a>
    </li>
    <?php } ?>
    <?php } ?>
    <li class="page-item <?php if(($page + 1) >= $total){ ?>disabled<?php } ?>">
      <a class="page-link" href="?<?php if(($page + 1) < $total){ ?>p=<?=($_GET['p'] + 2);?><?php } ?>" <?php if(($page + $paginator) >= $total){ ?>tabindex="-1"<?php } ?>>Próximo</a>
    </li>
  </ul>
</nav>