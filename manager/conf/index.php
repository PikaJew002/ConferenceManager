    <div id="container">
      <div id="control_panel">
        <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index">View Conference Info</a>
        <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index&edit=true">Edit Conference Info</a>
      </div>
      <div id="content_panel">
        <p>
          <?php if(!empty($edit)) {
            /* execute/echo the following block if the conference is being edited */ ?>
          <form action="conference.php" method="post">
          Name: <br>
            <input type="text" name="new_name" size="30" value="<?php echo $conf['name']; ?>">
            <input type="hidden" name="old_name" value="<?php echo $conf['name']; ?>"><br>
          Location: <br>
            <textarea name="new_location"><?php echo $conf['location']; ?></textarea>
            <input type="hidden" name="old_location" value="<?php echo $conf['location']; ?>"><br>
          Start Date: <br>
            <input type="date" name="new_start_date" value="<?php echo $conf['date_start']; ?>">
            <input type="hidden" name="old_start_date" value="<?php echo $conf['date_start']; ?>"><br>
          End Date: <br>
            <input type="date" name="new_end_date" value="<?php echo $conf['date_end']; ?>">
            <input type="hidden" name="old_end_date" value="<?php echo $conf['date_end']; ?>"><br><br>
            <input type="submit" name="edit_conference" value="Submit Changes"><br>
            <?php echo $msg; ?>
          </form>
          <?php } else {
            $startDate = explode("-", $conf['date_start']);
            $endDate = explode("-", $conf['date_end']);
          /* execute/echo the following block if the conference is not being edited */ ?>
          Name: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $conf['name']; ?></span><br>
          Location: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $conf['location']; ?></span><br>
          Start Date: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $startDate[1]."/".$startDate[2]."/".$startDate[0]; ?></span><br>
          End Date: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $endDate[1]."/".$endDate[2]."/".$endDate[0]; ?></span><br>
          <?php } ?>
        </p>
      </div>
    </div>
