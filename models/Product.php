<?php

class Product
{
    const SHOW_BY_DEFAULT = 9;

    public static function getProductsList($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        if ($count) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, name, price, image, is_new ";
                $sql .= "FROM product ";
                $sql .= "WHERE status = 1 ";
                $sql .= "ORDER BY id DESC ";
                $sql .= "LIMIT :count";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':count', $count, PDO::PARAM_INT);
                $stmt->execute();

                $products = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $products[] = $row;
                }
                return $products;
            }
        }
    }

    public static function getProductsByCategoryId($categoryId, $count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        $categoryId = intval($categoryId);
        if ($count && $categoryId) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, name, price, image, is_new ";
                $sql .= "FROM product ";
                $sql .= "WHERE status = 1 ";
                $sql .= "AND category_id = :categoryId ";
                $sql .= "ORDER BY id DESC ";
                $sql .= "LIMIT :count";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
                $stmt->bindParam(':count', $count, PDO::PARAM_INT);
                $stmt->execute();

                $products = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $products[] = $row;
                }
                return $products;
            }
        }
    }
}