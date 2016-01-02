<?php

class AdminController extends AdminBase
{
    public function actionIndex()
    {




        require_once(ROOT . '/views/admin/index.php');
        return true;
    }
}