<div id="container">
  <div id="control_panel">
    <a href="index.php?page=profile">View Profile</a>
    <a href="index.php?page=profile&edit=true">Edit Profile</a>
  </div>
  <div id="content_panel">
    <p>
      <?php if($edit) {
        /* execute/echo the following block if the researchers profile is being edited */ ?>
        <table>
          <tr>
            <form action="index.php" method="post">
            <td>
              Email: <br>
              <input type="text" name="new_email" size="30" maxlength="255" value="<?php echo ($_POST['update_admin_email'] ? $_POST['new_email'] : $admin->getEmail()); ?>"><br>
            </td>
            <td style="vertical-align: bottom;">
              <input type="submit" name="update_admin_email" value="Update Email">
            </td>
            </form>
          </tr>
          <tr>
            <form action="index.php" method="post">
            <td>
              Current Password: <br>
                <input type="password" name="old_password" size="30" maxlength="30"><br>
              New Password: <br>
                <input type="password" name="new_password" size="30" maxlength="30"><br>
              Confirm New Password: <br>
                <input type="password" name="confirm_new_password" size="30" maxlength="30"><br>
            </td>
            <td style="vertical-align: bottom;">
              <input type="submit" name="change_admin_password" value="Change Password">
            </td>
            </form>
          </tr>
          <tr>
            <form action="index.php" method="post">
            <td>
              First Name: <br>
                <input type="text" name="new_first_name" size="30" maxlength="50" value="<?php echo ($_POST['update_admin_profile'] ? $_POST['new_first_name'] : $admin->getFirstName()); ?>"><br>
              Last Name: <br>
                <input type="text" name="new_last_name" size="30" maxlength="50" value="<?php echo ($_POST['update_admin_profile'] ? $_POST['new_last_name'] : $admin->getLastName()); ?>"><br>
            </td>
            <td style="vertical-align: bottom;">
              <input type="submit" name="update_admin_profile" value="Update Profile">
            </td>
            </form>
          </tr>
        </table>
      <?php echo $msg; ?>
      <?php } else {
      /* execute/echo the following block if the researchers profile is not being edited */ ?>
      Email: <br>
        <span style="background-color: white; padding: 1px;"><?php echo $admin->getEmail(); ?></span><br>
      First Name: <br>
        <span style="background-color: white; padding: 1px;"><?php echo $admin->getFirstName(); ?></span><br>
      Last Name: <br>
        <span style="background-color: white; padding: 1px;"><?php echo $admin->getLastName(); ?></span><br>
        <?php echo $msg; ?>
      <?php } ?>
    </p>
  </div>
</div>
