<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 24.11.2017
 * Time: 0:14
 */




abstract class DoParse
{
    protected $connection;
    protected $parser;
    protected $url;
    protected $domain;
    function __construct($domain,$key)
    {
        $this->connection=$this->getConnection();
        $this->parser=$this->getParser();
        $this->url=Registry::get($key);
        $this->domain=$domain;
    }

    public function getData()
    {
        $get=$this->connection->connect($this->url,$this->domain);
        if($get) {
            return $this->parser->parse($get);
            }
        else {
            return NULL;
        }
    }
    abstract protected function getParser();
    abstract protected function getConnection();
}




