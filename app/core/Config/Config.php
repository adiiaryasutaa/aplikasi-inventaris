<?php

namespace Config;

class Config
{
	protected array $items = [];

	public function __construct(array $items = [])
	{
		$this->items = $items;
	}

	public function get(string $key, mixed $default = null)
	{
		if ($this->exists($key)) {
			return $this->items[$key];
		}

		if (!str_contains($key, '.')) {
			return $array[$key] ?? $default;
		}

		$config = $this->items;

		foreach (explode('.', $key) as $segment) {
			if (is_array($config) && array_key_exists($segment, $config)) {
				$config = $config[$segment];
			} else {
				return $default;
			}
		}

		return $config;
	}

	public function exists(string $key): bool
	{
		return array_key_exists($key, $this->items);
	}
}