<?php
/* @var $this HotelBookingController */
/* @var $model HotelBooking */

$this->breadcrumbs=array(
	'Hotel Bookings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HotelBooking', 'url'=>array('index')),
	array('label'=>'Manage HotelBooking', 'url'=>array('admin')),
);
?>

<h1>Create HotelBooking</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>