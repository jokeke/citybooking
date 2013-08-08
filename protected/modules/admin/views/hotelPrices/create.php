<?php
$this->breadcrumbs=array(
	'Hotel Prices'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List HotelPrices','url'=>array('index')),
array('label'=>'Manage HotelPrices','url'=>array('admin')),
);
?>

<h1>Create HotelPrices</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>