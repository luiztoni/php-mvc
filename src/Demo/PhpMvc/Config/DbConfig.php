<?php

namespace Demo\PhpMvc\Config;

class DbConfig
{
    public static function getConnection()
    {
        $dbLocation = $_SERVER['DOCUMENT_ROOT'].'/src/Demo/PhpMvc/Config/demo.db';

        try {
            $pdo = new \PDO('sqlite:'.$dbLocation);         
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
        return $pdo;   
    }
}
