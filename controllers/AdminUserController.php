<?php

class AdminUserController extends AdminBase
{
    public function actionIndex()
    {
        $users = User::getAdminUsers();
        if (!$users) {$users = array();}

        require_once(ROOT . '/views/admin-user/index.php');
        return true;
    }

    public function actionCreate()
    {
        $name     = '';
        $email    = '';
        $password = '';

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
                $result = User::registerAdmin($name, $email, $password);

                if (!$result) {
                    $message = 'Произошла ошибка при регистрации админа!';
                } else {
                    FunctionLibrary::redirectTo('/admin/user');
                }
            }
        }

        require_once(ROOT . '/views/admin-user/create.php');
        return true;
    }

    public function actionDelete($id)
    {
        $result = User::deleteAdmin($id);
        if ($result) {
            FunctionLibrary::redirectTo('/admin/user');
        }

        return true;
    }
}