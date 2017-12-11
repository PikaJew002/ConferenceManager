<?php
class Researcher {

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
?>
