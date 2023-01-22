<?php

namespace controller;

use Http\Response;

abstract class Controller
{
	protected function request()
	{

	}

	protected function response(string $content, int $status = 200)
	{
		return new Response($content, $status);
	}
}