<?php
$hasResearchers = $conference->getResearchers();
$researchers = $conference->returnResearchers();
$allPapers = [];
?>
    <div id="container">
      <div id="content_panel">
        <?php echo (!empty($bidded) ? "Bid successful!<br>\n" : ""); ?>
        <table<?php echo (!$hasResearchers ? " hidden" : ""); ?>>
          <tr>
            <th>Can bid?</th>
            <th>Title</th>
            <th>Accepted</th>
            <th>Date Time Submitted</th>
          </tr>
<?php
foreach ($researchers as $researcher) {
  $researcherObj = new Researcher($mysqli, $researcher['email']);
  $researcherObj->getResearcher();
  $researcherObj->getPapers();
  $papers = $researcherObj->returnPapers();
  foreach($papers as $key => $paper) {
    $allPapers[] = $paper;
    $paperObj = new Paper($mysqli, $paper['title']);
    $paperObj->getPaper();
    $paperObj->getReviews();
    $reviews = $paperObj->returnReviews();

    $reviewNum = count($reviews);
?>
        <tr>
          <td><?php echo ($reviewNum < 3 ? "Yes" : "No"); ?></td>
          <td><a href="index.php?page=paper&title=<?php echo $paper['title']; ?>" id="paper_<?php echo $key; ?>" title="<?php echo $paper['title']; ?>"><?php echo substr($paper['title'], 0, 50)." . . ."; ?></a></td>
          <td><?php echo ($paper['is_accepted'] == null ? "Pending" : ($paper['is_accepted'] == 0 ? "No" : "Yes" )); ?></td>
          <td><?php echo $paper['when_submitted']."\n"; ?></td>
        </tr>
<?php
  }
}
?>
      </table>
      <?php echo (empty($allPapers) ? "There are no papers to review." : ""); ?>
      </div>
    </div>
