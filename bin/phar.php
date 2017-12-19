<?php

// Create PHP Phar Archive
// @usage php -c php.ini scripts/phar.php
// @link https://www.sitepoint.com/packaging-your-apps-with-phar/
//       https://stackoverflow.com/a/11082338/82126

$srcRoot = "src";
$buildRoot = "build";

$buildName = 'git-package.phar';
$buildFile = $buildRoot.'/'.$buildName;

is_file($buildFile) && unlink($buildFile);

$phar = new \Phar($buildFile
	, FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME
	, $buildName
	);

$phar['index.php'] = file_get_contents('index.php');
$phar['LICENSE'] = file_get_contents('LICENSE');

$srcFiles = new RecursiveIteratorIterator(
	new RecursiveDirectoryIterator($srcRoot)
);

foreach ($srcFiles as $srcFileName => $srcFile) {
	if (is_file($srcFileName) == FALSE) {
		continue;
	}
	$phar[$srcFileName] = file_get_contents($srcFileName);
}

$phar->startBuffering();
$pharStub = $phar->createDefaultStub('index.php');
$pharStub = "#!/usr/bin/env php\n".$pharStub;
$phar->setStub($pharStub);
$phar->stopBuffering();

