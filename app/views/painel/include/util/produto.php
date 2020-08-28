<?php for($i = 0; $i < count($categorias); $i++): ?>
    <span class="badge badge-primary"><?= $categorias[$i]->nome; ?></span>
<?php endfor; ?>

<?php foreach ($categorias as $cat): ?>
    <?php if(!empty($cat->filhas)): ?>
        <span class="badge badge-light">></span> <?php $this->view("painel/include/util/produto", ["categorias" => $cat->filhas]); ?>
    <?php endif; ?>
<?php endforeach; ?>
