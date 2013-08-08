<?php
/* @var $this RoomsController */
/* @var $model Rooms */

$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Rooms', 'url'=>array('index')),
	array('label'=>'Create Rooms', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rooms-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Редактирование номеров</h1>
<?$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Создать страницу номера',
    'type' => 'inverse',
    'size' => 'medium',
    'icon' => 'icon-plus  icon-white',
    'url' => '/admin/rooms/create',
));?>
    </br>


<? $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'sortableRows' => true,
    'sortableAttribute' => 'position',
    'sortableAjaxSave' => true,
    'sortableAction' => 'admin/rooms/sort',
    'afterSortableUpdate' => 'js:function(){}',
    'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
    'type'=>'striped bordered',
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'columns'=>array(
        array(
            'class'=>'bootstrap.widgets.TbImageColumn',
            'imagePathExpression'=>'$data->images[0]',
            'usePlaceKitten'=>FALSE,
            'htmlOptions'=>array('style'=>'max-width: 100px'),
        ),
        'position',
        'id',
        'hotel_id',
        array( 'name'=>'hotel_search', 'value'=>'$data->hotel->name' ),
        'name',
        'url',
        'active',
        'payform',
        array( 'name'=>'updated', 'value'=>'date("d.m.Y H:i:s",$data->updated)' ),
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'rooms/toggle',
            'name' => 'active',
            'header' => 'Active'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),

    ),
));?>