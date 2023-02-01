<?php

$files = [
    __DIR__ . "\\core\\Application.php",
    __DIR__ . "\\core\\Http\\Request.php",
    __DIR__ . "\\core\\Database\\DatabaseConnection.php",
    __DIR__ . "\\core\\Routing\\Router.php",
    __DIR__ . "\\core\\Support\\functions.php",
    __DIR__ . "\\core\\View\\View.php",
];

foreach ($files as $file) {
    require_once $file;
}
