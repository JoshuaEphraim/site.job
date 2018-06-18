<?php
$url =$_SERVER['REQUEST_URI'];
$url=explode("/",urldecode($url));

$rout=array('directory','featured','blog','about');

(in_array($url[2],$rout)) ? $connect=$url[2] : $connect = 'sites';