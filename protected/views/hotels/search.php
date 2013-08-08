<?//print_r($hotels);?>
<?//die();?>
<ul class="breadcrumbs centrified">
    <li><a href="#">Главная</a></li>
    <li><a href="#">Отели Санкт-Петербурга</a></li>
</ul>
<div class="page-content">
    <div class="hotels-list centrified">
        <div class="page-left-col">
            <div class="search-form-wrap">
                <h2>Поиск отеля в Санкт-Петербурге</h2>
                <form class="search-form">
                    <input type="hidden" name="search-form-max-rows" id="search-form-max-rows" value="<?= $max_rows ?>" />
                    <div class="item">
                        <label for="hotel-name"></label>
                        <input type="text" name="name" id="hotel-name" value="<?= $get['title'] ?>" />
                    </div>
                    <div class="item dates">
                        <div class="left">
                            <label for="search-form-date-checkin">Дата заезда:</label>
                            <input type="text" class="datepicker" id="search-form-date-checkin" name="date_checkin" value="<?= $get['date_checkin'] ?>" />
                        </div>
                        <div class="right">
                            <label for="search-form-date-checkout">Дата выезда:</label>
                            <input type="text" class="datepicker" id="search-form-date-checkout" name="date_checkout" value="<?= $get['date_checkout'] ?>" />
                        </div>
                    </div>
                    <div class="item prices">
                        <label>Цены, руб.:</label>
                        от: <input type="text" id="price_from" name="price_from" value="<?= $get['price_from'] ?>" />
                        до: <input type="text" id="price_to" name="price_to" value="<?= $get['price_to'] ?>" />
                    </div>
                    <div class="item stars">
                        <ul>
                            <li><input type="checkbox" name="stars[]" <? if (isset($get['stars']) and in_array(2,$get['stars'])): ?> checked <? endif ?> value="2" /><label>2<span class="stars stars-2"></span></label></li>
                            <li><input type="checkbox" name="stars[]" <? if (isset($get['stars']) and in_array(3,$get['stars'])): ?> checked <? endif ?> value="3" /><label>3<span class="stars stars-3"></span></label></li>
                            <li><input type="checkbox" name="stars[]" <? if (isset($get['stars']) and in_array(4,$get['stars'])): ?> checked <? endif ?> value="4" /><label>4<span class="stars stars-4"></span></label></li>
                            <li><input type="checkbox" name="stars[]" <? if (isset($get['stars']) and in_array(5,$get['stars'])): ?> checked <? endif ?> value="5" /><label>5<span class="stars stars-5"></span></label></li>
                        </ul>
                    </div>
                    <div class="item metro">
                        <label>Ближайшая станция метро:</label>
                        <select name="metro">
                            <? foreach ($metro as $m) { ?>
                                <option value="<?= $m['name'] ?>"><?= $m['name'] ?></option>
                            <?}?>
                        </select>
                    </div>
                    <div class="item object">
                        <label>Ближайший объект:</label>
                        <select name="object">
                            <option value="Спас-на-Крови">Спас-на-Крови</option>
                            <option value="Медный всадник">Медный всадник</option>
                        </select>
                    </div>
                    <div class="item district">
                        <label>Ближайший район:</label>
                        <select name="object">
                            <? foreach ($districts as $d) { ?>
                                <option value="<?= $d['name'] ?>"><?= $d['name'] ?></option>
                            <?}?>
                            <option value="Спас-на-Крови">Спас-на-Крови</option>
                            <option value="Медный всадник">Медный всадник</option>
                        </select>
                    </div>
                    <div class="item persons">
                        <div class="parents" id="search-form-parents">
                            <input type="hidden" name="persons_cnt" value="<?php echo isset($_GET['persons_cnt']) ? $_GET['persons_cnt'] : '0' ?>" />
                            <a href="javascript:void(0)" class="increase">
                                <img src="/media/images/increase.png" alt="" />
                            </a>
                            <img src="/media/images/icon-parent.png" alt="" class="icon" />
                            <a href="javascript:void(0)" class="decrease">
                                <img src="/media/images/decrease.png" alt="" />
                            </a>
                            <div class="result"></div>
                        </div>
                        <div class="children" id="search-form-children">
                            <input type="hidden" name="children_cnt" value="<?php echo isset($_GET['children_cnt']) ? $_GET['children_cnt'] : '0' ?>" />
                            <a href="javascript:void(0)" class="increase">
                                <img src="/media/images/increase.png" alt="" />
                            </a>
                            <img src="/media/images/icon-child.png" alt="" class="icon" />
                            <a href="javascript:void(0)" class="decrease">
                                <img src="/media/images/decrease.png" alt="" />
                            </a>
                            <div class="result"></div>
                            <a href="javascript:void(0)" class="children-age" id="children-age">возраст</a>
                        </div>
                    </div>
                    <button id="ajaxSubmitFormHotels">
                        Найти отель
                    </button>
                </form>
            </div>
        </div>
        <div class="page-right-col">
            <div class="top-filter">
                <div class="sort">
                    <div class="title">Сортировать по:</div>
                    <ul>
                        <li><a id="hotelsAjaxSortByPrice" href="#">Цене</a></li>
                        <li><a id="hotelsAjaxSortByStars" href="javascript:void(0)">Звездам</a></li>
                        <li><a id="hotelsAjaxSortByRating" href="#">Рейтингу</a></li>
                    </ul>
                </div>
                <div class="links">
                    <a href="#" class="favorites">Просмотреть избранное</a>
                </div>
                <div class="pagination">
                    <a href="#" <? if ($pages == 1): ?> style="display: none" <? endif ?> class="prev"></a>
                    <? for ($i=1; $i <= $pages; $i++) { ?>
                        <a href="#" <? if ($pages == 1): ?> style="display: none" <? endif ?> class="pagination-item <? if ($get['page'] == $i): ?> active <? endif ?>" ><?= $i ?></a>
                    <? } ?>
                    <a href="#" <? if ($pages == 1): ?> style="display: none" <? endif ?> class="next"></a>
                </div>
                <div class="show-per-page-button" id="show-per-page-button">
                    <a href="javascript:void(0)" limit="<?= $get['per_page'] ?>" class="page-limit-main active">Показывать по <?= $get['per_page'] ?> отелей</a>
                    <ul>
                        <li><a limit="1" class="page-limit" href="#">Показывать по 1 отелю</a></li>
                        <li><a limit="2" class="page-limit" href="#">Показывать по 2 отеля</a></li>
                        <li><a limit="3" class="page-limit" href="#">Показывать по 3 отеля</a></li>
                        <li><a limit="10" class="page-limit" href="#">Показывать по 10 отелей</a></li>
                        <li><a limit="20" class="page-limit" href="#">Показывать по 20 отелей</a></li>
                        <li><a limit="50" class="page-limit" href="#">Показывать по 50 отелей</a></li>
                        <li><a limit="1000" class="page-limit" href="#">Показывать все отели</a></li>
                    </ul>
                </div>
            </div>
            <div class="hotels-wrap">
                <? foreach ($hotels as $h) {?>
                    <div class="item best">
                        <div class="left img">
                            <a href="<?=Yii::app()->createUrl('/hotels/view', array('url'=>$h['url'], 'date_checkin'=>$get['date_checkin']))?>">
                                <? if(isset($h['thumb_images'][0])): ?>
                                    <img src="<?= $h['thumb_images'][0] ?>" alt="" />
                                <? else: ?>
                                    <?
                                    $imagesDir = 'images/tips/';
                                    $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                                    $randomImage = $images[array_rand($images)];
                                    ?>
                                    <img src="/<?=$randomImage?>" alt="" />
                                <? endif; ?>
                                <!--<img src="images/hotel-of-week.png" class="best-marker" alt="" />!-->
                            </a>
                        </div>
                        <div class="right">
                            <div class="title">
                                <h3><?= $h['name'] ?></h3>
										<span class="stars-wrap">
											<?= $h['stars'] ?>
                                            <span class="stars stars-<?= $h['stars'] ?>"></span>
										</span>
                            </div>
                            <? if($h['description_short'] || $h['description']): ?>
                                <div class="description">
                                    <? if($h['description_short']): ?>
                                        <?= $h['description_short'] ?>
                                    <? else: ?>
                                        <?= mb_substr($h['description'], 0, 150, 'UTF-8').'...' ?>
                                    <? endif; ?>
                                </div>
                            <? endif; ?>
                            <div class="floating-lb-block">
                                <div class="address">
                                    <?= $h['address'] ?>
                                </div>
                                <div class="metro">
                                    <?= $h['metro_name'] ?>
                                </div>
                                <a href="#" class="show-on-map">Просмотреть на карте</a>
                            </div>
                            <div class="price">
                                Номера от <span><?= $h['price'] ?></span> руб
                                <!--<div class="label">
                                    Скидка на номера ЛЮКС:
                                </div>
                                <div class="value">
                                    <span>6000 руб</span>
                                    4000 руб
                                </div>-->
                            </div>
                            <div class="floating-rb-block">
                                <div class="rating">
                                    <a href="#" class="rating-icon"><img src="/media/images/rating-icon.png" alt="" /></a>
                                    <span class="rating-number"><?= $h['rating'] ?></span>
                                </div>
                                <a href="#" class="reviews-link">Отзывы: <?= $h['reviews'] ?></a>
                                <a href="#" hotelId="<?= $h['id'] ?>" class="add-to-favorites"><img src="/media/images/control-panel-fav.png" alt="" />В избранное</a>
                                <a href="#" class="read-more">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>