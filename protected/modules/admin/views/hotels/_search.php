<?php
/* @var $this HotelsController */
/* @var $model Hotels */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addres'); ?>
		<?php echo $form->textField($model,'addres',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lng'); ?>
		<?php echo $form->textField($model,'lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lat'); ?>
		<?php echo $form->textField($model,'lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lat_lng'); ?>
		<?php echo $form->textField($model,'lat_lng',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro1'); ?>
		<?php echo $form->textField($model,'metro1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro_dis1'); ?>
		<?php echo $form->textField($model,'metro_dis1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro2'); ?>
		<?php echo $form->textField($model,'metro2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro_dis2'); ?>
		<?php echo $form->textField($model,'metro_dis2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro3'); ?>
		<?php echo $form->textField($model,'metro3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro_dis3'); ?>
		<?php echo $form->textField($model,'metro_dis3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'district'); ?>
		<?php echo $form->textField($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stars'); ?>
		<?php echo $form->textField($model,'stars'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'images'); ?>
		<?php echo $form->textArea($model,'images',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'room_num'); ?>
		<?php echo $form->textField($model,'room_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updeated'); ?>
		<?php echo $form->textField($model,'updeated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metakeywords'); ?>
		<?php echo $form->textArea($model,'metakeywords',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metadescription'); ?>
		<?php echo $form->textArea($model,'metadescription',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->