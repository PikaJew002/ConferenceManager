    <div id="container">
      <div id="content_panel">
        <table>
          <tr>
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
            <td><a href="#" onclick="" title="<?php echo $row['title']; ?>"><?php echo substr($row['title'], 0, 50)." . . ."; ?></a></td>
            <td><?php echo $author['last_name'].", ".$author['first_name']."\n"; ?></td>
            <td><?php echo $row['datetime_submitted']."\n"; ?></td>
          </tr>
<?php } ?>
        </table>
      </div>
      <div id="content_view_panel" hidden>

      </div>
      <div id="content_view_more_panel" hidden>

      </div>
    </div>
