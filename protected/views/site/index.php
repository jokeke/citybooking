<?//print_r($news);
//die();?>
<div class="homepage-top-block">
    <div class="centrified">
        <div class="search-wrap">
            <div class="tabs-wrap">
                <ul class="tabs-navi">
                    <li class="active"><a href="javascript:void(0)" onclick="openTab(0, this)">Поиск отеля в Санкт-Петербурге</a></li>
                    <li><a href="javascript:void(0)" onclick="openTab(1, this)">Отели мира</a></li>
                    <li><a href="javascript:void(0)" onclick="openTab(2, this)">Авиабилеты</a></li>
                </ul>
                <div class="tabs-content">
                    <div id="tab-0" class="tab active">
                        <form action="<?= Yii::app()->createUrl('hotels/search') ?>" method="GET" class="search-form">
                            <input type="hidden" name="per_page" value="2" id="search-form-per-page" />
                            <div class="hotel-name">
                                <label for="search-form-hotel-name">Название отеля:</label>
                                <input type="text" name="title" value="" id="search-form-hotel-name" />
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
                                    <select id="search-form-persons-from" name="persons_cnt">
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
                                    <select id="search-form-persons-to" name="children_cnt">
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
                            <button type="submit">Найти отель</button>
                        </form>
                    </div>
                    <div id="tab-1" class="tab">
                        Неотрисованная вкладка
                    </div>
                    <div id="tab-2" class="tab">
                        Еще одна неотрисованная вкладка
                    </div>
                </div>
            </div>
        </div>
        <div class="best-hotels" id="best-hotels">
            <h3>Отель недели</h3>
            <div class="items">
                <div class="item active">
                    <img src="/media/images/deletable/img-01.jpg" alt="" />
                    <div class="info">
                        <div class="title">Кроун Плаза Отель</div>
                        <div class="stars">
                            <span>5</span>
                            <span class="stars-img count-5"></span>
                        </div>
                        <div class="address">
                            Лиговский пр., дом 61<br />
                            Ст. м. Площадь Восстания (350 м.)
                        </div>
                    </div>
                    <div class="price-wrap">
                        Цены от:
                        <div class="price">
                            4 000 <span class="currency">руб.</span>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/media/images/deletable/img-01.jpg" alt="" />
                    <div class="info">
                        <div class="title">Red Hot Chilli</div>
                        <div class="stars">
                            <span>3</span>
                            <span class="stars-img count-3"></span>
                        </div>
                        <div class="address">
                            Ангельский пр., дом 121<br />
                            Ст. м. Площадь Предания (200 м.)
                        </div>
                    </div>
                    <div class="price-wrap">
                        Цены от:
                        <div class="price">
                            24 000 <span class="currency">руб.</span>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/media/images/deletable/img-01.jpg" alt="" />
                    <div class="info">
                        <div class="title">Peperzzz Hotel</div>
                        <div class="stars">
                            <span>4</span>
                            <span class="stars-img count-4"></span>
                        </div>
                        <div class="address">
                            Ангельский пр., дом 121<br />
                            Ст. м. Площадь Предания (200 м.)
                        </div>
                    </div>
                    <div class="price-wrap">
                        Цены от:
                        <div class="price">
                            2 000 <span class="currency">руб.</span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" class="book-it">Бронировать</a>
            <a href="javascript:void(0)" onclick="bestHotelsPrev()" title="Предыдущий" class="prev"></a>
            <a href="javascript:void(0)" onclick="bestHotelsNext()" title="Следующий" class="next"></a>
        </div>
    </div>
