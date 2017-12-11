<?php
class Review {

  private $mysqli;
  private $paperTitle;
  private $reviewerEmail;
  private $score;
  private $whenBidded;
  private $whenSubmitted;
  private $isRecommended;

  public function __construct($mysqli, $paperTitle, $reviewerEmail, $score = "", $whenBidded = "", $whenSubmitted = "", $isRecommended = "") {
    $this->mysqli = $mysqli;
    $this->paperTitle = $paperTitle;
    $this->reviewerEmail = $reviewerEmail;
    $this->score = $this->mysqli->real_escape_string($score);
    $this->whenBidded = $whenBidded;
    $this->whenSubmitted = $whenSubmitted;
    $this->isRecommended = $isRecommended;
  }

  public function getReview() {

  }

  public function addReview() {
    if($result = $this->mysqli->query("INSERT INTO reviews (paper_title, reviewer_email) VALUES ('{$this->paperTitle}', '{$this->reviewerEmail}')")) {
      return true;
    } else {
      return false;
    }
  }


}
?>
