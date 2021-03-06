<?php
/* @var $this RoomsController */
/* @var $model Rooms */

$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Rooms', 'url'=>array('index')),
	array('label'=>'Create Rooms', 'url'=>array('create')),
	array('label'=>'Update Rooms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rooms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rooms', 'url'=>array('admin')),
);
?>

<h1>View Rooms #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'hotel_id',
		'name',
		'url',
		'active',
		'payform',
		'category',
		'category_standart',
		'num',
		'sleeper',
		'description',
		'position',
		'created',
		'updated',
	),
)); ?>
</br>
<?php $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Назад',
    'type' => 'inverse',
    'size' => 'large',
    'url' => '/admin/rooms/',
));?>
