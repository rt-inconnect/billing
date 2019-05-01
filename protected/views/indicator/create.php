<?php
/* @var $this IndicatorController */
/* @var $model Indicator */

$this->breadcrumbs=array(
	'Indicators'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Manage Indicator', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create Indicator') ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>