<? foreach ($hotels as $h) {?>
    <div class="item best">
        <div class="left img">
            <a href="<?=Yii::app()->createUrl('/hotels/view', array('url'=>$h['url']))?>">
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