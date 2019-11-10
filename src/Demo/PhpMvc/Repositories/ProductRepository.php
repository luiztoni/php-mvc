<?php

namespace Demo\PhpMvc\Repositories;

use Demo\PhpMvc\Models\Product;
use Demo\PhpMvc\Config\DbConfig;

class ProductRepository implements Repository
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = DbConfig::getConnection();
    }

    public function create($model) 
    {
        if (!($model instanceof Product)) {
            throw new InvalidArgumentException("Model not accepted.");
        } 

        $row = [
            'name' => $model->getName(),
            'price' => $model->getPrice()
        ];

        $sql = "INSERT INTO products VALUES (null, :name, :price);";
        $statement = $this->connection->prepare($sql);
        $status = $statement->execute($row);
    
        if ($status) 
            return $this->connection->lastInsertId();
        else 
            return -1;
    }

    public function update($id, $model) 
    {
        if (!($model instanceof Product)) {
            throw new InvalidArgumentException("Model not accepted.");
        } 

        $row = [
            'id' => $id,
            'name' => $model->getName(),
            'price' => $model->getPrice()
        ];

        $sql = "UPDATE products SET name = :name, price = :price WHERE id = :id;";
        $status = $this->connection->prepare($sql)->execute($row);
    }

    public function read($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM products WHERE id = :id;");
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();
        
        if (!$row) 
            return null;
        return new Product($row['id'], $row['name'], $row['price']);
    }

    public function delete($id)
    {
        $this->connection->prepare("DELETE FROM products WHERE id = :id;")->execute(['id' => $id]);
    }

    public function index()
    {
        $rows = $this->connection->query("SELECT * FROM products;")->fetchAll();
        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product($row['id'], $row['name'], $row['price']);
        }
        return $products;
    }

    public function find($param)
    { 
        $statement = $this->connection->prepare("SELECT * FROM products WHERE name LIKE :name;");
        $statement->execute(['name' => $param.'%']);

        $products = [];
        foreach ($statement as $row) {
            $products[] = new Product($row['id'], $row['name'], $row['price']);
        }
        return $products;
    }
}
