<script type='text/javascript'>
    $(document).ready(function(){
        $('.popover-help').popover({ trigger : 'hover', delay : 500, html: true });
        $('#hotels').liTranslit({
            elName: '#Hotels_name',    //Класс елемента с именем
            elAlias: '#Hotels_url'   //Класс елемента с алиасом
        });
    })
</script>
<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'hotels',
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
        <legend>Имя, Url и параметры отеля</legend>

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
            <div class="span3">
                <?php echo $form->toggleButtonRow($model, 'active'); ?>
            </div>
            <div class="span6">
                <?php echo $form->labelEx($model,'stars'); ?>
                <?php
                    $this->widget('CStarRating',array(
                        'model'=>$model,
                        'attribute'=>'stars',
                        'minRating'=>1,
                        'maxRating'=>5,
                        'starCount'=>5,
                        'readOnly'=>false,
                        'allowEmpty'=>false,
                    ));
                ?>
            </div>
        </div>

        <legend>Адрес, район и координаты отеля</legend>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'address', array('class' => 'span8')); ?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span3">
                <?php echo $form->select2Row($model, 'district', array('asDropDownList' => true,
                    'data'=> Hotels::model()->getHtmlListDistricts(),
                    'options' => array(
                        'width' => '85%',
                    )));?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'lng', array('class' => 'span10')); ?>
            </div>
            <div class="span3">
                <?php echo $form->textFieldRow($model, 'lat', array('class' => 'span7')); ?>
            </div>
            <div class="span3">
                <?php echo $form->textFieldRow($model, 'lat_lng', array('class' => 'span10')); ?>
            </div>
        </div>

        <legend>Ближайшие станции метро</legend>
        <div class="row-fluid control-group">
            <div class="span3">
                <?php echo $form->select2Row($model, 'metro1', array('asDropDownList' => true,
                    'data'=> Hotels::model()->getHtmlListMetro(),
                    'options' => array(
                        'width' => '85%',
                        'tokenSeparators' => array(',', ' ')
                    )));?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'metro_dis1', array('class' => 'span5')); ?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span3">
                <?php echo $form->select2Row($model, 'metro2', array('asDropDownList' => true,
                    'data'=> Hotels::model()->getHtmlListMetro(),
                    'options' => array(
                        'width' => '85%',
                        'tokenSeparators' => array(',', ' ')
                    )));?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'metro_dis2', array('class' => 'span5')); ?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span3">
                <?php echo $form->select2Row($model, 'metro3', array('asDropDownList' => true,
                    'data'=> Hotels::model()->getHtmlListMetro(),
                    'options' => array(
                        'width' => '85%',
                        'tokenSeparators' => array(',', ' ')
                    )));?>
            </div>
            <div class="span2">
                <?php echo $form->textFieldRow($model, 'metro_dis3', array('class' => 'span5')); ?>
            </div>
        </div>

        <legend>Услуги отеля</legend>
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
                    'htmlOptions'=>array('class'=>'deleteService', 'tag'=>'HotelServices'),
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
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'description_short', array('class'=>'span12', 'rows'=>5)); ?>
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
            'htmlOptions'   => array('model_name'=> 'Hotels'),
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
    'url'=> '/admin/hotels/'
    ));?>
</div>

<?php $this->endWidget();?>
