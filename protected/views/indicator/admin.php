<?php
/* @var $this IndicatorController */
/* @var $model Indicator */
?>

<?php echo CHtml::link(Yii::t('app', 'Create Indicator'), ['create'], ['class'=>'create-button']); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indicator-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name_ru',
		'name_en',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
