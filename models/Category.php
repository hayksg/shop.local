<?php

class Category
{
    public static function getCategoriesList($status = true)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, name, sort_order, status ";
            $sql .= "FROM category ";
            if ($status) {
                $sql .= "WHERE status = 1 ";
            }
            $sql .= "ORDER BY sort_order ASC";

            if (!$result = $db->query($sql)) {
                return false;
            }

            $categories = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }
            return $categories;
        }
    }

    public static function changeStatusToText($status)
    {
        switch ($status) {
            case '1':
                $result = 'Отображается';
                break;
            case '0':
                $result = 'Не отображается';
                break;
        }
        return $result;
    }

    public static function deleteCategory($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "DELETE FROM category ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
        }
    }

    public static function getTotalCategory()
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT COUNT(sort_order) ";
            $sql .= "AS count ";
            $sql .= "FROM category ";
            $sql .= "LIMIT 1";

            if (!$result = $db->query($sql)) {
                return false;
            }

            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['count'];
        }
    }

    public static function createCategory($name, $sortOrder, $status)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "INSERT INTO category(";
            $sql .= "name, sort_order, status";
            $sql .= ") VALUES(";
            $sql .= ":name, :sortOrder, :status";
            $sql .= ")";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name',      $name,      PDO::PARAM_STR);
            $stmt->bindParam(':sortOrder', $sortOrder, PDO::PARAM_INT);
            $stmt->bindParam(':status',    $status,    PDO::PARAM_INT);
            return $stmt->execute();
        }
    }

    public static function getCategoryById($id)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, name, sort_order, status ";
            $sql .= "FROM category ";
            $sql .= "WHERE id = :id ";
            $sql .= "LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $category = array();
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            return $category;
        }
    }

    public static function editCategory($id, $name, $sortOrder, $status)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "UPDATE category SET ";
                $sql .= "name = :name, ";
                $sql .= "sort_order = :sortOrder, ";
                $sql .= "status = :status ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':name',      $name,      PDO::PARAM_STR);
                $stmt->bindParam(':sortOrder', $sortOrder, PDO::PARAM_INT);
                $stmt->bindParam(':status',    $status,    PDO::PARAM_INT);
                $stmt->bindParam(':id',        $id,        PDO::PARAM_INT);
                return $stmt->execute();
            }
        }
    }
}