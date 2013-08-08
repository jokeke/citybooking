<script type='text/javascript'>
    $(document).ready(function(){
        $('.popover-help').popover({ trigger : 'hover', delay : 500, html: true });
        $('#conference').liTranslit({
            elName: '#Conference_name',    //Класс елемента с именем
            elAlias: '#Conference_url'   //Класс елемента с алиасом
        });
    })
</script>
<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'conference',
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
        <legend>Имя, Url и параметры конференц-зала</legend>

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
                <?php echo $form->textFieldRow($model, 'area', array('class' => 'span8')); ?>
            </div>
        </div>

        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->select2Row($model, 'hotel_id', array('asDropDownList' => true,
                    'data'=> Conference::model()->getHtmlListHotels(),
                    'options' => array(
                        'width' => '85%',
                    )));?>            </div>
        </div>

        <legend>Типы концеренц-зала</legend>
        <div class="types">
            <div class="row-fluid control-group">
                <div class="span2"></div>
                <div class="span3"><strong>Тип конференц-зала</strong></div>
                <div class="span3"><strong>Количество человек</strong></div>
            </div>
            <?$i=0?>
            <? foreach ($types as $t) {?>
            <div class="row-fluid control-group conferencetype-block">
                <div class="span2">
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Удалить',
                        'type' => 'inverse',
                        'size' => 'small',
                        'htmlOptions'=>array('class'=>'deleteType'),
                    ));?>
                    <?php echo CHtml::textField('typeId[]', $t->id,  array('style'=>'width: 90%; display:none;', 'class'=>'id'))?>
                </div>
                <div class="span3">
                    <? $this->widget('bootstrap.widgets.TbSelect2', array(
                        'data'=>array(
                            'teatr'=>'Театр',
                            'class'=>'Класс',
                            'banket'=>'Банкет',
                        ),
                        'value'=>$t->type_name,
                        'asDropDownList' => true,
                        'name' => 'conferenceType'.$i,
                        'options' => array(
                            'placeholder' => 'выберите тип',
                            'width' => '60%',
                        ))); ?>
                </div>
                <div class="span3">
                    <?php echo CHtml::textField('maxHumans'.$i, $t->max_humans, array( 'id'=>'maxHumans'.$i, 'class'=>'span4')) ?>
                </div>
            </div>
            <?$i++?>
            <?}?>
        </div>
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label' => 'Добавить тип',
            'type' => 'info',
            'size' => 'medium',
            'id' => 'addTypeConference'
        ));?>


        <legend>Цены концеренц-зала</legend>
        <div class="prices">
            <div class="row-fluid control-group">
                <div class="span2"></div>
                <div class="span3"><strong>Количество часов</strong></div>
                <div class="span3"><strong>Цена</strong></div>
            </div>
            <?$i=0?>
            <?php foreach ($prices as $p) {?>
            <div class="row-fluid control-group">
                <div class="span2">
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Удалить',
                        'type' => 'inverse',
                        'size' => 'small',
                        'htmlOptions'=>array('class'=>'deletePrice', 'tag'=>'ConferencePrices'),
                    ));?>
                    <?php echo CHtml::textField('priceId[]', $p->id,  array('style'=>'width: 90%; display:none;', 'class'=>'id'))?>
                </div>
                <div class="span3">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-time"></i></span>
                    <?php echo CHtml::textField('hours[]', $p->hours, array( 'id'=>'from'.$i, 'class'=>'span3')) ?>
                    </div>
                </div>
                <div class="span3">
                    <?php echo CHtml::textField('price[]', $p->price, array( 'id'=>'from'.$i, 'class'=>'span4')) ?>
                </div>
            </div>
            <?}?>
        </div>
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label' => 'Добавить цену',
            'type' => 'info',
            'size' => 'medium',
            'id' => 'addPriceConference'
        ));?>

    </div>
    <div class="span6">
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'description', array('class'=>'span12', 'rows'=>5)); ?>
        </div>
        </br>
        <legend>Изображения конференц-зала</legend>
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
            'htmlOptions'   => array('model_name'=> 'Conference'),
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
