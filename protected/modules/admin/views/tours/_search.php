<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textAreaRow($model,'visiting_time',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'type2',array('class'=>'span5')); ?>

		<?php echo $form->textAreaRow($model,'images',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'active',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'updated',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'lat',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lng',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lat_lng',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'metro1',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'metro_dis1',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'metro2',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'metro_dis2',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'metro3',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'metro_dis3',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'schedule',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'starttime',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'position',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textAreaRow($model,'metakeywords',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textAreaRow($model,'metadescription',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
