<?php


namespace App;

use App\Exceptions\Core;

class Router
{
    protected $routes = [];
    protected $route = [];

    public function __construct()
    {
        $this->routes = include(ROOT . "\App\Config\\routes.php");
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute()
    {
        $url = $this->removeQueryString();

        foreach ($this->routes as $pattern => $route) {

            if (preg_match("~$pattern~i", $url, $matches)) {

                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                $this->route = $route;
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $this->route = $route;
                return true;

            }
        }
        return false;
    }

    public function getUri()
    {
        return trim($_SERVER['REQUEST_URI'], "/");
    }

    public function run()
    {
        $this->dispatch();
    }

    protected function dispatch()
    {
        if ($this->getRoute()) {
            $controller = "App\Controllers\\" . $this->upperCamelCase($this->route['controller']);
            if (class_exists($controller)) {

                $cObj = new $controller();
                $action = 'action' . $this->upperCamelCase($this->route['action']);
                if (method_exists($cObj, $action)) {
                    try {
                        $cObj->action($this->route['action']);
                    } catch (Core $e) {
                        echo 'Возникло исключение ' . $e->getMessage();
                    }

                } else {
                    die("Данного метода не существует");
                }
            } else {
                die("Класс не существует");
            }

        } else {
            echo '<br>';
            echo "404";
        }

    }

    protected function upperCamelCase($name)
    {
        $name = ucwords(str_replace("-", " ", $name));
        return str_replace(" ", "", $name);
    }

    public function removeQueryString()
    {
        $url = $this->getUri();

        if ($url) {
            $params = explode("?", $url);

            if (empty($params)) {
                return '';
            }
            if (false === strpos($params[0], "=")) {
                return $params[0];
            } else {
                return '';
            }
        }
    }

}