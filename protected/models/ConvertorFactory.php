<?php

class ConvertorFactory
{

	public function getConvertor($language)
	{

		$class = 'Convertor' . ucfirst($language);
		return new $class;

	}

}