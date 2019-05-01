<?php

class ActiveRecord extends CActiveRecord
{
	public $name;

	protected function afterFind() {
	    $this->name = $this->{'name_' . Yii::app()->language};
	    parent::afterFind();
	} 	
}