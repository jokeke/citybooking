<?php
$this->breadcrumbs=array(
	'Hotel Prices',
);

$this->menu=array(
array('label'=>'Create HotelPrices','url'=>array('create')),
array('label'=>'Manage HotelPrices','url'=>array('admin')),
);
?>

<h1>Hotel Prices</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
