<?php

namespace controller;

class HomeController extends Controller
{
	public function index()
	{
		return $this->response('This is my home');
	}
}