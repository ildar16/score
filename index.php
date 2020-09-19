<?php

define("ROOT", dirname(__FILE__));
define("LAYOUT", 'default');

require_once ROOT . '/vendor/autoload.php';

$query = trim($_SERVER['REQUEST_URI'], '/');

$routes = [
    '^bill/(?P<action>[a-z0-9-]+)/?(?P<id>[0-9-]+)?$' => ['controller' => 'Bill', 'action' => 'index'],
    '^bill_count/(?P<action>[a-z0-9-]+)/?(?P<id>[0-9-]+)?$' => ['controller' => 'BillCount', 'action' => 'index'],
	'^$' => ['controller' => 'Main', 'action' => 'index'],
];

matchRoute($query, $routes);

function matchRoute($url, $routes)
{
    $url = removeQueryString($url);

    foreach ($routes as $pattern => $route) {
        	
        if (preg_match("#{$pattern}#i", $url, $matches)){
        	foreach ($matches as $key => $value){
                if (is_string($key)){
                    $route[$key] = $value;
                }
            }
            if (empty($route['action'])){
                $route['action'] = 'index';
            }

            return dispatch($route);
        }

    }

    die("Error 404");

}

function dispatch($route)
{
	if (!empty($route)) {
		$controller = 'app\controllers\\' . $route['controller'] . 'Controller';
    
    	if (class_exists($controller)) {
    		$controllerObject = new $controller($route);
    		$action = $route['action'] . 'Action';
		
    		if (method_exists($controllerObject, $action)) {
    			$controllerObject->$action();
                $controllerObject->getView();
    		} else {
    			echo "Method {$action} not found";
    		}
    		
    	} else {
    		echo "Controller {$controller} not found";
    	}
	} else {
		die("Error 404");
	}
}

function removeQueryString($url)
{
    if ($url){
        $params = explode('?', $url, 2);
        if (false === strpos($params[0],'=')){
            return rtrim($params[0], '/');
        }else{
            return '';
        }
    }
}

function dd($data)
{
	echo "
    <style>
    body {
        background: black;
    }
    </style>
    ";
    echo "<pre style='color:white'>";
	print_r($data);
	echo "</pre>";
    die;
}

function d($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}