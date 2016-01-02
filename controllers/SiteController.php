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

    public function actionContact()
    {
        $categories = Category::getCategoriesList();
        if (!$categories) {$categories = array();}

        $email     = '';
        $subject   = '';
        $message   = '';
        $result    = '';

        if (isset($_POST['submit'])) {
            $email    = FunctionLibrary::clearStr($_POST['email']);
            $subject  = FunctionLibrary::clearStr($_POST['subject']);
            $message  = FunctionLibrary::clearStr($_POST['message']);

            $errors = array();



            if (!User::checkEmail($email)) {
                $errors[] = 'Невалидный email.';
            }

            if (!User::checkName($subject)) {
                $errors[] = 'Тема не может быть пустым.';
            }

            if (!User::checkName($message)) {
                $errors[] = 'Сообщение не может быть пустым.';
            }

            if (empty($errors)) {
                $adminEmail = 'testxamppphp@gmail.com';
                $sub = "Тема письма: {$subject}. От: {$email}";
                $mess = "Текст письма: {$message}";
                $result = mail($adminEmail, $sub, $mess);
            }
        }

        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
}