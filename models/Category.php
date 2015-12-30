<?php

class Category
{
    public static function getCategoriesList()
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, name ";
            $sql .= "FROM category ";
            $sql .= "WHERE status = 1 ";
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
}