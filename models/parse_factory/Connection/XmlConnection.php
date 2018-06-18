<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:15
 */
class XmlConnection implements iConnection
{
	public function connect($url, $domain)
	{
		$url=$url.$domain;
		$xml = simplexml_load_file($url);
		if($xml) {
			return $xml;
		}
		else
		{
			return false;
		}
	}
}