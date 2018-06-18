<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:19
 */
class ReverseIp extends DoParse
{
	function __construct($domain, $key)
	{
		$domain = gethostbyname($domain);
		parent::__construct($domain, $key);
	}
	protected function getParser()
	{
		return new ReverseIpParser();
	}
	protected function getConnection()
	{
		return new Connection();
	}
}