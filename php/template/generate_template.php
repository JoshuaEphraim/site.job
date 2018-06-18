<?php
	/*GENERATOR START*/
	/*
		PUT THIS CODE BEFORE TEMPLATE CODE
		IN TEMPLATE YOU CAN USE VARIABLES FROM THIS CODE
	*/
	include_once($_SERVER['DOCUMENT_ROOT'].'/php/config.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/php/autoload.php');

	$time = time();

	$generator=new TemplateGenerator($db_c,$_POST['domain']);
	$d_id=$generator->getDId();
	if(!isset($d_id)){ echo '404'; exit;}
	$text_list=$generator->getTextData();

	$parsing=$generator->getParseData();
	
	$alexaRank=$parsing[0];
	$whois=$parsing[1];
	$geo=$parsing[2];
	$reverseIp=$parsing[3];
	$alexaMap=$parsing[4];
	$getTraffic=new TrafficPainter($parsing[5]);
	if(!file_exists("public/Template/img/'.$generator->getDomain().'.jpeg")) {
		$scrin=$generator->getScreenShot('1024x768', 313);
	}




	$header_text =$generator->getXmlText('header');
	$footer_text =$generator->getXmlText('footer');

    $dom=explode('.',$generator->getDomain());
    $printFirstElement=array_shift($dom);

	echo $time.PHP_EOL;
	/*GENRATOR END*/

include '../../public/Template/index.tpl';
?>

























