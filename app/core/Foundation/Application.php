<?php

namespace Foundation;

use Contracts\ApplicationInterface;

class Application implements ApplicationInterface
{
	protected string $baseDir;

	/**
	 * @param string $baseDir
	 */
	public function __construct(string $baseDir)
	{
		$this->baseDir = $baseDir;
	}

	public function start()
	{
		echo "Hello";
	}
}