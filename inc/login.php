<?php
  if($_POST['login']) {
    session_start();
    #validate login fields
    if(!empty($_POST['email']) && !empty($_POST['passwd'])) {
      #check login credentials
      $mysqli = new mysqli("localhost", "root", "admin", "conference_manager");
      if($mysqli->connect_error) {
        header("Location: ../index.php?page=login&error_msg=db_conn_fail");
      }
      $email = $mysqli->real_escape_string($_POST['email']);
      $passwd = $mysqli->real_escape_string($_POST['passwd']);
      $result = $mysqli->query("SELECT * FROM conference_admin WHERE email='$email' AND password='$passwd'");
      if($result->num_rows == 1) {
        $_SESSION['id'] = $email;
        header("Location: ../manager/index.php");
      } else {
        header("Location: ../index.php?page=login&error_msg=login_not_success");
      }
    } else {
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
