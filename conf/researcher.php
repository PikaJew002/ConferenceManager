    <div id="container">
      <div id="content_panel">
        <?php if(!empty($registered)) { ?>
          <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
            Registration successful! Submit your paper for review as soon as possible.
          </p>
        <?php } else { ?>
          <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
            Register as an researcher for the <?php echo $conf->getName(); ?> here!<br>
            After registering, you'll be able to submit papers to present at the
            conference, pending review and approval.
          </p>
        <?php } ?>
        <form action="conference.php" method="post"<?php echo (!empty($registered) ? " hidden" : ""); ?>>
          <input type="hidden" name="conf_name" value="<?php echo $conf->getName(); ?>">
          <input type="hidden" name="page_name" value="<?php echo $page; ?>">
          <div id="content_attendee" style="float: left; margin: 10px; width: 250px;">
            <h2>Researcher Information</h2>
            Email: <br>
            <input type="text" name="email" maxlength="255"<?php echo ($_POST['register_researcher'] ? " value=\"".$_POST['email']."\"" : ""); ?>><br>
            Password: <br>
            <input type="password" name="password"><br>
            Confirm password: <br>
            <input type="password" name="confirm_password"><br>
            First name: <br>
            <input type="text" name="first_name" maxlength="50"<?php echo ($_POST['register_researcher'] ? " value=\"".$_POST['first_name']."\"" : ""); ?>><br>
            Last name: <br>
            <input type="text" name="last_name" maxlength="50"<?php echo ($_POST['register_researcher'] ? " value=\"".$_POST['last_name']."\"" : ""); ?>><br>
            Phone (optional): <br>
            <input type="text" name="phone" maxlength="11"<?php echo ($_POST['register_researcher'] ? " value=\"".$_POST['phone']."\"" : ""); ?>><br>
            <input type="submit" name="register_researcher"><br>
            <?php echo $msg; ?>
          </div>
        </form>
      </div>
    </div>
