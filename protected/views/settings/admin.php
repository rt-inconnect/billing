<?php
/* @var $this SettingsController */
/* @var $model Settings */

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name_ru',
		'name_en',
		'value',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}'
		),
	),
)); ?>
