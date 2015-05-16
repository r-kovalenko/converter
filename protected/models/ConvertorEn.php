<?php

class ConvertorEn implements ConvertorInterface
{

	private $digits = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');
	private $tens = array('ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety');
	private $teens = array("eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen");
	private $second_words = array(
		0 => 'hundred', 1 => 'thousand', 2 => 'million', 3 => 'billion', 4 => 'trillion', 5 => 'quadrillion', 6 => 'quintillion', 7 => 'sextillion'
	);

	public function doConvertion($number)
	{

		if ($number == 0) {
			return "zero";
		}

		$converted_number = array();

		$arr_reverse_number = str_split(strrev(strval($number)));

		$portions = array_chunk($arr_reverse_number, 3);

		foreach ($portions as $key => $portion) {

			$temp = $this->convertThreeDigits($portion);

			if (is_array($temp)) {
				$temp_first_key = key($temp);
				if ($key > 0 and $key <= 3) {
					$temp[$temp_first_key] .= ' ' . $this->second_words[$key];
				}
				//replece with hyphen
				if (isset($portion[1]) and $portion[1] >= 2 and isset($portion[0]) and $portion[0] > 0) {
					$temp[$temp_first_key] = $temp[$temp_first_key + 1] . '-' . $temp[$temp_first_key];
					unset($temp[$temp_first_key + 1]);
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
				$result[0] = '';
				$result[$pos] = $this->teens[$prev - 1];
			}

			if ($pos == 2 and $digit != '0') {
				$result[$pos] .= ' ' . $this->second_words[0];
			}

			$prev = $digit;

		}

		return $result;

	}

}