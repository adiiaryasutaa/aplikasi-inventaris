<?php

namespace Core\View;

use Core\Application;

class View
{
    protected $basePath;

    protected $view;

    public function __construct($view)
    {
        $this->basePath = Application::getBaseViewPath();

        if (!file_exists("$this->basePath\\$view.php")) {
            echo "View doesn't exists";
        }

        $this->view = "$this->basePath\\$view.php";
    }

    public function make()
    {
        require_once $this->view;
    }
}
