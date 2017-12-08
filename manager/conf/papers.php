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
            <td><button type="button" id="paper_link" onclick="getPaperInfo()">View Paper</button></td>
            <td><a id="paper_a" title="<?php echo $row['path']; ?>"><?php echo substr($row['title'], 0, 50)." . . ."; ?></a></td>
            <td><?php echo $author['last_name'].", ".$author['first_name']."\n"; ?></td>
            <td><?php echo $row['datetime_submitted']."\n"; ?></td>
          </tr>
<?php } ?>
        </table>
      </div>
      <div id="content_view_panel" hidden>
        <embed id="paper_pdf" src="" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html"><br>
        This goes under the pdf.
      </div>
      <div id="content_view_more_panel" hidden>

      </div>
    </div>
    <script type="text/javascript">
    document.getElementById("paper_link").addEventListener("click", function() {
      getPaperInfo();
    }, false);
    </script>
