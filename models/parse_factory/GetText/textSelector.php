<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:21
 */
class textSelector implements iText{
	protected $text;
	function __construct($text)
	{
		$this->text=$text;
	}

	public function makeData(){
		while($t = mysqli_fetch_array($this->text)) {
			$text_list[$t['type']] = $t['text'];
		}
		return $text_list;
	}
}