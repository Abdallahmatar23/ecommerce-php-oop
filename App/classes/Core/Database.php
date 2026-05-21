<?php

namespace App\Classes\Core;

// require_once "../../Config/db.php";

use PDO;
use PDOException;

class Database
{
    private static ?PDO $conn = null;



    public function connect()
    {
        if (self::$conn === null) {

            try {
                self::$conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER_NAME, PASSWORD);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$conn;
    }

    public function query(string $sql, array $params = [])
    {
        $stmt = self::$conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function lastInsertId()
    {
        return self::$conn->lastInsertId();
    }

    public function fetchAll(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetch((PDO::FETCH_ASSOC));
    }
}
