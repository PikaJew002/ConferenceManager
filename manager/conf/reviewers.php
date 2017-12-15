<div id="container">
  <div id="content_panel">
<?php
$conf->getReviewers();
$reviewers = $conf->returnReviewers();
# print table of researchers if there are any
if(count($reviewers) > 0) { ?>
    <table>
      <tr>
        <th>Authenticated?</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
<?php
foreach($reviewers as $reviewer) {
  $reviewerObj = new Reviewer($mysqli, $reviewer['email']);
  $reviewerObj->getReviewer();
?>
      <tr>
        <td><?php echo ($reviewerObj->getIsAuth() == 0 ? "No" : "Yes"); ?></td>
        <td><a href="conference.php?name=<?php echo $conf->getName(); ?>&page=reviewer&email=<?php echo $reviewerObj->getEmail(); ?>" id="paper_a"><?php echo $reviewerObj->getLastName().", ".$reviewerObj->getFirstName(); ?></a></td>
        <td><?php echo $reviewerObj->getEmail(); ?></td>
      </tr>
<?php } ?>
    </table>
<?php } else { ?>
    There are no papers submitted for this conference yet.
<?php } ?>
  </div>
</div>
