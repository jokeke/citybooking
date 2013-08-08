<?php
$this->breadcrumbs=array(
	'Tours',
);

$this->menu=array(
array('label'=>'Create Tours','url'=>array('create')),
array('label'=>'Manage Tours','url'=>array('admin')),
);
?>

<h1>Tours</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
