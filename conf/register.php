    <div id="container">
      <div id="content_panel" style="float: none;">
        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
          Register as an attendee for the <?php echo $conf['name']; ?> here!
        </p>
        <form action="conference.php" method="post"<?php echo (!empty($registered) ? " hidden" : ""); ?>>
          <input type="hidden" name="conf_name" value="<?php echo $conf['name']; ?>">
          <input type="hidden" name="page_name" value="<?php echo $page; ?>">
          <div id="content_attendee" style="float: left; margin: 10px; width: 250px;">
            <h2>Personal Information</h2>
            Email: <br>
            <input type="text" name="email" maxlength="255"<?php echo ($_POST['register_attendee'] ? " value=\"".$_POST['email']."\"" : ""); ?>><br>
            First name: <br>
            <input type="text" name="first_name" maxlength="50"<?php echo ($_POST['register_attendee'] ? " value=\"".$_POST['first_name']."\"" : ""); ?>><br>
            Last name: <br>
            <input type="text" name="last_name" maxlength="50"<?php echo ($_POST['register_attendee'] ? " value=\"".$_POST['last_name']."\"" : ""); ?>><br>
            <?php echo $msg; ?>
          </div>
          <div id="content_card" style="float: left; margin: 10px;">
            <h2>Credit Card Information</h2>
            Card number: <br>
            <input type="text" name="number" maxlength="19"><br>
            Name on card: <br>
            <input type="text" name="name_card" maxlength="100"><br>
            Billing Address: <br>
            <textarea name="billing_address"></textarea><br>
            Expiration date: <br>
            <input type="text" name="exp_date" size="4" maxlength="4"><br>
            Security code: <br>
            <input type="text" name="sec_code" size="3" maxlength="3"><br><br>
            <input type="submit" name="register_attendee" value="Register">
          </div>
        </form>
      </div>
    </div>
