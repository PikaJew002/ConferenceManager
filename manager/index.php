<?php
session_start();
require("inc/auth.php"); # this is a protected page, must be logged in
require("inc/conn.php"); # database connection required
$userData = $mysqli->query("SELECT * FROM admin_users WHERE email=\"".$_SESSION['id']."\"")->fetch_assoc(); # get user data from session
$page = $_GET['page']; # gets the page to include
$content = $_GET['content'];
#if the create conference submit button was pressed
if($_POST['create_conference']) {
  #check for empty fields
  if(!empty($_POST['name']) && !empty($_POST['location'])) {
    $confName = $mysqli->real_escape_string($_POST['name']);
    $check = $mysqli->query("SELECT * FROM conferences WHERE name='$confName'");
    #check that conference name is not already in use
    if($check->num_rows == 0) {
      $admin = $userData['email'];
      $confLocal = $mysqli->real_escape_string($_POST['location']);
      $dateStart = $_POST['start_year'].str_pad($_POST['start_month'], 2, "0", STR_PAD_LEFT).str_pad($_POST['start_day'], 2, "0", STR_PAD_LEFT);
      $dateEnd = $_POST['end_year'].str_pad($_POST['end_month'], 2, "0", STR_PAD_LEFT).str_pad($_POST['end_day'], 2, "0", STR_PAD_LEFT);
      $query = "INSERT INTO conferences (name, admin, location, date_start, date_end) VALUES ('$confName', '$admin', '$confLocal', '$dateStart', '$dateEnd')";
      echo "eh";
      if($result = $mysqli->query($query)) {
        header("Location: conference.php?name="+$confName);
      }
    } else {
      $content = "create";
      $msg = "There is already a conference with that name. Please choose another.";
    }
  } else {
    $content = "create";
    $msg = "Make sure all your fields are filled in!";
  }
} else {
  $msg = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
      <em>Welcome, <?php echo $userData['first_name']; ?>. Let's get to managing!</em>
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
