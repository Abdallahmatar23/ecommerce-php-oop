<?php

namespace App\Core;

use App\Core\Database;
use PDO;

class Model
{
  protected   PDO $db;
  public function __construct()
  {
    $this->db = (new Database())->connect();
  }
  public function query(string $sql, array $params = [])
  {
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }
  public function lastInsertId()
  {
    return $this->db->lastInsertId();
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
