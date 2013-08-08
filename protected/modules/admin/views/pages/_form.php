<script type='text/javascript'>
    $(document).ready(function(){
        $('.popover-help').popover({ trigger : 'hover', delay : 500, html: true });
        $('#pages').liTranslit({
            elName: '#Pages_name',    //Класс елемента с именем
            elAlias: '#Pages_url'   //Класс елемента с алиасом
        });
    })
</script>
<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'pages',
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
        </div>

        <legend>Адрес, район и координаты отеля</legend>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->select2Row($model, 'level', array('asDropDownList' => true,
                    'data'=> array(
                        '0'=>'Контентная страница',
                        '1'=>'Новость',
                    ),
                    'options' => array(
                        'width' => '85%',
                    )));?>
            </div>
            <div class="span4" id="newsDate" <?if ($model->level == 0):?> style="display: none;" <?endif?>>
                <?php echo $form->textFieldRow($model, 'news_date', array('class' => 'span8 hasDatepicker', 'prepend'=>'<i class="icon-calendar"></i>')); ?>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("select#Pages_level").change(function (){
                    if ($(this).val() == "1"){
                        $("#newsDate").animate({ opacity: "show" }, "slow");
                    }
                    else
                    {
                        $("#newsDate").animate({ opacity: "hide" }, "slow");
                    }
                });
            });
        </script>
        <?php echo Pages::model()->getRdate('d M Y', 1373641200); ?>
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
                <div class="row-fluid control-group">
                    <img src="<?=$model->image?>" style="max-width:240px;" class="img-rounded">
                    <?php echo $form->textFieldRow($model, 'image', array('class' => 'span7 popover-help', 'data-original-title' =>'Название страницы', 'data-content' => 'order', 'rel'=>'popover')); ?>
                    <?php echo $form->fileFieldRow($model, 'image_upl', array('labelOptions' => array('label' => false))); ?>
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'label' => 'Удалить',
                        'type' => 'inverse',
                        'size' => 'medium',
                        'htmlOptions'   => array('class'=> 'deleteImage'),
                    ));?>
                </div>
        </div>

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
        'htmlOptions'=> array('name' => 'submit-type'),
    ));?>

    <?php $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'Отмена',
        'type' => 'warning',
        'size' => 'large',
        'url'=> '/admin/hotels/'
    ));?>
</div>

<?php $this->endWidget();?>
