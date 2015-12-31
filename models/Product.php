<?php

class Product
{
    const SHOW_BY_DEFAULT = 9;

    public static function getProductsList($count = self::SHOW_BY_DEFAULT, $page)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * $count;
        if ($count) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, name, price, image, is_new ";
                $sql .= "FROM product ";
                $sql .= "WHERE status = 1 ";
                $sql .= "ORDER BY id DESC ";
                $sql .= "LIMIT :count ";
                if ($offset > 0) {
                    $sql .= "OFFSET " . $offset;
                }

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

    public static function getProductsByCategoryId($categoryId, $count = self::SHOW_BY_DEFAULT, $page)
    {
        $count = intval($count);
        $categoryId = intval($categoryId);
        $page = intval($page);
        $offset = ($page - 1) * $count;
        if ($count && $categoryId && $page) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, name, price, image, is_new ";
                $sql .= "FROM product ";
                $sql .= "WHERE status = 1 ";
                $sql .= "AND category_id = :categoryId ";
                $sql .= "ORDER BY id DESC ";
                $sql .= "LIMIT :count ";
                $sql .= "OFFSET " . $offset;

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

    public static function getProductById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT * ";
                $sql .= "FROM product ";
                $sql .= "WHERE status = 1 ";
                $sql .= "AND id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $product = array();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                return $product;
            }
        }
    }

    public static function getTotalProductsInCategory($categoryId)
    {
        $categoryId = intval($categoryId);
        if ($categoryId) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT COUNT(id) ";
                $sql .= "AS count ";
                $sql .= "FROM product ";
                $sql .= "WHERE status = 1 ";
                $sql .= "AND category_id = :category_id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return ($row) ? $row['count'] : 0;
            }
        }
    }

    public static function getTotalProducts()
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT COUNT(id) ";
            $sql .= "AS count ";
            $sql .= "FROM product ";
            $sql .= "WHERE status = 1 ";
            $sql .= "LIMIT 1";

            if (!$result = $db->query($sql)) {
                return false;
            }

            $row = $result->fetch(PDO::FETCH_ASSOC);
            return ($row) ? $row['count'] : 0;
        }
    }
}