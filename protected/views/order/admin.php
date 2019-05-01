<?php
/* @var $this OrderController */
/* @var $model Order */
$currency = Settings::model()->findByPk('CURRENCY');
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		[
			'name' => 'status',
			'value' => '$data->statuses()[$data->status]',
			'filter' => $model->statuses(),
		],
		'email',
		[
			'name' => 'total',
			'value' => '$data->total . "' . $currency->value . '"',
		],
		'createdAt',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
