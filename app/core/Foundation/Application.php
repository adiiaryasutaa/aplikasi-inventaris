<?php

namespace Foundation;

class Application
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