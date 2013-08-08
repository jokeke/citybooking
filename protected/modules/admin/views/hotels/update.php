<?php
/* @var $this HotelsController */
/* @var $model Hotels */

$this->breadcrumbs=array(
	'Hotels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Hotels', 'url'=>array('index')),
	array('label'=>'Create Hotels', 'url'=>array('create')),
	array('label'=>'View Hotels', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Hotels', 'url'=>array('admin')),
);
?>

<h1>Update Hotels <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
    'services' => $services,
)); ?>