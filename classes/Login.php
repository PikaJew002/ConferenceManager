<?php
class Login {

  private $mysqli;
  private $tblName;
  private $email;
  private $password;
  private $firstName;
  private $lastName;
  private $exists;
  private $loggedIn;

  public function __construct($mysqli, $tblName, $email, $password) {
    # sets properties of class from provided values (or default values)
    $this->mysqli = $mysqli;
    $this->tblName = $tblName;
    $this->email = $email;
    $this->password = $password;
    $this->exists = false;
    $this->loggedIn = false;

    # runs login verification/and sets firstName and lastName from database
    $this->login();
  }

  # sets exists and loggedIn based on email and password combination
  private function login() {
    $result = $this->mysqli->query("SELECT * FROM {$this->tblName} WHERE email='{$this->email}'");
    if($result->num_rows == 1) {
      $this->exists = true;
      $user = $result->fetch_assoc();
      if(password_verify($this->password, $user['password'])) {
        $this->loggedIn = true;
      } else {
        $this->loggedIn = false;
      }
    } else {
      $this->exists = false;
    }
  }

  public static function isValidEmail($email): bool {
    # code later, if time
    if($email) {
      return true;
    }
    return false;
  }

  public static function isValidPassword($password): bool {
    # code later, if time
    if($password) {
      return true;
    }
    return false;
  }

  public function doesExist(): bool {
    return $this->exists;
  }

  public function isLoggedIn(): bool {
    return $this->loggedIn;
  }

  public function getEmail() {
      return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }
}
?>
