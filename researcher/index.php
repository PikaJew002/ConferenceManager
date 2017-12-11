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
if($researcher->getResearcher()) {

}
if($_GET['page']) {
  $page = $_GET['page']; # get page to include from URL
}
if($_GET['edit']) {
  $edit = $_GET['edit']; # is something being edited?
}
$msg = ""; # default: there are not error messages

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
  $page = "papers";
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name=\"".$mysqli->real_escape_string($_POST['old_name'])."\"")->fetch_assoc(); # get conference data from database from URL conference name
  $edit = "true";
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
    <h1><?php echo $researcher->getConfName(); ?></h1>
    <p>
      <em>Hello, <?php echo $researcher->getFirstName(); ?>.</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="index.php?page=index">Papers</a>
      <a href="index.php?page=papers">Submit Paper</a>
      <a href="index.php?page=reviewers">Profile</a>
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
