<?php

class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        $categories = Category::getCategoriesList(false);
        if (!$categories) {$categories = array();}

        $message = FunctionLibrary::sessionMessage();

        require_once(ROOT . '/views/admin-category/index.php');
        return true;
    }

    public function actionCreate()
    {
        $totalCategory = Category::getTotalCategory();
        if (!$totalCategory) {$totalCategory = 0;}

        $name      = '';
        $sortOrder = '';
        $status    = '';
        $errors    = '';

        if (isset($_POST['submit'])) {
            $name      = FunctionLibrary::clearStr($_POST['name']);
            $sortOrder = FunctionLibrary::clearStr($_POST['sortOrder']);
            $status    = FunctionLibrary::clearStr($_POST['status']);

            if (!User::checkName($name)) {
                $errors[] = 'Название категории должно быть больше 1 символа.';
            }

            if (empty($errors)) {
                $result = Category::createCategory($name, $sortOrder, $status);

                if (!$result) {
                    $message = 'Произошла ошибка при добавлении категории.';
                } else {
                    FunctionLibrary::redirectTo('/admin/category');
                }
            }
        }

        require_once(ROOT . '/views/admin-category/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        $category = Category::getCategoryById($id);
        if (!$category) {$category = array();}

        $totalCategory = Category::getTotalCategory();
        if (!$totalCategory) {$totalCategory = 0;}

        $name      = '';
        $sortOrder = '';
        $status    = '';
        $errors    = array();

        if (isset($_POST['submit'])) {
            $name      = FunctionLibrary::clearStr($_POST['name']);
            $sortOrder = FunctionLibrary::clearStr($_POST['sortOrder']);
            $status    = FunctionLibrary::clearStr($_POST['status']);

            if (!User::checkName($name)) {
                $errors[] = 'Название категории должно быть больше 1 символа.';
            }

            if (empty($errors)) {
                $result = Category::editCategory($id, $name, $sortOrder, $status);

                if (!$result) {
                    $message = 'Произошла ошибка при редактировании категории.';
                } else {
                    FunctionLibrary::redirectTo('/admin/category');
                }
            }
        }

        require_once(ROOT . '/views/admin-category/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])) {
            $result = Category::deleteCategory($id);

            if (!$result) {
                $_SESSION['message'] = 'Произошла ошибка при удалении.';
            }
            FunctionLibrary::redirectTo('/admin/category');
        }

        return true;
    }
}