<?php
$this->breadcrumbs=array(
	'Hotel Prices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List HotelPrices','url'=>array('index')),
	array('label'=>'Create HotelPrices','url'=>array('create')),
	array('label'=>'View HotelPrices','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage HotelPrices','url'=>array('admin')),
	);
	?>

	<h1>Update HotelPrices <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>