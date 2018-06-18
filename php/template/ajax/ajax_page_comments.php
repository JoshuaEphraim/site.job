<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 15.11.2017
 * Time: 16:15
 */
include('../../config.php');
$domain = intval($_POST['domain']);
$comment_0 = $db_c->query('SELECT * FROM '.DBP.'domain_comment WHERE `domain_id` = '.$domain. ' AND `status` = 0 AND type = 0 ORDER BY date DESC');
$comment_1 = $db_c->query('SELECT * FROM '.DBP.'domain_comment WHERE `domain_id` = '.$domain. ' AND `status` = 0 AND type = 1 ORDER BY date DESC');
$com0=array();
$com1=array();
while($c = mysqli_fetch_array($comment_0)) {
	$date=new DateTime($c['date']);
	$c['date']=$date->format('l, F j, Y');
	$com0[]=$c;
}
while($c = mysqli_fetch_array($comment_1)) {
	$date=new DateTime($c['date']);
	$c['date']=$date->format('l, F j, Y');
	$com1[]=$c;
}
echo json_encode(array($com0,$com1));