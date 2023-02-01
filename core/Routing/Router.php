<?php

namespace Core\Router;

use Core\Application;

class Router
{
    protected $items = [];

    public function __construct()
    {
    }

    public function addRoute($method, $uri, $action)
    {
        $this->items[$method][$uri] = $action;
    }

    public function get($uri, $action)
    {
        $this->addRoute("GET", $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute("POST", $uri, $action);
    }

    public function resolve()
    {
        $request = Application::getRequest();
        $method = $request->method();
        $uri = $request->uri();

        $action = $this->items[$method][$uri];

        return $action();
    }
}
