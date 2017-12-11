<?php
class Reviewer {

  private $mysqli;
  private $email;
  private $password;
  private $firstName;
  private $lastName;
  private $confName;
  private $phone;
  private $isAuth;

  public function __construct($mysqli, $email, $password = "", $firstName = "", $lastName = "", $confName = "", $phone = "", $isAuth = 0) {
    $this->mysqli = $mysqli;
    $this->email = $this->mysqli->real_escape_string($email);
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    $this->firstName = $this->mysqli->real_escape_string($firstName);
    $this->lastName = $this->mysqli->real_escape_string($lastName);
    $this->confName = $confName;
    if($phone == "") {
      $this->phone = null;
    } else {
      $this->phone = $phone;
    }
    $this->isAuth = $isAuth;
  }

  public function getReviewer($mysqli = null, $inputEmail = "") {
    if((!empty($inputEmail)) && ($mysqli != null)) {
      $email = $inputEmail;
      $this->mysqli = $mysqli;
    } else {
      $email = $this->email;
    }
    $result = $this->mysqli->query("SELECT * FROM reviewers WHERE email='{$email}'");
    if($result->num_rows == 1) { #  Researcher exists in database
      $reviewer = $result->fetch_assoc();
      $this->firstName = $reviewer['first_name'];
      $this->lastName = $reviewer['last_name'];
      $this->confName = $reviewer['conf_name'];
      $this->phone = $reviewer['phone'];
      $this->isAuth = $reviewer['is_auth'];
      return true;
    } else { #  Researcher doesn't exist yet
      return false;
    }
  }

  public function addReviewer() {
    if($this->mysqli->query("INSERT INTO reviewers (email, conf_name, password, first_name, last_name, phone) VALUES ('{$this->email}', '{$this->confName}', '{$this->password}', '{$this->firstName}', '{$this->lastName}', '{$this->phone}')")) {
      # INSERT query successful
      return true;
    } else { #  INSERT query failed
      return false;
    }
  }

  public function authenticate() {

  }
}
?>
