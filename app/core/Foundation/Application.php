<?php

namespace Foundation;

use Config\Config;
use Http\Response;
use Router\Router;

class Application
{
	protected string $basePath;
	protected string $configPath;

	public static Config $config;
	public static Router $router;

	public function __construct(array $options)
	{
		$this->basePath = $options['paths']['base'];
		$this->configPath = $options['paths']['config'];

		self::$config = new Config($this->loadConfigs());
		self::$router = new Router();
		self::$router->loadRoutes();
	}

	protected function loadConfigs(): array
	{
		$configs = [];

		foreach (glob("{$this->configPath}\\*.php") as $file) {
			$configs[pathinfo($file, PATHINFO_FILENAME)] = require_once $file;
		}

		return $configs;
	}

	public function start(): void
	{
		$this->handleRequest();
	}

	protected function handleRequest()
	{
		$this->handleResponse(self::$router->resolve());
	}

	protected function handleResponse(Response $response)
	{
		http_response_code($response->getStatus());

		echo $response->getContent();
	}
}