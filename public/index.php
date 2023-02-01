<?php

require_once __DIR__ . "\\..\\loader.php";

use Core\Application;
use Core\View\View;

$app = new Application([
	'host' => 'http://inventaris-app.test',
	'paths' => [
		'base' => __DIR__ . "\\..",
		'view' => __DIR__ . "\\..\\app\\views",
	]
]);

$router = $app->getRouter();

$router->get('/', function () {
	return (new View('home'))->make();
});

$router->get('/login', function () {
	return (new View('login'))->make();
});

$router->post('/login', function () {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	$connection = Application::getDatabaseConnection();

	$statement = $connection->prepare("SELECT password FROM petugas WHERE username = :username");
	$statement->bindParam(':username', $username);
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);

	if (empty($result)) {
		$statement = $connection->prepare("SELECT password FROM pegawai WHERE nip = :nip");
		$statement->bindParam(':nip', $username);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
	}

	if (!empty($result) && password_verify($password, $result['password'])) {
		header('Location: /');
		exit();
	} else {
		return "login gagal";
	}
});

$app->start();