<?php


include_once('config.php');
$pData=$db_c->query('SELECT d.domain,p.domain_id FROM dc_domain d LEFT JOIN dc_parse_data p ON d.id=p.domain_id WHERE p.traffic IS NULL  
						ORDER by case when JSON_EXTRACT(alexa_rank, \'$."0"."0"\')+0 is null then 2
						        when JSON_EXTRACT(alexa_rank, \'$."0"."0"\')+0 = \'\' then 1
						        Else 0 end, JSON_EXTRACT(alexa_rank, \'$."0"."0"\')+0');
if($db_c->affected_rows)
{
	$arr=$pData->fetch_assoc();
	$traffic=getTraffic($arr['domain']);
	$traffic=($traffic)?$traffic:'{}';
	$domain=$arr['domain'];
	$input=($traffic)?$db_c->real_escape_string($traffic):$traffic;
	$db_c->query('UPDATE dc_parse_data SET traffic="'.$input.'" WHERE domain_id="'.$arr['domain_id'].'"');
	$f = fopen('traffic.txt', 'a');
	if (!empty($f)) {
		$d=date("Y-m-d H:i:s");
		$err  = "$d $traffic for $domain\r\n";
		fwrite($f, $err);
		fclose($f);
	}
}
function getTraffic($domain)
{
    $domain=mb_strtolower($domain);

	$con=connection("https://www.similarweb.com/website/".$domain);
	if($con) {
		$pos1 = strpos($con, '"WeeklyTrafficNumbers":{');
		$pos2 = strpos($con, '},"', $pos1);
		$pos = substr($con, $pos1, $pos2 - $pos1);
		$pos3 = strpos($pos, '{');
		$jsun = substr($pos, $pos3);
		if(!empty($jsun)) {
			return $jsun;
		}
		else
		{
			return NULL;
		}
	}
	else
	{
		return NULL;
	}

}

function connection($url)
{
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

