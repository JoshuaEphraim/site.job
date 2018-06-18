<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:22
 */
class AlexaParser implements iParse
{
	public function parse($get){
		$alexaRank=isset($get->SD[1]->POPULARITY)?$get->SD[1]->POPULARITY->attributes()->TEXT:'-';
		$alexaDelta=isset($get->SD[1]->RANK)?$get->SD[1]->RANK->attributes()->DELTA:'-';
		$alexaUS=isset($get->SD[1]->COUNTRY)?$get->SD[1]->COUNTRY->attributes()->RANK:'-';
		($alexaDelta>0)?$dinamik="Declined":$dinamik="Improved";
		return array($alexaRank, $alexaDelta, $alexaUS, 'dinamik'=>$dinamik);
	}
}