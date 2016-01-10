<?php

class BlogController
{
    public function actionIndex()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $blogs = Blog::getAllBlogs();
        if (!$blogs) {$blogs = array();}

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