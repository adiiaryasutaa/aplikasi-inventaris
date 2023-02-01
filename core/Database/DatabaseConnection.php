<?php

namespace Core\Http;

use PDO;
use PDOException;

class DatabaseConnection extends PDO
{
	protected $host = 'localhost:3310';
	protected $database = 'inventaris';
	protected $user = 'root';
	protected $password = 'fr33pass';

	public function __construct()
	{
		try {
			parent::__construct("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);

			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $ex) {
			echo ($ex->getMessage());
		}
	}
}