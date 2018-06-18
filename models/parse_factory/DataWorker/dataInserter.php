<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:12
 */
class dataInserter implements iDataWorker
{
	function __construct()
	{
	}
	public function makeData($db_c,$d_id,$pData,$domain)
	{
		$arr = array('alexa_rank','whois','geo','reverse_ip','alexa_map');
		$director=new Director();
		foreach($arr as $value)
		{

			$parsing =$director->getParse($domain,$value);
			$parse=$parsing->getData();
			($parse != NULL) ? $get[] = $parse : $get[] = NULL;

		}
		$db_c->query('INSERT IGNORE INTO dc_parse_data (domain_id,alexa_rank,whois,geo,reverse_ip,alexa_map) VALUES 
						("' . $d_id . '","' . $db_c->real_escape_string(json_encode($get[0])) . '",
						"' . $db_c->real_escape_string(json_encode($get[1])) . '",
						"' . $db_c->real_escape_string(json_encode($get[2])) . '",
						"' . $db_c->real_escape_string(json_encode($get[3])) . '",
						"' . $db_c->real_escape_string(json_encode($get[4])) . '")');

		return $get;
	}

}