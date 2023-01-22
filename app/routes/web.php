<?php

$router = \Foundation\Application::$router;

$router->addRoute('GET', '/', function () {
	return "UKK ANJAYYY";
});
$router->addRoute('GET', '/home', [\controller\HomeController::class, 'index']);
$router->addRoute('GET', '/{username}', function ($username) {
	return $username;
});
$router->addRoute('GET', '/{username}/blog/{slug}', function ($username, $slug) {
	dd([
		'username' => $username,
		'slug' => $slug
	]);
});