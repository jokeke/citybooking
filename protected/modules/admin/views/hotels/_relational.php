<?php
echo CHtml::tag('h3',array(),'Комнаты отеля : "'.$name.'"');
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered',
    'dataProvider' => $gridDataProvider,
    'template' => "{items}",
    'columns'=>array(
        'position',
        'id',
        'hotel_id',
        'name',
        'url',
        'active',
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'rooms/toggle',
            'name' => 'active',
            'header' => 'Active'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update} {delete}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("admin/rooms/view/", array("id"=>$data->id))',
                ),
                'update'=>array(
                    'url'=>'Yii::app()->createUrl("admin/rooms/update/", array("id"=>$data->id))',
                ),
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("admin/rooms/delete/", array("id"=>$data->id))',
                ),

            )

        ),

    ),));
?>