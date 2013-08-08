<?php
$this->breadcrumbs=array(
	'Conferences',
);

$this->menu=array(
array('label'=>'Create Conference','url'=>array('create')),
array('label'=>'Manage Conference','url'=>array('admin')),
);
?>

<h1>Conferences</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
