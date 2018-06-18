<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16.11.2017
 * Time: 11:39
 */
include_once('../../config.php');
$country=$db_c->query('SELECT distinct JSON_EXTRACT(geo, \'$."geoplugin_countryName"\')  country FROM `dc_parse_data`');
$rate=$db_c->query('SELECT distinct FLOOR(sum(rate)/count(comment)) rate FROM `dc_domain_comment` group by domain_id');
echo $db_c->error;
$com1=array();
$com2=array();
while($c = mysqli_fetch_array($country)) {
	$com1[]=$c;
}
while($c = mysqli_fetch_array($rate)) {
	$com2[]=$c;
}
foreach($com1 as $key=>$value)
{
	if($value['country']=='null'||$value['country']==NULL)
	{
		unset($com1[$key]);
	}
}
echo json_encode(array($com1,$com2));