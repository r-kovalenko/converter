<?php

/**
 * SiteForm class.
 * SiteForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SiteForm extends CFormModel
{
	public $number;

	public $converted_number = NULL;
	private $digits_en = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');
	private $tens_en = array('ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety');
	private $teens_en = array("eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen");
	private $second_words_en = array(
		0 => 'hundred', 1 => 'thousand', 2 => 'million', 3 => 'billion'
	);

	private $digits_ru = array('один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять');
	private $tens_ru = array('десять', 'двадцать', 'тридцат', 'сорок', 'пятьдесят', 'шестьдесят', 'семдесят', 'восемдесят', 'девяносто');
	private $teens_ru = array("одиннадцать", "двенадцать", "тринадцать", "четырнадцать", "пятнадцать", "шестнадцать", "семнадцать", "восемнадцать", "девятнадцать");

	private $second_words_ru = array(
		0 => 'сто', 1 => 'тысяча', 2 => 'миллион', 3 => 'миллиард'
	);


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('number', 'required'),
			// email has to be a valid email address
			array('number', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999999),

		);
	}

	public function convertNumber()
	{

		$language = Yii::app()->language;

		if ($language == 'ru') {
			$this->_doConvertionRu();
		} else {
			$this->_doConvertionEn();
		}

	}

	protected function _doConvertionRu()
	{
		$this->_doConvertionEn();
	}

	protected function _doConvertionEn()
	{
		$number = $this->number;
		if ($number > 9999999999) {
			$this->converted_number = "$number is too much, try smaller number (<10000)";
		} elseif ($number == 0) {
			$this->converted_number = "zero";
		}

		if (!$this->converted_number) {
			$result = array();

			$arr_reverse_number = str_split(strrev(strval($number)));

			$portions = array_chunk($arr_reverse_number, 3);

			foreach ($portions as $key => $portion) {

				$temp = $this->convertThreeDigits($portion);

				if (is_array($temp)) {
					if ($key > 0 and $key < 3) {
						$temp[0] = $temp[0] . ' ' . $this->second_words_ru[$key];
					}

					$result = array_merge($result, $temp);
				}

			}

			$this->converted_number = implode(array_reverse($result), ' ');
		}
	}

	public function convertThreeDigits($arr_reverse_number)
	{

		$result = array();

		$prev = NULL;

		foreach ($arr_reverse_number as $pos => $digit) {

			if ($pos == 0 and $digit != '0') {
				$result[0] = $this->digits_ru[$digit - 1];
			}

			if ($pos == 1 and $digit != '0') {
				$result[$pos] = $this->tens_ru[$digit - 1];
			}

			if ($pos == 1 and $digit == 1) {
				$result[0] = '';
				$result[$pos] = $this->teens_ru[$prev - 1];
			}

			if ($pos > 1 and $digit != '0') {
				$result[$pos] = $this->digits_ru[$digit - 1];
			}

			if ($pos == 2 and $digit != '0') {
				$result[$pos] = $result[$pos] . ' ' . $this->second_words_ru[0];
			}

			$prev = $digit;

		}

		return $result;

	}

}