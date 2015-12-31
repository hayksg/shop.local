<?php

class CatalogController
{
    public function actionIndex($page = 1)
    {
        $page = (int)$page;
        $count = 9;

        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $products = Product::getProductsList($count, $page);
        if (!$products) {$products = array();}

        $total = Product::getTotalProducts();
        $pagination = FunctionLibrary::buildPagination($total, $count, $page, 'page-');

        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $page = (int)$page;
        $count = 9;

        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $products = Product::getProductsByCategoryId($categoryId, $count, $page);
        if (!$products) {$products = array();}

        $total = Product::getTotalProductsInCategory($categoryId);
        $pagination = FunctionLibrary::buildPagination($total, $count, $page, 'page-');

        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }
}