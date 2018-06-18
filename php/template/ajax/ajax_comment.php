<?php
include('../../config.php');
include('../../function.php');
	$comment = cleanText($_POST['comment'],$db_c);
	$name = cleanText($_POST['name'],$db_c);
	$e_mail = cleanText($_POST['e_mail'],$db_c);
	$domain = intval($_POST['domain']);
	$type = intval($_POST['type']);
	$rate = intval($_POST['value']);
	$validate=array();
	if(!isset($name))
	{
		$validate[]='Ввведите свое имя';
	}
	if(mb_strlen($comment) <= 5)
	{
		$validate[]='Ваш комментарий слишком короткий';
	}
	if(filter_var($email_a, FILTER_VALIDATE_EMAIL))
	{
		$validate[]='Не корректный e-mail';
	}

	if(empty($validate)&&isset($domain)&&isset($type)&&isset($rate)){
		$db_c->query('INSERT INTO `'.DBP.'domain_comment`(domain_id, comment, `name`,`type`,e_mail,rate)
		                    VALUES ("'.$domain.'", "'.$db_c->real_escape_string($comment).'",
		                     "'.$db_c->real_escape_string($name).'", '.$type.',"'.$e_mail.'","'.$rate.'")');
		echo $db_c->error;
	}
	else
	{
		$val=implode(", ",$validate);
		echo $val;
	}


?>