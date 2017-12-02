<script>
  function setNumDaysStart() {
    var year = document.getElementById("start_year");
    var month = document.getElementById("start_month");
    var day = document.getElementById("start_day");
    var len = getNumDays(year.value, month.value);
    while (day.options.length) {
      day.remove(0);
    }
    for (var i = 1; i <= len; i++) {
      var option = document.createElement("option");
      option.setAttribute("value", i);
      option.innerHTML = i;
      day.appendChild(option);
    }
  }
  function setNumDaysEnd() {
    var year = document.getElementById("end_year");
    var month = document.getElementById("end_month");
    var day = document.getElementById("end_day");
    var len = getNumDays(year.value, month.value);
    while (day.options.length) {
      day.remove(0);
    }
    for (var i = 1; i <= len; i++) {
      var option = document.createElement("option");
      option.setAttribute("value", i);
      option.innerHTML = i;
      day.appendChild(option);
    }
  }
  function getNumDays(year, month) {
    if(month == 2) {
      if(((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) {
        return 29;
      } else {
        return 28;
      }
    } else if(month == 4 || month == 6 || month == 9 || month == 11) {
      return 30;
    } else {
      return 31;
    }
  }
</script>
    <div id="container">
      <div id="conferences">
<?php
$query = "SELECT name FROM conferences WHERE admin=\"".$_SESSION['id']."\"";
$result = $mysqli->query($query);
if($result->num_rows >= 1) {
  while($row = $result->fetch_assoc()) {
    echo "\t\t\t\t<a href=\"conference.php?name=\"".$row['name'].">".$row['name']."</a>\n";
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

        </p>
<?php } ?>
      </div>
    </div>
