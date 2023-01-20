<?php

namespace Foundation;

use Config\Config;

class Application
{
	protected string $basePath;
	protected string $configPath;

	protected Config $config;

	public function __construct(array $options)
	{
		$this->basePath = $options['paths']['base'];
		$this->configPath = $options['paths']['config'];

		$this->config = new Config($this->loadConfigs());
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
		var_dump($this->config->get('app.key'));
	}
}