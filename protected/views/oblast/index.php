<?php
/* @var $this OblastController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Oblasts',
);

$this->menu=array(
	array('label'=>'Create Oblast', 'url'=>array('create')),
	array('label'=>'Manage Oblast', 'url'=>array('admin')),
);
?>

<h1>Oblasts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
