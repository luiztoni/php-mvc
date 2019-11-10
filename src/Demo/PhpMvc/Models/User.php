<?php

namespace Demo\PhpMvc\Models; 

class User
{
    private $id;
    private $email;
    private $password;
    private $image;

    public function __construct($id = null, $email, $password, $image)
    {
        $this->id = $id;
        $this->setEmail($email);
        $this->password = $password;
        $this->image = $image;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail() 
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}
