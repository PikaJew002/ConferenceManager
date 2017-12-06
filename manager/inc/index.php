    <div id="container">
      <div id="conferences">
<?php
$query = "SELECT name FROM conferences WHERE admin=\"".$_SESSION['id']."\"";
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
          Conference Name<br />
          <input type="text" name="name"<?php if($_POST['create_conference']) { echo " value=\"".$_POST['name']."\""; } ?> /><br />
          Location<br />
          <textarea name="location"><?php if($_POST['create_conference']) { echo $_POST['location']; } ?></textarea><br />
          Start Date<br />
          <select id="start_year" name="start_year">
<?php
$curYear = date("Y");
for($i = 0; $i < 5; $i++) {
  echo "\t\t\t<option value=\"".($curYear+$i)."\">".($curYear+$i)."</option>\n";
}
?>
          </select>
          <select id="start_month" name="start_month" onchange="setNumDaysStart();">
<?php
for($i = 1; $i <= 12; $i++) {
  echo "\t\t\t<option value=\"".$i."\">".$i."</option>\n";
}
?>
          </select>
          <select id="start_day" name="start_day">
<?php
for($i = 1; $i <= 31; $i++) {
  echo "\t\t\t<option value=\"".$i."\">".$i."</option>\n";
}
?>
          </select><br />
          End Date<br />
          <select id="end_year" name="end_year">
<?php
$curYear = date("Y");
for($i = 0; $i < 5; $i++) {
  echo "\t\t\t<option value=\"".($curYear+$i)."\">".($curYear+$i)."</option>\n";
}
?>
          </select>
          <select id="end_month" name="end_month" onchange="setNumDaysEnd();">
<?php
for($i = 1; $i <= 12; $i++) {
  echo "\t\t\t<option value=\"".$i."\">".$i."</option>\n";
}
?>
          </select>
          <select id="end_day" name="end_day">
<?php
for($i = 1; $i <= 31; $i++) {
  echo "\t\t\t<option value=\"".$i."\">".$i."</option>\n";
}
?>
          </select>
          <br />
          <input type="submit" name="create_conference" value="Create Conference" />
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
