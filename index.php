<?php
session_start();
$page = $_GET['page'];
require("inc/conn.php"); #  Database connection file

# Class definition files
require("classes/Login.php");
require("classes/Admin.php");
require("classes/Attendee.php");
require("classes/Card.php");
require("classes/Conference.php");
require("classes/Researcher.php");
require("classes/Reviewer.php");
require("classes/Paper.php");
require("classes/Review.php");


if($_POST['login']) {
  # check for empty fields
  if(!empty($_POST['email']) && !empty($_POST['password'])) {
    # check for valid email and password
    if((Login::isValidEmail($_POST['email'])) && (Login::isValidPassword($_POST['password']))) {
      $user = new Login($mysqli, $_POST['user_type'], $_POST['email'], $_POST['password']); # initialize new Login object
      # check if email exists
      if($user->doesExist()) {
        # check if email and password match
        if($user->isLoggedIn()) {
          if($_POST['user_type'] == "admin_users") { #  if admin, login successful
            $_SESSION['id'] = $user->getEmail();
            header("Location: manager/index.php");
          } else if($_POST['user_type'] == "reviewers") { # if rveviewer, check authentication status
            $reviewer = new Reviewer($mysqli, $user->getEmail());
            $reviewer->getReviewer();
            if($reviewer->getIsAuth() == 1) { # if reviewer is authenticated, login successful
              $_SESSION['id'] = $user->getEmail();
              header("Location: reviewer/index.php");
            } else {
              header("Location index.php?login&error_msg=not_auth");
            }
          } else { # (else) if researcher, login successful
            $_SESSION['id'] = $user->getEmail();
            header("Location: researcher/index.php");
          }
        } else {
          header("Location: index.php?page=login&error_msg=email_password_no_match");
        }
      } else {
        header("Location: index.php?page=login&error_msg=email_not_found");
      }
    } else {
      header("Location: index.php?page=login&error_msg=email_or_password_not_valid");
    }
  } else {
    header("Location: index.php?page=login&error_msg=fields_empty");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<!-- meta -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="Description" content="description" />
  <meta name="Keywords" content="keywords" />
  <meta name="robots" content="all, follow" />
<!-- title -->
  <title>Conference Manager</title>
<!-- css -->
  <link rel="stylesheet" href="style.css" type="text/css" />
  <?php
  if($page) {
    if(!strpos($page,".")&&!strpos($page,"/")) {
      if(file_exists("inc/".$page.".php")) {
        echo "<link rel=\"stylesheet\" href=\"inc/style.".$page.".css\" type=\"text/css\" />\n";
      }
    }
  } else {
    echo "<link rel=\"stylesheet\" href=\"inc/style.index.css\" type=\"text/css\" />\n";
  }
  ?>
</head>
<body>
<div id="main">
  <div id="header">
    <h1>Conference Manager</h1>
    <p>
      <em>Excellence in conference management since like a week ago</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="?page=index">Home</a>
      <a href="?page=conferences">View Conferences</a>
      <a href="?page=login">Login</a>
    </div>
    <div id="content">
<?php
if($page) {
	if(!strpos($page,".")&&!strpos($page,"/")) {
		if(file_exists("inc/".$page.".php")) {
			include("inc/".$page.".php");
		} else {
			echo "Sorry, that page does not exist.<br />";
		}
	} else {
		echo "Not allowed!";
	}
} else {
	include("inc/index.php");
}
?>
    </div>
  </div>
</div>
</body>
</html>
