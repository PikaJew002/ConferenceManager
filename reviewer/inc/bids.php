<?php
$bids = Review::getBids($mysqli, $_SESSION['id']);
?>
    <div id="container">
      <div id="content_panel">
        <table<?php echo (empty($bids) ? " hidden" : ""); ?>>
          <tr>
            <th>Title</th>
            <th>Reviewed</th>
            <th>Author</th>
          </tr>
<?php
foreach ($bids as $bid) {
  $review = new Review($mysqli, $bid['paper_title'], $bid['reviewer_email']);
  $review->getReview();
  $paper = new Paper($mysqli, $bid['paper_title']);
  $paper->getPaper();
  $researcher = new Researcher($mysqli, $paper->getResearcherEmail());
  $researcher->getResearcher();
?>
        <tr>
          <td><a href="index.php?page=review&title=<?php echo $paper->getTitle(); ?>"><?php echo substr($paper->getTitle(), 0, 50)." . . ."; ?></a></td>
          <td><?php echo ($review->getWhenSubmitted() == null ? "Needs reviewing" : $review->getWhenSubmitted()); ?></td>
          <td><?php echo $researcher->getLastName().", ".$researcher->getFirstName(); ?></td>
        </tr>
<?php } ?>
      </table>
      <?php echo (empty($bids) ? "Go to the <a href=\"index.php?page=index\">Papers</a> page to select papers to review." : ""); ?>
      </div>
    </div>
