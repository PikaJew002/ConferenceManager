<?php
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
