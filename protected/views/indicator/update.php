<?php
/* @var $this IndicatorController */
/* @var $model Indicator */

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Create Indicator', 'url'=>array('create')),
	array('label'=>'View Indicator', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Indicator', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update Indicator') ?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>