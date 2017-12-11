<?php
class Card {

  private $mysqli; #  MySQLi object
  private $id; # the identifier (in the database)
  private $cardNum; # the card number
  private $name; #  the name on the card
  private $billingAddress; #  the billing address
  private $exp; # the 4-digit expiration date (mmyy)
  private $securityCode; #  the 3-digit security code found on the back on a credit card

  public function __construct($mysqli, $id, $cardNum = "", $name = "", $billingAddress = "", $exp = "", $securityCode = "") {
    # escapes and sets properties
    $this->mysqli = $mysqli;
    $this->id = $id;
    $this->cardNum = $this->mysqli->real_escape_string($cardNum);
    $this->name = $this->mysqli->real_escape_string($name);
    $this->billingAddress = $this->mysqli->real_escape_string($billingAddress);
    $this->exp = $this->mysqli->real_escape_string($exp);
    $this->securityCode = $this->mysqli->real_escape_string($securityCode);
  }

  # Retrieves Card from the database using id
  public function getCard(): bool {
    $result = $this->mysqli->query("SELECT * FROM cards WHERE id='{$this->id}'");
    if($result->num_rows == 1) { #  Card exists in database
      $card = $result->fetch_assoc();
      $this->cardNum = $card['card_num'];
      $this->name = $card['name'];
      $this->billingAddress = $card['billing_address'];
      $this->exp = $card['exp'];
      $this->securityCode = $card['security_code'];
      return true;
    } else { #  Card doesn't exist yet
      return false;
    }
  }

  # Adds new Card to the database with the info specified
  public function addCard(): bool {
    if($this->id == 0) { #  Card doesn't exist yet
      if($result = $this->mysqli->query("INSERT INTO cards (card_num, name, billing_address, exp, security_code) VALUES ('{$this->cardNum}', '{$this->name}', '{$this->billingAddress}', '{$this->exp}', '{$this->securityCode}')")) {
        # INSERT query successful
        $lastEntry = $this->mysqli->query("SELECT max(id) FROM cards")->fetch_assoc();
        $this->id = $lastEntry['max(id)'];
        return true;
      } else { #  INSERT query failed
        return false;
      }
    } else { #  Card does exist in database
      return false;
    }
  }

  # Get functions: return value of property, only included ones that are used
  public function getId() {
    return $this->id;
  }

  public function getCardNum() {
    return $this->cardNum;
  }

  # Set functions: sets value of property, only includes ones that are nessecary
  public function setId($id) {
    $this->id = $id;
  }
}
?>
