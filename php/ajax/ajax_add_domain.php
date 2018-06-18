<?php
/**
 * Created by PhpStorm.
 * User: sozin
 * Date: 25.10.2017
 * Time: 0:23
 */
include('../config.php');
include('../function.php');
$dom=$_POST['domain'];
$dom=cleanText($dom, $db_c);
$_domain = explode('.', $dom);
$lst = count($_domain)-1;
$ext = $_domain[$lst];
if(isset($servers[$ext])) {
    $db_c->query('INSERT IGNORE INTO `dc_domain`(domain)
		                    VALUES ("' . $dom . '")');
    if ($db_c->affected_rows)
        $resp = 'Домен успешно добавлен';
    else
        $resp = 'Такой домен уже существует';

}
else
    $resp = 'Такой домен не поддерживается';

echo json_encode($resp);