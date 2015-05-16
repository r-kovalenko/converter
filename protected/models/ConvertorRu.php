<?php

class ConvertorRu implements ConvertorInterface
{

	private $digits = array('один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять');
	private $tens = array('десять', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семдесят', 'восемдесят', 'девяносто');
	private $teens = array("одиннадцать", "двенадцать", "тринадцать", "четырнадцать", "пятнадцать", "шестнадцать", "семнадцать", "восемнадцать", "девятнадцать");
	private $hundreds = array('сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
	private $second_words = array(
		0 => array('тысяч', 'а', 'и', ''),
		1 => array('миллион', '', 'а', 'ов'),
		2 => array('миллиард', '', 'а', 'ов')
	);
	private $for_thousands = array('одна', 'две');

	public function doConvertion($number)
	{

		if ($number == 0) {
			return "ноль";
		}

		$converted_number = array();

		$arr_reverse_number = str_split(strrev(strval($number)));

		$portions = array_chunk($arr_reverse_number, 3);

		foreach ($portions as $key => $portion) {

			$temp = $this->convertThreeDigits($portion);

			if (is_array($temp)) {
				$temp_first_key = key($temp);
				if ($key > 0 and $key <= 3) {
					//присваиваем название без окончания
					$second_word = $this->second_words[$key - 1][0];
					$last_digit = $portion[0];
					//если это не 'надцать'
					if (!(isset($portion[1]) and $portion[1] == '1')) {
						switch ($last_digit) {
							case 1:
								$second_word .= $this->second_words[$key - 1][1];
								break;
							case 2:
							case 3:
								$second_word .= $this->second_words[$key - 1][2];
								break;
							default:
								$second_word .= $this->second_words[$key - 1][3];
						}
						if ($key == 1 and isset($this->for_thousands[$last_digit - 1])) {
							$temp[0] = $this->for_thousands[$last_digit - 1];
						}
					}
					$temp[$temp_first_key] .= ' ' . $second_word;
				}

				$converted_number = array_merge($converted_number, $temp);
			}

		}

		return implode(array_reverse($converted_number), ' ');
	}

	public function convertThreeDigits(array $arr_reverse_number)
	{

		$result = array();

		$prev = NULL;

		foreach ($arr_reverse_number as $pos => $digit) {

			if (($pos == 0 or $pos == 2) and $digit != '0') {
				$result[$pos] = $this->digits[$digit - 1];
			}

			if ($pos == 1 and $digit != '0') {
				$result[$pos] = $this->tens[$digit - 1];
			}

			if ($pos == 1 and $digit == 1 and $prev != 0) {
				$result[0] = $this->teens[$prev - 1];
				$result[$pos] = '';
			}

			if ($pos == 2 and $digit != '0') {
				$result[$pos] = $this->hundreds[$digit - 1];
			}

			$prev = $digit;

		}

		return $result;

	}

}