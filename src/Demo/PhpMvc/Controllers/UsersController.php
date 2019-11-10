<?php

namespace Demo\PhpMvc\Controllers;

use Demo\PhpMvc\Repositories\UserRepository as Repository;
use Demo\PhpMvc\Services\AuthService as Auth;

class UsersController extends Controller
{
    public function signin()
    {
        include_once($this->getViewPath("auth/start.phtml"));
    }

    public function register()
    {    
        Auth::register();
    }

    public function login()
    {
        Auth::login();
    }

    public function signup()
    {           
        include_once($this->getViewPath("auth/register.phtml"));
    }

    public function logout()
    {
        Auth::logout();
        header("location:/product/index");
    }

    public function image()
    {
        include_once($this->getViewPath("users/image.phtml"));
    }

    public function upload()
    {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check == false) 
            header("location:/product/index");
        else {
    
            $path = $this->getImagePath(basename($_FILES["file"]["name"]));
            move_uploaded_file($_FILES["file"]["tmp_name"], $path);

            $imageName = $_FILES["file"]["name"];
            
            session_start();
            $_SESSION['user_image'] = $imageName;
            
            $repository = new Repository;

            $user = $repository->read($_SESSION['user_id']);
            $user->setImage($imageName);
            $repository->update($_SESSION['user_id'], $user);
        }
        header("location:/product/index");      
    }
}
