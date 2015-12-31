<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $products = Product::getProductsList(6, 0);
        if (!$products) {$products = array();}

        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}