<?php if($total > 1): ?>

    <div class="pagination-container">
        <span style="position: relative; top: 35px"> Página <?= $pag; ?> de <?= $total; ?> </span>
        <nav class="pagination align-right">
            <?php if(($pag - 1) > 0): ?>
                <a class="prev page-numbers" href="<?= $url; ?>pag=<?= ($pag - 1); ?>"><i class="fa fa-angle-left"></i></a>
            <?php endif; ?>

            <?php for($i = ($pag - 4); $i <= ($pag + 4); $i++): ?>
                <?php if($i > 0 && $i <= $total): ?>
                    <span class="page-numbers <?php if($i == $pag){echo 'current';} ?>">
                        <a href="<?= $url; ?>pag=<?= $i; ?>"><?= $i; ?></a>
                    </span>
                <?php endif; ?>
            <?php endfor; ?>


            <?php if(($pag + 1) <= $total): ?>
                <a class="next page-numbers" href="<?= $url; ?>pag=<?= ($pag + 1); ?>"><i class="fa fa-angle-right"></i></a>
            <?php endif; ?>
        </nav>
    </div>

<?php endif; ?>