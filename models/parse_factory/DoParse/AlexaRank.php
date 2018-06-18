<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:17
 */
class AlexaRank extends DoParse
{
	function __construct($domain, $key)
	{
		parent::__construct($domain, $key);
	}

	protected function getParser()
	{
		return new AlexaParser();
	}
	protected function getConnection()
	{
		return new XmlConnection();
	}
}