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
    $this->password = password_hash($password, PASSWORD_DEFAULT);
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
    if($this->mysqli->query("INSERT INTO researchers (email, conf_name, password, first_name, last_name, phone) VALUES ('{$this->email}', '{$this->confName}', '{$this->password}', '{$this->firstName}', '{$this->lastName}', '{$this->phone}')")) {
      # INSERT query successful
      return true;
    } else { #  INSERT query failed
      return false;
    }
  }

  public function checkIn() {

  }

  public function getPapers() {
    $result = $this->mysqli->query("SELECT * FROM papers WHERE researcher_email='{$this->email}'");
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $this->papers[] = $row;
      }
      return true;
    } else {
      return false;
    }
  }
}
?>
