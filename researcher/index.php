<?php
session_start();
require("inc/conn.php"); # database connection required
require("inc/auth.php"); # this is a protected page, must be logged in

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

$researcher = new Researcher($mysqli, $_SESSION['id']);
$researcher->getResearcher();
if($_GET['page']) {
  $page = $_GET['page']; # get page to include from URL
}
if($_GET['edit']) {
  $edit = $_GET['edit']; # is something being edited?
}
#$msg = ""; # default: there are not error messages

/******* if a submit button was pressed *******/
#  In case of any form submission,
if($_POST['upload_paper']) {
  # check for any empty fields
  if(!empty($_POST['title']) && !empty($_POST['abstract'])) {
    # check title isn't taken
    $paper = new Paper($mysqli, $_POST['title'], $_SESSION['id'], $_POST['abstract'], "papers/".md5($_POST['title']).".pdf");
    if(!$paper->getPaper()) {
      # upload file
      if(is_uploaded_file($_FILES['paper']['tmp_name'])) {
        $fileName = "../papers/".md5($_POST['title']).".pdf";
        if(move_uploaded_file($_FILES['paper']['tmp_name'], $fileName)) {
          if($paper->addPaper()) {
            $uploaded = true;
            $msg = "Paper was submitted and uploaded successfully!";
          } else {
            $msg = "Database error. Check error logs.";
          }
        } else {
          $msg = "File couldn't be moved.";
        }
      } else {
        $msg = "File was not uploaded. Please try again.";
      }
    } else {
      $msg = "A paper already exists with that title. Have you already submitted this paper before?";
    }
  } else {
    $msg = "Make sure all fields are filled in!";
  }
  $page = "index";
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name=\"".$mysqli->real_escape_string($_POST['old_name'])."\"")->fetch_assoc(); # get conference data from database from URL conference name
  $edit = "true";
}

if($_POST['update_researcher']) {
  $page = "profile";
  $edit = true;
  $researcher = new Researcher($mysqli, $_SESSION['id']);
  $researcher->getResearcher();
  #  Email is changed
  if(!empty($_POST['new_email'])) {
    #  Email is not the same
    if($_POST['new_email'] != $_POST['old_email']) {
      #  Check if new email is not taken
      $checkReseacher = new Researcher($mysqli, $_POST['new_email']);
      if(!$checkReseacher->getResearcher()) {
        # Update email
        $reseacher->updateResearcher($_POST['new_email']);
        $msg = "Email updated.";
      } else {
        $msg = "The new email is already in use. Please choose another one.";
      }
    }
  }
  #  Password fields are all filled
  if(!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])) {
    # Check that new password and confirm new password match
    if($_POST['new_password'] == $_POST['confirm_new_password']) {
      # Check that old password matches current password
      if(password_verify($_POST['old_password'], $this->getPasswordHash())) {
        # update password
        $reseacher->updateResearcher("", password_hash($_POST['new_password'], PASSWORD_DEFAULT));
        $msg = "Password updated.";
      } else {
        $msg = $msg."<br>\nThe current password you gave doesn't match the database.";
      }
    } else {
      $msg = $msg."<br>\nThe new password and confirm new password do not match.";
    }
  }
  $researcher->updateResearcher("", "", $_POST['new_first_name'], $_POST['new_last_name'], $_POST['new_phone']);
}

if($_POST['cancel']) {
  header("Location: index.php?page=index");
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
  <style>
  table, th, tr, td {
    padding: 10px;
  }
  </style>
<!-- javascript -->
  <script src="functions.js" type="text/javascript"></script>
</head>
<body>
<div id="main">
  <div id="header">
    <h1><?php echo $researcher->getConfName(); ?></h1>
    <p>
      <em>Hello, <?php echo $researcher->getFirstName(); ?>.</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="index.php?page=index">View Papers</a>
      <a href="index.php?page=submitpaper">Submit Paper</a>
      <a href="index.php?page=profile">Profile</a>
      <a href="index.php?page=logout">Logout</a>
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
