<?php
$hasPapers = $reseacher->getPapers();
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
        <?php foreach ($researcher->papers as $paper) { ?>
        ?>
        <tr>
          <td><button type="button" id="paper_link" onclick="getPaperInfo()">View Paper</button><p id="paper_abstract" hidden><?php echo $paper['abstract']; ?></p></td>
          <td><a id="paper_a" title="<?php echo "../".$paper['path']; ?>"><?php echo substr($paper['title'], 0, 50)." . . ."; ?></a></td>
          <td><?php echo ($paper['is_accepted'] == null ? "Pending" : ($paper['is_accepted'] == 0 ? "No" : "Yes" )); ?></td>
          <td><?php echo $paper['when_submitted']."\n"; ?></td>
        </tr>
        <?php } ?>
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
    </div>
