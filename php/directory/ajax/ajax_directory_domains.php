<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 25.10.2017
 * Time: 20:27
 */
include_once('../../config.php');
include_once('../../function.php');
$usl = '';
$show_pages=10;
$this_page = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT);
$country=cleanText($_POST['country'],$db_c);
$rate=$_POST['rate'];
$db='dc_domain';
$count='*';
if($country!='All'&&$rate!='All')
{
    $db = 'dc_domain_comment';
    $condition = 'WHERE domain_id IN (SELECT domain_id FROM `dc_domain_comment` group by domain_id HAVING FLOOR(sum(rate)/count(comment))=5 AND domain_id IN
                    (SELECT domain_id FROM dc_parse_data WHERE JSON_EXTRACT(geo, \'$."geoplugin_countryName"\') = "United States"))';
    $where = 'WHERE JSON_EXTRACT(p.geo, \'$."geoplugin_countryName"\') = "' . $country . '"';
    $count = 'distinct domain_id';
}
else {
    if ($country != 'All') {
        $db = 'dc_parse_data';
        $condition = 'WHERE JSON_EXTRACT(geo, \'$."geoplugin_countryName"\') = "' . $country . '"';
        $where = 'WHERE JSON_EXTRACT(p.geo, \'$."geoplugin_countryName"\') = "' . $country . '"';
    }
    if ($rate != 'All') {
        $db = 'dc_domain_comment';
        $condition = 'WHERE domain_id IN (SELECT domain_id FROM `dc_domain_comment` group by domain_id HAVING FLOOR(sum(rate)/count(comment))=5)';
        $count = 'distinct domain_id';
    }
}
$pag = countPagination($this_page, $db, $db_c, $show_pages, $condition, $count);
$var=($country)?'WHERE JSON_EXTRACT(p.geo, \'$."geoplugin_countryName"\') = ".$country."':' ';
$row = $db_c->query('SELECT d.domain, count(c.comment) comments , sum(c.rate) sumR,
                      MAX(JSON_LENGTH(p.reverse_ip)) reverse_count FROM dc_domain d LEFT JOIN dc_domain_comment c ON d.id=c.domain_id 
                                                                                        
                                                                                        LEFT JOIN dc_parse_data p ON d.id=p.domain_id
                                                                                        '.$where.'
                                                                                      GROUP BY d.domain LIMIT ' . $pag['offset'] . ', ' . $show_pages);
$com1=array();

echo $db_c->error;
while($c = mysqli_fetch_array($row)) {
    $com1[]=$c;
}
if($rate!='All')
{
    foreach($com1 as $key=>$value)
    {
        if($value['comments']==0||floor($value['sumR']/$value['comments'])!=$rate)
        {
            unset($com1[$key]);
        }
    }
}
echo json_encode(array($com1,$pag));