<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 25.10.2017
 * Time: 20:27
 */
include_once('../../config.php');
include_once('../../function.php');
$row1 = $db_c->query('SELECT d.domain, count(c.comment) comments , sum(c.rate) sumR,
                      MAX(JSON_LENGTH(p.reverse_ip)) reverse_count FROM dc_domain d LEFT JOIN dc_domain_comment c ON d.id=c.domain_id 
                                                                                        
                                                                                        LEFT JOIN dc_parse_data p ON d.id=p.domain_id
                                                                                      GROUP BY d.domain HAVING comments!=0 ORDER BY sum(c.rate)/count(c.comment) DESC LIMIT 10');
echo $db_c->error;
$row2 = $db_c->query('SELECT d.domain, count(c.comment) comments , sum(c.rate) sumR,
                      MAX(JSON_LENGTH(p.reverse_ip)) reverse_count FROM dc_domain d LEFT JOIN dc_domain_comment c ON d.id=c.domain_id 
                                                                                        
                                                                                        LEFT JOIN dc_parse_data p ON d.id=p.domain_id
                                                                                      GROUP BY d.domain HAVING comments!=0 ORDER BY comments DESC LIMIT 10');

while($c = mysqli_fetch_array($row1)) {
    $dom1[]=$c;
}
while($c = mysqli_fetch_array($row2)) {
    $dom2[]=$c;
}
echo json_encode(array($dom1,$dom2));