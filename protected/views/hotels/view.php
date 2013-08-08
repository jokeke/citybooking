<?//print_r($hotel)?>
<?print_r($rooms)?>
<?//die()?>
<ul class="breadcrumbs centrified">
    <li><a href="<?=Yii::app()->createUrl('site/index')?>">Главная</a></li>
    <li><a href="<?=Yii::app()->createUrl('hotels/search')?>">Отели Санкт-Петербурга</a></li>
    <li><?= $hotel['name'] ?></li>
</ul>
<div class="page-content">
<div class="hotel-item centrified">
<div class="info-wrap">
    <div class="gallery" id="hotel-gallery">
        <div class="current-img">
            <img src="<? echo $hotel['images'][0] ?>" alt="" />
            <a href="javascript:void(0)" class="prev"></a>
            <a href="javascript:void(0)" class="next"></a>
        </div>
        <div class="thumbs-wrap">
            <div class="prev-wrap">
                <a href="javascript:void(0)"></a>
            </div>
            <div class="items">
                <? foreach ($hotel['images'] as $img ) {?>
                    <a href="javascript:void(0)" data-src="<?= $img ?>" class="item"><img src="<?= $img ?>" alt="" /></a>
                <?}?>
            </div>
            <div class="next-wrap">
                <a href="javascript:void(0)"></a>
            </div>
        </div>
    </div>
    <div class="info">
        <h1><?= $hotel['name'] ?></h1>
        <div class="stars">
            <?= $hotel['stars'] ?>
            <span class="stars-<?= $hotel['stars'] ?>"></span>
        </div>
        <div class="rating">
            <a href="#"><img src="/media/images/rating-icon.png" alt="" /></a>
            5,0
        </div>
        <div class="price">
            от <span><?= $hotel['min_price'] ?></span> руб
        </div>
        <div class="rooms-quantity">
            Количество номеров: <?= count($rooms) ?>
        </div>
        <div class="address">
            <?= $hotel['address'] ?>
        </div>
        <div class="metro">
            <? if ($hotel['metro1'] > 0): ?><div class="item"><?= $hotel['metro_name1'] ?> <span><?= $hotel['metro_dis1'] ?> м</span></div><? endif ?>
            <? if ($hotel['metro2'] > 0): ?><div class="item"><?= $hotel['metro_name2'] ?> <span><?= $hotel['metro_dis2'] ?> м</span></div><? endif ?>
            <? if ($hotel['metro3'] > 0): ?><div class="item"><?= $hotel['metro_name3'] ?> <span><?= $hotel['metro_dis3'] ?> м</span></div><? endif ?>
        </div>
        <a href="javascript:void(0)" class="show-on-map-link" id="show-on-map-link">Просмотреть на карте</a>
        <a href="javascript:void(0)" class="add-to-favourites" id="add-to-favourites">В избранное</a>
        <div class="share-panel">
            <img src="/media/images/deletable/share.png" alt="" />
        </div>
        <a href="<?= Yii::app()->createUrl('conference/view', array('url'=>$hotel['url'])) ?>" class="conference-by-hotel-link">Конференцзалы отеля</a>
    </div>
