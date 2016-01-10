<?php

class Cart
{
    public static function addProduct($id)
    {
        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;
        return self::countProductsInCart();
    }

    public static function countProductsInCart()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function countProductInCart($id)
    {
        if (isset($_SESSION['products'][$id])) {
            return $_SESSION['products'][$id];
        } else {
            return 0;
        }
    }

    public static function getSessionProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        } else {
            return false;
        }
    }

    public static function getTotalPrice($products)
    {
        if (is_array($products) && !empty($products)) {
            $sessionProducts = Cart::getSessionProducts();

            if (is_array($sessionProducts) && !empty($sessionProducts)) {
                $totalPrice = 0;
                foreach ($products as $product) {
                    $totalPrice += $product['price'] * $sessionProducts[$product['id']];
                }
                return $totalPrice;
            }
        }
    }

    public static function deleteProduct($id)
    {
        if (isset($_SESSION['products'][$id])) {
            unset($_SESSION['products'][$id]);
        }
    }

    public static function annul()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
}