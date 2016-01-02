<?php

class AdminBase
{
    public function __construct()
    {
        $email = User::isLogged();
        $user = User::getUserByEmail($email);

        if ($user['role'] == 'super_admin' || $user['role'] == 'admin') {
            return true;
        }
        die('Access denied.');
    }
}