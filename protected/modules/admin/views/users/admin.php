<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список пользователей</h1>
<?$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Добавить пользователя',
    'type' => 'inverse',
    'size' => 'medium',
    'icon' => 'icon-plus  icon-white',
    'url' => '/admin/users/create',
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
        'id',
        'firstname',
        'surname',
        'familyname',
        'phone',
        'email',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),

    ),
));?>
<?='$1$bY5.IT0.$169O04ObkxLuYJPfQBz/a1'?>