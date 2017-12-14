<?php
session_start();
require("inc/conn.php"); # this is a protected page, must be logged in
require("inc/auth.php"); # database connection required

# Class definition files
require("../classes/Login.php");
require("../classes/Admin.php");
require("../classes/Attendee.php");
require("../classes/Card.php");
require("../classes/Conference.php");
require("../classes/Researcher.php");
require("../classes/Reviewer.php");
require("../classes/Paper.php");
require("../classes/Review.php");

$admin = new Admin($mysqli, $_SESSION['id']); # get admin user data from session
$admin->getAdmin();
$page = $_GET['page']; # gets the page to include
$content = $_GET['content'];
if($_GET['edit']) {
  $edit = true;
}

/******* if the create conference submit button was pressed *******/
/*
if($_POST['create_conference']) {
  #check for empty fields
  if(!empty($_POST['name']) && !empty($_POST['location']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
    $confName = $mysqli->real_escape_string($_POST['name']);
    $check = $mysqli->query("SELECT * FROM conferences WHERE name='$confName'");
    #check that conference name is not already in use
    if($check->num_rows == 0) {
      $admin = $userData['email'];
      $confLocal = $mysqli->real_escape_string($_POST['location']);
      $dateStart = $_POST['start_date'];
      $dateEnd = $_POST['end_date'];
      $query = "INSERT INTO conferences (name, admin_email, location, date_start, date_end) VALUES ('$confName', '$admin', '$confLocal', '$dateStart', '$dateEnd')";
      #if query is successful, redirect to conference page
      if($result = $mysqli->query($query)) {
        header("Location: conference.php?name=".$confName);
      } else {
        $content = "create";
        $msg = "Database error. Could not insert a new conference.";
      }
    } else {
      $content = "create";
      $msg = "There is already a conference with that name. Please choose another.";
    }
  } else {
    $content = "create";
    $msg = "Make sure all your fields are filled in (including starting an ending dates)!";
  }
} else {
  $msg = "";
}
*/

if($_POST['update_admin_email']) {
  #  Email field is not empty
  if(!empty($_POST['new_email'])) {
    #  Email is not the same
    if($_POST['new_email'] != $_SESSION['id']) {
      #  Check if new email is not taken
      $checkAdmin = new Admin($mysqli, $_POST['new_email']);
      if(!$checkAdmin->getAdmin()) {
        # Update email
        if($admin->updateAdmin($_POST['new_email'])) {
          $_SESSION['id'] = $_POST['new_email'];
          $msg = "Email updated.";
        } else {
          $msg = "Database error: email.";
        }
      } else {
        $msg = "That email is already in use. Please choose another one.";
      }
    } else {
      $msg = "Your email was not updated.";
    }
  }
  $page = "profile";
  $edit = true;
}

if($_POST['change_admin_password']) {
  #  Password fields are all filled
  if(!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])) {
    # Check that new password and confirm new password match
    if($_POST['new_password'] == $_POST['confirm_new_password']) {
      # Check that old password matches current password
      if(password_verify($_POST['old_password'], $admin->getPasswordHash())) {
        # update password
        if($admin->updateAdmin("", $_POST['new_password'])) {
          $msg = "Password changed.";
        } else {
          $msg = "Database error: password.";
        }
      } else {
        $msg = "The current password you gave doesn't match the database.";
      }
    } else {
      $msg = "The new password and confirm new password do not match.";
    }
  }
  $page = "profile";
  $edit = true;
}

if($_POST['update_admin_profile']) {
  if(!empty($_POST['new_first_name']) && !empty($_POST['new_last_name'])) {
    if($admin->updateAdmin("", "", $_POST['new_first_name'], $_POST['new_last_name'], $_POST['new_phone'])) {
      $msg = "Profile updated.";
    } else {
      $msg = "Database error: profile.";
    }
  }
  $page = "profile";
  $edit = true;
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
  <!-- javascript -->
    <script src="functions.js" type="text/javascript"></script>
</head>
<body>
<div id="main">
  <div id="header">
    <h1>Conference Manager</h1>
    <p>
      <em>Welcome, <?php echo $admin->getFirstName(); ?>. Let's get to managing!</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="?page=index">Conferences</a>
      <a href="?page=profile">Profile</a>
      <a href="?page=logout">Logout</a>
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
