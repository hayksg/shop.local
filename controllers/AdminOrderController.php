<?php

class AdminOrderController extends AdminBase
{
    public function actionIndex()
    {

        require_once(ROOT . '/views/admin-order/index.php');
        return true;
    }

    public function actionCreate()
    {

        require_once(ROOT . '/views/admin-order/create.php');
        return true;
    }

    public function actionUpdate($id)
    {

        require_once(ROOT . '/views/admin-order/update.php');
        return true;
    }

    public function actionDelete($id)
    {

        require_once(ROOT . '/views/admin-order/delete.php');
        return true;
    }
}