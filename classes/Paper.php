<?php
class Paper {

  private $mysqli;
  private $title;
  private $researcherEmail;
  private $abstract;
  private $path;
  private $whenSubmitted;
  private $isAccepted;
  private $reviews;

  public function __construct($mysqli, $title, $researcherEmail = "", $abstract = "", $path = "", $whenSubmitted = "", $isAccepted = 0) {
    $this->mysqli = $mysqli;
    $this->title = $this->mysqli->real_escape_string($title);
    $this->researcherEmail = $this->mysqli->real_escape_string($researcherEmail);
    $this->abstract = $this->mysqli->real_escape_string($abstract);
    $this->path = $path;
    $this->whenSubmitted = $whenSubmitted;
    $this->isAccepted = $isAccepted;
    $this->reviews = array();
  }

  public function getPaper() {
    $result = $this->mysqli->query("SELECT * FROM papers WHERE title='{$this->title}'");
    if($result->num_rows == 1) {
      $paper = $result->fetch_assoc();
      $this->researcherEmail = $paper['researcher_email'];
      $this->abstract = $paper['abstract'];
      $this->path = $paper['path'];
      $this->whenSubmitted = $paper['when_submitted'];
      $this->isAccepted = $paper['is_accepted'];
      return true;
    } else {
      return false;
    }
  }

  public function addPaper() {
    if($this->mysqli->query("INSERT INTO papers (title, researcher_email, abstract, path) VALUES ('{$this->title}', '{$this->researcherEmail}', '{$this->abstract}', '{$this->path}')")) {
      # INSERT query successful
      return true;
    } else { #  INSERT query failed
      return false;
    }
  }

  public function getTitle() {
    return $this->title;
  }

  public function getAbstract() {
    return $this->abstract;
  }

  public function getResearcherEmail() {
    return $this->researcherEmail;
  }

  public function getWhenSubmitted() {
    return $this->whenSubmitted;
  }

  public function getIsAccepted() {
    return $this->isAccepted;
  }

  public function getResearcher() {
    $result = $this->mysqli->query("SELECT * FROM researchers WHERE email='{$this->researcherEmail}'");
    if($result->num_rows == 1) {
      $researcher = $result->fetch_assoc();
      $this->researcher = $researcher;
      return true;
    } else {
      return false;
    }
  }

  public function getReviews() {
    $result = $this->mysqli->query("SELECT * FROM reviews WHERE paper_title='{$this->title}'");
    if($result->num_rows > 0) {
      while($review = $result->fetch_assoc()) {
        $this->reviews[] = $review;
      }
      return true;
    } else {
      return false;
    }
  }

  public function returnReviews() {
    return $this->reviews;
  }
}
?>
