<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:23
 */
class GeoParser implements iParse
{
	public function parse($get){
		$meta = unserialize($get);
		return $meta;
	}
}