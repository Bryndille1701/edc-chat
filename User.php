<?php

class User
{
  function __construct( $user_id, $unique_id, $firstname, $lastname, $email, $password, $image, $status ) {
    $this->user_id = $user_id;
    $this->unique_id = $unique_id;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->email = $email;
    $this->password = $password;
    $this->image = $image;
    $this->status = $status;
  }
  public static function buildFromPDO( $user_id, $unique_id, $firstname, $lastname, $email, $password, $image, $status ) {
    return new self( $user_id, $unique_id, $firstname, $lastname, $email, $password, $image, $status );
  }

  public static function getUsers() {
    global $db;
    $query = $db->pdo->prepare('SELECT * FROM user');
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