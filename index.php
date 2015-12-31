<?php

// Front Controller

// 1. Общие настройки
ini_set('display_errors', '1');
error_reporting(E_ALL);
session_start();

// 2. Подключение системных файлов
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/autoload.php');

// 3. Вызов Router
$router = new Router;
echo $router->run();