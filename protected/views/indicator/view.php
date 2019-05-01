<?php
/* @var $this IndicatorController */
/* @var $model Indicator */

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Create Indicator', 'url'=>array('create')),
	array('label'=>'Update Indicator', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Indicator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Indicator', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name_ru',
		'name_en',
	),
)); ?>
