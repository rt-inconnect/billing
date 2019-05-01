<?php
/* @var $this OblastController */
/* @var $model Oblast */

$this->breadcrumbs=array(
	'Oblasts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Oblast', 'url'=>array('index')),
	array('label'=>'Create Oblast', 'url'=>array('create')),
	array('label'=>'Update Oblast', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Oblast', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Oblast', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_country',
		'name_ru',
		'name_en',
	),
)); ?>
