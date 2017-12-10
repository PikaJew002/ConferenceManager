    <div id="container">
      <div id="content_panel">
        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
          Register as an attendee for the <?php echo $conf['name']; ?> here!
        </p>
        <form action="conference.php" method="post">
          <div id="content_attendee" style="float: left; margin: 10px;">
            <h2>Personal Information</h2>
            Email: <br>
            <input type="text" name="email" maxlength="255"><br>
            First name: <br>
            <input type="text" name="first_name" maxlength="50"><br>
            Last name: <br>
            <input type="text" name="last_name" maxlength="50"><br>
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
