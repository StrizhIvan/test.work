<?php

namespace App\Core;

use PDO;
use PDOException;

abstract class Model
{
    protected string $host;
    protected string $dbName;
    protected string $username;
    protected string $password;
    protected string $charset;
    private $connection;

    public function __construct(array $config)
    {

        $this->host = $config["host"];
        $this->dbName = $config["dbname"];
        $this->username = $config["username"];
        $this->password = $config["password"];
        $this->charset = $config["charset"];

        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}";
        try {
            $this->connection = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            die("Ошибка подключения: " . $e->getMessage());
        }

    }

    public function find()
    {
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne(string $table, string $value, string $column)
    {
        $stmt = $this->connection->prepare("SELECT * from $table WHERE $column = ?");
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $data, array $columns)
    {
        $data = array_map(function ($value) {
            return "'" . $value . "'";
        }, $data);
        $data = implode(",", $data);
        $columns = implode(",", $columns);
        $stmt = $this->connection->prepare("INSERT INTO $table ($columns) VALUES ($data)");
        $stmt->execute();
        //var_dump($stmt);
    }

}