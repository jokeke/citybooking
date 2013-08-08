<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Редактирование контентных страниц</h1>
<?$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Создать контентную страницу',
    'type' => 'inverse',
    'size' => 'medium',
    'icon' => 'icon-plus  icon-white',
    'url' => '/admin/pages/create',
));?>
</br>

<? $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'sortableRows' => true,
    'sortableAttribute' => 'position',
    'sortableAjaxSave' => true,
    'sortableAction' => 'admin/pages/sort',
    'afterSortableUpdate' => 'js:function(){}',
    //'afterAjaxUpdate' => 'js:function(id, position){$afterAjaxUpdate}',
    //'afterSortableUpdate'   => 'js:function(position){ $.ajax({url: "'.$this->createUrl('sortSave').'", data: position}); }',
    'fixedHeader' => true,
    'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
    'type'=>'striped bordered',
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'columns'=>array(
        'position',
        'id',
        'name',
        'content',
        'image',
        'description',
        'level',
        array( 'name'=>'updated', 'value'=>'date("d.m.Y H:i:s",$data->updated)' ),
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'pages/toggle',
            'name' => 'active',
            'header' => 'Active'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),

    ),
));?>
