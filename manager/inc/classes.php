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

class Admin {

  public function __construct($mysqli, $email, $password) {

  }
}

class Reviewer {

  private $confName;
  private $phone;
  private $isAuth;

  public function __construct($mysqli, $email, $password, $confName = "", $firstName = "", $lastName = "", $phone = "") {

  }

  private function populate() {
    $result = $this->mysqli->query("SELECT * FROM {$this->tblName} WHERE email='{$this->email}'");
    $reviewer = $result->fetch_assoc();
    $this->confName = $reviewer['conf_name'];
    $this->phone = $reviewer['phone'];
    $this->isAuth = (bool) $reviewer['is_auth'];
  }
}

class Researcher extends Login {

  private $confName;
  private $phone;
  private $isRSVP;

  public function __construct($mysqli, $email, $password, $confName = "", $firstName = "", $lastName = "", $phone = "") {
    parent::__construct($mysqli, "reviewers", $email, $password); # verifies login and sets first and last name

    if($this->doesExist() && $this->isLoggedIn()) {
      $this->populate();
    }
  }

  private function populate() {
    $result = $this->mysqli->query("SELECT * FROM {$this->tblName} WHERE email='{$this->email}'");
    $researcher = $result->fetch_assoc();
    $this->confName = $researcher['conf_name'];
    $this->phone = $researcher['phone'];
    $this->isRSVP = (bool) $researcher['is_rsvp'];
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
