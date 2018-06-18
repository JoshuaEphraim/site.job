<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:23
 */
class WhoisParser implements iParse
{
	public function parse($get){
		if(substr($get,0,8)=="No match"||substr($get,0,17)=="Whois Service not")
		{
			return NULL;
		}
		else {
			$who = explode('>>>', $get);
			$array1 = array();
			$w = nl2br($who[0]);
			$array2 = explode('<br />', $w);
			foreach ($array2 as $str) {
				list($key, $value) = explode(':', $str);
				$array1[$key] = $value;
			}

			return $array1;
		}
	}
}