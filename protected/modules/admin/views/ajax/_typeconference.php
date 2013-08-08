<?php if (Yii::app()->request->isAjaxRequest) {
    Yii::app()->clientscript->scriptMap['*.js'] = false;
}  ?>
<div class="row-fluid control-group conferencetype-block">
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label' => 'Удалить',
            'type' => 'inverse',
            'size' => 'small',
            'htmlOptions'=>array('class'=>'deletePrice', 'tag'=>'ConferencePrices'),
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