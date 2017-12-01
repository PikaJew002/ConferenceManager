<?php
if($_POST['create_conference']) {

}
?>
    <div id="container">
      <div id="conferences">
<?php
$query = "SELECT name FROM conferences WHERE admin=\"".$_SESSION['id']."\"";
$result = $mysqli->query($query);
if($result->num_rows >= 1) {
  while($row = $result->fetch_assoc()) {
    echo "\t\t\t\t<a href=\"\">".$row['name']."</a>\n";
  }
}
?>
        <a href="?content=create">Create Conference</a>
      </div>
      <div id="info">
<?php if($_GET['content'] && $_GET['content'] == "create") { ?>
        <form action="inc/index.php" method="post">
          Conference Name<br />
          <input type="text" name="name" /><br />
          Location<br />
          <textarea name="location"></textarea><br />
          Start Date<br />
          <select name="start_year">
<?php
$curYear = date("Y");
for($i = 0; $i < 5; $i++) {
  echo "\t\t\t<option value=\"".($curYear+$i)."\">".($curYear+$i)."</option>\n";
}
?>
          </select>
          <select name="start_month">
<?php
for($i = 1; $i <= 12; $i++) {
  echo "\t\t\t<option value=\"".str_pad($i, 2, "0", STR_PAD_LEFT)."\">".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>\n";
}
?>
          </select>
          <select name="start_day">
<?php
for($i = 1; $i <= 31; $i++) {
  echo "\t\t\t<option value=\"".str_pad($i, 2, "0", STR_PAD_LEFT)."\">".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>\n";
}
?>
          </select>
          End Date<br />
          <select name="end_year">
<?php
$curYear = date("Y");
for($i = 0; $i < 5; $i++) {
  echo "\t\t\t<option value=\"".($curYear+$i)."\">".($curYear+$i)."</option>\n";
}
?>
          </select>
          <select name="end_month">
<?php
for($i = 1; $i <= 12; $i++) {
  echo "\t\t\t<option value=\"".str_pad($i, 2, "0", STR_PAD_LEFT)."\">".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>\n";
}
?>
          </select>
          <select name="end_day">
<?php
for($i = 1; $i <= 31; $i++) {
  echo "\t\t\t<option value=\"".str_pad($i, 2, "0", STR_PAD_LEFT)."\">".str_pad($i, 2, "0", STR_PAD_LEFT)."</option>\n";
}
?>
          </select>
          <br />
          <input type="submit" name="create_conference" value="Create Conference" />
        </form>
<?php } else { ?>
        <p>

        </p>
<?php } ?>
      </div>
    </div>
