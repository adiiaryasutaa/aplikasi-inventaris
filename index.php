<?php

require_once __DIR__ . '/autoloader.php';

$app = new \Foundation\Application([
	'paths' => [
		'base' => __DIR__,
		'config' => __DIR__ . '\\app\\config'
	]
]);

$app->start();