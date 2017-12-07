      <div id="container">
        <div id="header_box">
          <div id="content">
            <h1>Already Have an Account With Us?</h1>
            <p>
              Use the login form below to login and get to managing!
            </p>
            <p>
              If you don't have an account yet, head to the Register page to get started with Conference
              Manager.
            </p>
          </div>
        </div>
        <div id="sub_container">
          <div class="sub_box">
            <div class="content">
              <h2>Login</h2>
              <p>
                <form action="index.php" method="post">
                  Email<br />
                  <input type="text" name="email" /><br />
                  Password<br />
                  <input type="password" name="password" /><br />
                  <input type="submit" name="login" value="Submit" />
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
