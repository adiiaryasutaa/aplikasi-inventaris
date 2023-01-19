<?php

$dirs = [
	__DIR__ . '\\app\\core\\Contracts',
	__DIR__ . '\\app\\core\\Foundation',
];

foreach ($dirs as $dir) {
	foreach (glob("$dir\\*.php") as $file) {
		require_once $file;
	}
}