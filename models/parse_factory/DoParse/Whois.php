<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:18
 */
class Whois extends DoParse
{
	function __construct($domain, $key)
	{
		$domain = strtolower(trim($domain));
		$domain = preg_replace('/^http:\/\//i', '', $domain);
		$domain = preg_replace('/^www\./i', '', $domain);
		$domain = explode('/', $domain);
		$domain = trim($domain[0]);
		parent::__construct($domain, $key);
	}
	protected function getParser()
	{
		return new WhoisParser();
	}
	protected function getConnection()
	{
		return new WhoisConnection();
	}
}