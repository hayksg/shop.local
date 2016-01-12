<?php

class Blog
{
    public static function getAllBlogs($count, $page)
    {
        $page = intval($page);
        $count = intval($count);
        $offset = ($page - 1) * $count;

        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, title, description, content, image, dt ";
            $sql .= "FROM blog ";
            $sql .= "ORDER BY dt DESC ";
            $sql .= "LIMIT " . $count;
            if ($offset > 0) {
                $sql .= " OFFSET " . $offset;
            }

            if (!$result = $db->query($sql)) {
                var_dump($result);die;
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

    public static function updateBlogById($id, $title, $description, $content)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "UPDATE blog SET ";
                $sql .= "title = :title, ";
                $sql .= "description = :description, ";
                $sql .= "content = :content, ";
                $sql .= "dt = :dt ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $dt = date('Y-m-d H:i:s');

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':title',       $title,       PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':content',     $content,     PDO::PARAM_STR);
                $stmt->bindParam(':dt',          $dt,          PDO::PARAM_STR);
                $stmt->bindParam(':id',          $id,          PDO::PARAM_INT);

                return $stmt->execute();
            }
        }
    }

    public static function deleteBlog($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "DELETE FROM blog ";
                $sql .= "WHERE id = :id ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
        }
    }

    public static function getTotalBlogs()
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT COUNT(id) ";
            $sql .= "AS count ";
            $sql .= "FROM blog ";
            $sql .= "LIMIT 1";

            if (!$result = $db->query($sql)) {
                return false;
            }

            $row = $result->fetch(PDO::FETCH_ASSOC);
            return ($row) ? $row['count'] : false;
        }
    }
}