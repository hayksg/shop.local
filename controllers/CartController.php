<?php

class CartController
{
    public function actionAdd($id)
    {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionAddProduct($id)
    {
        $count = Cart::countProductInCart($id);
        if (isset($_POST['price'])) {
            $price = (float)$_POST['price'];
            $amount = $count * $price;
            echo "{$count}|{$amount}";
        }

        return true;
    }

    public function actionIndex()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $sessionProducts = Cart::getSessionProducts();
        if ($sessionProducts) {
            $productsIdsArray = array_keys($sessionProducts);
            $products = Product::getProductsByIds($productsIdsArray);
            $totalPrice = Cart::getTotalPrice($products);
        }

        $message = FunctionLibrary::sessionMessage();

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        Cart::deleteProduct($id);
        FunctionLibrary::redirectTo('/cart');
    }

    public function actionOrder()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $name     = '';
        $phone    = '';
        $comment  = '';
        $userName = '';

        $sessionProducts = Cart::getSessionProducts();
        if ($sessionProducts) {
            $productsIdsArray = array_keys($sessionProducts);
            $products = Product::getProductsByIds($productsIdsArray);
            $totalPrice = Cart::getTotalPrice($products);
            $totalProductCount = Cart::countProductsInCart();
        }

        if (isset($_POST['submit'])) {
            $name    = FunctionLibrary::clearStr($_POST['name']);
            $phone   = FunctionLibrary::clearStr($_POST['phone']);
            $comment = nl2br(FunctionLibrary::clearStr($_POST['comment']));

            $errors = array();

            if (!User::checkName($name)) {
                $errors[] = 'Имя не может быть пустым.';
            }

            if (!User::checkPhone($phone)) {
                $errors[] = 'Невалидный номер телефона.';
            }

            if (!User::checkName($comment)) {
                $errors[] = 'Комментарий не может быть пустым.';
            }

            if (empty($errors)) {
                if (User::isUser()) {
                    $email = User::isLogged();
                    $user = User::getUserByEmail($email);
                    $userId = htmlentities($user['id']);
                } else {
                    $userId = false;
                }

                $result = Order::save($name, $phone, $comment, $userId, $sessionProducts);

                if ($result) {
                    $_SESSION['message'] = 'Заказ оформлен!';
                    Cart::annul();
                    FunctionLibrary::redirectTo('/cart');
                }
            }
        } else {
            if (!$sessionProducts) {
                FunctionLibrary::redirectTo('/');
            }

            if (User::isUser()) {
                $email = User::isLogged();
                $user = User::getUserByEmail($email);
                $userName = htmlentities($user['name']);
            }
        }

        require_once(ROOT . '/views/cart/order.php');
        return true;
    }
}