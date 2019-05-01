<?php
/* @var $this OblastController */
/* @var $model Oblast */
/* @var $form CActiveForm */

$indicators = Indicator::model()->findAll();
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oblast-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_country'); ?>
		<?php echo $form->dropDownList($model,'id_country',CHtml::listData(Country::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'id_country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_ru'); ?>
		<?php echo $form->textField($model,'name_ru',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name_ru'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_en'); ?>
		<?php echo $form->textField($model,'name_en',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name_en'); ?>
	</div>

	<h2><?php echo Yii::t('app', 'Link with indicators') ?></h2>

	<table class="existings">
		<thead>
			<tr>
				<th><?php echo Yii::t('app', 'Indicator'); ?></th>
				<th><?php echo Yii::t('app', 'Min Year'); ?></th>
				<th><?php echo Yii::t('app', 'Max Year'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($indicators as $indicator): ?>
				<tr>
					<td><?php echo $indicator->name; ?></td>
					<td>
						<input type="number"
							name="<?php echo 'Existings[' . $indicator->id . '][min_year]'; ?>"
							value="<?php echo $model->findExistByIndicator($indicator->id, 'min_year'); ?>"
						/>
					</td>
					<td>
						<input type="number"
							name="<?php echo 'Existings[' . $indicator->id . '][max_year]'; ?>"
							value="<?php echo $model->findExistByIndicator($indicator->id, 'max_year'); ?>"
						/>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->