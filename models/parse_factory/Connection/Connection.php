<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:14
 */
class Connection implements iConnection
{
	public function connect($url, $domain)
	{
		$url=$url.$domain;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.7.62 Version/11.01');
		$data = curl_exec($ch);
		$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if(curl_errno($ch) == 0 AND $http == 200) {
			curl_close($ch);
			return $data;
		}
		else
		{
			curl_close($ch);
			return false;
		}
	}
}