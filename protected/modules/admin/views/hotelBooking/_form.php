<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'booking',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => array(
            'class' => 'well',
            'enctype'=>'multipart/form-data'),
        'inlineErrors'           => true,
    )
); ?>

<div class="alert alert-info" xmlns="http://www.w3.org/1999/html">
    <?php echo 'Поля, отмеченные'; ?>
    <span class="required">*</span>
    <?php echo 'обязательны.'; ?>
</div><!-- form -->
<div class="row-fluid control-group">
    <div class="span6">
        <legend>ФИО</legend>

        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'surname', array('class' => 'span8')); ?>
            </div>

            <div class="span4">
                <?php echo $form->textFieldRow($model, 'firstname', array('class' => 'span8')); ?>
            </div>

            <div class="span4">
                <?php echo $form->textFieldRow($model, 'contact_name', array('class' => 'span8')); ?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span3">
                <?php echo $form->toggleButtonRow($model, 'active'); ?>
            </div>
        </div>

        <legend>Контактные данные</legend>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span8')); ?>
            </div>
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'email', array('class' => 'span8')); ?>
            </div>
        </div>

        <legend>Доп сервисы</legend>
        <div class="row-fluid control-group">
            <?$model->services = unserialize($model->services);?>
            <? foreach ($model->services as $s) { ?>
                <?= $s?></br>
            <? } ?>
        </div>

        <legend>Комнаты</legend>
        <? foreach ($model->hotelBookingRooms as $r) { ?>
            <? $room = Rooms::model()->findByPk($r['room_id']);
               $hotel = Hotels::model()->findByPk($room->hotel_id);?>
            <div class="row-fluid control-group">
                Название отеля: <?= $hotel->name?> </br>
                Категория номера: <?= $room->category?> </br>
                Колbчество взрослых: <?= $r['man'] ?> </br>
                Количество детей: <?= $r['kid'] ?> </br>
                Дата заезда: <?= date("d.m.Y",$r->date_checkin) ?> </br>
                Дата выезда: <?= date("d.m.Y",$r->date_checkout) ?> </br>
                Время заезда: <?= $r->time_checkin ?> </br>
                Время выезда: <?= $r->time_checkout ?> </br>
                Кровать: <?= $r->bed ?> </br>
                Цена за номер: <?= $r->price ?> </br>
                Гости: </br>
                <? foreach (unserialize($r->guest) as $g) { ?>
                    Фамилия: <?= $g[0] ?> // Имя: <?= $g[1] ?> // Отчество: <?= $g[2] ?> </br>
                <? } ?>
            </div>
        <? } ?>
        <legend>Общая цена</legend>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'price', array('class' => 'span8')); ?>
            </div>
        </div>

    </div>
    <div class="span6">
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'wishes', array('class'=>'span12', 'rows'=>5)); ?>
        </div>
        </br>

    </div>
</div>
<br/>
<br/><br/>

<div class="row-fluid control-group">
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'Сохранить',
        'type' => 'primary',
        'size' => 'large',
        'buttonType' => 'submit',
        'htmlOptions'=> array('name' => 'submit-type', 'value' => 'index'),
    ));?>

    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'Отмена',
        'type' => 'warning',
        'size' => 'large',
        'url'=> '/admin/rooms/'
    ));?>
</div>

<?php $this->endWidget();?>
