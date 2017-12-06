    <div id="container">
      <div id="conferences">
<?php
$query = "SELECT name FROM conferences WHERE admin_email=\"".$_SESSION['id']."\"";
$result = $mysqli->query($query);
if($result->num_rows >= 1) {
  while($row = $result->fetch_assoc()) {
    echo "\t\t\t\t<a href=\"conference.php?name=".$row['name']."\">".$row['name']."</a>\n";
  }
}
?>
        <a href="?content=create">Create Conference</a>
      </div>
      <div id="info">
<?php if($content && $content == "create" ) { ?>
        <form action="index.php" method="post">
          Conference Name<br>
          <input type="text" name="name" size="30"<?php if($_POST['create_conference']) { echo " value=\"".$_POST['name']."\""; } ?>><br>
          Location<br>
          <textarea name="location"><?php if($_POST['create_conference']) { echo $_POST['location']; } ?></textarea><br>
          Start Date<br>
          <input type="date" name="start_date"<?php if($_POST['create_conference']) { echo " value=\"".$_POST['start_date']."\""; } ?>><br>
          End Date<br >
          <input type="date" name="end_date"<?php if($_POST['create_conference']) { echo " value=\"".$_POST['end_date']."\""; } ?>><br>
          <input type="submit" name="create_conference" value="Create Conference">
<?php
if($msg != "") {
  echo "\t\t  <p>".$msg."</p>\n";
}
?>
        </form>
<?php } else { ?>
        <p>
          This page shows all of the conferences you are currently managing on the left.
          If you need to create a new conference, click "Create Conference" and fill out the form.
        </p>
<?php } ?>
      </div>
    </div>
