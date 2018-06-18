<?php

/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 24.11.2017
 * Time: 23:09
 */
class XmlTextGenerator
{
    protected $array;
    function __construct()
    {
        $xml = file_get_contents('text.xml');
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $this->array = json_decode($json,TRUE);
    }
    public function getXml($param)
    {
        $text = '';

        foreach($this->array['block'] as $k => $v){
            if($param==$v["@attributes"]['name']){

                $rand_keys = array_rand($v["text"], 3);
                foreach($rand_keys as $ke){$text.=$v["text"][$ke];}

                break;
            }
        }

        return $text;
    }
}