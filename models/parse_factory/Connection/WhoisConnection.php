<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:15
 */
class WhoisConnection implements iConnection
{
	public function connect($url, $domain)
	{

		$output = '';

		// split the TLD from domain name
		$_domain = explode('.', $domain);
		$lst = count($_domain)-1;
		$ext = $_domain[$lst];



		if(!isset($url[$ext])) die('Error: No matching nic server found!');

		$nic_server = $url[$ext];
		$output = '';

		// connect to whois server:
		if($conn = fsockopen ($nic_server, 43)) {
			fputs($conn, $domain."\r\n");
			while(!feof($conn)) $output .= fgets($conn,128);
			fclose($conn);
		} else {
			$output=false;
		}
		return $output;
	}

}