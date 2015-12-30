<?php

class Router
{
    private $routes = array();

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private static function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получаем строку запроса
        $uri = $this->getURI();

        // Проверяем есть ли совпадения в строке запроса и в маршрутах
        foreach ($this->routes as $uriPattern => $url) {
            if (preg_match("~$uriPattern~", $uri)) {
                // Получаем внутренний путь из внешнего согласно паттерну
                $internalRoute = preg_replace("~$uriPattern~", $url, $uri);

                // Если есть совпадения находим контроллер, action, параметр(ы)
                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                // Подключаем класс-контроллер
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (is_file($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создаём объект, вызываем метод (т.е. action)
                if (class_exists($controllerName)) {
                    $controllerObject = new $controllerName;

                    if (is_object($controllerObject)) {
                        if (method_exists($controllerObject, $actionName)) {
                            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                            if (!is_null($result)) {
                                break;
                            }
                        } else {
                            header('Location: /');
                            exit;
                        }
                    }
                }
            }
        }
    }
}