<? foreach ($review as $r) { ?>
    <div class="item">
        <div class="header">
            <div class="name"><?= $r['name'] ?></div>
            <div class="date"><?= $r['from'] ?> - <?= $r['to'] ?></div>
            <div class="point">
                Оценка <a href="javascript:void(0)"><img src="/media/images/hotel-rating.png" alt="" /><?= $r['total'] ?></a>
            </div>
        </div>
        <div class="text">
            <?= $r['review'] ?>
        </div>
    </div>
<? } ?>
                    