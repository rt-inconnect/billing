<?php
/* @var $this OblastController */
/* @var $model Oblast */
?>

<?php echo CHtml::link(Yii::t('app', 'Create Oblast'), ['create'], ['class'=>'create-button']); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oblast-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_country',
		'name_ru',
		'name_en',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
