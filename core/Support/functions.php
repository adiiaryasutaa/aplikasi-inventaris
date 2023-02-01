<?php

use Core\Application;

function asset($uri)
{
    $host = Application::getHost();
    return "$host\\$uri";
}
