<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<script type="text/javascript">
	$(document).ready(function () {
		var Index = new IndexController(<?php echo json_encode($settings); ?>);
	});
</script>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	<div class="span-18">
		<h1><?php echo Yii::t('app', 'Create Order') ?></h1>
		<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></p>
	</div>
	<div class="span-4">
		<table class="billing-table"></table>
	</div>
</div>
<div class="clearfix"></div>

<?php echo $form->errorSummary($model); ?>

<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email'); ?>
	<?php echo $form->error($model,'email'); ?>
</div>

<div class="row">
	<?php echo $form->labelEx($model,'fio'); ?>
	<?php echo $form->textField($model,'fio'); ?>
	<?php echo $form->error($model,'fio'); ?>
</div>

<?php foreach ($countries as $country): ?>
	<?php if (count($country->oblasts) == 0) continue; ?>
	<div class="card country closed country-<?php echo $country->id; ?>" data-id="<?php echo $country->id; ?>" data-title="<?php echo $country->name; ?>">
		<h3 class="card-header">
			<input type="checkbox" title="<?php echo Yii::t('app', 'Select All') ?>" />
			<?php echo $country->name; ?>
			<a href="#" class="collapse">
				<img class="closed" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/closed.svg" />
				<img class="opened" src="<?php echo Yii::app()->getBaseUrl(); ?>/images/opened.svg" />
			</a>
			<span class="right"></span>
		</h3>
		<div class="card-content">
			<?php foreach ($country->oblasts as $oblast) : ?>
				<?php if (count($oblast->existings) == 0) continue; ?>
				<div class="oblast-group">
					<h4>
						<input type="checkbox" title="<?php echo Yii::t('app', 'Select All') ?>" />
						<?php echo $oblast->name; ?>
					</h4>
					<div class="oblast-group-content">
						<?php foreach ($oblast->existings as $existing): ?>
							<div class="existing-row">
								<div class="existing-row-indicator checkbox">
									<?php echo CHtml::checkbox(
										'Order[indicators][' . $oblast->id . '][' . $existing->id_indicator . ']',
										!empty($model['indicators'][$oblast->id][$existing->id_indicator]),
										[ 'id' => 'ch_' . $oblast->id . '_' . $existing->id_indicator ]
									); ?>
									<?php echo CHtml::label($existing->idIndicator->name, 'ch_' . $oblast->id . '_' . $existing->id_indicator); ?>
								</div>
								<div class="existing-row-years years">
									<?php echo $form->dropDownList(
										$model,
										'year_start[' . $oblast->id . '][' . $existing->id_indicator . ']',
										$model->getYears($existing->min_year, $existing->max_year)
									); ?>
									-
									<?php echo $form->dropDownList(
										$model,
										'year_end[' . $oblast->id . '][' . $existing->id_indicator . ']',
										$model->getYears($existing->min_year, $existing->max_year)
									); ?>

								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endforeach; ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Submit'), ['class' => 'right w3-button']); ?>
</div>

<?php $this->endWidget(); ?>
</div>