<?php
/* @var $this HotelsController */
/* @var $model Hotels */

$this->breadcrumbs=array(
	'Hotels'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Hotels', 'url'=>array('index')),
	array('label'=>'Create Hotels', 'url'=>array('create')),
	array('label'=>'Update Hotels', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Hotels', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Hotels', 'url'=>array('admin')),
);
?>

<h1>View Hotels #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'name',
        'position',
        'active',
        'address',
        'lng',
        'lat',
        'lat_lng',
        'metro1',
        'metro_dis1',
        'metro2',
        'metro_dis2',
        'metro3',
        'metro_dis3',
        'district',
        'stars',
        'description',
        //'images',
        'room_num',
        'created',
        'updated',
        'title',
        'metakeywords',
        'metadescription',
    ),
));?>
<?php $this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Назад',
    'type' => 'warning',
    'size' => 'large',
    'url'=> '/admin/hotels/'
));?>
