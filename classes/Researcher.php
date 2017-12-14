<?php
class Researcher {

  private $mysqli;
  private $email;
  private $password;
  private $firstName;
  private $lastName;
  private $confName;
  private $phone;
  private $isCheckedIn;
  private $papers = [];

  public function __construct($mysqli, $email, $password = "", $firstName = "", $lastName = "", $confName = "", $phone = "", $isCheckedIn = 0) {
    $this->mysqli = $mysqli;
    $this->email = $this->mysqli->real_escape_string($email);
    $this->password = $password;
    $this->firstName = $this->mysqli->real_escape_string($firstName);
    $this->lastName = $this->mysqli->real_escape_string($lastName);
    $this->confName = $confName;
    if($phone == "") {
      $this->phone = null;
    } else {
      $this->phone = $phone;
    }
    $this->isCheckedIn = $isCheckedIn;
  }

  public function getResearcher() {
    $result = $this->mysqli->query("SELECT * FROM researchers WHERE email='{$this->email}'");
    if($result->num_rows == 1) { #  Researcher exists in database
      $researcher = $result->fetch_assoc();
      $this->firstName = $researcher['first_name'];
      $this->lastName = $researcher['last_name'];
      $this->confName = $researcher['conf_name'];
      $this->phone = $researcher['phone'];
      $this->isCheckedIn = $researcher['is_checked_in'];
      return true;
    } else { #  Researcher doesn't exist yet
      return false;
    }
  }

  public function addResearcher() {
    $password = password_hash($this->password, PASSWORD_DEFAULT);
    if($this->mysqli->query("INSERT INTO researchers (email, conf_name, password, first_name, last_name, phone) VALUES ('{$this->email}', '{$this->confName}', '{$password}', '{$this->firstName}', '{$this->lastName}', '{$this->phone}')")) {
      # INSERT query successful
      return true;
    } else { #  INSERT query failed
      return false;
    }
  }

  public function updateResearcher($email = "", $password = "", $firstName = "", $lastName = "", $phone = "") {
    if(!empty($email)) {
      $newEmail = $this->mysqli->real_escape_string($email);
      if($this->mysqli->query("UPDATE researchers SET email='{$newEmail}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else if(!empty($password)) {
      $newPassword = password_hash($password, PASSWORD_DEFAULT);
      if($this->mysqli->query("UPDATE researchers SET password='{$newPassword}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else if(!empty($firstName) && !empty($lastName)) {
      $newFirstName = $this->mysqli->real_escape_string($firstName);
      $newLastName = $this->mysqli->real_escape_string($lastName);
      $newPhone = $this->mysqli->real_escape_string($phone);
      if($this->mysqli->query("UPDATE researchers SET first_name='{$newFirstName}', last_name='{$newLastName}', phone='{$newPhone}' WHERE email='{$this->email}'")) {
        # INSERT query successful
        return true;
      } else { #  INSERT query failed
        return false;
      }
    }
    $this->getResearcher();
  }

  public function checkIn() {

  }

  public function getPapers() {
    $result = $this->mysqli->query("SELECT * FROM papers WHERE researcher_email='{$this->email}'");
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $this->papers[] = $row;
      }
      return $this->papers;
    } else {
      return array();
    }
  }

  public function returnPapers() {
    return $this->papers;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPasswordHash() {
    $result = $this->mysqli->query("SELECT password FROM researchers WHERE email='{$this->email}'");
    return $result->fetch_assoc()['password'];
  }

  public function getConfName() {
    return $this->confName;
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
