<?php

$usl = '';
$show_pages=10;
$this_page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
$pag = countPagination($this_page, DBP.'domain_comment', $db_c, $usl, $show_pages);

if(isset($_GET['search']))
{
	$search=cleanText($_GET['search'],$db_c);
	$rows = $db_c->query('SELECT d.domain, c.name, c.comment, c.id 
							  FROM dc_domain_comment c INNER JOIN dc_domain d ON d.id=c.domain_id
							   WHERE d.domain LIKE "%'.$search.'%" 
							   ORDER BY d.domain ASC');
	$row=$db_c->affected_rows;
	$pag['rows_max']=$row;
	$comment=fetchAll($rows, $pag, $show_pages);
}
else {
	$rows = $db_c->query('SELECT d.domain, c.name, c.comment, c.id 
							  FROM dc_domain_comment c INNER JOIN dc_domain d ON d.id=c.domain_id 
							  ORDER BY d.domain ASC');
	$comment=fetchAll($rows, $pag, $show_pages);
}


