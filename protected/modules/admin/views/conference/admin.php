<?php
$this->breadcrumbs=array(
	'Conferences'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Conference','url'=>array('index')),
array('label'=>'Create Conference','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('conference-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Редактирование конференц-залов</h1>
<?$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Создать страницу конференц-зала',
    'type' => 'inverse',
    'size' => 'medium',
    'icon' => 'icon-plus  icon-white',
    'url' => '/admin/conference/create',
));?>
</br>


<? $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'sortableRows' => true,
    'sortableAttribute' => 'position',
    'sortableAjaxSave' => true,
    'sortableAction' => 'admin/conference/sort',
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
        'name',
        'url',
        'hotel_id',
        'description',
        'type',
        'area',
        array( 'name'=>'updated', 'value'=>'date("d.m.Y H:i:s",$data->updated)' ),
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'conference/toggle',
            'name' => 'active',
            'header' => 'Active'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),

    ),
));?>
