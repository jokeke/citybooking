<?php
/* @var $this HotelsController */
/* @var $model Hotels */

$this->breadcrumbs=array(
	'Hotels'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Hotels', 'url'=>array('index')),
	array('label'=>'Create Hotels', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#hotels-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Редактирование отелей</h1>
<?$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Создать страницу отеля',
    'type' => 'inverse',
    'size' => 'medium',
    'icon' => 'icon-plus  icon-white',
    'url' => '/admin/hotels/create',
));?>
</br>

<? $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'sortableRows' => true,
    'sortableAttribute' => 'position',
    'sortableAjaxSave' => true,
    'sortableAction' => 'admin/hotels/sort',
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
        array(
            'class'=>'bootstrap.widgets.TbRelationalColumn',
            'url' => $this->createUrl('hotels/relational'),
            'value'=> '"Комнаты"',
            'cacheData' => false,
        ),
        //'id',

        'position',
        'name',
        'active',
        'address',
        'lat',
        array( 'name'=>'updated', 'value'=>'date("d.m.Y H:i:s",$data->updated)' ),
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=> $this->createUrl('hotels/toggle'),
            'name' => 'active',
            'header' => 'Active'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),

    ),

));?>
<?
if(Yii::app()->bootstrap->registerAssetCss('bootstrap-relational.css'))
    echo 'qwe';
?>