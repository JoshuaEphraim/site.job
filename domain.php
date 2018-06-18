<?php
include_once ('models/exceptionHandler/MyException.php');


	define('HOME', 'http://site.job/');

	$domain = urldecode($_GET['domain']);
	$time = time();

	
	$path = 'cache/'.substr($domain, 0, 3).'/';

	if(is_file($path.$domain.'.html')){
		$page = file($path.$domain.'.html');
		$t = ($time-(int)$page[0])/(60*60*24);
		if($t>=30){
			generate_cache($path,$domain); $page = file($path.$domain.'.html');
		}
	}else{
		generate_cache($path,$domain); $page = file($path.$domain.'.html');
	}
	if($page[0] == '404'){ echo 'Wrong Domain';}
	else{
		unset($page[0]);
		foreach($page as $p){ echo $p; } exit;
	}
	
	function generate_cache($path,$domain){
		if(!is_dir($path)){mkdir($path, 0755);}
	
		$page = postSomething(array('domain'=>$domain), 'http://site.job/php/template/generate_template.php', $resp = 10);
		if($page[0] != '404'){
			$fp=fopen($path.$domain.'.html','w');
			fwrite($fp, $page);
			fclose($fp);
		}

		return $page;
	}

	function postSomething($data, $url, $resp = 10){
		$query = http_build_query ($data);
		$contextData = array ( 
			'method' => 'POST',
			'header' => "Connection: close\r\n".
						"Content-Type: application/x-www-form-urlencoded\r\n".
						"Content-Length: ".strlen($query)."\r\n",
			'content'=> $query );
		if($resp!=0){$contextData['timeout'] = $resp;}
		
		$context = stream_context_create (array ( 'http' => $contextData ));

		$result =  file_get_contents (
			$url,
			false,
			$context);

		return $result;

	}
	function fileExists($path){
		return (@fopen($path,"r")==true);
	}

?>