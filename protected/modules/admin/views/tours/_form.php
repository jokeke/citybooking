<script type='text/javascript' xmlns="http://www.w3.org/1999/html">
    $(document).ready(function(){
        $('.popover-help').popover({ trigger : 'hover', delay : 500, html: true });
        $('#tours').liTranslit({
            elName: '#Tours_name',    //Класс елемента с именем
            elAlias: '#Tours_url'   //Класс елемента с алиасом
        });
    })
</script>
<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'tours',
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
        <legend>Имя, Url и параметры экскурсии</legend>

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
        </div>

        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->select2Row($model, 'type', array('asDropDownList' => true,
                    'data'=>array(
                        '1'=>'По городу',
                        '2'=>'Пригородная',
                        '3'=>'Другая',
                    ),
                    'options' => array(
                        'class' => 'span8',
                    )));?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'type2', array('class' => 'span8')); ?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'duration', array('class' => 'span8')); ?>
            </div>
        </div>

        <legend>Адрес, район и координаты отеля</legend>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'address', array('class' => 'span8')); ?>
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

        <legend>Цена экскурии</legend>
        <div class="pricestour">
            <div class="row-fluid control-group">
                <div class="span3">
                    <?php echo CHtml::textField('priceId', $prices->id,array('class'=>'span6', 'style'=>'width: 90%; display:none;',)) ?>
                    <label>Тип экскурсии</label>
                    <? $this->widget('bootstrap.widgets.TbSelect2', array(
                        'data'=>array(
                            '0'=>'Общая',
                            '1'=>'Индивидульная',
                        ),
                        'value'=>$prices->type,
                        'asDropDownList' => true,
                        'name' => 'priceType',
                        'options' => array(
                            'placeholder' => 'выберите тип',
                            'width' => '60%',
                        ))); ?>
                </div>
                <div class="span3">
                    <label>Человек минимально</label>
                    <?php echo CHtml::textField('priceMin', $prices->min,array('class'=>'span6', 'placeholder' => 'Человек минимально',)) ?>
                </div>
                <div class="span3">
                    <label>Человек максимально</label>
                    <?php echo CHtml::textField('priceMax', $prices->max,array('class'=>'span6', 'placeholder' => 'Человек максимально')) ?>
                </div>
                <div class="span3">
                    <label>Человек максимально</label>
                    <?php echo CHtml::textField('priceTo', $prices->to,array('class'=>'span6 hasDatepicker', 'placeholder' => 'До',)) ?>
                </div>
            </div>
            <div class="row-fluid control-group">
                <div class="span2">
                    <label>Цена за взрослого</label>
                    <?php echo CHtml::textField('priceMen', $prices->men,array('class'=>'span6', 'placeholder' => 'Цена за взрослого')) ?>
                </div>
                <div class="span2">
                    <label>Цена за ребенка</label>
                    <?php echo CHtml::textField('priceKid', $prices->kid,array('class'=>'span6', 'placeholder' => 'Цена за ребенка')) ?>
                </div>
                <div class="span2 total">
                    <label>Цена за студента</label>
                    <?php echo CHtml::textField('priceStud', $prices->stud,array('class'=>'span6', 'placeholder' => 'Цена за студента')) ?>
                </div>
                <div class="span3 total">
                    <label>Цена за пенсионера</label>
                    <?php echo CHtml::textField('priceOld', $prices->old,array('class'=>'span4', 'placeholder' => 'Цена за пенсионера')) ?>
                </div>
                <div class="span3 total">
                    <label>Цена за иностранца</label>
                    <?php echo CHtml::textField('priceForeigner', $prices->foreigner,array('class'=>'span4', 'placeholder' => 'Цена за иностранца')) ?>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                if ($('#priceType').val() == "1") { $(".total").hide(); }
                $("select#priceType").change(function (){
                    if ($(this).val() == "0"){
                        $(".total").animate({ opacity: "show" }, "slow");
                    }
                    else
                    {
                        $(".total").animate({ opacity: "hide" }, "slow");
                    }
                });
            });
        </script>
        <legend>Расписание экскурий</legend>
        <div class="timetable">
        <?php $i=0 ?>
        <?php foreach ($timetable as $t) {?>
        <div class="timetable-block">
            <div class="row-fluid control-group">
                <div class="span3">
                    <label>От</label>
                    <?php echo CHtml::textField('timetableId[]', $t->id,  array('style'=>'width: 90%; display:none;', 'class'=>'id'))?>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php echo CHtml::textField('from'.$i, $t->from,array('class'=>'span6 hasDatepicker', 'placeholder' => 'От',)) ?>
                    </div>
                </div>
                <div class="span3">
                    <label>До</label>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php echo CHtml::textField('to'.$i, $t->to,array('class'=>'span6 hasDatepicker', 'placeholder' => 'До',)) ?>
                    </div>
                </div>
                <?php $this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Удалить',
                    'type' => 'inverse',
                    'size' => 'medium',
                    'htmlOptions'   => array('class'=> 'deleteTimeTable', 'style'=>'margin-top: 25px'),
                ));?>
            </div>
            <div class="row-fluid control-group">
                <div class="span3">
                    <label>Дни недели</label>
                    <? $this->widget('bootstrap.widgets.TbSelect2', array(
                        'data'=>array(
                            '1'=>'Пн',
                            '2'=>'Вт',
                            '3'=>'Ср',
                            '4'=>'Чт',
                            '5'=>'Пт',
                            '6'=>'Сб',
                            '0'=>'Вс',
                        ),
                        'value'=>$t->week,
                        'asDropDownList' => true,
                        'name' => 'week'.$i,
                        'htmlOptions'=>array(
                            'multiple'=>'multiple',

                        ),
                        'options' => array(
                            'placeholder' => 'Выберите дни недели',
                            'width' => '60%',
                        ))); ?>
                </div>

                <div class="span3">
                    <label>Время</label>
                    <? $this->widget('bootstrap.widgets.TbSelect2', array(
                        'data'=>TourTimetable::model()->getHtmlListTime(),
                        'value'=> $t->time,
                        'asDropDownList' => true,
                        'name' => 'time'.$i,
                        'htmlOptions'=>array(
                            'multiple'=>'multiple',
                        ),
                        'options' => array(
                            'placeholder' => 'Выберите время',
                            'width' => '60%',
                        ))); ?>
                </div>
            </div>
            </br>
        </div>
        <?$i++;?>
        <?}?>
        </div>
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label' => 'Добавить расписание',
            'type' => 'info',
            'size' => 'medium',
            'id' => 'addtimetable',
            'htmlOptions'   => array('model_name'=> 'Tours'),
        ));?>
        <div id="hz">asdas</div>

    </div>
    <div class="span6">
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'description', array('class'=>'span12', 'rows'=>5)); ?>
        </div>
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'visiting_time', array('class'=>'span12', 'rows'=>5)); ?>
        </div>
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'starttime', array('class'=>'span12', 'rows'=>5)); ?>
        </div>
        <div class="row-fluid control-group">
            <?php echo $form->textFieldRow($model, 'food', array('class' => 'span12')); ?>
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
            'htmlOptions'   => array('model_name'=> 'Tours'),
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
