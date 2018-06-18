<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 23.11.2017
 * Time: 15:42
 */




class Director
{
	function __construct()
	{
	}
	public function getParseDataMaker($db_c)
	{
		if($db_c)
		{
			return new dataFinder();
		}
		else
		{
			return new dataInserter();
		}
	}
	public function getTextDataMaker($db_c,$d_id)
	{
        $text = $db_c->query('SELECT t.text, t.type FROM '.DBP.'domain_text d, '.DBP.'text t WHERE d.domain_id = '.$d_id. ' AND d.text_id = t.id');
		if($text->num_rows >0){
			return new textSelector($text);
		}
		else
		{
			return new textInserter($db_c,$d_id);
		}
	}
	public function getParse($domain,$key)
	{
		switch($key){
		    case 'alexa_rank':
		        return new AlexaRank($domain,$key);
		        break;
            case 'whois':
                return new Whois($domain,$key);
                break;
            case 'geo':
                return new Geo($domain,$key);
                break;
            case 'reverse_ip':
                return new ReverseIp($domain,$key);
                break;
            case 'alexa_map':
                return new AlexaMap($domain,$key);
                break;
        }
	}


}