</div>
<div class="tabs-wrap">
    <ul class="tabs-navi">
        <li class="active"><a href="javascript:void(0)" onclick="openTab(0, this)">Описание мини-отеля Парк Лейн Ин</a></li>
        <li><a href="javascript:void(0)" onclick="openTab(1, this)">Услуги мини-отеля Парк Лейн Ин</a></li>
        <li><a href="javascript:void(0)" onclick="openTab(2, this)">Отзывы об отеле</a></li>
    </ul>
    <div class="tabs-content">
        <div id="tab-0" class="tab active description">
            <p>
                <?= $hotel['description'] ?>
            </p>
        </div>
        <div id="tab-1" class="tab services">
            <div class="title">Мини-отель Парк Лейн Ин предоставляет следующие услуги:</div>
            <ul>
                <? foreach ($services as $s) {?>
                    <li>- <?= $s['description'] ?></li>
                <?}?>
            </ul>
        </div>
        <div id="tab-2" class="tab reviews">
            <div class="title">Написать отзыв</div>
            <form action="" method="post" class="add-review-form" id="add-review-form">
                <div class="left">
                    <div class="item">
                        <label for="review-name">Имя<span>*</span>:</label>
                        <input type="text" name="name" value="" id="review-name" />
                    </div>
                    <div class="item dates">
                        <div class="line-title">Период проживания<span>*</span>:</div>
                        <div class="left">
                            <label for="review-date-from">c</label>
                            <input type="text" name="date_from" value="" id="review-date-from" />
                        </div>
                        <div class="right">
                            <label for="review-date-to">по</label>
                            <input type="text" name="date_to" value="" id="review-date-to" />
                        </div>
                    </div>
                    <div class="item">
                        <label for="review-email">E-mail<span>*</span>:</label>
                        <input type="text" name="email" value="" id="review-email" />
                    </div>
                    <div class="item">
                        <label for="review-number">Номер брони<span>*</span>:</label>
                        <input type="text" name="number" value="" id="review-number" />
                    </div>
                    <!-- Инпуты для отзывов -->
                    <div class="item">
                        <label for="review-number">Сервис<span>*</span>:</label>
                        <input type="text" name="service" value="" id="review-service" />
                    </div>
                    <div class="item">
                        <label for="review-number">чистота<span>*</span>:</label>
                        <input type="text" name="clear" value="" id="review-clear" />
                    </div>
                    <div class="item">
                        <label for="review-number">цена-качество<span>*</span>:</label>
                        <input type="text" name="price-quality" value="" id="review-price-quality" />
                    </div>
                    <div class="item">
                        <label for="review-number">расположение<span>*</span>:</label>
                        <input type="text" name="location" value="" id="review-location" />
                    </div>
                    <div class="item">
                        <label for="review-number">качество завтрака<span>*</span>:</label>
                        <input type="text" name="breakfast" value="" id="review-breakfast" />
                    </div>
                    <div class="item">
                        <input style="display: none" type="text" name="breakfast" value="<?= $hotel['id'] ?>" id="review-hotelid" />
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var service = $('#review-service').val();
                        var clear = $('#review-clear').val();
                        var pq = $('#review-price-quality').val();
                        var location = $('#review-location').val();
                        var breakfast = $('#review-breakfast').val();
                        var total = (service + clear + location + pq + breakfast)/5;
                        $('#total').text(total);
                    });
                </script>
                <div class="right">
                    <div class="points-wrap">
                    </div>
                    <div class="points-sum">
                        Общая<br />оценка
                        <div id="total" class="number">5</div>
                    </div>
                </div>
                <textarea id="review-text" class="text-comment" name="comment"></textarea>
                <button id="review-form-submit" >Отправить</button>
            </form>
            <div class="reviews-items">
                <div class="title">Последние отзывы</div>
                <div class="pagination">
                    <a href="#" class="prev"></a>
                    <a href="#">1</a>
                    <a href="#" class="active">2</a>
                    <a href="#">3</a>
                    <a href="#" class="next"></a>
                </div>
                <div class="items-wrap">
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
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <h2>Номера и цены <?= $hotel['name'] ?></h2>
    <? foreach($rooms as $r) { ?>
        <div class="item">
            <?= $r['category'] ?>
            <div class="item-date">
                <button roomId="<?= $r['id'] ?>" tag="prev" class="prev-date">Назад</button>
                <span class="item-date" ><?= $date_checkin ?></span>
                <button roomId="<?= $r['id'] ?>" tag="next" class="next-date">Вперед</button>
            </div>
            <div class="item-price">
                <table>
                    <tr>
                        <td>По предоплате</td>
                        <td>Оплата в отеле</td>
                    </tr>
                    <tr>
                        <td>Один человек:<?= $r['price'] ?></td>
                        <td>Один человек: <?= $r['price']*1.6 ?></td>
                    </tr>
                    <tr>
                        <td>Два человека:<?= $r['price']*1.6 ?></td>
                        <td>Два человека: <?= $r['price']*2 ?></td>
                    </tr>
                </table>
                <a roomId="<?= $r['id'] ?>" class="add-hotel-booking" href="#">Бронировать</a>
            </div>
        </div>
    <? } ?>
    <div>
        <h2>Бронирование номера в отеле <?= $hotel['name'] ?></h2>
        <form id="booking-form-hotel" method="POST">
            <input hidden name="hotel_id" type="text" value="<?= $hotel['id'] ?>">
            <div class="booking-wrap">

            </div>
            <div class="booking-details">
                Доп пожелания:
                <input name="special_wishes" type="text"></br>
                Фамилия гостя:
                <input name="booking_surname" type="text"></br>
                Имя гостя:
                <input name="booking_firstname" type="text"></br>
                Контактное лицо:
                <input name="booking_contact_name" type="text"></br>
                Телефон:
                <input name="booking_phone" type="text"></br>
                Электронная почта:
                <input name="booking_email" type="text"></br>
                Доп услуги:</br>
                <input class="booking-services" type="checkbox" name="booking_services[]" price="1000" value="Встреча на вокзале - 1000 руб">Встреча на вокзале - 1000 руб<br>
                <input class="booking-services" type="checkbox" name="booking_services[]" price="1500" value="Встреча в аэропорту - 1500 руб">Встреча в аэропорту - 1500 руб<br>
                <input class="booking-services" type="checkbox" name="booking_services[]" price="450" value="Визовая поддержка - 450 руб">Визовая поддержка - 450 руб<br>
                <input class="booking-services" type="checkbox" name="booking_services[]" price="0" value="Экскурсии">Экскурсии<br>
            </div>
            <div class="total-price">Итоговая сумма бронирования: <span id="total-price" >0</span> руб</div>
            <input hidden class="total-price" name="total_price" type="text">
                <a id="submit-booking-form-hotel" href="#" type="submit">Бронировать</a>
        </form>
    </div>
