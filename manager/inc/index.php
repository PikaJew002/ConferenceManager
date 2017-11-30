<div id="container">
  <div id="conferences">
    <?php
    $query = "SELECT name FROM conferences WHERE admin=\"".$_SESSION['id']."\"";
    $result = $mysqli->query($query);
    if($result->num_rows >= 1) {
      while($row = $result->fetch_assoc()) {
        echo "<a href=\"\">".$row['name']."</a>\n";
      }
    }
    ?>
    <a href="">Create Conference</a>
  </div>
  <div id="info">
  </div>
</div>
