<?//print_r($conference)?>
<?//die();?>
<div class="page-content" xmlns="http://www.w3.org/1999/html">
    <div class="news-view centrified">
        Название отеля: <?= $hotel['name'] ?> // Звезды отеля: <?= $hotel['stars'] ?> // метро: <?= $hotel['metro_name1'] . ',' . $hotel['metro_name2'] . ',' . $hotel['metro_name3'] ?> </br>
        Изображение отеля: <img src="<?= $hotel['thumb_images'][0] ?>"> </br>
        Адрес отеля: <?= $hotel['address'] ?> </br>
        Количество залов: <?= count($conference) ?> </br>
        <a href="<?= Yii::app()->createUrl('hotels/view/', array('url' => $hotel['url'])) ?>">Подробнее об отеле</a> </br></br>

        <? foreach($conference as $con) {?>
            <div class="conference-item">
                Название конференц-зала: <?= $con['name'] ?> // Изображение конференц-зала: <img src="<?= $con['thumb_images'][0] ?>"> </br>
                Адрес отеля: <?= $con['address'] ?> //  Описание конференц-зала:: <?= $con['description'] ?> </br>
                Площадь <?= $con['area'] ?> м^2 </br>
                Цены конференц-залов: </br>
                <? foreach ($con['prices'] as $p) { ?>
                    ЦенаЖ <?= $p['price'] ?> // часы: <?= $p['hours'] ?> </br>
                <? } ?>
                Типы конференц-залов: </br>
                <? foreach ($con['types'] as $t) { ?>
                    Название типа: <?= $t['name'] ?> // часы: <?= $t['humans'] ?> </br>
                <? } ?>
                Вместимость залов: от <?= $con['minHumans'] ?> до <?= $con['maxHumans'] ?> </br>
                Количество комнат: <?= $con['roomsCount'] ?> </br>
                Залы от: <?= $con['minPrice'] ?> </br>
            </div>
            </br>
        <?}?>


    </div>
</div>