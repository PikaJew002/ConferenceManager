<?php
if(!$error) {
  if($_GET['title']) {
    $paperTitle = $_GET['title'];
  } else {
    $paperTitle = $title;
  }
} else {
  if(isset($title)) {
    $paperTitle = $title;
  } else {

  }
}
$paper = new Paper($mysqli, $paperTitle);
$paper->getPaper();
$paper->getReviews();
$reviews = $paper->returnReviews();
$review = new Review($mysqli, $paperTitle, $_SESSION['id']);
$review->getReview();
$researcher = new Researcher($mysqli, $paper->getResearcherEmail());
$researcher->getResearcher();
?>
    <div id="content_view_panel">
      <div id="pdf_container" style="float: left; padding: 10px; width: 620px;">
        <h2 style="text-align: center;"><?php echo $paperTitle; ?></h2>
        <embed id="paper_pdf" src="<?php echo "../papers/".md5($paperTitle).".pdf"; ?>" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
      </div>
      <div id="abstract_container" style="float: left; padding: 10px;">
        <b>Abstract:</b> <br>
        <p style="padding-left: 10px;">
          <?php echo $paper->getAbstract(); ?>
        </p>
        <b>Author info:</b> <br>
        <p style="padding-left: 10px;">
          Name: <em><?php echo $researcher->getLastName().", ".$researcher->getFirstName(); ?></em><br>
          Email: <em><?php echo $researcher->getEmail(); ?></em><br>
        </p>
      </div>
      <div id="paper_reviews" style="float: left; padding: 10px;">
        <form action="index.php" method="post">
          <input type="hidden" name="title" value="<?php echo $paper->getTitle(); ?>">
          Score: <br>
<?php if($review->getScore() == null) { ?>
          <input type="number" name="score" min="0" max="100">%<br>
<?php } else { echo $review->getScore()."%<br>"; } ?>
          Recommend:
<?php if($review->getIsRecommended() == null) { ?>
          <input type="checkbox" name="is_recommended" value="1"><br>
<?php } else if($review->getIsRecommended() == 0) {
        echo "Not recommended<br>\n";
      } else {
        echo "Recommended<br>\n";
      }
      if(count($reviews) < 3 && $review->getScore() == null) { ?>
          <input type="submit" name="submit_review" value="Submit Review"><br>
<?php } else { echo "Bidding not available.<br>\n"; } ?>
          <input type="submit" name="go_back" value="Go Back"><br>
<?php echo $msg; ?>
        </form>
      </div>
    </div>
