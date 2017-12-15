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

$admin =  new Admin($mysqli, $_SESSION['id']);
$admin->getAdmin();# get admin user data from session

if($_GET['name']) {
  $conf = new Conference($mysqli, $_GET['name']);
  $conf->getConference();
} else if($_POST['name']) {
  $conf = new Conference($mysqli, $_POST['name']);
  $conf->getConference();
}
if($_GET['page']) {
  $page = $_GET['page']; # get page to include from URL
} else if($_POST['page']) {
  $page = $_POST['page']; # get page to include from form submission
}
if($_GET['edit']) {
  $edit = $_GET['edit']; # is the conference being edited?
}
$msg = ""; # default: there are not error messages

/******* if the save changes/edit_conference submit button was pressed *******/
#  In this case, the conference name, page, nor edit are not set via url, need to be set manually if validation is not passed or update query unsuccessful
if($_POST['edit_conference']) {
  #check for any empty fields
  if(!empty($_POST['new_name']) && !empty($_POST['new_location']) && !empty($_POST['new_start_date']) && !empty($_POST['new_end_date'])) {
    #check if name is changed
    $newName = $mysqli->real_escape_string($_POST['new_name']);
    $newLocation = $mysqli->real_escape_string($_POST['new_location']);
    $newStartDate = $mysqli->real_escape_string($_POST['new_start_date']);
    $newEndDate = $mysqli->real_escape_string($_POST['new_end_date']);
    $oldName = $_POST['old_name'];
    $email = $_SESSION['id'];
    if($_POST['old_name'] != $_POST['new_name']) {
      $query = "SELECT * from conferences WHERE name=\"".$mysqli->real_escape_string($_POST['new_name'])."\" AND admin_email=\"".$_SESSION['id']."\"";
      $results = $mysqli->query($query);
      #check if new name is unused
      if($results->num_rows == 0) {
        $updateQuery = "UPDATE conferences SET name='$newName', location='$newLocation', date_start='$newStartDate', date_end='$newEndDate' WHERE name='$oldName' AND admin_email='$email'";
        $update = $mysqli->query($updateQuery);
        if($update) {
          header("Location: conference.php?name=".$newName."&page=index");
        }
      } else {
        $msg = "The new name you gave for the conference is already in use! Please choose another one.";
      }
    } else {
      $updateQuery = "UPDATE conferences SET location='$newLocation', date_start='$newStartDate', date_end='$newEndDate' WHERE name='$oldName' AND admin_email='$email'";
      $update = $mysqli->query($updateQuery);
      if($update) {
        header("Location: conference.php?name=".$newName."&page=index");
      }
    }
  } else {
    $msg = "Make sure all fields are filled in (this includes starting and ending dates)!";
  }
  $page = "index";
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name=\"".$mysqli->real_escape_string($_POST['old_name'])."\"")->fetch_assoc(); # get conference data from database from URL conference name
  $edit = "true";
}

if($_POST['accept_paper']) {
  $paper = new Paper($mysqli, $_POST['title']);
  $paper->getPaper();
  if($paper->updatePaper("", "", "", (isset($_POST['is_accepted']) ? 1 : 0))) {
    $msg = "Paper acceptance choice has been saved.";
  } else {
    $msg = "Datebase error: update paper.";
  }
}

if($_POST['authenticate_reviewer']) {
  $reviewer = new Reviewer($mysqli, $_POST['email']);
  $reviewer->getReviewer();
  if($reviewer->updateReviewer("", "", "", "", "", 1)) {
    $msg = "Reviwer authenticated.";
  } else {
    $msg = "Database error: update reviwer, authentication.";
  }
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
  <link rel="stylesheet" href="style.conference.css" type="text/css" />
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
    <h1><?php echo $conf->getName(); ?></h1>
    <p>
      <em>Hello, <?php echo $admin->getFirstName(); ?>.</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="conference.php?name=<?php echo $conf->getName(); ?>&page=index">Overview</a>
      <a href="conference.php?name=<?php echo $conf->getName(); ?>&page=papers">Papers Submitted</a>
      <a href="conference.php?name=<?php echo $conf->getName(); ?>&page=reviewers">Paper Reviewers</a>
      <a href="index.php">Back to Conferences</a>
    </div>
    <div id="content">
<?php
if($page) {
	if(!strpos($page,".")&&!strpos($page,"/")) {
		if(file_exists("conf/".$page.".php")) {
			include("conf/".$page.".php");
		} else {
			echo "Sorry, that page does not exist.<br />";
		}
	} else {
		echo "Not allowed!";
	}
} else {
	include("conf/index.php");
}
?>
    </div>
  </div>
</div>
</body>
</html>
