<?php
class Conference {

  private $mysqli;
  private $name;
  private $admin;
  private $location;
  private $startDate;
  private $endDate;
  private $researchers;
  private $reviewers;

  public function __construct($mysqli, $name, $admin = "", $location = "", $startDate = "", $endDate = "") {
    $this->mysqli = $mysqli;
    $this->name = $name;
    $this->admin = $admin;
    $this->location = $location;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
    $this->researchers = array();
    $this->reviewers = array();
  }

  public function getConference() {
    $result = $this->mysqli->query("SELECT * FROM conferences WHERE name='{$this->name}'");
    if($result->num_rows == 1) { #  Conference exists in database
      $conference = $result->fetch_assoc();
      $this->admin = $conference['admin_email'];
      $this->location = $conference['location'];
      $this->startDate = $conference['date_start'];
      $this->endDate = $conference['date_end'];
      return true;
    } else { #  Conference doesn't exist yet
      return false;
    }
  }

  public function getResearchers() {
    $result = $this->mysqli->query("SELECT * FROM researchers WHERE conf_name='{$this->name}'");
    if($result->num_rows > 0) {
      while($researcher = $result->fetch_assoc()) {
        $this->researchers[] = $researcher;
      }
      return true;
    } else {
      return false;
    }
  }

  public function returnResearchers() {
    return $this->researchers;
  }

  public function getReviewers() {
    $result = $this->mysqli->query("SELECT * FROM reviewers WHERE conf_name='{$this->name}'");
    if($result->num_rows > 0) {
      while($reviewer = $result->fetch_assoc()) {
        $this->reviewers[] = $reviewer;
      }
      return true;
    } else {
      return false;
    }
  }

  public function returnReviewers() {
    return $this->reviewers;
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
