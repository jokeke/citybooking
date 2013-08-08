<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'users',
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
                <?php echo $form->textFieldRow($model, 'firstname', array('class' => 'span8')); ?>
            </div>
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'surname', array('class' => 'span8')); ?>
            </div>
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'familyname', array('class' => 'span8')); ?>
            </div>
        </div>

        <legend>Контактная информация</legend>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'city', array('class' => 'span8')); ?>
            </div>
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span8')); ?>
            </div>
        </div>
        <div class="row-fluid control-group">
            <div class="span4">
                <?php echo $form->textFieldRow($model, 'email', array('class' => 'span8')); ?>
            </div>
        </div>

        <legend>Пароль</legend>
        <div class="row-fluid control-group">
            <div class="span3">
                <?php echo $form->passwordField($model, 'password', array('class' => 'span8')); ?>
            </div>
        </div>

    </div>
    <div class="span6">
        <div class="row-fluid control-group">
            <?php echo $form->redactorRow($model, 'note', array('class'=>'span12', 'rows'=>5)); ?>
        </div>
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
