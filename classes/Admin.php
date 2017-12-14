<?php
class Admin {

  private $mysqli;
  private $email;
  private $password;
  private $firstName;
  private $lastName;

  public function __construct($mysqli, $email, $password = "", $firstName = "", $lastName = "") {
    $this->mysqli = $mysqli;
    $this->email = $this->mysqli->real_escape_string($email);
    $this->password = $password;
    $this->firstName = $this->mysqli->real_escape_string($firstName);
    $this->lastName = $this->mysqli->real_escape_string($lastName);
  }

  public function getAdmin() {
    $result = $this->mysqli->query("SELECT * FROM admin_users WHERE email='{$this->email}'");
    if($result->num_rows == 1) { #  Admin exists in database
      $admin = $result->fetch_assoc();
      $this->firstName = $admin['first_name'];
      $this->lastName = $admin['last_name'];
      return true;
    } else { #  Admin doesn't exist yet
      return false;
    }
  }

  public function updateAdmin($email = "", $password = "", $firstName = "", $lastName = "", $phone = "") {
    if(!empty($email)) {
      $newEmail = $this->mysqli->real_escape_string($email);
      if($this->mysqli->query("UPDATE admin_users SET email='{$newEmail}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else if(!empty($password)) {
      $newPassword = password_hash($password, PASSWORD_DEFAULT);
      if($this->mysqli->query("UPDATE admin_users SET password='{$newPassword}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else if(!empty($firstName) && !empty($lastName)) {
      $newFirstName = $this->mysqli->real_escape_string($firstName);
      $newLastName = $this->mysqli->real_escape_string($lastName);
      if($this->mysqli->query("UPDATE admin_users SET first_name='{$newFirstName}', last_name='{$newLastName}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    }
    $this->getAdmin();
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPasswordHash() {
    $result = $this->mysqli->query("SELECT password FROM admin_users WHERE email='{$this->email}'");
    return $result->fetch_assoc()['password'];
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }
}
?>
