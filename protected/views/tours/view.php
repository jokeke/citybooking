<?//print_r($tour);?>
<?//die();?>
<div class="page-content" xmlns="http://www.w3.org/1999/html">
    <div class="news-view centrified">
        Название экскурсии: <?= $tour['name'] ?> // метро: <?= $tour['metro_name1'] . ',' . $tour['metro_name2'] . ',' . $tour['metro_name3'] ?> </br>
        Изображение экскурсии: <img src="<?= $tour['thumb_images'][0] ?>"> </br>
        Адрес отеля: <?= $tour['address'] ?> </br>
        Время отправления: <?= $tour['starttime'] ?> </br>
        Описание: <?= $tour['description'] ?> </br>
        Описание: <?= $tour['visiting_time'] ?> </br>
    </div>
</div>

