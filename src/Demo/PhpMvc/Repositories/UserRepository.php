<?php

namespace Demo\PhpMvc\Repositories;

use Demo\PhpMvc\Models\User;
use Demo\PhpMvc\Config\DbConfig;

class UserRepository implements Repository
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = DbConfig::getConnection();
    }

    public function create($model) 
    {
        
        if (!($model instanceof User)) {
            throw new InvalidArgumentException("Model not accepted.");
        }

        $row = [
            'email' => $model->getEmail(),
            'password' => $model->getPassword(),
            'image' => "default.png"
        ];

        $sql = "INSERT INTO users VALUES (null, :email, :password, :image);";
        $statement = $this->connection->prepare($sql);
        $status = $statement->execute($row);

        if ($status) 
            return $this->connection->lastInsertId();
        else 
            return -1;
    }

    public function match($email, $password)
    { 
        $statement = $this->connection->prepare("SELECT * FROM users WHERE email = :email;");
        $statement->execute(['email' => $email]);
        $row = $statement->fetch();
        
        if (password_verify($password, $row['password'])) {
            return new User($row['id'], $row['email'], $row['password'], $row['image']);
        } 
        return null;
    }

    public function update(int $id, $model)
    {
        if (!($model instanceof User)) {
            throw new InvalidArgumentException("Model not accepted.");
        }
        
        $row = [
            'id' => $id,
            'email' => $model->getEmail(),
            'password' => $model->getPassword(),
            'image' => $model->getImage()
        ];

        $sql = "UPDATE users SET email = :email, password = :password, image=:image WHERE id = :id;";
        $status = $this->connection->prepare($sql)->execute($row);
    }

    public function read(int $id)
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();
        
        if (!$row) 
            return null;
        return new User($row['id'], $row['email'], $row['password'], $row['image']);
    }

    public function delete(int $id)
    {
        //TODO
        throw new Exception("Method not implemented.");
    }

    public function index()
    {
        //TODO
        throw new Exception("Method not implemented.");
    }

    public function find(string $param)
    {
        //TODO
        throw new Exception("Method not implemented.");
    }
}
