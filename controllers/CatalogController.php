<?php
include_once(ROOT . '/models/Category.php');
include_once(ROOT . '/models/Product.php');

class CatalogController
{
    public function actionIndex()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $products = Product::getProductsList(9);
        if (!$products) {$products = array();}

        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    public function actionCategory($categoryId)
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $products = Product::getProductsByCategoryId($categoryId);
        if (!$products) {$products = array();}

        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }
}