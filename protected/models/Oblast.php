<?php

/**
 * This is the model class for table "oblast".
 *
 * The followings are the available columns in table 'oblast':
 * @property integer $id
 * @property string $id_country
 * @property string $name_ru
 * @property string $name_en
 *
 * The followings are the available model relations:
 * @property Existings[] $existings
 * @property Country $idCountry
 */
class Oblast extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'oblast';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'unique'),
			array('id, id_country, name_ru, name_en', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('id_country', 'length', 'max'=>5),
			array('name_ru, name_en', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_country, name_ru, name_en', 'safe', 'on'=>'search'),
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
			'existings' => array(self::HAS_MANY, 'Existings', 'id_oblast'),
			'idCountry' => array(self::BELONGS_TO, 'Country', 'id_country'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'id_country' => Yii::t('app', 'ID Country'),
			'name' => Yii::t('app', 'Oblast'),
			'name_ru' => Yii::t('app', 'Name Ru'),
			'name_en' => Yii::t('app', 'Name En'),
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
		$criteria->compare('id_country',$this->id_country,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_en',$this->name_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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

	public function findExistByIndicator($id_indicator, $attr)
	{
		$existings = CHtml::listData($this->existings, 'id_indicator', $attr);
		return !empty($existings[$id_indicator]) ? $existings[$id_indicator] : '';
	}
}
