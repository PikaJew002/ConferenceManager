<?php
session_start();
require("inc/conn.php"); # database connection required

# Class definition files
require("classes/Login.php");
require("classes/Admin.php");
require("classes/Attendee.php");
require("classes/Card.php");
require("classes/Conference.php");
require("classes/Researcher.php");
require("classes/Reviewer.php");

if(isset($_GET['name'])) {
  $conf = $mysqli->real_escape_string($_GET['name']);
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name='{$conf}'")->fetch_assoc(); # get conference data from database from URL conference name
}
if(isset($_GET['page'])) {
  $page = $_GET['page']; # get page to include from URL
}
$msg = ""; # default: there are not error messages

/******* if the register_attendee submit button was pressed *******/
#  In this case, the conference name nor page are not set via url, need to be set manually if validation is not passed or update query unsuccessful
if($_POST['register_attendee']) {
  # check for empty fields in the personal information section
  if(!empty($_POST['email']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {
    # check for empty fields in the credit card information section
    if(!empty($_POST['number']) && !empty($_POST['name_card']) && !empty($_POST['billing_address']) && !empty($_POST['exp_date']) && !empty($_POST['sec_code'])) {
      # add more validation if time allows
      $attendee = new Attendee($mysqli, $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['conf_name']);
      # check if attendee does not already exist
      if(!$attendee->getAttendee()) {
        # add card to the database
        $card = new Card($mysqli, 0, $_POST['number'], $_POST['name_card'], $_POST['billing_address'], $_POST['exp_date'], $_POST['sec_code']);
        if($card->addCard()) {
          # add attendee to the database
          $attendee = new Attendee($mysqli, $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['conf_name'], $card->getId());
          if($attendee->addAttendee()) {
            $registered = true;
          } else {
            $msg = "Database error when adding the attendee";
          }
        } else {
          $msg = "Database error when adding the card";
        }
      } else {
        $msg = "An attendee with that email, first name, and last name already exists.";
      }
    } else {
      $msg = "You have empty fields in the credit card information section. Make sure all fields are filled in!";
    }
  } else {
    $msg = "You have empty fields in the personal information section. Make sure all fields are filled in!";
  }
  $page = "register";
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name='{$_POST['conf_name']}'")->fetch_assoc(); # get conference data from database from URL conference name
}

if($_POST['register_researcher']) {
  # check for empty required fields
  if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) &&!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
    # add more validation if time allows
    $researcher = new Researcher($mysqli, $_POST['email'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['conf_name'], $_POST['phone']);
    # check if researcher does not already exist
    if(!$researcher->getResearcher()) {
      # check that password and confirm password
      if($_POST['password'] == $_POST['confirm_password']) {
      # add attendee to the database
        if($researcher->addResearcher()) {
          $registered = true;
        } else {
          $msg = "Database error when adding the researcher";
        }
      } else {
        $msg = "The passwords don't match. Make sure your password and confirm passord match.";
      }
    } else {
      $msg = "A researcher with that email already exists.";
    }
  } else {
    $msg = "You have empty required fields. Make sure all required fields are filled in!";
  }
  $page = "researcher";
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name='{$_POST['conf_name']}'")->fetch_assoc(); # get conference data from database from URL conference name
}

if($_POST['register_reviewer']) {
  # check for empty required fields
  if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) &&!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
    # add more validation if time allows
    $reviewer = new Reviewer($mysqli, $_POST['email'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['conf_name'], $_POST['phone']);
    # check if researcher does not already exist
    if(!$reviewer->getReviewer()) {
      # check that password and confirm password
      if($_POST['password'] == $_POST['confirm_password']) {
      # add attendee to the database
        if($reviewer->addReviewer()) {
          $registered = true;
        } else {
          $msg = "Database error when adding the reviewer";
        }
      } else {
        $msg = "The passwords don't match. Make sure your password and confirm passord match.";
      }
    } else {
      $msg = "A reviewer with that email already exists.";
    }
  } else {
    $msg = "You have empty required fields. Make sure all required fields are filled in!";
  }
  $page = "reviewer";
  $conf = $mysqli->query("SELECT * FROM conferences WHERE name='{$_POST['conf_name']}'")->fetch_assoc(); # get conference data from database from URL conference name
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
  <title><?php echo $conf['name']; ?></title>
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
    <h1><?php echo $conf['name']; ?></h1>
  </div>
  <div id="body">
    <div id="nav">
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index">About</a>
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=register">Registration</a>
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=researcher">Researcher</a>
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=reviewer">Reviewer</a>
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=checkin">Checkin</a>
      <a href="index.php?page=conferences">Back to Conferences</a>
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
