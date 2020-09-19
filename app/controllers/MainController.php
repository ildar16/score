<?php

namespace app\controllers;

use app\services\ProductService;

class MainController extends Controller
{

	public function indexAction()
	{
		$this->setMeta('Main page');
	}

}