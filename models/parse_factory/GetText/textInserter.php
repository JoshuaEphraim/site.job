<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:21
 */
class textInserter implements iText{
	protected $db_c;
	protected $d_id;
	function __construct($db_c,$d_id)
	{
		$this->db_c=$db_c;
		$this->d_id=$d_id;
	}

	public function makeData(){
		for($i=0;$i<=3;++$i)
		{
			$text = $this->db_c->query('SELECT * FROM ' . DBP . 'text WHERE `type` = "'.$i.'" ORDER BY rand() LIMIT 1');
			$t = mysqli_fetch_array($text);
			$text_list[$t['type']] = $t['text'];

			$this->db_c->query('INSERT INTO `' . DBP . 'domain_text`(domain_id, text_id) VALUES ("' . $this->d_id . '", "' . $t['id'] . '")');
		}
		return $text_list;
	}
}