<?php

// Front Controller

// 1. Общие настройки
ini_set('display_errors', '1');
error_reporting(E_ALL);

// 2. Подключение системных файлов
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Router.php');

// 3. Установка соединения с БД
require_once(ROOT . '/components/DB.php');

// 4. Вызов Router
$router = new Router;
echo $router->run();