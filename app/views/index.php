<div>
<?php
foreach ($juegos as $j) {
?>    
    <a href='<?=$j['enlace']?>'><img src="<?=$j['imagen']?>" class="th img-thumbnail" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<b><?=htmlspecialchars($j['nombre'])?></b><br/><?=htmlspecialchars($j['descripcion'])?>"></a>
<? } ?>
</div>
<div class="tm">
<ul class="pagination justify-content-center">
<?php 
    foreach($paginado as $p) { ?>
        <li class="page-item<?= (isset($p['actual']) && $p['actual']?' active':'') ?>"><a class="page-link" href="<?= $p["url"] ?>"><?= $p["pagina"] ?></a></li>
<?php
    }
?>
</ul>
</div>
