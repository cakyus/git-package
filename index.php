<?php

spl_autoload_register(function($className){
	$fileName = $className;
	$fileName = str_replace('\\', '/', $fileName);
	$fileName = 'src/'.$fileName.'.php';
	if (is_file($fileName)) {
		require_once($fileName);
	}
});

// require_once('src/Application.php');
// require_once('src/Controller/Index.php');

$application = new \Application;
$application->start();

