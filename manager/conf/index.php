    <div id="container">
      <div id="control_panel">
        <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index">View Conference Info</a>
        <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index&edit=true">Edit Conference Info</a>
      </div>
      <div id="content_panel">
        <p>
          Name: <br />
          <?php if($_GET['edit'] && $_GET['edit'] == "true") { ?>
            <input type="text" name="name" size="30" value="<?php echo $conf['name']; ?>" />
          <?php } else { echo $conf['name']; } ?><br />
          Location: <br />
          <?php if($_GET['edit'] && $_GET['edit'] == "true") { ?>
            <textarea name="location"><?php echo $conf['location']; ?></textarea>
          <?php } else { echo $conf['location']; } ?><br />
          Start Date: <br />
          <?php if($_GET['edit'] && $_GET['edit'] == "true") { ?>
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
          <?php if($_GET['edit'] && $_GET['edit'] == "true") { ?>
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

          <?php } else { echo $conf['name']; } ?><br />
        </p>
      </div>
    </div>
