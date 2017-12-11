<?php
$hasPapers = $researcher->getPapers();
$papers = $researcher->returnPapers();
?>
    <div id="container">
      <div id="content_panel">
        <table<?php echo (!$hasPapers ? " hidden" : ""); ?>>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Accepted</th>
            <th>Date Time Submitted</th>
          </tr>
        <?php foreach ($papers as $key => $paper) { ?>
        <tr>
          <td><button type="button" id="paper_link>" onclick="getPaperInfo('<?php echo $key; ?>')">View Paper</button><p id="paper_abstract_<?php echo $key; ?>" hidden><?php echo $paper['abstract']; ?></p></td>
          <td><a id="paper_<?php echo $key; ?>" title="<?php echo "../".$paper['path']; ?>"><?php echo substr($paper['title'], 0, 50)." . . ."; ?></a></td>
          <td><?php echo ($paper['is_accepted'] == null ? "Pending" : ($paper['is_accepted'] == 0 ? "No" : "Yes" )); ?></td>
          <td><?php echo $paper['when_submitted']."\n"; ?></td>
        </tr>
        <?php } ?>
      </table>
      <?php echo (!$hasPapers ? "You don't have any papers submitted. " : ""); ?>
      </div>
      <div id="content_view_panel" hidden>
        <div id="pdf_container">
          <embed id="paper_pdf" src="" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
        </div>
        <div id="abstract_container">
          <p id="paper_ab">

          </p>
        </div>
      </div>
    </div>
