<?//print_r($conference);?>
<?//die();?>
<div class="page-content" xmlns="http://www.w3.org/1999/html">
    <div class="news-view centrified">
<form action="<?=Yii::app()->createUrl('conference/search')?>" method="GET" class="search-form">
    <div class="hotel-name">
        <label for="search-form-hotel-name">Название отеля:</label>
        <select style="width: 390px" name="title" id="search-form-hotel-id">
            <option value="0">--Выберите--</option>
            <? foreach($hotels as $h) {?>
            <option value="<?= $h['id']?>"><?= $h['name'] ?></option>
            <?}?>
        <input type="text" name="title" value="" id="search-form-hotel-name" style="display: none" />
        <ul class="stars-checkboxes">
            <li><input type="checkbox" name="stars[]" value="3" id="stars-3" /><label for="stars-3" class="stars stars-3">3</label></li>
            <li><input type="checkbox" name="stars[]" value="4" id="stars-4" /><label for="stars-4" class="stars stars-4">4</label></li>
            <li><input type="checkbox" name="stars[]" value="5" id="stars-5" /><label for="stars-5" class="stars stars-5">5</label></li>
            <li><input type="checkbox" name="stars[]" value="" id="stars-void" /><label for="stars-void" class="stars-void">Все равно</label></li>
        </ul>
    </div>
    <div class="hotel-persons">
        <div>Количество человек:</div>
        <div class="left">
            <select id="search-form-persons-from" name="persons_from">
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <label for="search-form-persons-from">
                Взрослых
            </label>
        </div>
        <div class="center">
            <select id="search-form-persons-to" name="persons_to">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <label for="search-form-persons-to">
                Детей<br />(до 14 лет)
            </label>
        </div>
        <div class="right">
            <label>Возраст детей</label>
            <div class="children-age-wrap" id="children-age-wrap">
                <input type="text" name="children[]" value="" maxlength="2" class="number-only" />
                <input type="text" name="children[]" value="" maxlength="2" class="number-only" />
                <input type="text" name="children[]" value="" maxlength="2" class="number-only" />
                <input type="text" name="children[]" value="" maxlength="2" class="number-only" />
                <input type="text" name="children[]" value="" maxlength="2" class="number-only" />
                <a href="javascript:void(0)" id="search-form-show-all-children-inputs">>></a>
            </div>
        </div>
    </div>
    <div class="dates">
        <div class="left">
            <label for="search-form-date-checkin">Дата заезда:</label>
            <input type="text" class="datepicker" id="search-form-date-checkin" name="date_checkin" value="<?=date('d.m.Y')?>" />
        </div>
        <div class="center">
            <label for="search-form-date-checkout">Дата выезда:</label>
            <input type="text" id="search-form-date-checkout" class="datepicker" name="date_checkout" value="<?=date('d.m.Y',time()+24*60*60)?>" />
        </div>
        <div class="right sum" id="search-form-sum-days">
            <span class="number">365</span>
            <span class="word">дней</span>
        </div>
    </div>
    <div class="price">
        <label>Цена за сутки, руб:</label>
        <input type="text" name="price_from" value="" class="number-only" maxlength="7" /> — <input type="text" class="number-only" name="price_to" value="" maxlength="7" />
    </div>
    <button id="ajaxSubmitFormConference" type="submit">Найти отель</button>
</form>
<div style="margin-top: 200px "></div>
<div class="conference-content">
    <? foreach($conference as $con) {?>
    <div class="conference-item">
        Название отеля: <?= $con['name'] ?> // Звезды отеля: <?= $con['stars'] ?> // Название отеля: <?= $con['name'] ?> // метро: <?= $con['metro_name'] ?> </br>
        Адрес отеля: <?= $con['address'] ?> //  Описание отеля: <?= $con['description_short'] ?> </br>
        Количество залов: <?= $con['conferenceCount'] ?> (площадь от <?= $con['minArea'] ?> до <?= $con['maxArea'] ?>) </br>
        Вместимость залов: от <?= $con['minHumans'] ?> до <?= $con['maxHumans'] ?> </br>
        Количество комнат: <?= $con['roomsCount'] ?> </br>
        Залы от: <?= $con['minPrice'] ?> </br>
        <a href="<?= Yii::app()->createUrl('conference/view/', array('url' => $con['url'])) ?>">Подробнее</a>
    </div>
        </br>
    <?}?>
</div>
    </div>
    </div>
