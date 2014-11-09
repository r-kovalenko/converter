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

	private $digits_en = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');
	private $tens_en = array('ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety');
	private $teens_en = array("eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen");
	private $second_words_en = array(
		0 => 'hundred', 1 => 'thousand', 2 => 'million', 3 => 'billion', 4 => 'trillion', 5 => 'quadrillion', 6 => 'quintillion', 7 => 'sextillion'
	);

	private $digits_ru = array('один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять');
	private $tens_ru = array('десять', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семдесят', 'восемдесят', 'девяносто');
	private $teens_ru = array("одиннадцать", "двенадцать", "тринадцать", "четырнадцать", "пятнадцать", "шестнадцать", "семнадцать", "восемнадцать", "девятнадцать");
	private $hundreds_ru = array('сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
	private $second_words_ru = array(
		0 => array('тысяч', 'а', 'и', ''),
		1 => array('миллион', '', 'а', 'ов'),
		2 => array('миллиард', '', 'а', 'ов')
	);
	private $for_thousands_ru = array('одна', 'две');

	private $digits_uk = array('один', 'два', 'три', 'четири', 'п\'ять', 'шість', 'сім', 'вісім', 'дев\'ять');
	private $tens_uk = array('десять', 'двадцять', 'тридцять', 'сорок', 'п\'ятдесят', 'шістдесят', 'сімдесят', 'вісімдесят', 'дев\'яносто');
	private $teens_uk = array('одинадцять', 'дванадцять', 'тринадцять', 'чотирнадцять', 'п\'ятнадцять', 'шістнадцять', 'сімнадцять', 'вісімнадцять', 'дев\'ятнадцять');
	private $hundreds_uk = array('сто', 'двісті', 'триста', 'чотириста', 'п\'ятсот', 'шістсот', 'сімсот', 'вісімсот', 'дев\'ятсот');
	private $second_words_uk = array(
		0 => array('тисяч', 'а', 'і', ''),
		1 => array('мильйон', '', 'а', 'ів'),
		2 => array('мильярд', '', 'а', 'ів')
	);
	private $for_thousands_uk = array('одна', 'дві');


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
		$method = '_doConvertion' . ucfirst($language);

		if (method_exists($this, $method)) {
			$this->$method();
		}


	}


	protected function _doConvertionEn()
	{
		$number = $this->number;

		if ($number == 0) {
			$this->converted_number = "zero";
		}

		if (!$this->converted_number) {
			$result = array();

			$arr_reverse_number = str_split(strrev(strval($number)));

			$portions = array_chunk($arr_reverse_number, 3);

			foreach ($portions as $key => $portion) {

				$temp = $this->convertThreeDigitsEn($portion);

				if (is_array($temp)) {
					if ($key > 0 and $key <= 3) {
						$temp[0] .= ' ' . $this->second_words_en[$key];
					}
					//replece with hyphen
					if (isset($portion[1]) and $portion[1] > 1) {
						$temp[0] = $temp[1] . '-' . $temp[0];
						unset($temp[1]);
					}

					$result = array_merge($result, $temp);
				}

			}

			$this->converted_number = implode(array_reverse($result), ' ');
		}
	}

	protected function _doConvertionRu()
	{
		$number = $this->number;

		if ($number == 0) {
			$this->converted_number = "ноль";
		}

		if (!$this->converted_number) {
			$result = array();

			$arr_reverse_number = str_split(strrev(strval($number)));

			$portions = array_chunk($arr_reverse_number, 3);

			foreach ($portions as $key => $portion) {

				$temp = $this->convertThreeDigitsRu($portion);

				if (is_array($temp)) {
					if ($key > 0 and $key <= 3) {
						//присваиваем название без окончания
						$second_word = $this->second_words_ru[$key - 1][0];
						$last_digit = $portion[0];
						//если это не 'надцать'
						if (!(isset($portion[1]) and $portion[1] == '1')) {
							switch ($last_digit) {
								case 1:
									$second_word .= $this->second_words_ru[$key - 1][1];
									break;
								case 2:
								case 3:
									$second_word .= $this->second_words_ru[$key - 1][2];
									break;
								default:
									$second_word .= $this->second_words_ru[$key - 1][3];
							}
							if ($key == 1 and isset($this->for_thousands_ru[$last_digit - 1])) {
								$temp[0] = $this->for_thousands_ru[$last_digit - 1];
							}
						}
						$temp[0] = $temp[0] . ' ' . $second_word;
					}

					$result = array_merge($result, $temp);
				}

			}

			$this->converted_number = implode(array_reverse($result), ' ');
		}
	}

	public function convertThreeDigitsRu($arr_reverse_number)
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
				$result[0] = $this->teens_uk[$prev - 1];
				$result[$pos] = '';
			}

			if ($pos > 1 and $digit != '0') {
				$result[$pos] = $this->digits_ru[$digit - 1];
			}

			if ($pos == 2 and $digit != '0') {
				$result[$pos] = $this->hundreds_ru[$digit - 1];
			}

			$prev = $digit;

		}

		return $result;

	}

	public function convertThreeDigitsEn($arr_reverse_number)
	{

		$result = array();

		$prev = NULL;

		foreach ($arr_reverse_number as $pos => $digit) {

			if ($pos == 0 and $digit != '0') {
				$result[0] = $this->digits_en[$digit - 1];
			}

			if ($pos == 1 and $digit != '0') {
				$result[$pos] = $this->tens_en[$digit - 1];
			}

			if ($pos == 1 and $digit == 1) {
				$result[0] = '';
				$result[$pos] = $this->teens_en[$prev - 1];
			}

			if ($pos > 1 and $digit != '0') {
				$result[$pos] = $this->digits_en[$digit - 1];
			}

			if ($pos == 2 and $digit != '0') {
				$result[$pos] = $result[$pos] . ' ' . $this->second_words_en[0];
			}

			$prev = $digit;

		}

		return $result;

	}

	protected function _doConvertionUk()
	{
		$number = $this->number;

		if ($number == 0) {
			$this->converted_number = "нуль";
		}

		if (!$this->converted_number) {
			$result = array();

			$arr_reverse_number = str_split(strrev(strval($number)));

			$portions = array_chunk($arr_reverse_number, 3);

			foreach ($portions as $key => $portion) {

				$temp = $this->convertThreeDigitsUk($portion);

				if (is_array($temp)) {
					if ($key > 0 and $key <= 3) {
						//присваиваем название без окончания
						$second_word = $this->second_words_uk[$key - 1][0];
						$last_digit = $portion[0];
						//если это не 'надцать'
						if (!(isset($portion[1]) and $portion[1] == '1')) {
							switch ($last_digit) {
								case 1:
									$second_word .= $this->second_words_uk[$key - 1][1];
									break;
								case 2:
								case 3:
									$second_word .= $this->second_words_uk[$key - 1][2];
									break;
								default:
									$second_word .= $this->second_words_uk[$key - 1][3];
							}
							if ($key == 1 and isset($this->for_thousands_uk[$last_digit - 1])) {
								$temp[0] = $this->for_thousands_uk[$last_digit - 1];
							}
						}
						$temp[0] = $temp[0] . ' ' . $second_word;
					}

					$result = array_merge($result, $temp);
				}

			}

			$this->converted_number = implode(array_reverse($result), ' ');
		}
	}

	public function convertThreeDigitsUk($arr_reverse_number)
	{

		$result = array();

		$prev = NULL;

		foreach ($arr_reverse_number as $pos => $digit) {

			if ($pos == 0 and $digit != '0') {
				$result[0] = $this->digits_uk[$digit - 1];
			}

			if ($pos == 1 and $digit != '0') {
				$result[$pos] = $this->tens_uk[$digit - 1];
			}

			if ($pos == 1 and $digit == 1) {
				$result[0] = $this->teens_uk[$prev - 1];
				$result[$pos] = '';
			}

			if ($pos > 1 and $digit != '0') {
				$result[$pos] = $this->digits_uk[$digit - 1];
			}

			if ($pos == 2 and $digit != '0') {
				$result[$pos] = $this->hundreds_uk[$digit - 1];
			}

			$prev = $digit;

		}

		return $result;

	}
}