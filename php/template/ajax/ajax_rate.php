<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 06.11.2017
 * Time: 23:57
 */
include('../../config.php');
$ip=$_SERVER['REMOTE_ADDR'];
$ip=ip2long($ip);
$domain = intval($_POST['domain']);

$row = $db_c->query('SELECT * FROM ' . DBP . 'rates WHERE ip="' . $ip . '" AND domain_id="' . $domain . '"');
$num_row = $row->num_rows;
if (!isset($_POST['value'])) {
    $rate=$row->fetch_assoc();
    echo $rate['rate'];
}else {
    $rate = intval($_POST['value']);
    if ($num_row > 0) {
        $db_c->query('UPDATE ' . DBP . 'rates
                             SET rate="' . $rate . '"
                             WHERE ip="' . $ip . '" AND domain_id="' . $domain . '"');
    } else {
        $db_c->query('INSERT INTO ' . DBP . 'rates (ip, rate, domain_id)
                                    VALUES ("' . $ip . '", "' . $rate . '","' . $domain . '")');
    }
    echo $db_c->error;
}

