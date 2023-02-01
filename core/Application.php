<?php

namespace Core;

use Core\Http\DatabaseConnection;
use Core\Http\Request;
use Core\Router\Router;

class Application
{
	protected static $host;

	/**
	 * @var string
	 */
	protected $basePath;

	/**
	 * @var string
	 */
	protected static $baseViewPath;

	/**
	 * The application router
	 * 
	 * @var Router
	 */
	protected static $router;

	/**
	 * The application request
	 * 
	 * @var Request
	 */
	protected static $request;

	protected static $databaseConnection;

	/**
	 * Application constructor
	 * @param array options
	 */
	public function __construct(array $options = [])
	{
		$this->readOptions($options);
		self::$router = new Router();
		self::$request = new Request();
		self::$databaseConnection = new DatabaseConnection();
	}

	protected function readOptions(array $options)
	{
		self::$host = $options['host'];
		$this->basePath = $options['paths']['base'];
		self::$baseViewPath = $options['paths']['view'];
	}

	public function start()
	{
		echo self::$router->resolve();
	}

	public static function getHost()
	{
		return self::$host;
	}

	public static function getBaseViewPath()
	{
		return self::$baseViewPath;
	}

	public static function getRouter()
	{
		return self::$router;
	}

	public static function getRequest()
	{
		return self::$request;
	}

	public static function getDatabaseConnection()
	{
		return self::$databaseConnection;
	}
}