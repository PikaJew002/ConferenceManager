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
    # must be 5-255 characters
    if(strlen($email) >=5 && strlen($email) <= 255) {
      # valid email address
      #if(preg_match("^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$", $email)) {
        return true;
      # else {
        #return false;
      #
    } else {
      return false;
    }
  }

  public static function isValidPassword($password): bool {
    # must be at least 3 characters
    if(strlen($password) >=3) {
      return true;
    } else {
      return false;
    }
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
