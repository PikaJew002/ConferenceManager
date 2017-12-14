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

$reviewer = new Reviewer($mysqli, $_SESSION['id']);
$reviewer->getReviewer();
$conference = new Conference($mysqli, $reviewer->getConfName());
$conference->getConference();
if(isset($_GET['name'])) {
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name=\"".$mysqli->real_escape_string($_GET['name'])."\"")->fetch_assoc(); # get conference data from database from URL conference name
}
if(isset($_GET['page'])) {
  $page = $_GET['page']; # get page to include from URL
}
if(isset($_GET['edit'])) {
  $edit = $_GET['edit']; # is the conference being edited?
}
$msg = ""; # default: there are not error messages
$error = false;

/******* if a submit button was pressed *******/
#  In this case,
if(isset($_POST['bid_paper'])) {
  $review = new Review($mysqli, $_POST['title'], $_SESSION['id']);
  if($review->addReview()) {
    header("Location: index.php?");
  } else {
    header("Location: ");
  }
  $page = "index";
}

if($_POST['submit_review']) {
  if(!empty($_POST['score'])) {
    #$recommend = ($_POST['is_recommended'] ? 1 : 0);
    #echo $_POST['score']." ".$recommend." ".time();
    $review = new Review($mysqli, $_POST['title'], $_SESSION['id']);
    $review->getReview();
    $result = $review->updateReview($_POST['score'], ($_POST['is_recommended'] ? "1" : "0"));
    if($result[0]) {
      $msg = "Review Submitted! ".$result[1];
    } else {
      $msg = "Database error! ".$result[1];
    }
  } else {
    $error = true;
    $msg = "Please enter a score before submitted a review.";
  }
  $page = "bids";
  $title = $_POST['title'];
}

if($_POST['update_reviewer_email']) {
  #  Email field is not empty
  if(!empty($_POST['new_email'])) {
    #  Email is not the same
    if($_POST['new_email'] != $_SESSION['id']) {
      #  Check if new email is not taken
      $checkReviewer = new Reviewer($mysqli, $_POST['new_email']);
      if(!$checkReviewer->getReviewer()) {
        # Update email
        if($reviewer->updateReviewer($_POST['new_email'])) {
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

if($_POST['change_reviewer_password']) {
  #  Password fields are all filled
  if(!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])) {
    # Check that new password and confirm new password match
    if($_POST['new_password'] == $_POST['confirm_new_password']) {
      # Check that old password matches current password
      if(password_verify($_POST['old_password'], $this->getPasswordHash())) {
        # update password
        if($reviewer->updateReviewer("", $_POST['new_password'])) {
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

if($_POST['update_reviewer_profile']) {
  if(!empty($_POST['new_first_name']) && !empty($_POST['new_last_name'])) {
    if($reviewer->updateReviewer("", "", $_POST['new_first_name'], $_POST['new_last_name'], $_POST['new_phone'])) {
      $msg = "Profile updated.";
    } else {
      $msg = "Database error: profile.";
    }
  }
  $page = "profile";
  $edit = true;
}

if($_POST['cancel']) {
  header("Location: conference.php?name={$_POST['old_name']}&page=index");
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
    <h1><?php echo $conference->getName(); ?></h1>
    <p>
      <em>Hello, <?php echo $reviewer->getFirstName(); ?>.</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="index.php?page=index">Papers</a>
      <a href="index.php?page=bids">Reviews</a>
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
