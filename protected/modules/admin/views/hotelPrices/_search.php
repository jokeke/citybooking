<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'roomid',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'season_name',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'from',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'to',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'price',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'updated',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
