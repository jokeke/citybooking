<?//print_r($news);?>
<?//die();?>
<ul class="breadcrumbs centrified">
    <li><a href="#">Главная</a></li>
    <li><a href="#">Отели Санкт-Петербурга</a></li>
</ul>
<div class="page-content">
<div class="news-view centrified">
    Заголовок новости: <?= $news['name'] ?></br>
    Текст новости: <?= $news['description'] ?></br>
    Изображение: <img src="<?= $news['image'] ?>"></br>
</div>
</div>