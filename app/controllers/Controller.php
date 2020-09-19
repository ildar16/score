<?php

namespace app\controllers;

abstract class Controller
{

	public $route;
	public $controller;
	public $model;
	public $view;
	public $layout;
	public $data = [];
	public $meta = [];

	public function __construct($route)
	{
		$this->route = $route;
		$this->controller = $route['controller'];
		$this->view = $route['action'];
		$this->layout = LAYOUT;
		session_start();
	}

	public function set($data)
	{
		$this->data = $data;
	}

	public function setMeta($title = '', $description = '')
	{
		$this->meta['title'] = $title;
		$this->meta['description'] = $description;
	}

	public function getView()
	{
		if(is_array($this->data)) extract($this->data);

		if ($this->view !== false) {
			$view = ROOT . "/app/views/{$this->controller}/{$this->view}.php";

			if (file_exists($view) && is_file($view)) {
				ob_start();
				require_once $view;
				$content = ob_get_clean();
			} else {
				die("View {$view} not found");
			}
		}

		if ($this->layout !== false) {
			$layout = ROOT . "/app/views/layouts/{$this->layout}.php";
			if (file_exists($layout) && is_file($layout)) {
				require_once $layout;
			} else {
				die("Layout {$layout} not found");
			}
		}
		
	}

	public function redirectBack($message)
    {
    	$_SESSION['success'] = $message;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function redirectTo($message, $location = '/')
    {
    	$_SESSION['success'] = $message;
        header('Location: ' . $location);
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

}