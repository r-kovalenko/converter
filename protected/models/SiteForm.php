<?php

/**
 * SiteForm class.
 * SiteForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SiteForm extends CFormModel
{
	public $number;

	public $number_max = 9999999999;

	public $converted_number = NULL;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('number', 'required'),
			array('number', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => $this->number_max),

		);
	}

	public function attributeLabels()
	{
		return array('number' => Yii::t('translate', 'Attribute') . ' ' . Yii::t('translate', 'Number'));
	}
	public function convertNumber()
	{

		$language = Yii::app()->getLanguage();

		$factory = new ConvertorFactory();
		$convertor = $factory->getConvertor($language);
		$this->converted_number = $convertor->doConvertion($this->number);


	}

}