</div>
<div class="page-content homepage">
    <div class="google-map" id="google-map">
        <div class="centrified">
            <h2>Отели Санкт-Петербурга на карте</h2>
        </div>
        <div class="map-wrapper">  	
            <div class="inner">
		        <script>
		            $(document).ready(function () {
		                function toggleGroup() {
		                    var marker = EGMapMarker2;
		                    if (marker.isHidden()) {
		                        marker.show();
		                    } else {
		                        marker.hide();
		                    }
		                }
		            });
		        </script>        
				<?php
				Yii::import('ext.EGMap.*');
				
				$gMap = new EGMap();
				$gMap->setWidth(1300);
				$gMap->setHeight(507);
				$gMap->zoom = 10;
				$mapTypeControlOptions = array(
				    'position' => EGMapControlPosition::RIGHT_TOP,
				    'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
				);
				
				$gMap->mapTypeId = EGMap::TYPE_ROADMAP;
				$gMap->mapTypeControlOptions = $mapTypeControlOptions;
				
				$mapTypeControlOptions = array(
				    'position'=> EGMapControlPosition::LEFT_BOTTOM,
				    'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
				);
				
				$gMap->mapTypeControlOptions= $mapTypeControlOptions;
				
				$gMap->setCenter(59.939536, 30.312174);
				/*
				59.941815, 30.283972
				59.946028, 30.363022
				59.926291, 30.339333
				 */
				
				
				// Create GMapInfoWindows
				$info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
				$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');
				
				$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/home.png");
				
				$icon->setSize(32, 37);
				$icon->setAnchor(16, 16.5);
				$icon->setOrigin(0, 0);
				
				
				// Create markers
				foreach ($markers as $m)
				{
				    if ($m['stars'] == 5)
				    {
				        $marker = new EGMapMarker($m['lng'], $m['lat'], array('title' => 'Marker With Custom Image','icon'=>$icon, 'zIndex'=>5));
				    }
				    elseif ($m['stars'] == 4)
				    {
				        $marker = new EGMapMarker($m['lng'], $m['lat'], array('title' => 'Marker With Custom Image','icon'=>$icon, 'zIndex'=>4));
				    }
				    elseif ($m['stars'] == 3)
				    {
				        $marker = new EGMapMarker($m['lng'], $m['lat'], array('title' => 'Marker With Custom Image','icon'=>$icon, 'zIndex'=>3));
				    }
				    $info_window_a = new EGMapInfoWindow('<div>Отель '.$m['name'].'</div>');
				    $marker->addHtmlInfoWindow($info_window_a);
				    $gMap->addMarker($marker);
				}
				
				
				// enabling marker clusterer just for fun
				// to view it zoom-out the map
				//$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
				?>		              	
                <?php $gMap->renderMap(); ?>                
                <img src="/media/images/googlemap-left-fade.png" class="left-fade" alt="" />
                <img src="/media/images/googlemap-right-fade.png" class="right-fade" alt="" />
            </div>
        </div>
        <div class="centrified">
            <ul class="controls">
                <li><a href="javascript:void(0)" onclick="showOverlays();">Все отели</a></li>
                <li><a href="javascript:void(0)" onclick="showOverlays(markers5);">Отели Петербурга <span class="stars stars-5">5<span></span></span></a></li>
                <li><a href="javascript:void(0)" onclick="showOverlays(markers4);">Отели Петербурга <span class="stars stars-4">4<span></span></span></a></li>
                <li><a href="javascript:void(0)" onclick="showOverlays(markers3)">Отели Петербурга <span class="stars stars-3">3<span></span></span></a></li>
                <li><a href="javascript:void(0)">Отели рядом<br />с ЛенЭкспо</a></li>
                <li><a href="javascript:void(0)">Отели рядом<br />c СКК</a></li>
                <li><a href="javascript:void(0)">Отели в центре Петербурга</a></li>
            </ul>
        </div>
    </div>
    <div class="centrified">
        <div class="news">
            <h2>Новости</h2>
            <div class="archive">
                <a href="javascript:void(0)">Архив новостей</a>
            </div>
            <div class="items">
                <? foreach ($news as $n) {?>
                <? if (empty($n['image'])) : ?>
                <div class="item">
                <?else:?>
                <div class="item with-img">
                    <div class="img-col">
                        <img src="<?= $n['image'] ?>" alt="" />
                    </div>
                <?endif?>
                    <div class="content-col">
                        <div class="title-wrap">
                            <h3><a href="<?=Yii::app()->createUrl('pages/news/'.$n['url'])?>"><?= $n['name'] ?></a></h3>
                            <div class="date"><?= $n['news_date'] ?></div>
                        </div>
                        <div class="text">
                            <?= $n['description_short'] ?>
                        </div>
                        <div class="read-more">
                            <a href="<?=Yii::app()->createUrl('pages/news/'.$n['url'])?>">Читать полностью</a>
                        </div>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
    <div class="site-description">
        <div class="centrified">
            <h2>Отели Санкт-Петербурга — удобное бронирование</h2>
            Миллионы Гостей из разных уголков мира приезжают в Петербург каждый год - посетить Эрмитаж и Петропавловскую крепость, увидеть золото парков в Царском селе и фонтаны в Петродворце, балет в Мариинском театре или покормить уток на Фонтанке у Летнего сада. Прекрасные воспоминаия о городе останутся на всю жизнь...
            <br />Если, конечно, после прогулки Вы придете в хороший спокойный отель, с достойным сервисом и обслуживанием. Мы обошли и проверили  множество гостиниц  и выбрали для Вас лучшие отели Санкт-Петербурга - крупные гостиницы международных сетей и малые отели до 50 номеров. Наша екомпания - представитель этих отелей, поэтому цены никогда не выше, чем в самом отеле, наоборот - за счет комиссии мы часто можем предоставлять значительные скидки. Воспользуйтесь поиском на нашем сайте или позвоните по телефону  и профессиональный менеджер бесплатно подберет подходящий именно Вам отель в Санкт-Петербурге.
        </div>
    </div>
    <div class="bottom-block">
        <div class="centrified">
            <div class="hotels-by-stars">
                <h2>Отели Санкт-Петербурга на ваш выбор</h2>
                <div class="items">
                    <div class="item">
                        <div class="title">Петербургские отели 3***</div>
                        <div class="description">
                            Мы проверили лично и  выбрали для Вас самые
                            достойные небольшие гостиницы с домашним
                            уютом и внимательным, отзывчивым персоналом
                            и крупные отели Санкт-Петербурга в разных
                            районах города. Лучшие цены по телефону
                            (812)764-89-47
                        </div>
                        <a href="<?=Yii::app()->createUrl('hotels/search', array('stars[]'=>3))?>" class="submit-link">Подобрать отель 3*</a>
                    </div>
                    <div class="item">
                        <div class="title">Отели 4**** в Санкт-Петербурге</div>
                        <div class="description">
                            Мы проверили лично и  выбрали для Вас самые
                            достойные небольшие гостиницы с домашним
                            уютом и внимательным, отзывчивым персоналом
                            и крупные отели Санкт-Петербурга в разных
                            районах города. Лучшие цены по телефону
                            (812)764-89-47
                        </div>
                        <a href="<?=Yii::app()->createUrl('hotels/search', array('stars[]'=>4))?>" class="submit-link">Подобрать отель 4*</a>
                    </div>
                    <div class="item">
                        <div class="title">Отели Санкт-Петербурга 5*****</div>
                        <div class="description">
                            Мы проверили лично и  выбрали для Вас самые
                            достойные небольшие гостиницы с домашним
                            уютом и внимательным, отзывчивым персоналом
                            и крупные отели Санкт-Петербурга в разных
                            районах города. Лучшие цены по телефону
                            (812)764-89-47
                        </div>
                        <a href="<?=Yii::app()->createUrl('hotels/search', array('stars[]'=>5))?>" class="submit-link">Подобрать отель 5*</a>
                    </div>
                </div>
            </div>
            <div class="hotels-by-location">
                <h2>Отели для участников и гостей выставок в Санкт-Петербурге</h2>
                <div class="map-img">
                    <a href="javascript:void(0)" class="first">Отели в центре<br />Петербурга</a>
                    <a href="javascript:void(0)" class="second">Гостиницы<br />рядом с СКК</a>
                    <a href="javascript:void(0)" class="third">Гостиницы<br />рядом с ЛенЭкспо</a>
                </div>
                <div class="items">
                    <div class="item">
                        Знаменитые символы Санкт-Петербурга - Эрмитаж и
                        Дворцовая площадь, Казанский собор и Спас-на-Крови
                        расположены в самом сердце города. Поэтому
                        приезжающие Гости в первую очередь выбирают
                        отели Санкт-Петербурга ближе к Невскому проспекту
                        и главым достопримечательностям.
                        <div class="read-more">
                            <a href="javascript:void(0)">Читать полностью</a>
                        </div>
                    </div>
                    <div class="item">
                        Построенный к Олимпиаде Спортивно-Концертный
                        Комплекс Санкт-Петебурга проводит выставки и форумы,
                        концерты и спортивные мероприятия. СКК располагается
                        в Московском районе и выбор гостиниц рядом
                        с комплексом невелик - бронировать номера лучше
                        заранее.
                        <div class="read-more">
                            <a href="javascript:void(0)">Читать полностью</a>
                        </div>
                    </div>
                    <div class="item">
                        Крупнейший на Северо-Западе выставочный центр
                        ЛенЭкспо приглашает Гостей посетить выставки
                        и конференции, ярмарки и крупные экономиче-
                        ские форумы на Васильевском острове. Для
                        участников и организаторов выставок всегда
                        открыты двери отелей в Санкт-Петербурге рядом
                        с ЛенЭкспо.
                        <div class="read-more">
                            <a href="javascript:void(0)">Читать полностью</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>