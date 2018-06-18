<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:19
 */
class AlexaMap extends DoParse
{
	function __construct($domain, $key)
	{
		$domain=mb_strtolower($domain);
		parent::__construct($domain, $key);
	}
	protected function getParser()
	{
		return new AlexaMapParser();
	}
	protected function getConnection()
	{
		return new Connection();
	}
}