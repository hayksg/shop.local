<?php

class DB
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db-params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        try{
            $db = new PDO($dsn, $params['user'], $params['password']);
            if ($db) {
                $db->exec("SET NAMES 'utf8'");
                return $db;
            }
        } catch (PDOException $e) {
            echo "Нет соединения с БД.";
        }

    }
}