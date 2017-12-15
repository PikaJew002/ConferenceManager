<?php
class Review {

  private $mysqli;
  private $paperTitle;
  private $reviewerEmail;
  private $score;
  private $whenBidded;
  private $whenSubmitted;
  private $isRecommended;

  public function __construct($mysqli, $paperTitle, $reviewerEmail, $score = "", $whenBidded = "", $whenSubmitted = null, $isRecommended = null) {
    $this->mysqli = $mysqli;
    $this->paperTitle = $paperTitle;
    $this->reviewerEmail = $reviewerEmail;
    $this->score = $this->mysqli->real_escape_string($score);
    $this->whenBidded = $whenBidded;
    $this->whenSubmitted = $whenSubmitted;
    $this->isRecommended = $isRecommended;
  }

  public function getReview() {
    $result = $this->mysqli->query("SELECT * FROM reviews WHERE paper_title='{$this->paperTitle}' AND reviewer_email='{$this->reviewerEmail}'");
    if($result->num_rows == 1) {
      $review = $result->fetch_assoc();
      $this->score = $review['score'];
      $this->whenBidded = $review['when_bidded'];
      $this->whenSubmitted = $review['when_submitted'];
      $this->isRecommended = $review['is_recommended'];
      return true;
    } else {
      return false;
    }
  }

  public function addReview() {
    if($result = $this->mysqli->query("INSERT INTO reviews (paper_title, reviewer_email) VALUES ('{$this->paperTitle}', '{$this->reviewerEmail}')")) {
      return true;
    } else {
      return false;
    }
  }

  public static function getBids($mysqli, $reviewerEmail) {
    $results = $mysqli->query("SELECT * FROM reviews WHERE reviewer_email='{$reviewerEmail}'");
    $return = array();
    if($results->num_rows > 0) {
      while($review = $results->fetch_assoc()) {
        $return[] = $review;
      }
      return $return;
    } else {
      return array();
    }
  }

  public function updateReview($score, $recommendation) {
    if($result = $this->mysqli->query("UPDATE reviews SET score='{$score}', is_recommended='{$recommendation}' WHERE paper_title='{$this->paperTitle}' AND reviewer_email='{$this->reviewerEmail}'")) {
      $this->getReview();
      return true;
    } else {
      return false;
    }
  }

  public function getPaperTitle() {
    return $this->paperTitle;
  }

  public function getReviewerEmail() {
    return $this->reviewerEmail;
  }

  public function getWhenBidded() {
    return $this->whenBidded;
  }

  public function getWhenSubmitted() {
    return $this->whenSubmitted;
  }

  public function getIsRecommended() {
    return $this->isRecommended;
  }

  public function getScore() {
    return $this->score;
  }
}
?>
