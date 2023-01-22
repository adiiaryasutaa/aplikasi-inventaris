<?php

namespace Router;

use Closure;
use Foundation\Application;
use Http\Response;

class Router
{
	protected array $routes = [];

	protected array $currentRouteActionParams = [];

	public function loadRoutes()
	{
		$path = Application::$config->get('app.paths.routes');

		require_once $path;
	}


	public function addRoute(string $method, string $uri, array|Closure $action)
	{
		$this->routes[$method][$uri] = $action;
	}

	public function has(string $method, string $uri)
	{
		return isset($this->routes[$method][$uri]);
	}

	public function resolve()
	{
		$action = $this->getAction();

		if (!$action) {
			return $this->routeNotFound();
		}

		if (is_array($action)) {
			$action = [new $action[0], $action[1]];
		}

		$response = call_user_func($action, ...$this->currentRouteActionParams);

		if (!$response instanceof Response) {
			$response = new Response($response);
		}

		return $response;
	}

	public function getAction()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$uri = trim($_SERVER['REQUEST_URI'], '/');

		if ($this->has($method, $uri)) {
			$this->currentRouteActionParams = [];
			return $this->routes[$method][$uri];
		}

		// All routes from current request method
		$routes = $this->routes[$method];

		foreach ($routes as $route => $callback) {
			$route = trim($route, '/');
			$paramNames = [];

			// Find all route names from route
			if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
				$paramNames = $matches[1];
			}

			// Convert route name into regex pattern
			$routeRegex = "@^" . preg_replace_callback(
					'/\{\w+(:([^}]+))?}/',
					fn($match) => isset($match[2]) ? "({$match[2]})" : '(\w+)',
					$route
				) . "$@";

			// Test and match current route against $routeRegex
			if (preg_match_all($routeRegex, $uri, $valueMatches)) {
				$values = [];

				for ($i = 1; $i < count($valueMatches); $i++) {
					$values[] = $valueMatches[$i][0];
				}

				$this->currentRouteActionParams = array_combine($paramNames, $values);

				return $callback;
			}
		}

		return false;
	}

	protected function routeNotFound(): Response
	{
		return new Response("404 | Not Found", 404);
	}
}