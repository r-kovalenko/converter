<?php

mb_internal_encoding('UTF-8');

function mb_ucfirst($str)
{

	$fc = mb_strtoupper(mb_substr($str, 0, 1), 'UTF-8');

	return $fc . mb_substr($str, 1);

}