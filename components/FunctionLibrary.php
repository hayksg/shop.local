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

    public static function showUserOrder($order)
    {
        if (isset($order) && !empty($order)) {
            $productsColumn = $order['products'];
            if ($productsColumn) {
                $idsAndQuantity = json_decode($productsColumn, true);
                $idsString = array_keys($idsAndQuantity);
                $products = Product::getProductsByIds($idsString);

                $totalPrice = Order::getTotalOrdersPrice($products, $idsAndQuantity);
                $totalQuantity = Order::countProductsInOrder($idsAndQuantity);
                $date = $order['date'];
                $status = $order['status'];
                return array($products, $totalPrice, $totalQuantity, $idsAndQuantity, $date, $status);
            }
        }
    }

    public static function dateFormat($dt, $hms = true)
    {
        $date = new DateTime($dt);
        if ($hms) {
            $dateString =  $date->format('j,F,Y,H,i,s');
        } else {
            $dateString =  $date->format('j,F,Y');
        }

        $dateArray = explode(',', $dateString);

        switch ($dateArray[1]) {
            case 'January':
                $result = 'Января';
                break;
            case 'February':
                $result = 'Февраля';
                break;
            case 'March':
                $result = 'Марта';
                break;
            case 'April':
                $result = 'Апреля';
                break;
            case 'May':
                $result = 'Мая';
                break;
            case 'June':
                $result = 'Июня';
                break;
            case 'July':
                $result = 'Июля';
                break;
            case 'August':
                $result = 'Августа';
                break;
            case 'September':
                $result = 'Сентября';
                break;
            case 'October':
                $result = 'Октября';
                break;
            case 'November':
                $result = 'Ноября';
                break;
            case 'December':
                $result = 'Декабря';
                break;
        }
        if ($hms) {
            return $dateArray[0] . ' ' . $result . ' ' . $dateArray[2] . ' ' .
                                                         $dateArray[3] . ':' .
                                                         $dateArray[4] . ':' .
                                                         $dateArray[5];
        } else {
            return $dateArray[0] . ' ' . $result . ' ' . $dateArray[2];
        }

    }
}