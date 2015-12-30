<?php

class ProductController
{
    public function actionView()
    {

        
        require_once(ROOT . '/views/product/view.php');
        return true;
    }
}