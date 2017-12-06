    <div id="container">
      <div id="control_panel">
        <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index">View Conference Info</a>
        <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index&edit=true">Edit Conference Info</a>
      </div>
      <div id="content_panel">
        <p>
          <?php if($_GET['edit'] && $_GET['edit'] == "true") {
            /* execute/echo the following block if the conference is being edited */ ?>
          <form action="" method="post">
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
            <input type="submit" name="edit_conference" value="Submit Changes">
          </form>
          <?php } else {
            $startDate = explode("-", $conf['date_start']);
            $endDate = explode("-", $conf['date_end']);
          /* execute/echo the following block if the conference is not being edited */ ?>
          Name: <br>
            <?php echo $conf['name']; ?><br>
          Location: <br>
            <?php echo $conf['location']; ?><br>
          Start Date: <br>
            <?php echo $startDate[1]."/".$startDate[2]."/".$startDate[0]; ?><br>
          End Date: <br>
            <?php echo $endDate[1]."/".$endDate[2]."/".$endDate[0]; ?><br>
          <?php } ?>
        </p>
      </div>
    </div>
