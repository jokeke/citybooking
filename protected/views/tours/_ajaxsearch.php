<? foreach ($tours as $t) { ?>
    <div class="conference-item">
        Название экскурсии: <?= $t['name'] ?> // Продолжительность: <?= $t['duration'] ?> </br>
        Изображение экскурсии: <img src="<?= $t['thumb_images'][0] ?>"> </br>
        <? if ($t['type'] == 1) echo 'Индивидуальная экскурсия. До: ' . $t['to'] ?> </br>
        Взрослый: <?= $t['men'] ?> // Детский: <?= $t['kid'] ?> // Студенческий: <?= $t['stud'] ?> // Пенсионный: <?= $t['old'] ?> // Иностранец: <?= $t['foreigner'] ?> </br>
        Питание: <?= $t['food'] ?> </br>
        <a href="<?= Yii::app()->createUrl('tours/view/', array('url' => $t['url'])) ?>">Подробнее</a>
    </div>
    </br>
<?}?>