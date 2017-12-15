    <div id="container">
      <div id="content_panel">
<?php
$conf->getResearchers();
$researchers =$conf->returnResearchers();
# print table of researchers if there are any
if(count($researchers) > 0) { ?>
        <table>
          <tr>
            <th>Accepted</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Time Submitted</th>
          </tr>
<?php
foreach($researchers as $researcher) {
  $researcherObj = new Researcher($mysqli, $researcher['email']);
  $researcherObj->getResearcher();
  $researcherObj->getPapers();
  foreach($researcherObj->returnPapers() as $paper) {
    $paperObj = new Paper($mysqli, $paper['title']);
    $paperObj->getPaper();
?>
          <tr>
            <td><?php echo ($paperObj->getIsAccepted() == null ? "Pending" : ($paperObj->getIsAccepted() == 0 ? "Denied" : "Accepted")); ?></td>
            <td><a href="conference.php?name=<?php echo $conf->getName(); ?>&page=paper&title=<?php echo $paperObj->getTitle(); ?>" id="paper_a" title="<?php echo $paperObj->getTitle(); ?>"><?php echo substr($paperObj->getTitle(), 0, 50)." . . ."; ?></a></td>
            <td><?php echo $researcherObj->getLastName().", ".$researcherObj->getFirstName(); ?></td>
            <td><?php echo $paperObj->getWhenSubmitted(); ?></td>
          </tr>
<?php
  }
}
?>
        </table>
<?php } else { ?>
        There are no papers submitted for this conference yet.
<?php } ?>
      </div>
    </div>
