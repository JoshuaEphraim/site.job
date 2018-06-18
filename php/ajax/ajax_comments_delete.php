<?php
include('../config.php');
$db_c->query('TRUNCATE TABLE dc_domain_comment');

echo json_encode(array('cd'=>'success'));