<?php
/* @var $this HotelBookingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hotel Bookings',
);

$this->menu=array(
	array('label'=>'Create HotelBooking', 'url'=>array('create')),
	array('label'=>'Manage HotelBooking', 'url'=>array('admin')),
);
?>

<h1>Hotel Bookings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
