<?php

class Blog
{
    public static function getAllBlogs($sort = false)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, title, description, content, image, dt ";
            $sql .= "FROM blog ";
            if ($sort) {
                $sql .= "ORDER BY dt ASC";
            } else {
                $sql .= "ORDER BY dt DESC";
            }

            if (!$result = $db->query($sql)) {
                return false;
            }

            $blogs = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $blogs[] = $row;
            }
            return $blogs;
        }
    }

    public static function getBlogById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "SELECT id, title, description, content, image, dt ";
                $sql .= "FROM blog ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $blog = array();
                $blog = $stmt->fetch(PDO::FETCH_ASSOC);
                return $blog;
            }
        }
    }

    public static function saveBlog($title, $description, $content)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "INSERT INTO blog(";
            $sql .= "title, description, content";
            $sql .= ") VALUES(";
            $sql .= "?, ?, ?";
            $sql .= ")";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $title,       PDO::PARAM_STR);
            $stmt->bindParam(2, $description, PDO::PARAM_STR);
            $stmt->bindParam(3, $content,     PDO::PARAM_STR);

            return ($stmt->execute()) ? $db->lastInsertId() : false;
        }
    }

    public static function putImageToDataBase($id, $imagePath)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "UPDATE blog SET ";
            $sql .= "image = :imagePath ";
            $sql .= "WHERE id = :id ";
            $sql .= "LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':id',        $id,        PDO::PARAM_INT);

            return $stmt->execute();
        }
    }
}