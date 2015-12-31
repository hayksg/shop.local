<?php

function __autoload($className)
{
    $segments = array('/components/', '/models/');
    foreach ($segments as $segment) {
        $file = ROOT . $segment . $className . '.php';
        if (file_exists($file)) {
            include_once($file);
        }
    }
}