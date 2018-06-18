<?php
spl_autoload_register('loadParseFactory');
spl_autoload_register('loadParseFactoryConnection');
spl_autoload_register('loadParseFactoryDataWorker');
spl_autoload_register('loadParseFactoryDoParse');
spl_autoload_register('loadParseFactoryGetText');
spl_autoload_register('loadParseFactoryParsers');
function loadParseFactory($aClassName) {
	$aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'parse_factory' . DIRECTORY_SEPARATOR .$aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}
function loadParseFactoryConnection($aClassName) {
	$aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'parse_factory' . DIRECTORY_SEPARATOR .'Connection' . DIRECTORY_SEPARATOR .$aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}
function loadParseFactoryDataWorker($aClassName) {
	$aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'parse_factory' . DIRECTORY_SEPARATOR .'DataWorker' . DIRECTORY_SEPARATOR .$aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}
function loadParseFactoryDoParse($aClassName) {
	$aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'parse_factory' . DIRECTORY_SEPARATOR .'DoParse' . DIRECTORY_SEPARATOR .$aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}
function loadParseFactoryGetText($aClassName) {
	$aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'parse_factory' . DIRECTORY_SEPARATOR .'GetText' . DIRECTORY_SEPARATOR .$aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}
function loadParseFactoryParsers($aClassName) {
	$aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'parse_factory' . DIRECTORY_SEPARATOR .'Parsers' . DIRECTORY_SEPARATOR .$aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}