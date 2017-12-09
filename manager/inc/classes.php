<?php

class Login {

  private $mysqli;
  private $tblName;
  private $email;
  private $password;
  private $exists;
  private $loggedIn;

  public function __construct($mysqli, $tblName, $email, $password = "") {
    $this->mysqli = $mysqli;
    $this->tblName = $tblName;
    $this->email = $email;
    $this->password = $password;
    $this->login();
  }

  private function login(): bool {
    $result = $mysqli->query("SELECT * FROM {$this->tblName} WHERE email='{$this->email}'");
    if($result->num_rows == 1) {
      $this->exists = true;
      if(password_verify($this->password, $result->fetch_assoc()['password'])) {
        $this->loggedIn = true;
      } else {
        $this->loggedIn = false;
      }
    } else {
      $this->exists = false;
    }
  }

  public function doesExist() {
    return $this->exists;
  }

  public function isLoggedIn() {
    return $this->loggedIn;
  }
}

class Admin extends Login {

  private $firstName;
  private $lastName;

  public function __construct($mysqli, $email, $password = "", $firstName = "", $lastName = "") {
    parent::__construct($mysqli, "admin_users", $email, $password);
    $this->firstName = $firstName;
    $this->lastName = $lastName;
  }

  private function setFromDB() {
    $query = "SELECT * FROM admin_users WHERE email='".$this->email."' AND password='".$this->password."'";
    $result = $this->dbConn->query($query);
    if($result->num_rows != 0) {
      $admin = $result->fetch_assoc();
      $this->firstName = $admin['first_name'];
      $this->lastName = $admin['last_name'];
      return true;
    } else {
      return false;
    }
  }

  public function getEmail() {
      return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }
}

class Conference {
  private $name = "";
  private $admin = "";
  private $location = "";
  private $startDate = "";
  private $endDate = "";
  private $dbConn = null;

  public function __construct($name = "", $admin = "", $location = "", $startDate = "", $endDate = "", $dbConn = null) {
    if($dbConn != null && $admin != "" && $name != "") {
      $this->dbConn = $dbConn;
      $this->name = $name;
      $this->admin = $admin;
      $this->setFromDB();
    } else {
      $this->name = $name;
      $this->admin = $admin;
      $this->location = $location;
      $this->startDate = $startDate;
      $this->endDate = $endDate;
    }
  }

  private function setFromDB() {
    $query = "SELECT * FROM conferences WHERE name='".$this->name."' AND admin_email='".$this->admin."'";
    $result = $this->dbConn->query($query);
    if($result->num_rows != 0) {
      $conf = $result->fetch_assoc();
      $this->location = $conf['location'];
      $this->start_date = $conf['date_start'];
      $this->end_date = $conf['date_end'];
      return true;
    } else {
      return false;
    }
  }

  public function getName() {
    return $this->name;
  }

  public function getAdmin() {
    return $this->admin;
  }

  public function getLocation() {
    return $this->location;
  }

  public function getStartDate() {
    return $this->startDate;
  }

  public function getEndDate() {
    return $this->endDate;
  }
}

?>
