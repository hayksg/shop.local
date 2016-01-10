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

    public static function getAllOrders()
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT * ";
            $sql .= "FROM product_order ";
            $sql .= "ORDER BY id ASC";

            if (!$result = $db->query($sql)) {
                return false;
            }

            $orders = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $orders[] = $row;
            }
            return $orders;
        }
    }

    public static function orderStatusToText($status)
    {
        switch ($status) {
            case '1':
                $result = 'Новый заказ';
                break;
            case '2':
                $result = 'В обработке';
                break;
            case '3':
                $result = 'Доставляется';
                break;
            case '4':
                $result = 'Доставлен';
                break;
            default:
                $result = 'Такого статуса нет';
                break;
        }
        return $result;
    }

    public static function getOrderById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, user_name, user_phone, user_comment, date, status, products ";
                $sql .= "FROM product_order ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $order = $stmt->fetch(PDO::FETCH_ASSOC);
                return ($order) ? $order : false;
            }
        }
    }

    public static function getOrdersById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, user_name, user_phone, user_comment, date, status, products ";
                $sql .= "FROM product_order ";
                $sql .= "WHERE user_id = :id ";
                $sql .= "ORDER BY id ASC";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $orders = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders[] = $row;
                }
                return $orders;
            }
        }
    }

    public static function deleteOrder($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "DELETE FROM product_order ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
        }
    }

    public static function getTotalOrdersPrice($products, $idsAndQuantity)
    {
        if (is_array($products) && !empty($products)) {
            if (is_array($idsAndQuantity) && !empty($idsAndQuantity)) {
                $totalPrice = 0;
                foreach ($products as $product) {
                    $totalPrice += $product['price'] * $idsAndQuantity[$product['id']];
                }
                return $totalPrice;
            }
        }
    }

    public static function countProductsInOrder($idsAndQuantity)
    {
        if (is_array($idsAndQuantity) && !empty($idsAndQuantity)) {
            $count = 0;
            foreach ($idsAndQuantity as $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function editOrder($id, $status)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "UPDATE product_order SET ";
                $sql .= "status = :status ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':status', $status, PDO::PARAM_INT);
                $stmt->bindParam(':id',     $id,     PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }
}