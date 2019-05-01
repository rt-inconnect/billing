<?php

class Order extends CActiveRecord
{
	public $years;

	const STATUS_NEW = 0;
	const STATUS_PROCESS = 1;
	const STATUS_FINISHED = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, fio, indicators, year_start, year_end', 'required'),
			array('status', 'safe'),
			array('id, email, fio, status, total, createdAt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'email' => Yii::t('app', 'E-mail'),
			'fio' => Yii::t('app', 'Full Name'),
			'indicators' => Yii::t('app', 'Select Indicators'),
			'years' => Yii::t('app', 'Select Years'),
			'status' => Yii::t('app', 'Status'),
			'createdAt' => Yii::t('app', 'Created At'),
			'total' => Yii::t('app', 'Total Cost'),
		);
	}

	public function statuses()
	{
		return [
			self::STATUS_NEW => Yii::t('app', 'New'),
			self::STATUS_PROCESS => Yii::t('app', 'Processing'),
			self::STATUS_FINISHED => Yii::t('app', 'Finished'),
		];
	}

	public function getYears($start, $end)
	{
		$results = [];
		for ($i = $start; $i <= $end; $i++) {
			$results[$i] = $i;
		}
		return $results;
	}

	public function populate()
	{
		$results = [];
		$price = Settings::model()->findByPk('PRICE');
		$oblasts = Oblast::model()->findAll();
		$indicators = CHtml::listData(Indicator::model()->findAll(), 'id', 'name');
		foreach ($oblasts as $oblast) {
			if (empty($this->indicators[$oblast->id])) continue;
			$record = [
				'price' => 0,
				'idCountry' => $oblast->id_country,
				'nameCountry' => $oblast->idCountry->name,
				'idOblast' => $oblast->id,
				'nameOblast' => $oblast->name,
				'indicators' => [],
			];
			foreach ($this->indicators[$oblast->id] as $idIndicator => $checked) {
				$year_start = $this->year_start[$oblast->id][$idIndicator];
				$year_end = $this->year_end[$oblast->id][$idIndicator];
				$total = ($year_end - $year_start + 1) * $price->value;
				$record['indicators'][] = [
					'price' => $total,
					'id' => $idIndicator,
					'name' => $indicators[$idIndicator],
					'year_start' => $year_start,
					'year_end' => $year_end,
				];
				$record['price'] += $total;
			}
			$results[] = $record;
		}

		return $this->groupByCountry($results);
	}

	public function groupByCountry($oblasts)
	{
		$results = [];
		foreach ($oblasts as $oblast) {
			if (empty($results[$oblast['idCountry']])) {
				$results[$oblast['idCountry']] = [
					'price' => 0,
					'id' => $oblast['idCountry'],
					'name' => $oblast['nameCountry'],
					'oblasts' => [],
				];
			}

			$results[$oblast['idCountry']]['oblasts'][] = [
				'price' => $oblast['price'],
				'id' => $oblast['idOblast'],
				'name' => $oblast['nameOblast'],
				'indicators' => $oblast['indicators'],
			];

			$results[$oblast['idCountry']]['price'] += $oblast['price'];
		}
		return array_values($results);
	}

	public function calculateTotal($results)
	{
		$total = 0;
		foreach ($results as $country) {
			$total += $country['price'];
		}

		return $total;
	}

	public function reduceYearValues($model)
	{
		$yearEnd = [];
		$yearStart = [];
		foreach ($model->indicators as $idOblast => $indicators) {
			$selection[$idOblast] = array_keys($indicators);
			foreach (array_keys($indicators) as $idIndicator) {
				if (empty($yearEnd[$idOblast])) $yearEnd[$idOblast] = [];
				if (empty($yearStart[$idOblast])) $yearStart[$idOblast] = [];
				$yearEnd[$idOblast][$idIndicator] = $model->year_end[$idOblast][$idIndicator];
				$yearStart[$idOblast][$idIndicator] = $model->year_start[$idOblast][$idIndicator];
			}
		}
		$model->year_end = $yearEnd;
		$model->year_start = $yearStart;
		return $model;
	}

	public function saveOrder()
	{
		$model = new Order;
		$model->attributes = $_POST['Order'];
		$model = $model->reduceYearValues($model);
		$model->total = $model->calculateTotal($model->populate());
		$model->indicators = json_encode($model->indicators);
		$model->year_start = json_encode($model->year_start);
		$model->year_end = json_encode($model->year_end);
		return $model->save();
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('createdAt',$this->createdAt,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		    'sort' => array(
		        'defaultOrder' => 'id DESC',
		    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Oblast the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
