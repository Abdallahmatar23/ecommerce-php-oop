<?php

namespace App\Core;

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

  
}
