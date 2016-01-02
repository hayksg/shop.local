<?php

class Order
{
    public static function save($name, $phone, $comment, $userId, $sessionProducts)
    {
        $sessionProducts = json_encode($sessionProducts);

        $db = DB::getConnection();
        if ($db) {
            $sql  = "INSERT INTO product_order(";
            $sql .= "user_name, user_phone, user_comment, user_id, products";
            $sql .= ") VALUES(";
            $sql .= "?, ?, ?, ?, ?";
            $sql .= ")";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $phone, PDO::PARAM_STR);
            $stmt->bindParam(3, $comment, PDO::PARAM_STR);
            $stmt->bindParam(4, $userId, PDO::PARAM_INT);
            $stmt->bindParam(5, $sessionProducts, PDO::PARAM_STR);
            return $stmt->execute();
        }
    }
}