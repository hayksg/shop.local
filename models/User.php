<?php

class User
{
    public static function checkName($name)
    {
        return (strlen($name) > 1) ? true : false;
    }

    public static function checkEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function checkPhone($phone)
    {
        $pattern = "/^\(?\+{1}[0-9]+\)?([0-9 -]+)$/";
        if (preg_match($pattern, $phone)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkPassword($password)
    {
        return (strlen($password) > 5) ? true : false;
    }

    public static function checkEmailExists($email)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id ";
            $sql .= "FROM user ";
            $sql .= "WHERE email = :email ";
            $sql .= "LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $id = $stmt->fetchColumn();
            return ($id) ? true : false;
        }
    }

    public static function register($name, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $db = DB::getConnection();
        if ($db) {
            $sql  = "INSERT INTO user(";
            $sql .= "name, email, password";
            $sql .= ") VALUES(";
            $sql .= "?, ?, ?";
            $sql .= ")";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $passwordHash, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $user = self::getUserByEmail($email);
                self::auth($user);
                return true;
            } else {
                return false;
            }
        }
    }

    public static function getUserByEmail($email)
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, name, email, password, role ";
            $sql .= "FROM user ";
            $sql .= "WHERE email = :email ";
            $sql .= "LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($user) ? $user : false;
        }
    }

    public static function login($email, $password, $remember)
    {
        $user = self::getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($remember == 'true') {
                    $key = "2a23tramvai34e44avtobus";
                    $encrypted = FunctionLibrary::encrypted($user['email'], $key);
                    setcookie('user', $encrypted, 0x7FFFFFFF, '/');
                }
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function auth($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function isLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']['email'];
        } elseif (isset($_COOKIE['user'])) {
            $key = "2a23tramvai34e44avtobus";
            $decrypted = FunctionLibrary::decrypted($_COOKIE['user'], $key);
            return $decrypted;
        } else {
            FunctionLibrary::redirectTo('/');
        }
    }

    public static function isUser()
    {
        if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time() - 3600, '/');
        }
    }

    public static function edit($id, $name, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $db = DB::getConnection();
        if ($db) {
            $sql  = "UPDATE user SET ";
            $sql .= "name = :name, ";
            $sql .= "password = :password ";
            $sql .= "WHERE id = :id ";
            $sql .= "LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return ($stmt->execute()) ? true : false;
        }
    }

    public static function getAdminUsers()
    {
        $db = DB::getConnection();
        if ($db) {
            $sql  = "SELECT id, name ";
            $sql .= "FROM user ";
            $sql .= "WHERE role = 'admin' ";
            $sql .= "ORDER BY id ASC";

            if (!$result = $db->query($sql)) {
                return false;
            }

            $admins = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $admins[] = $row;
            }
            return $admins;
        }
    }

    public static function registerAdmin($name, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $db = DB::getConnection();
        if ($db) {
            $sql  = "INSERT INTO user(";
            $sql .= "name, email, password, role";
            $sql .= ") VALUES(";
            $sql .= "?, ?, ?, 'admin'";
            $sql .= ")";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $passwordHash, PDO::PARAM_STR);

            return $stmt->execute();
        }
    }

    public static function deleteAdmin($id)
    {
        $id = intval($id);
        if ($id) {
            $db = DB::getConnection();
            if ($db) {
                $sql  = "DELETE FROM user ";
                $sql .= "WHERE id = :id ";
                $sql .= "AND role = 'admin' ";
                $sql .= "LIMIT 1";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
        }
    }
}