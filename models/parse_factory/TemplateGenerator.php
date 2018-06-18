<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 23.11.2017
 * Time: 15:34
 */




class TemplateGenerator
{
	protected $d_id;
	protected $db_c;
	protected $domain;
	protected $servers;
	protected $pData;
	protected $parser;
	protected $textData;
	protected $screen;
	protected $xmlText;
	public function getDId()
	{
		return $this->d_id;
	}

	public function getDomain()
	{
		return $this->domain;
	}
	function __construct($db_c,$domain)
	{
		$domain_info = $db_c->query('SELECT * FROM `'.DBP.'domain` WHERE `domain` = "'.$domain.'"');
		$d = mysqli_fetch_array($domain_info);
		$this->d_id=$d['id'];
		$this->db_c=$db_c;
		$this->domain=$domain;
		$this->pData=$db_c->query('SELECT alexa_rank,whois,geo,reverse_ip,alexa_map,traffic FROM dc_parse_data WHERE domain_id="'.$d['id'].'"');
		$director=new Director();
		$this->parser=$director->getParseDataMaker($db_c->affected_rows);
		$this->textData=$director->getTextDataMaker($db_c,$d['id']);
		$this->screen=new GetScreenShot();
		$this->xmlText=new XmlTextGenerator();
	}
	public function getParseData()
	{
		return $this->filter($this->parser->makeData($this->db_c,$this->d_id,$this->pData,$this->domain));
	}
	public function getTextData()
	{
		return $this->textData->makeData();
	}
	public function getScreenShot($screen, $size)
	{
		return $this->screen->makeScreenShot($this->domain,$screen,$size);
	}
	public function getXmlText($param)
    {
	    return $this->xmlText->getXml($param);
    }
    private function filter($arr)
    {
        foreach($arr as $key=>$value)
        {
            switch($key){
            case 1:
                $arr[$key]=($value)?$value:'No whois data for this site.';
                break;
            case 3:
                $arr[$key]=($value)?$value:'No reverse ip for this site.';
                break;
            case 4:
                $arr[$key]=($value)?$value:'if(!ALEXA)
										var ALEXA={viewsHelpers:{}};
										if(!ALEXA.viewsHelpers.map)
										ALEXA.viewsHelpers.map={};
										ALEXA.viewsHelpers.map.div= "visitsMap";
										ALEXA.viewsHelpers.map.areas=[];';
                break;
            }
        }
        return $arr;
    }

}