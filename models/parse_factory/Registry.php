<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 24.11.2017
 * Time: 0:33
 */




class Registry
{
    protected static $data = array('alexa_rank'=>'http://data.alexa.com/data?cli=10&dat=snbamz&url=',
                                    'whois'=>array(
                                        "biz" => "whois.neulevel.biz",
                                        "com" => "whois.internic.net",
                                        "us" => "whois.nic.us",
                                        "coop" => "whois.nic.coop",
                                        "info" => "whois.nic.info",
                                        "name" => "whois.nic.name",
                                        "net" => "whois.internic.net",
                                        "gov" => "whois.nic.gov",
                                        "edu" => "whois.internic.net",
                                        "mil" => "rs.internic.net",
                                        "int" => "whois.iana.org",
                                        "ac" => "whois.nic.ac",
                                        "ae" => "whois.uaenic.ae",
                                        "at" => "whois.ripe.net",
                                        "au" => "whois.aunic.net",
                                        "be" => "whois.dns.be",
                                        "bg" => "whois.ripe.net",
                                        "br" => "whois.registro.br",
                                        "bz" => "whois.belizenic.bz",
                                        "ca" => "whois.cira.ca",
                                        "cc" => "whois.nic.cc",
                                        "ch" => "whois.nic.ch",
                                        "cl" => "whois.nic.cl",
                                        "cn" => "whois.cnnic.net.cn",
                                        "cz" => "whois.nic.cz",
                                        "de" => "whois.nic.de",
                                        "fr" => "whois.nic.fr",
                                        "hu" => "whois.nic.hu",
                                        "ie" => "whois.domainregistry.ie",
                                        "il" => "whois.isoc.org.il",
                                        "in" => "whois.ncst.ernet.in",
                                        "ir" => "whois.nic.ir",
                                        "mc" => "whois.ripe.net",
                                        "to" => "whois.tonic.to",
                                        "tv" => "whois.tv",
                                        "ru" => "whois.ripn.net",
                                        "org" => "whois.pir.org",
                                        "aero" => "whois.information.aero",
                                        "nl" => "whois.domain-registry.nl",
                                        "io" => "whois.nic.io",
                                        "ua"=> "whois.imena.ua"),
                                    'geo'=>'http://www.geoplugin.net/php.gp?ip=',
                                    'reverse_ip'=>'http://website.informer.com/',
                                    'alexa_map'=>'https://www.alexa.com/siteinfo/');
    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }
    public static function get($key)
    {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }
    final public static function removeProduct($key)
    {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}