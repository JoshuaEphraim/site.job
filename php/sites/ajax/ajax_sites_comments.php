<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 15.11.2017
 * Time: 12:37
 */
include('../../config.php');
$comment_0 = $db_c->query('SELECT d.domain, c.name, c.comment, c.id, c.rate, c.e_mail, c.date FROM '.DBP.'domain_comment c INNER JOIN dc_domain d ON d.id=c.domain_id WHERE  c.status = 0 AND c.type = 0 ORDER BY c.date DESC');
$comment_1 = $db_c->query('SELECT d.domain, c.name, c.comment, c.id, c.rate, c.e_mail, c.date FROM '.DBP.'domain_comment c INNER JOIN dc_domain d ON d.id=c.domain_id WHERE  c.status = 0 AND c.type = 1 ORDER BY c.date DESC');
$all=$db_c->query('SELECT COUNT(*) AS count, SUM(rate) AS rate,COUNT(CASE WHEN rate>5 THEN 1 ELSE NULL END) AS pos,
 					COUNT(CASE WHEN rate<5 THEN 1 ELSE NULL END) AS neg FROM dc_domain_comment');
echo $db_c->error;
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
$c = mysqli_fetch_array($all);
$com3=$c;

echo json_encode(array($com0,$com1,$com3));