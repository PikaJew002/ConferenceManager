<?php
if($_GET['title']) {
    $paperTitle = $_GET['title'];
}
$paper = new Paper($mysqli, $paperTitle);
$paper->getPaper();
$paper->getReviews();
$reviews = $paper->returnReviews();
$researcher = new Researcher($mysqli, $paper->getResearcherEmail());
$researcher->getResearcher();
?>
    <div id="content_view_panel">
      <div id="paper_title" style="padding: 10px; width: 100%;">
        <h1><?php echo $paperTitle; ?></h1>
      </div>
      <div id="pdf_container" style="float: left; padding: 10px; width: 620px;">
        <h3>PDF</h3>
        <embed id="paper_pdf" src="<?php echo "../papers/".md5($paperTitle).".pdf" ?>" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
      </div>
      <div id="abstract_container" style="float: left; padding: 10px; padding-right: 0px; width: 350px;">
        <h3>Details</h3>
        <u>Author info:</u><br>
        <p>
          Name: <br>
          <em><?php echo $researcher->getLastName().", ".$researcher->getFirstName(); ?></em><br>
          Email: <br>
          <em><?php echo $researcher->getEmail(); ?></em><br>
        </p>
        <u>Abstract:</u><br>
        <p>
          <?php echo $paper->getAbstract(); ?>
        </p>
      </div>
      <div id="paper_reviews" style="float: left; padding: 10px 0px 10px 0px; margin: 0px;">
        <h3>Reviews</h3>
<?php if(count($reviews) > 0) { ?>
        <table style="padding: 0px;">
          <tr>
<?php
$reviewCount = 0;
foreach($reviews as $review) {
  $reviewObj = new Review($mysqli, $review['paper_title'], $review['reviewer_email']);
  $reviewObj->getReview();
  $reviewer = new Reviewer($mysqli, $reviewObj->getReviewerEmail());
  $reviewer->getReviewer();
?>
            <td style="width: 200px; padding: 0px;">
                Reviewer Name: <br>
                <em><?php echo $reviewer->getFirstName().", ".$reviewer->getLastName(); ?></em><br>
                Reviewer Email: <br>
                <em><?php echo $reviewer->getEmail() ?></em><br><br>
<?php if($reviewObj->getScore() != null) { ?>
                Score: <?php echo $reviewObj->getScore(); ?><br>
                Recommend?  <?php echo ($reviewObj->getIsRecommended() == 1 ? "Yes" : "No"); ?>
<?php
$reviewCount = $reviewCount + 1;
} else { ?>
                This reviewer has bid on this paper, but has not submitted a review.
<?php } ?>
            </td>
<?php
}
?>
          </tr>
        </table><br>
        <form action="conference.php" method="post">
          <input type="hidden" name="name" value="<?php echo $conf->getName(); ?>">
          <input type="hidden" name="page" value="papers">
          <input type="hidden" name="title" value="<?php echo $paper->getTitle(); ?>">
<?php if($reviewCount == 3 && $paper->getIsAccepted() == null) { ?>
          Accept: <input type="checkbox" name="is_accepted" value="1"><br>
          <input type="submit" name="accept_paper" value="Submit Acceptance Choice">
<?php } else { ?>
          This paper has been <em><?php echo ($paper->getIsAccepted() == 1 ? "accepted" : "denied"); ?></em>.<br>
<?php } ?>
          <input type="submit" name="go_back" value="Go back">
        </form>
<?php } else { ?>
        There are no bids or reviews submitted for this paper yet.
        <form action="conference.php" method="post">
          <input type="hidden" name="name" value="<?php echo $conf->getName(); ?>">
          <input type="hidden" name="page" value="papers">
          <input type="submit" name="go_back" value="Go back">
        </form>
<?php } ?>
      </div>
    </div>
