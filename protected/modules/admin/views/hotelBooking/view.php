<?php
/* @var $this HotelBookingController */
/* @var $model HotelBooking */

$this->breadcrumbs=array(
	'Hotel Bookings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HotelBooking', 'url'=>array('index')),
	array('label'=>'Create HotelBooking', 'url'=>array('create')),
	array('label'=>'Update HotelBooking', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HotelBooking', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HotelBooking', 'url'=>array('admin')),
);
?>

<h1>View HotelBooking #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'hotel_id',
		'surname',
		'firstname',
		'contact_name',
		'phone',
		'email',
		'wishes',
		'services',
		'price',
		'created',
		'updated',
		'active',
	),
)); ?>
