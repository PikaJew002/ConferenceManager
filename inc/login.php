      <div id="container">
        <div id="header_box">
          <div id="content">
            <h1>Already Have an Account With Us?</h1>
            <p>
              Use the login form below to login and get to managing!
            </p>
            <p>
              If you are looking to register as an attendee, researcher, or
              reviewer for a conference, head to the
              <a href="?page=conferences">View Conferences</a> page and click on
              your desired conference.
            </p>
            <p>
              If you are interested in purchasing a copy of the Conference Manager
              software, please send an email to
              <a href="mailto:bestinthecs@koolschool.edu">Dr. Chang</a>
              and ask about his students awesome software.
            </p>
          </div>
        </div>
        <div id="sub_container">
          <div class="sub_box">
            <div class="content">
              <h2>Login</h2>
              <p>
                <form action="index.php" method="post">
                  Email<br>
                  <input type="text" name="email"><br>
                  Password<br>
                  <input type="password" name="password"><br>
                  I am an
                  <select name="user_type">
                    <option value="researchers">researcher</option>
                    <option value="reviewers">reviewer</option>
                    <option value="admin_users">administrator</option>
                  </select>
                  <input type="submit" name="login" value="Login">
                </form>
<?php
if($_GET['error_msg']) {
  if($_GET['error_msg'] == "fields_empty") {
?>
                <p>
                  You have empty fields! Enter your email and password before pressing submit.
                </p>
<?php
  } else {
    echo $_GET['error_msg'];
  }
}
?>
              </p>
            </div>
          </div>
        </div>
      </div>
