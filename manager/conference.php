<?php
session_start();
require("inc/auth.php");
require("inc/conn.php");
$userData = $mysqli->query("SELECT * FROM admin_users WHERE email=\"".$_SESSION['id']."\"")->fetch_assoc();
$conference = $_GET['name'];
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
  <link rel="stylesheet" href="style.conference.css" type="text/css" />
</head>
<body>
<div id="main">
  <div id="header">
    <h1><?php echo $conference; ?></h1>
    <p>
      <em>Hello, <?php echo $userData['first_name']; ?>. !</em>
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
