<?php

spl_autoload_register(function($className){
	$fileName = $className;
	$fileName = str_replace('\\', '/', $fileName);
	$fileName = dirname(__FILE__).'/src/'.$fileName.'.php';
	if (is_file($fileName)) {
		require_once($fileName);
	}
});

$application = new \Application;
$application->start();

