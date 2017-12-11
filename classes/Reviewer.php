<?php
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
?>
