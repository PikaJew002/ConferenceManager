<?php
  if($_POST['login']) {
    #validate login fields
    if(!empty($_POST['email']) && !empty($_POST['passwd'])) {
      #check login credentials
    } else {
      $errorMsg = "";
      header("Location: ../index.php?page=login&error_msg=fields_empty");
    }
  }
?>
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
          <form action="inc/login.php" method="post">
            Email<br />
            <input type="text" name="email" /><br />
            Password<br />
            <input type="password" name="passwd" /><br />
            <input type="submit" name="login" value="Submit" />
          </form>
          <?php
          if($_GET['error_msg']) {
            if($_GET['error_msg'] == "fields_empty") {
              echo "<p>You have empty fields! Enter your email and password before pressing submit.</p>";
            }
          }
          ?>
        </p>
      </div>
    </div>
  </div>
</div>
