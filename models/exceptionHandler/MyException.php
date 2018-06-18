<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 09.11.2017
 * Time: 11:52
 */
class MyException extends Exception {
	public function __construct($message, $errorLevel = 0, $errorFile = '', $errorLine = 0) {
		parent::__construct($message, $errorLevel);
		$this->file = $errorFile;
		$this->line = $errorLine;
	}
}
set_error_handler('err_handler',E_ALL);
function err_handler($errno, $errmsg, $filename, $linenum) {
	$date = date('Y-m-d H:i:s (T)');
	$f = fopen('errors.txt', 'a');
	if (!empty($f)) {
		$err  = "$errmsg = $filename = $linenum\r\n";
		fwrite($f, $err);
		fclose($f);
	}
	if (stripos($filename,'domain.php')&&stripos($errmsg,'get_contents')){
	exit("<meta http-equiv='refresh' content='0; url= $_SERVER[request_uri]'>");
}
}
?>