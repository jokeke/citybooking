<?php
/**
 * Отображение для layouts/main:
 *
 *   @category YupeLayout
 *   @package  YupeCMS
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode(Yii::app()->name); ?> <?php echo CHtml::encode($this->pageTitle); ?></title>
    <?/*php
    $mainAssets = Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('application.modules.yupe.views.assets')
    );
    Yii::app()->clientScript->registerCssFile($mainAssets . '/css/styles.css');
    Yii::app()->clientScript->registerScriptFile($mainAssets . '/js/main.js');
    Yii::app()->clientScript->registerScriptFile($mainAssets . '/js/jquery.li-translit.js');
    if (($langs = $this->yupe->languageSelectorArray) != array())
        Yii::app()->clientScript->registerCssFile($mainAssets. '/css/flags.css');
    */?>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/media/modules/admin/css/styles.css"/>
    <script type="text/javascript" src="/media/modules/admin/js/script.js"></script>
    <script type="text/javascript" src="/media/modules/admin/js/jquery.li-translit.js"></script>
    <script type="text/javascript" src="/media/modules/admin/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>


    <!-- чтобы работали иконки нужно это прогрузить -->
    <?php Yii::app()->bootstrap->registerCoreCss(); ?>
    <?php Yii::app()->bootstrap->registerCoreScripts(); ?>
    <?php Yii::app()->bootstrap->registerYiiCss(); ?>
    <?php if (Yii::app()->request->isAjaxRequest) {
        Yii::app()->clientscript->scriptMap['*.js'] = false;
    }  ?>


</head>

<body>
<div id="overall-wrap">
    <!-- mainmenu -->
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
        'brand' => 'CityBooking',
        'brandOptions' => array('style'=>'width:auto;margin-left: 0px;'),
        'fixed' => 'top',
        'htmlOptions' => array('style' => 'position:absolute'),
        'type' => 'inverse',
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => array(
                    array('label' => 'Отели', 'url' => array('/admin/hotels')),
                    array('label' => 'Номера', 'url' => array('/admin/rooms')),
                    array('label' => 'Конференц-залы', 'url' => array('/admin/conference')),
                    array('label' => 'Экскурсии', 'url' => array('/admin/tours')),
                    array('label' => 'Контентные странички', 'url' => array('/admin/pages')),
                    array('label' => 'Пользователи', 'url' => array('/admin/users')),
                    array('label' => 'Бронирования', 'url' => array('/admin/hotelbooking')),
                    array('label' => 'Выход', 'url' => array('/site/logout')),
                )
            )
        )
    ));
    ?>
    <div class="container-fluid" id="page"><?php echo $content; ?></div>
    <div id="footer-guard"><!-- --></div>
</div>
<footer>
    Copyright &copy; 2009-<?php echo date('Y'); ?>
    <?//php echo $this->yupe->poweredBy();?>
    <small class="label label-info"><?//php echo $this->yupe->getVersion(); ?></small>
    <br/>
    <?php echo Yii::powered(); ?>
    <?//php $this->widget('YPerformanceStatistic'); ?>
</footer>
</body>
</html>