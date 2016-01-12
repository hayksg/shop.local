<?php

class BlogController
{
    public function actionIndex($page = 1)
    {
        $page = (int)$page;
        $count = 6;

        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $blogs = Blog::getAllBlogs($count, $page);
        if (!$blogs) {$blogs = array();}

        $total = Blog::getTotalBlogs();
        $pagination = FunctionLibrary::buildPagination($total, $count, $page, 'page-');

        require_once(ROOT . '/views/blog/index.php');
        return true;
    }

    public function actionView($id)
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $blog = Blog::getBlogById($id);
        if (!$blog) {$blog = array();}

        require_once(ROOT . '/views/blog/view.php');
        return true;
    }
}