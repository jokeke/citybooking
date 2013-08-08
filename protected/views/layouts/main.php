<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Citybooking</title>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="/media/js/lib/jquery-ui/ui-lightness/jquery-ui-1.10.3.custom.min.css" type="text/css" rel="stylesheet" />
    <link href="/media/css/public/template.css" type="text/css" rel="stylesheet" />

    <!-- JS -->
    <script src="/media/js/lib/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="/media/js/lib/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="/media/js/lib/jquery.customSelect.min.js" type="text/javascript"></script>
    <script src="/media/js/lib/modernizr.custom.95591.js" type="text/javascript"></script>

    <script src="/media/js/helper.js" type="text/javascript"></script>
    <script src="/media/js/best-hotels-slider.js" type="text/javascript"></script>
    <script src="/media/js/template.js" type="text/javascript"></script>
    <script src="/media/js/date.format.js" type="text/javascript"></script>
    <script src="/media/js/scripts.js" type="text/javascript"></script>
</head>
<script>
	curLang = '<?php echo Yii::app()->language ?>';
</script>
<body onload="EGMapContainer1_init()">
<div class="page-wrapper">
<header class="page-header <?if (Yii::app()->controller->action->id == 'index') :?> homepage <?endif?>">
    <div class="centrified">
        <div class="control-panel">
            <div class="lang">
                <a href="javascript:void(0)" title="In English, please">
                    <img src="/media/images/lang-en.png" alt="" />
                    English
                </a>
            </div>
            <div class="links">
                <a href="javascript:void(0)">О нас</a>
                <a href="<?=Yii::app()->createUrl('admin/hotels')?>"><?=Yii::app()->user->name?></a>
                <a href="<?=Yii::app()->createUrl('admin/hotels')?>"><?=Yii::app()->user->isGuest?></a>

            </div>
            <div class="control-links" id="header-control-links">
                <ul>
                    <li class="parent orange"><a href="javascript:void(0)">Ваша бронь</a>
                    <li class="parent orange"><a href="javascript:void(0)" onclick="toggleActive($(this).parent());">Ваш тур</a>
                    <li class="parent green favorites"><a href="javascript:void(0)" onclick="toggleActive($(this).parent());">Избранное</a>
                    <li class="parent">
                        <style>
                            .valid {
                                box-shadow: 0 0 7px rgba(0, 200, 0, 0.92) !important;
                            }

                            .notValid {
                                box-shadow: 0 0 7px rgba(230, 0, 0, 0.92) !important;
                            }
                        </style>
                        <script>
                            $(document).ready(function() {
                                $('#register-from-name').blur(function(){
                                    // Убираем все классы с поля «Ваше имя»
                                    $('#register-from-name').removeClass();
                                    // Определяем длину значения поля
                                    var nameLngth = $('#register-from-name').val().length;
                                    // Если значение меньше или равно 1 символу, то выводим предупреждение
                                    if(nameLngth <= 1){
                                        $('#register-from-name').addClass('notValid');
                                        $(this).text('Введите пожалуйста ваше имя');
                                    } else {
                                        // Здесь мы пишем что должно быть, если все введено верно
                                        $('#register-from-name').addClass('valid');
                                        $(this).next().text('');
                                    }
                                });
                            });

                        </script>
                        <? if (Yii::app()->user->isGuest): ?>
                            <a href="javascript:void(0)">Вход/Регистрация</a>
                        <? else: ?>
                            <a href="site/logout">Выход</a>
                        <? endif ?>
									<span class="content register">
										<form action="/site/registration" method="post" class="register-form">
                                            <span class="title">Регистрация нового пользователя</span>
											<span class="item">
												<label for="register-form-email">E-mail<span>*</span>:</label>
												<input type="email" name="email" value="" id="register-form-email" />
											</span>
											<span class="item">
												<label for="register-form-password">Пароль<span>*</span>:</label>
												<input type="password" name="password" value="" id="register-form-password" />
											</span>
											<span class="item">
												<label for="register-from-name">Имя<span>*</span>:</label>
												<input type="text" name="name" value="" id="register-from-name" />
											</span>
											<span class="item">
												<label for="register-from-city">Город:</label>
												<input type="text" name="city" value="" id="register-from-city" />
											</span>											
											<span class="item">
												<label for="register-from-phone">Телефон:</label>
												<input type="text" name="phone" value="" id="register-from-phone" />
											</span>
                                            <span class="login-link"><a href="#" onclick="showLoginForm()">Войти как пользователь</a></span>
                                            <input type="submit" id="register-form-submit" name="submit" value="Зарегистрироваться" />
                                        </form>
										<form action="/site/login" method="POST" class="login-form">
                                            <span class="title">Авторизация</span>
											<span class="item">
												<label for="login-form-email">E-mail<span>*</span>:</label>
												<input type="email" name="email" value="" id="login-form-email" />
											</span>
											<span class="item">
												<label for="login-form-password">Пароль<span>*</span>:</label>
												<input type="password" name="password" value="" id="login-form-password" />
											</span>
                                            <span class="login-link"><a href="#" onclick="showRegisterForm()">Зарегистрироваться</a></span>
                                            <input type="submit" name="submit" value="Авторизоваться" />
                                        </form>
									</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="logo">
            <a href="/"><img src="/media/images/logo.png" alt="" /></a>
        </div>
        <div class="contacts">
            <div class="item first-col">
                <span class="label">E-mail:</span>
                <span class="value"><a href="mailto:office@citybooking.ru">office@citybooking.ru</a></span>
            </div>
            <div class="item sec-col">
                <span class="label">Санкт-Петербург:</span>
                <span class="value">+7 (812) 764-89-47</span>
            </div>
            <div class="item third-col">
                <span class="label">Москва:</span>
                <span class="value">+7 (495) 998-58-46</span>
            </div>
            <div class="item first-col">
                <span class="label">Skype:</span>
                <span class="value">CityBooking</span>
            </div>
            <div class="item sec-col">
                <span class="label">факс:</span>
                <span class="value">+7 (812) 764-95-22</span>
            </div>
            <div class="item third-col">
                <span class="label">Мобильный офис:</span>
                <span class="value">+7 (911) 998-58-46</span>
            </div>
        </div>
        <nav class="main-menu">
            <ul>
                <li class="<? if (Yii::app()->controller->id == 'hotels'): ?> active <? endif ?>"><a href="<?= Yii::app()->createUrl('hotels/search', array('date_checkin'=>date('d.m.Y'), 'per_page'=>2)) ?>">Отели<span>Санкт-Петербурга</span></a></li>
                <li class="<? if (Yii::app()->controller->id == 'tours'): ?> active <? endif ?>"><a href="<?= Yii::app()->createUrl('tours/search') ?>">Экскурсии по<span>Санкт-Петербургу</span></a></li>
                <li class="<? if (Yii::app()->controller->action->id == 'pages'): ?> active <? endif ?>"><a href="<?= Yii::app()->createUrl('hotels/search') ?>">Транспорт<span>Санкт-Петербурга</span></a></li>
                <li class="<? if (Yii::app()->controller->action->id == 'pages'): ?> active <? endif ?>"><a href="<?= Yii::app()->createUrl('hotels/search') ?>">Визовая поддержка<span>Visa to Russia</span></a></li>
                <li class="<? if (Yii::app()->controller->id == 'conference'): ?> active <? endif ?>"><a href="<?= Yii::app()->createUrl('conference/search') ?>">Конференц-залы<span>Санкт-Петербурга</span></a></li>
                <li class="parent">
                    <a href="javascript:void(0)" class="more">Еще</a>
                    <ul>
                        <li><a href="javascript:void(0)">Отличный пункт</a></li>
                        <li><a href="javascript:void(0)">Прекрасный</a></li>
                        <li><a href="javascript:void(0)">Супер</a></li>
                        <li><a href="javascript:void(0)">А отрисовать?</a></li>
                        <li><a href="javascript:void(0)">Да верстальщик</a></li>
                        <li><a href="javascript:void(0)">Сам придумает</a></li>
                        <li><a href="javascript:void(0)">Чай, не дурак</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
    <?php echo $content; ?>
