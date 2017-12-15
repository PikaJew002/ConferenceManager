    <div id="container">
      <div id="content_panel">
        <table>
          <tr>
            <th>Accepted</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Time Submitted</th>
          </tr>
<?php
$conf->getResearchers();
foreach($conf->returnResearchers() as $researcher) {
  $researcherObj = new Researcher($mysqli, $researcher['email']);
  $researcherObj->getResearcher();
  $researcherObj->getPapers();
  foreach($researcherObj->returnPapers() as $paper) {
    $paperObj = new Paper($mysqli, $paper['title']);
    $paperObj->getPaper();
?>
          <tr>
            <td><?php echo ($paperObj->getIsAccepted() == null ? "Pending" : ($paperObj->getIsAccepted() == 0 ? "Denied" : "Accepted")); ?></td>
            <td><a href="index.php?page=paper&title=<?php echo $paperObj->getTitle(); ?>" id="paper_a" title="<?php echo $paperObj->getTitle(); ?>"><?php echo substr($paperObj->getTitle(), 0, 50)." . . ."; ?></a></td>
            <td><?php echo $researcherObj->getLastName().", ".$researcherObj->getFirstName(); ?></td>
            <td><?php echo $paperObj->getWhenSubmitted(); ?></td>
          </tr>
<?php
  }
}
?>
        </table>
      </div>
      <div id="content_view_panel" hidden>
        <div id="pdf_container">
          <embed id="paper_pdf" src="" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
        </div>
        <div id="abstract_container">
          <p id="paper_abstract">

          </p>
        </div>
      </div>
      <div id="content_view_more_panel" hidden>

      </div>
    </div>
