<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 19.11.2017
 * Time: 22:33
 */
include_once('../../config.php');
$pData=$db_c->query('SELECT traffic FROM dc_parse_data WHERE traffic IS NOT NULL ');
$getTraffic=array(date('Y-m-d',mktime(0, 0, 0, date("m")-6, 1, date("Y")))=>0,
    date('Y-m-d',mktime(0, 0, 0, date("m")-5, 1,   date("Y")))=>0,
    date('Y-m-d',mktime(0, 0, 0, date("m")-4, 1,   date("Y")))=>0,
    date('Y-m-d',mktime(0, 0, 0, date("m")-3, 1,   date("Y")))=>0,
    date('Y-m-d',mktime(0, 0, 0, date("m")-2, 1,   date("Y")))=>0,
    date('Y-m-d',mktime(0, 0, 0, date("m")-1, 1,   date("Y")))=>0);
while($c=$pData->fetch_assoc())
{
    foreach (json_decode($c['traffic']) as $key=>$value)
    {

        $getTraffic[$key]+=$value;
    }
}
foreach ($getTraffic as $key=>$value)
{
    $tDate[]=$key;
    $traffic[]=($value!=0)?$value:NULL;
}
echo json_encode(array($tDate,$traffic));