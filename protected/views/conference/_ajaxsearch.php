<? foreach($conference as $con) {?>
    <div class="conference-item">
        Название отеля: <?= $con['name'] ?> // Звезды отеля: <?= $con['stars'] ?> // Название отеля: <?= $con['name'] ?> // метро: <?= $con['metro_name'] ?> </br>
        Адрес отеля: <?= $con['address'] ?> //  Описание отеля: <?= $con['description_short'] ?> </br>
        Количество залов: <?= $con['conferenceCount'] ?> (площадь от <?= $con['minArea'] ?> до <?= $con['maxArea'] ?>) </br>
        Вместимость залов: от <?= $con['minHumans'] ?> до <?= $con['maxHumans'] ?> </br>
        Количество комнат: <?= $con['roomsCount'] ?> </br>
        Залы от: <?= $con['minPrice'] ?> </br>
    </div>
    </br>
<?}?>