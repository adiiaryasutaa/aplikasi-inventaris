<?php

$dirs = [
	__DIR__ . '\\app\\core\\Config',
	__DIR__ . '\\app\\core\\Router',
	__DIR__ . '\\app\\core\\Http',
	__DIR__ . '\\app\\core\\Foundation',
	__DIR__ . '\\app\\core\\Support',
	__DIR__ . '\\app\\controller',
];

foreach ($dirs as $dir) {
	foreach (glob("$dir\\*.php") as $file) {
		require_once $file;
	}
}