<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 02.11.2017
 * Time: 14:58
 */
include('../config.php');
include('../function.php');
$comm=intval($_POST['comment']);

$db_c->query('DELETE FROM dc_domain_comment WHERE id='.$comm);

echo json_encode(array('cd'=>'success'));