<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 15:07
 */
class GetScreenShot
{
	protected $connect;
	function __construct()
	{
		$this->connect=new Connection();
	}

	public function makeScreenShot($url,$screen,$size,$format = "jpeg")
	{
		$get=$this->connect->connect("http://mini.s-shot.ru/".$screen."/".$size."/".$format."/?",$url);
		if($get) {
			$file = fopen("../../public/Template/img/" . $url . "." . $format, "w+");
			fputs($file, $get);
			fclose($file);
		}
		else {
			copy("../../public/Template/img/images.jpg", "../../public/Template/img/" . $url . "." . $format);
		}
	}
}