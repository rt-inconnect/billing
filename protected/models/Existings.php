<?php

/**
 * This is the model class for table "existings".
 *
 * The followings are the available columns in table 'existings':
 * @property integer $id
 * @property integer $id_oblast
 * @property string $id_indicator
 * @property integer $min_year
 * @property integer $max_year
 *
 * The followings are the available model relations:
 * @property Oblast $idOblast
 * @property Indicator $idIndicator
 */
class Existings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'existings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_oblast, id_indicator, min_year, max_year', 'required'),
			array('id_oblast, min_year, max_year', 'numerical', 'integerOnly'=>true),
			array('id_indicator', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_oblast, id_indicator, min_year, max_year', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idOblast' => array(self::BELONGS_TO, 'Oblast', 'id_oblast'),
			'idIndicator' => array(self::BELONGS_TO, 'Indicator', 'id_indicator'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'id_oblast' => Yii::t('app', 'ID Oblast'),
			'id_indicator' => Yii::t('app', 'ID Indicator'),
			'min_year' => Yii::t('app', 'Min Year'),
			'max_year' => Yii::t('app', 'Max Year'),
		);
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_oblast',$this->id_oblast);
		$criteria->compare('id_indicator',$this->id_indicator,true);
		$criteria->compare('min_year',$this->min_year);
		$criteria->compare('max_year',$this->max_year);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Existings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
