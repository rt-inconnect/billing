<?php
/* @var $this OblastController */
/* @var $model Oblast */

$this->breadcrumbs=array(
	'Oblasts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Oblast', 'url'=>array('index')),
	array('label'=>'Manage Oblast', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create Oblast') ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>