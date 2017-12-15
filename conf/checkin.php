      <div id="container">
        <div id="content_panel">
<?php if(!empty($registered)) { ?>
            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
              Checkin successful! Enjoy the conference!
            </p>
<?php } else { ?>
            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
              Checkin for the <?php echo $conf->getName(); ?> here!<br>
              After checkin, you'll be able to attend presentations by experts in the field.
            </p>
          <form action="conference.php" method="post">
            <input type="hidden" name="conf_name" value="<?php echo $conf->getName(); ?>">
            <input type="hidden" name="page_name" value="<?php echo $page; ?>">
            <div id="content_attendee" style="float: left; margin: 10px; width: 450px;">
              <h2>Checkin Form For Attendee</h2>
              Email: <br>
              <input type="text" name="email" maxlength="255"<?php echo ($_POST['register_attendee'] ? " value=\"".$_POST['email']."\"" : ""); ?>><br>
              First name: <br>
              <input type="text" name="first_name" maxlength="50"<?php echo ($_POST['register_attendee'] ? " value=\"".$_POST['first_name']."\"" : ""); ?>><br>
              Last name: <br>
              <input type="text" name="last_name" maxlength="50"<?php echo ($_POST['register_attendee'] ? " value=\"".$_POST['last_name']."\"" : ""); ?>><br><br>
              <input type="submit" name="checkin_attendee" value="Checkin"><br>
              <?php echo $msg; ?>
            </div>
          </form>
<?php } ?>
        </div>
      </div>