</div><!-- wrapper -->
<footer class="page-footer">
    <div class="centrified">
        <nav class="footer-menu">
            <ul>
                <li><a href="<?= Yii::app()->createUrl('hotels/search') ?>" class="<? if (Yii::app()->controller->id == 'hotels'): ?> active <? endif ?>">Отели Петербурга</a></li>
                <li><a href="<?= Yii::app()->createUrl('tours/search') ?>" class="<? if (Yii::app()->controller->id == 'tours'): ?> active <? endif ?>">Экскурсии по Петербургу</a></li>
                <li><a href="javascript:void(0)" >Отели мира</a></li>
                <li><a href="javascript:void(0)" >Авиабилеты</a></li>
                <li><a href="javascript:void(0)" >Визовая поддержка</a></li>
                <li><a href="<?= Yii::app()->createUrl('conference/search') ?>" class="<? if (Yii::app()->controller->id == 'conference'): ?> active <? endif ?>">Конференц-залы</a></li>
                <li><a href="javascript:void(0)" >О нас</a></li>
            </ul>
        </nav>
        <div class="copyright">
            Copyright © 2013 CityBooking.ru. Все права защищены
        </div>
    </div>
</footer>
<div class="consul">
    <a href="#"><img src="/media/images/consul-online.png" alt="" /></a>
</div>
</body>
</html>