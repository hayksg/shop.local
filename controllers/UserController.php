<?php

class UserController
{
    public function actionRegister()
    {
        $name     = '';
        $email    = '';
        $password = '';
        $result   = '';

        if (isset($_POST['submit'])) {
            $name     = FunctionLibrary::clearStr($_POST['name']);
            $email    = FunctionLibrary::clearStr($_POST['email']);
            $password = FunctionLibrary::clearStr($_POST['password']);

            $errors = array();

            if (!User::checkName($name)) {
                $errors[] = 'Имя должно быть больше 1 символа.';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Невалидный email.';
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже существует.';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль должен быть больше 5 символов.';
            }

            if (empty($errors)) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once(ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogin()
    {
        $email    = '';
        $password = '';
        $remember = '';

        if (isset($_POST['submit'])) {
            $email    = FunctionLibrary::clearStr($_POST['email']);
            $password = FunctionLibrary::clearStr($_POST['password']);
            if (isset($_POST['remember'])) {
                $remember = FunctionLibrary::clearStr($_POST['remember']);
            }

            $errors = array();

            if (!User::checkEmail($email)) {
                $errors[] = 'Невалидный email.';
            }

            $user = User::login($email, $password, $remember);
            if ($user) {
                User::auth($user);
                FunctionLibrary::redirectTo('/cabinet');
            } else {
                $errors[] = 'Неправильные данные для входа на сайт.';
            }

        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    public function actionLogout()
    {
        User::logout();
        FunctionLibrary::redirectTo('/');
    }
}