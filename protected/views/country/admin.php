<?php
/* @var $this CountryController */
/* @var $model Country */
?>

<?php echo CHtml::link(Yii::t('app', 'Create Country'), ['create'], ['class'=>'create-button']); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'country-grid',
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
