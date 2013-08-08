<?php
/* @var $this HotelsController */
/* @var $data Hotels */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addres')); ?>:</b>
	<?php echo CHtml::encode($data->addres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lng')); ?>:</b>
	<?php echo CHtml::encode($data->lng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lat')); ?>:</b>
	<?php echo CHtml::encode($data->lat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lat_lng')); ?>:</b>
	<?php echo CHtml::encode($data->lat_lng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro1')); ?>:</b>
	<?php echo CHtml::encode($data->metro1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro_dis1')); ?>:</b>
	<?php echo CHtml::encode($data->metro_dis1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro2')); ?>:</b>
	<?php echo CHtml::encode($data->metro2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro_dis2')); ?>:</b>
	<?php echo CHtml::encode($data->metro_dis2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro3')); ?>:</b>
	<?php echo CHtml::encode($data->metro3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro_dis3')); ?>:</b>
	<?php echo CHtml::encode($data->metro_dis3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district')); ?>:</b>
	<?php echo CHtml::encode($data->district); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stars')); ?>:</b>
	<?php echo CHtml::encode($data->stars); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('images')); ?>:</b>
	<?php echo CHtml::encode($data->images); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_num')); ?>:</b>
	<?php echo CHtml::encode($data->room_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updeated')); ?>:</b>
	<?php echo CHtml::encode($data->updeated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metakeywords')); ?>:</b>
	<?php echo CHtml::encode($data->metakeywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metadescription')); ?>:</b>
	<?php echo CHtml::encode($data->metadescription); ?>
	<br />

	*/ ?>

</div>