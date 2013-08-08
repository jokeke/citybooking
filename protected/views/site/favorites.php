<div class="page-content">
    <div class="news-view centrified">
        <h3>Избранные Отели:</h3>
        <? if (isset(Yii::app()->session['hotelFavoriteId'])): ?>
        <? foreach(Yii::app()->session['hotelFavoriteId'] as $key => $hotel) { ?>
            <div>Отель с id <?= $hotel ?> // <a key="<?= $key ?>" class="delete-hotel-favorite" href="#" >Удалить</a></div> </br>
        <?}?>
        <? else: ?>
        Добавьте отели в избранное
        <? endif ?>
    </div>
</div>
