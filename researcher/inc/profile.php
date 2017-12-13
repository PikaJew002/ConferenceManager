    <div id="container">
      <div id="control_panel">
        <a href="index.php?page=profile">View Profile</a>
        <a href="index.php?page=profile&edit=true">Edit Profile</a>
      </div>
      <div id="content_panel">
        <p>
          <?php if(!empty($edit)) {
            /* execute/echo the following block if the researchers profile is being edited */ ?>
          <form action="index.php" method="post">
          New Email: <br>
            <input type="text" name="new_email" maxlength="255"> <?php  ?><br>
            <input type="hidden" name="old_email" value="<?php echo $researcher->getEmail(); ?>">
          Old Password: <br>
            <input type="password" name="old_password_enter" maxlength="30"><br>
          New Password: <br>
            <input type="password" name="new_password" maxlength="30"><br>
          Confirm New Password: <br>
            <input type="password" name="confirm_new_password" maxlength="30"><br>
          First Name: <br>
            <input type="text" name="new_first_name" maxlength="50" value="<?php echo ($_POST['update_researcher'] ? $_POST['new_first_name'] : $researcher->getFirstName()); ?>"><br>
          Last Name: <br>
            <input type="text" name="new_last_name" maxlength="50" value="<?php echo ($_POST['update_researcher'] ? $_POST['new_last_name'] : $researcher->getLastName()); ?>"><br><br>
            <input type="submit" name="update_researcher" value="Update Profile"> <input type="submit" name="cancel" value="Cancel"><br>
          </form>
          <?php } else {
          /* execute/echo the following block if the researchers profile is not being edited */ ?>
          Email: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $researcher->getEmail(); ?></span><br>
          First Name: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $researcher->getFirstName(); ?></span><br>
          Last Name: <br>
            <span style="background-color: white; padding: 1px;"><?php echo $researcher->getLastName(); ?></span><br>
          <?php } ?>
          <?php echo $msg; ?>
        </p>
      </div>
    </div>
