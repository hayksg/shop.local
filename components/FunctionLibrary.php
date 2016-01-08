<?php

class FunctionLibrary
{
    public static function clearStr($value)
    {
        return trim(strip_tags($value));
    }

    public static function clearInt($value)
    {
        return abs((int)$value);
    }

    public static function clearFloat($value)
    {
        return abs((float)$value);
    }

    public static function redirectTo($location = false)
    {
        if ($location) {
            header("Location: $location");
            exit;
        }
    }

    public static function sessionMessage()
    {
        if (isset($_SESSION['message'])) {
            $message = htmlentities($_SESSION['message']);
            unset($_SESSION['message']);
            return $message;
        } else {
            return false;
        }
    }

    public static function buildPagination($total, $count, $page, $index)
    {
        $permissible = ceil($total / $count);
        if ($total > $count) {
            if ($page != 0 && $page <= $permissible) {
                return new Pagination($total, $page, $count, $index);
            } else {
                FunctionLibrary::redirectTo('/');
            }
        }
    }

    public static function encrypted($string, $key)
    {
        $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
            MCRYPT_DEV_URANDOM
        );

        $encrypted = base64_encode(
            $iv .
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', $key, true),
                $string,
                MCRYPT_MODE_CBC,
                $iv
            )
        );

        return $encrypted;
    }

    public static function decrypted($encrypted, $key)
    {
        $data = base64_decode($encrypted);
        $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

        $decrypted = rtrim(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', $key, true),
                substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
                MCRYPT_MODE_CBC,
                $iv
            ),
            "\0"
        );

        return $decrypted;
    }

    public static function showErrors($errors)
    {
        if (!empty($errors)) {
            $result = '<ul class="my-ul">';
                foreach ($errors as $error) {
                    $result .= '<li class="my-red-color">';
                    $result .= htmlentities($error);
                    $result .= '</li>';
                }
            $result .= '</ul><br>';
            return $result;
        }
    }
}