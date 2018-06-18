<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:24
 */
class AlexaMapParser implements iParse
{
	public function parse($get){
		$pos1 = strpos($get, 'if(!ALEXA)');
		$pos2 = strpos($get, '//-->', $pos1);
		$pos = substr($get, $pos1, $pos2 - $pos1);
		if (!empty($pos)) {
			return $pos;
		}
		else
		{
			return NULL;
		}
	}
}