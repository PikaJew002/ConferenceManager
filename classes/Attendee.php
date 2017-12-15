<?php
class Attendee {

  private $mysqli;
  private $email;
  private $firstName;
  private $lastName;
  private $confName;
  private $card;
  private $whenRegistered;
  private $isCheckedIn;

  public function __construct($mysqli, $email, $firstName, $lastName, $confName = "", $card = 0, $isCheckedIn = 0) {
    $this->mysqli = $mysqli;
    $this->email = $this->mysqli->real_escape_string($email);
    $this->firstName = $this->mysqli->real_escape_string($firstName);
    $this->lastName = $this->mysqli->real_escape_string($lastName);
    $this->confName = $confName;
    $this->card = $card;
    $this->isCheckedIn = $isCheckedIn;
  }

  public function getAttendee() {
    $result = $this->mysqli->query("SELECT * FROM attendees WHERE email='{$this->email}' AND first_name='{$this->firstName}' AND last_name='{$this->lastName}'");
    if($result->num_rows == 1) { #  Attendee exists in database
      $attendee = $result->fetch_assoc();
      $this->confName = $attendee['conf_name'];
      $this->card = $attendee['card'];
      $card = new Card($this->mysqli, $attendee['card']);
      $card->getCard();
      return true;
    } else { #  Attendee doesn't exist yet
      return false;
    }
  }

  public function addAttendee() {
    if($this->mysqli->query("INSERT INTO attendees (email, first_name, last_name, conf_name, card) VALUES ('{$this->email}', '{$this->firstName}', '{$this->lastName}', '{$this->confName}', '{$this->card}')")) {
      # INSERT query successful
      return true;
    } else { #  INSERT query failed
      return false;
    }
  }

  public function updateAttendee($email = "", $firstName = "", $lastName = "", $isCheckedIn = 0) {
    if(!empty($email)) {
      # Editing the email is not allowed in this version. May be implemented in future versions
    } else if(!empty($firstName) && !empty($lastName)) {
      # Editing the first and/or last name is not allowed in this version. May be implemented in future versions
    } else if($isCheckedIn == 1) {
      if($result = $this->mysqli->query("UPDATE attendees SET is_checked_in='{$isCheckedIn}' WHERE email='{$this->email}' AND first_name='{$this->firstName}' AND last_name='{$this->lastName}'")) {
        $this->getAttendee();
        return true;
      } else {
        return false;
      }
    }
  }

  public function isCheckedIn() {
    if($this->isCheckedIn == 0) {
      return false;
    } else {
      return true;
    }
  }
}
?>
