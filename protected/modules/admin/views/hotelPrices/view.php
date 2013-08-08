<?php
$this->breadcrumbs=array(
	'Hotel Prices'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List HotelPrices','url'=>array('index')),
array('label'=>'Create HotelPrices','url'=>array('create')),
array('label'=>'Update HotelPrices','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete HotelPrices','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage HotelPrices','url'=>array('admin')),
);
?>

<h1>View HotelPrices #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'roomid',
		'season_name',
		'from',
		'to',
		'price',
		'active',
		'created',
		'updated',
),
)); ?>
