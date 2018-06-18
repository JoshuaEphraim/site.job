<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:10
 */
class dataFinder implements iDataWorker
{
	function __construct()
	{
	}
	public function makeData($db_c,$d_id,$pData,$domain)
	{
		$arr=$pData->fetch_assoc();
		$director=new Director();
		foreach($arr as $key=>$value)
		{
			if($value==NULL||$value=='{}')
			{
				if($key!='traffic') {
					$parsing =$director->getParse($domain,$key);
					$parse=$parsing->getData();
					$input=$db_c->real_escape_string(json_encode($parse));
					$db_c->query('UPDATE dc_parse_data SET "'.$key.'"="'.$input.'" WHERE domain_id="'.$d_id.'"');
					$get[]=$parse;
				}
			}
			else
			{
				$get[]=json_decode($value,true);
			}
		}

		return $get;
	}

}