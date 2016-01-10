<?php

class AdminBlogController extends AdminBase
{
    public static function actionIndex()
    {
        $blogs = Blog::getAllBlogs(true);
        if (!$blogs) {$blogs = array();}

        require_once(ROOT . '/views/admin-blog/index.php');
        return true;
    }

    public static function actionCreate()
    {
        $errors      = array();
        $title       = '';
        $description = '';
        $content     = '';

        if (isset($_POST['submit'])) {
            $title       = FunctionLibrary::clearStr($_POST['title']);
            $description = FunctionLibrary::clearStr($_POST['description']);
            $content     = FunctionLibrary::clearStr($_POST['content']);

            if (!User::checkName($title)) {
                $errors[] = 'Заглавие не может быть пустым.';
            }

            if (!User::checkName($description)) {
                $errors[] = 'Описание не может быть пустым.';
            }

            if (!User::checkName($content)) {
                $errors[] = 'Содержание не может быть пустым.';
            }

            if (empty($errors)) {
                $id = Blog::saveBlog($title, $description, $content);

                if ($id) {
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        $tmpName = $_FILES['image']['tmp_name'];

                        $imagePath = "/images/blog/blog{$id}.jpg";
                        $result = Blog::putImageToDataBase($id, $imagePath);
                        if ($result) {
                            $destination = ROOT . '/template' . $imagePath;
                            $moveResult = move_uploaded_file($tmpName, $destination);
                            if (!$moveResult) {
                                $message = "Произошла ошибка при добавлении картинки.";
                            }
                        }
                    }
                }
            }
        }


        require_once(ROOT . '/views/admin-blog/create.php');
        return true;
    }

    public static function actionUpdate($id)
    {


        require_once(ROOT . '/views/admin-blog/update.php');
        return true;
    }

    public static function actionDelete($id)
    {


        require_once(ROOT . '/views/admin-blog/delete.php');
        return true;
    }
}