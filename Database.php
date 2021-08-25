<?php

class Database
{
  protected $pdo;

  public function __construct($hostname, $port_number, $username_db, $password_db, $db_name)
  {
    try {
      $this->pdo = new PDO("mysql:host=" . $hostname . ";dbname=" . $db_name . ";port=" . $port_number, $username_db, $password_db);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

    }
    catch (PDOException $e) {
      echo "error " . $e->getMessage();
    }
  }

  public function getUsers() {
    $query = $this->pdo->prepare('SELECT * FROM user');
    try {
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');
      return $result;
    }
    catch (PDOException $exception) {
      echo $exception->getMessage();
      exit();
    }
  }
}