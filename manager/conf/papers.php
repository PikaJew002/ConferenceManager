    <div id="container">
      <div id="content_panel">
        <table>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Time Submitted</th>
          </tr>
<?php
$result = $mysqli->query("SELECT * FROM papers WHERE conf_name='{$conf['name']}'");
while($row = $result->fetch_assoc()) {
  $author = $mysqli->query("SELECT * FROM researchers WHERE conf_name='{$conf['name']}' AND email='{$row['author']}'")->fetch_assoc();
?>
          <tr>
            <td><button type="button" id="paper_link" onclick="getPaperInfo()">View Paper</button><p id="paper_abstract" hidden><?php echo $row['abstract']; ?></p></td>
            <td><a id="paper_a" title="<?php echo $row['path']; ?>"><?php echo substr($row['title'], 0, 50)." . . ."; ?></a></td>
            <td><a id=""><?php echo $author['last_name'].", ".$author['first_name']."\n"; ?></a></td>
            <td><?php echo $row['datetime_submitted']."\n"; ?></td>
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
      <div id="content_view_more_panel" hidden>

      </div>
    </div>
