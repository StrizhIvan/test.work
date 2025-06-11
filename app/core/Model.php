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
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findOne(string $table, string $value, string $column)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $table WHERE $column = :value");
        $stmt->execute(['value' => $value]);
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
    }

    public function updateById(string $table, array $data, int $id)
    {
        //, array $data, array $columns
        $setParts = [];
        $params = [];

        foreach ($data as $column => $value) {
            $paramName = ':' . $column;
            $setParts[] = "`$column` = $paramName";
            $params[$paramName] = $value;
        }

        $strParts = implode(", ", $setParts);
        $stmt = $this->connection->prepare("UPDATE $table SET $strParts WHERE id = $id");
        $stmt->execute($params);
    }

}