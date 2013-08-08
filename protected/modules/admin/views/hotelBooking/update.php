<?php
/* @var $this HotelBookingController */
/* @var $model HotelBooking */

$this->breadcrumbs=array(
	'Hotel Bookings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HotelBooking', 'url'=>array('index')),
	array('label'=>'Create HotelBooking', 'url'=>array('create')),
	array('label'=>'View HotelBooking', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HotelBooking', 'url'=>array('admin')),
);
?>

<h1>Update HotelBooking <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>