<script type='text/javascript'>
    $(document).ready(function(){
        $('.popover-help').popover({ trigger : 'hover', delay : 500, html: true });
        $('#rooms').liTranslit({
            elName: '#Rooms_name',    //Класс елемента с именем
            elAlias: '#Rooms_url'   //Класс елемента с алиасом
        });
    })
</script>
<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'rooms',
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
    <legend>Имя, Url и параметры комнаты</legend>

    <div class="row-fluid control-group">
        <div class="span4">
            <?php echo $form->textFieldRow($model, 'name', array('class' => 'span8')); ?>
        </div>
    </div>

    <div class="row-fluid control-group">
        <div class="span4">
            <?php echo $form->textFieldRow($model, 'url', array('class' => 'span8')); ?>
        </div>
    </div>

    <div class="row-fluid control-group">

        <div class="span4">
            <?php echo $form->textFieldRow($model, 'category', array('class' => 'span8')); ?>
        </div>

        <div class="span4">
            <?php echo $form->select2Row($model, 'category_standart', array('asDropDownList' => true,
                'data'=> array(
                    'Одноместный',
                    'Двухместный',
                    'Люкс',
                ),
                'options' => array(
                    'width' => '85%',
                )));?>
        </div>
    </div>

    <div class="row-fluid control-group">
        <div class="span3">
            <?php echo $form->toggleButtonRow($model, 'active'); ?>
        </div>
    </div>

    <legend>Адрес, район и координаты отеля</legend>
    <div class="row-fluid control-group">
        <div class="span4">
            <?php echo $form->select2Row($model, 'hotel_id', array('asDropDownList' => true,
                'data'=> Rooms::model()->getHtmlListHotels(),
                'options' => array(
                    'width' => '85%',
                )));?>
        </div>
    </div>

    <legend>Цены номера</legend>
    <div class="prices">
        <?$i=0?>
        <?php foreach ($prices as $p) { ?>
        <div class="prices-block">
            <div class="row-fluid control-group">
                <div class="span1">
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Удалить',
                        'type' => 'inverse',
                        'size' => 'small',
                        'htmlOptions'=>array('class'=>'deletePrice', 'tag'=>'HotelPrices'),
                    ));?>
                    <?php echo CHtml::textField('priceId[]', $p->id,  array('style'=>'width: 90%; display:none;', 'class'=>'id'))?>
                </div>
                <div class="span3">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php echo CHtml::textField('from[]', date("d.m.Y",$p->from), array( 'id'=>'from'.$i, 'class'=>'span6 hasDatepicker')) ?>
                    </div>
                </div>
                <div class="span3">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php echo CHtml::textField('to[]', date("d.m.Y",$p->to), array('display:block;', 'id'=>'to'.$i, 'class'=>'span6 hasDatepicker')) ?>
                    </div>
                </div>
                <div class="span2">
                    <?php echo CHtml::textField('priceSeason[]', $p->season_name, array('style' => 'width: 90%; display:block;')) ?>
                </div>
                <div class="span1">
                    <?php echo CHtml::textField('pricePrice[]', $p->price, array('style' => 'width: 90%; display:block;')) ?>
                </div>
            </div>
        </div>
            <?$i++?>
        <?}?>
    </div>
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'Добавить цену',
        'type' => 'info',
        'size' => 'medium',
        'id' => 'addPriceRoom'
    ));?>

    <legend>Сервисы номера</legend>
    <div class="services">
        <?php foreach ($services as $s) {?>
            <? if ($s->free == 1)
            {
                $class = 'success';
                $name = 'Бесплатно';
                $visible = 'display: none ;';
            } else
            {
                $class = 'warning';
                $name = 'Платно';
                $visible = 'display: inline-block;';
            } ?>
            <div class="row-fluid control-group">
                <div class="span1">
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Удалить',
                        'type' => 'inverse',
                        'size' => 'small',
                        'htmlOptions'=>array('class'=>'deleteService', 'tag'=>'RoomServices'),
                    ));?>
                </div>
                <div class="span7">
                    <?php echo CHtml::textField('serviceId[]', $s->id,  array('style'=>'width: 90%; display:none;', 'class'=>'id'))?>
                    <?php echo CHtml::textField('serviceDescription[]', $s->description,  array('style'=>'width: 90%;'))?>
                </div>
                <div class="span3">
                    <?php echo CHtml::textField('serviceFree[]', $s->free, array('style'=>'width: 100%; display: none;'))?>
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => $name,
                        'type' => $class,
                        'size' => 'small',
                        'htmlOptions'=>array('class'=>'free'),
                    ));?>
                </div>
                <div class="span1">
                    <?php echo CHtml::textField('servicePrice[]', $s->price, array('style'=>'width: 100%;'.$visible, 'class'=>'price'))?>
                </div>
            </div>
        <?}?>
    </div>
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'Добавить сервис',
        'type' => 'info',
        'size' => 'medium',
        'id' => 'addService'
    ));?>


</div>
<div class="span6">
    <div class="row-fluid control-group">
        <?php echo $form->redactorRow($model, 'description', array('class'=>'span12', 'rows'=>5)); ?>
    </div>
    </br>
    <legend>Изображения отеля</legend>
    <div id="images">
        <?foreach ($model->images as $img) {?>
            <div class="row-fluid control-group">
                <img src="<?=$img?>" style="max-width:240px;" class="img-rounded">
                <?php echo $form->textFieldRow($model, 'images[]', array('class' => 'span5','labelOptions' => array('label' => false), 'value'=>$img)); ?>
                <?php echo $form->fileFieldRow($model, 'image_upl[]', array('labelOptions' => array('label' => false))); ?>
                <?php $this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Удалить',
                    'type' => 'inverse',
                    'size' => 'medium',
                    'htmlOptions'   => array('class'=> 'deleteImage'),
                ));?>
            </div>
        <?}?>
    </div>
    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'Добавить изображение',
        'type' => 'info',
        'size' => 'medium',
        'id' => 'addimage',
        'htmlOptions'   => array('model_name'=> 'Rooms'),
    ));?>



</div>
</div>
<br/>
<div class="row-fluid control-group">
    <div class="span6">
        <?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse');?>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Данные для поисковой оптимизации
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse">
                <div class="accordion-inner">
                    <div class="row-fluid control-group">
                        <?php echo $form->textFieldRow($model, 'title', array('class' => 'span7 popover-help', 'data-original-title' =>'Название страницы', 'data-content' => 'order', 'rel'=>'popover')); ?>
                    </div>
                    <div class="row-fluid control-group">
                        <?php echo $form->textAreaRow($model, 'metakeywords', array('rows' => 3, 'cols' => 98, 'class' => 'span7 popover-help', 'data-original-title' => $model->getAttributeLabel('metadescription'), 'data-content'=> 'asd')); ?>
                    </div>
                    <div class="row-fluid control-group">
                        <?php echo $form->textAreaRow($model, 'metadescription', array('rows' => 3, 'cols' => 98, 'class' => 'span7 popover-help', 'data-original-title' => $model->getAttributeLabel('metadescription'), 'data-content'=> 'asd')); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget();?>
    </div>
</div>
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
