<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hotels-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addres'); ?>
		<?php echo $form->textField($model,'addres',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'addres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lng'); ?>
		<?php echo $form->textField($model,'lng'); ?>
		<?php echo $form->error($model,'lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lat'); ?>
		<?php echo $form->textField($model,'lat'); ?>
		<?php echo $form->error($model,'lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lat_lng'); ?>
		<?php echo $form->textField($model,'lat_lng',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lat_lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro1'); ?>
		<?php echo $form->textField($model,'metro1'); ?>
		<?php echo $form->error($model,'metro1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro_dis1'); ?>
		<?php echo $form->textField($model,'metro_dis1'); ?>
		<?php echo $form->error($model,'metro_dis1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro2'); ?>
		<?php echo $form->textField($model,'metro2'); ?>
		<?php echo $form->error($model,'metro2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro_dis2'); ?>
		<?php echo $form->textField($model,'metro_dis2'); ?>
		<?php echo $form->error($model,'metro_dis2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro3'); ?>
		<?php echo $form->textField($model,'metro3'); ?>
		<?php echo $form->error($model,'metro3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro_dis3'); ?>
		<?php echo $form->textField($model,'metro_dis3'); ?>
		<?php echo $form->error($model,'metro_dis3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->textField($model,'district'); ?>
		<?php echo $form->error($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stars'); ?>
		<?php echo $form->textField($model,'stars'); ?>
		<?php echo $form->error($model,'stars'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
		<?php echo $form->textArea($model,'images',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'images'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'room_num'); ?>
		<?php echo $form->textField($model,'room_num'); ?>
		<?php echo $form->error($model,'room_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updeated'); ?>
		<?php echo $form->textField($model,'updeated'); ?>
		<?php echo $form->error($model,'updeated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metakeywords'); ?>
		<?php echo $form->textArea($model,'metakeywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'metakeywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metadescription'); ?>
		<?php echo $form->textArea($model,'metadescription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'metadescription'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->