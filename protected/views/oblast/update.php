<?php
/* @var $this OblastController */
/* @var $model Oblast */

$this->breadcrumbs=array(
	'Oblasts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Oblast', 'url'=>array('index')),
	array('label'=>'Create Oblast', 'url'=>array('create')),
	array('label'=>'View Oblast', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Oblast', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update Oblast') ?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>