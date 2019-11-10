<?php

namespace Demo\PhpMvc\Services;

use Demo\PhpMvc\Models\User;
use Demo\PhpMvc\Repositories\UserRepository as Repository;

class AuthService
{
    public static function login()
    {
       $password = filter_input(INPUT_POST, 'password');
       $email = filter_input(INPUT_POST, 'email');
       $repository = new Repository;
       $user = $repository->match($email, $password);
       
       if ($user) {
            self::start($user);    
       } 
       else 
            header("location:/users/signin");
    }

    public static function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_image']);
        session_destroy();
        setcookie("token", null, 1, "/");
    }

    public static function start($user)
    {
        setcookie("token", bin2hex(random_bytes(32)), time()+3600, "/");
        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_image'] = $user->getImage();
        header("location:/products/index");
    }

    public static function register()
    {
        $email = filter_input(INPUT_POST, 'email');
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        $password = filter_input(INPUT_POST, 'password');
        $password = password_hash($password, PASSWORD_DEFAULT);
       
        $repository = new Repository;
        $user = new User(null, $email, $password, "default.png");

       
        $id = $repository->create($user);
        $user->setId($id);
        self::start($user);
    }
}
