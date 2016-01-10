<?php

class AdminOrderController extends AdminBase
{
    public function actionIndex()
    {
        $orders = Order::getAllOrders();
        if (!$orders) {$orders = array();}

        $message = FunctionLibrary::sessionMessage();

        require_once(ROOT . '/views/admin-order/index.php');
        return true;
    }

    public function actionView($id)
    {
        $order = Order::getOrderById($id, false);

        if (isset($order) && !empty($order)) {
            $productsColumn = $order['products'];
            if ($productsColumn) {
                $idsAndQuantity = json_decode($productsColumn, true);
                $idsString = array_keys($idsAndQuantity);
                $products = Product::getProductsByIds($idsString);

                $totalPrice = Order::getTotalOrdersPrice($products, $idsAndQuantity);
                $totalQuantity = Order::countProductsInOrder($idsAndQuantity);
            }
        }

        require_once(ROOT . '/views/admin-order/view.php');
        return true;
    }

    public function actionUpdate($id)
    {
        $order = Order::getOrderById($id, false);
        if (isset($order) && !empty($order)) {
            $id     = $order['id'];
            $status = $order['status'];
        }

        $orderParams = include(ROOT . '/config/order-params.php');
        if (!$orderParams) {$orderParams = array();}

        if (isset($_POST['submit'])) {
            $status = FunctionLibrary::clearInt($_POST['status']);

            if ($status) {
                Order::editOrder($id, $status);
                FunctionLibrary::redirectTo('/admin/order');
            }
        }

        require_once(ROOT . '/views/admin-order/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])) {
            $result = Order::deleteOrder($id);

            if (!$result) {
                $_SESSION['message'] = 'Произошла ошибка при удалении.';
            }
            FunctionLibrary::redirectTo('/admin/order');
        }

        return true;
    }
}