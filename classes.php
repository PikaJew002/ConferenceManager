<?php
require("manager/inc/auth.php");
require("manager/inc/conn.php");

class Admin {
  private $email = "";
  private $password = "";
  private $firstName = "";
  private $lastName = "";
  private $dbConn = null;

  public function __construct($email = "", $password = "", $firstName = "", $lastName = "", $dbConn = null) {
    if($dbConn != null && $email != "" && $password != "") {
      $this->dbConn = $dbConn;
      $this->email = $email;
      $this->password = $password;
      $this->setFromDB();
    } else {
      $this->email = $email;
      $this->password = $password;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
    }
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
