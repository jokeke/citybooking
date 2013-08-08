<?php
$this->breadcrumbs=array(
	'Tours'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Tours','url'=>array('index')),
array('label'=>'Create Tours','url'=>array('create')),
array('label'=>'Update Tours','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Tours','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Tours','url'=>array('admin')),
);
?>

<h1>View Tours #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'url',
		'description',
		'visiting_time',
		'type',
		'type2',
		'active',
		'created',
		'updated',
		'address',
		'lat',
		'lng',
		'lat_lng',
		'metro1',
		'metro_dis1',
		'metro2',
		'metro_dis2',
		'metro3',
		'metro_dis3',
		'schedule',
		'starttime',
		'position',
		'title',
		'metakeywords',
		'metadescription',
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Назад',
    'type' => 'inverse',
    'size' => 'large',
    'url' => '/admin/tours/',
));?>