</div>
<div class="rooms-wrap">
    <h2>Номера и цены Парк Лейн Ин</h2>
    <form>
        <div class="item date-checkin">
            <label for="room-form-checkin">Дата заезда:</label>
            <input type="text" class="datepicker" name="date_checkin" id="date-checkin" />
        </div>
        <div class="item date-checkout">
            <label for="room-form-checkout">Дата заезда:</label>
            <input type="text" class="datepicker" name="date_checkout" id="date-checkout" />
        </div>
        <div class="item parents" id="hotel-form-parents">
            <input type="hidden" name="persons" value="12" />
            <a href="javascript:void(0)" class="decrease">
                <img src="/media/images/decrease.png" alt="" />
            </a>
            <img src="/media/images/icon-parents.png" alt="" />
            <a href="javascript:void(0)" class="increase">
                <img src="/media/images/increase.png" alt="" />
            </a>
            <div class="result">12 взрослых</div>
        </div>
        <div class="children" id="search-form-children">
            <input type="hidden" name="children" value="14" />
            <a href="javascript:void(0)" class="decrease">
                <img src="/media/images/decrease.png" alt="" />
            </a>
            <img src="/media/images/icon-parents.png" alt="" />
            <a href="javascript:void(0)" class="increase">
                <img src="/media/images/increase.png" alt="" />
            </a>
            <div class="result">14 детей</div>
        </div>
    </form>
    <div class="rooms-items">
        <div class="item">
            <h3>Шестиместный</h3>
            <div class="rooms-quantity">(1 номер)</div>
            <div class="left img">
                <a href="javascript:void(0)"><img src="/media/images/deletable/blablabla.png" alt="" /></a>
                <a href="javascript:void(0)" class="show-all-info-button" onclick="function showRoomInfo(this)">Подробнее</a>
                <div class="room-gallery hidden">
                    <a href="javascript:void(0)"><img src="/media/images/blablabla.png" alt="" /></a>
                    <a href="javascript:void(0)"><img src="/media/images/blablabla.png" alt="" /></a>
                    <a href="javascript:void(0)"><img src="/media/images/blablabla.png" alt="" /></a>
                    <a href="javascript:void(0)"><img src="/media/images/blablabla.png" alt="" /></a>
                </div>
            </div>
            <div class="center dates">
                <div class="controls">
                    <a href="javascript:void(0)" class="prev"></a>
                    <span>22.03.2012</span>
                    <a href="javascript:void(0)" class="next"></a>
                </div>
                <div class="prices-wrap">
                    <div class="item">
                        <div class="left">
                            <div class="title">По предоплате</div>
                            <div class="line">
                                <img src="/media/images/room-guest-01.png" alt="" />
                                <span class="price"><span>1600</span> руб</span>
                            </div>
                            <div class="line">
                                <img src="/media/images/room-guest-02.png" alt="" />
                                <span class="price"><span>1600</span> руб</span>
                            </div>
                            <div class="line">
                                <img src="/media/images/room-guest-03.png" alt="" />
                                <span class="price"><span class="no-price-available">Свяжитесь с нами для уточнения цены</span></span>
                            </div>
                            <div class="note">
                                Включая завтрак в кафе отеля
                            </div>
                        </div>
                        <div class="right">
                            <div class="title">Оплата в отеле</div>
                            <div class="line">
                                <img src="/media/images/room-guest-01.png" alt="" />
                                <span class="price"><span>2690</span> руб</span>
                            </div>
                            <div class="line">
                                <img src="/media/images/room-guest-02.png" alt="" />
                                <span class="price"><span>2900</span> руб</span>
                            </div>
                            <div class="line">
                                <img src="/media/images/room-guest-03.png" alt="" />
                                <span class="price"><span class="no-price-available">Свяжитесь с нами для уточнения цены</span></span>
                            </div>
                            <div class="note">
                                Включая завтрак в кафе отеля
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="title">Итого за 3 суток</div>
                <div class="paytime">
                    <div class="item">
                        <input type="radio" name="paytime" class="paytime-input" value="prepayment" />
                        <label>По предоплате: </label>
											<span class="pyatime-price">
												<span>12500</span> руб
											</span>
                    </div>
                    <div class="item">
                        <input type="radio" name="paytime" class="paytime-input" value="payinhotel" />
                        <label>Оплата в отеле: </label>
                    </div>
                    <a href="javascript:void(0)" class="room-book-button">Бронировать</a>
                </div>
            </div>
            <div class="description">
                <p>
                    Площадь номера 12 кв.м. В номере зеркальный шкаф, стол, складные стулья, телевизор, две односпальные кровати с ортопедическими матрасами, прикроватные тумбочки. Один номер с одной большой кроватью. Постельное белье, полотенце, набор ванной парфюмерии входят в стоимость проживания.
                </p>
            </div>
        </div>
    </div>
</div>
</div>
</div>