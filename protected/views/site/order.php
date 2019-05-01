<?php
	$countries = $model->populate();
	$currency = Settings::model()->findByPk('CURRENCY');
	$total = $model->calculateTotal($countries);
?>

<style type="text/css">
	/*
	Generic Styling, for Desktops/Laptops
	*/
	table {
	  width: 100%;
	  border-collapse: collapse;
	}
	/* Zebra striping */
	tr:nth-of-type(odd) {
	  background: #eee;
	}
	th {
	  background: #333;
	  color: white;
	  font-weight: bold;
	}
	td, th {
	  padding: 5px 10px;
	  border: 1px solid #ccc;
	  text-align: left;
	}
</style>

<div style="font-family: freesans;">
<table>
	<thead>
		<tr>
			<th><?php echo Yii::t('app', 'Oblast') ?></th>
			<th><?php echo Yii::t('app', 'Indicators') ?></th>
			<th><?php echo Yii::t('app', 'Price') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($countries as $i => $country): ?>
		<tr>
			<td colspan="2" style="font-weight: bold;"><?php echo $country['name']; ?></td>
			<td style="font-weight: bold; text-align: right;"><?php echo $country['price']; ?></td>
		</tr>
		<?php foreach ($country['oblasts'] as $oblast): ?>
			<tr>
				<td style="width: 200px; padding-left: 20px;"><?php echo $oblast['name']; ?></td>
				<td style="width: 300px;">
					<?php foreach ($oblast['indicators'] as $indicator): ?>
						<p style="margin: 0; margin-bottom: 5px;"><?php echo $indicator['name'] . ' (' . $indicator['year_start'] . ' - ' . $indicator['year_end'] . ')' ?> </p>
					<?php endforeach; ?>
				</td>
				<td style="text-align: right;"><?php echo $oblast['price']; ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<th><?php echo Yii::t('app', 'Total'); ?></th>
			<th></th>
			<th style="text-align: right;"><?php echo $total; ?> <?php echo $currency->value; ?></th>
		</tr>
	</tfoot>

</table>
</div>