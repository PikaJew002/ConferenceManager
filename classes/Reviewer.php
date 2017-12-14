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

  public function getReviewer() {
    $result = $this->mysqli->query("SELECT * FROM reviewers WHERE email='{$this->email}'");
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

  public function updateReviewer($email = "", $password = "", $firstName = "", $lastName = "", $phone = "") {
    if(!empty($email)) {
      $newEmail = $this->mysqli->real_escape_string($email);
      if($this->mysqli->query("UPDATE reviewers SET email='{$newEmail}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else if(!empty($password)) {
      $newPassword = password_hash($password, PASSWORD_DEFAULT);
      if($this->mysqli->query("UPDATE reviewers SET password='{$newPassword}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else if(!empty($firstName) && !empty($lastName)) {
      $newFirstName = $this->mysqli->real_escape_string($firstName);
      $newLastName = $this->mysqli->real_escape_string($lastName);
      $newPhone = $this->mysqli->real_escape_string($phone);
      if($this->mysqli->query("UPDATE reviewers SET first_name='{$newFirstName}', last_name='{$newLastName}', phone='{$newPhone}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    }
    $this->getResearcher();
  }

  public function authenticate() {

  }

  public function getEmail() {
    return $this->email;
  }

  public function getPasswordHash() {
    $result = $this->mysqli->query("SELECT password FROM reviewers WHERE email='{$this->email}'");
    return $result->fetch_assoc()['password'];
  }

  public function getConfName() {
    return $this->confName;
  }

  public function getIsAuth() {
    return $this->isAuth;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function getPhone() {
    return $this->phone;
  }
}
?>
